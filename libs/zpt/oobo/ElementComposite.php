<?php
/**
 * =============================================================================
 * Copyright (c) 2010, Philip Graham
 * All rights reserved.
 *
 * This file is part of OO-bo and is licensed by the Copyright holder under the
 * 3-clause BSD License.  The full text of the license can be found in the
 * LICENSE.txt file included in the root directory of this distribution or at
 * the link below.
 * =============================================================================
 *
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
namespace zpt\oobo;

use \zpt\oobo\event\AddElementEvent;

/**
 * This class encapsulates functionality common to elements that are composed of
 * zero or more elements.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
abstract class ElementComposite extends ElementBase {

  /**
   * Constant that tells the add() method to shift the given element into the
   * element's array of child elements.
   */
  const UNSHIFT = false;

  /** The element's child children */
  protected $_elements = array();

  /**
   * Array of object types that can be added to the composite
   */
  protected $_objectTypes = array();

  /**
   * Boolean indicating whether or not text can be added directly to the
   * element.
   */
  protected $_allowText = true;

  /**
   * Transforms the element into a string.
   *
   * @return string
   */
  public function __toString() {
    // Allow implementing classes to perform manipulation (such as adding
    // elements with a required position) immediately prior to output
    $this->onDump();

    $elementStr = self::openTag($this);
    foreach ($this->_elements AS $element) {
      $elementStr .= $element;
    }
    $elementStr.= self::closeTag($this);
    return $elementStr;
  }

  /**
   * Adds an element to the array of child elements.
   *
   * @param mixed The element to add to the array.
   * @param boolean Whether to push or shift the element into the array
   */
  public function add($element, $push = true) {
    if (is_array($element)) {
      foreach ($element AS $elm) {
        $this->add($elm, $push);
      }
      return $this;
    }

    // Non OO-bo objects are simply cast to a string and added as text.
    // Document structure enforcement only applies to OO-bo object instances
    if (is_object($element) && !($element instanceof ElementBase) && !($element instanceof Composite)) {
      return $this->add((string) $element, $push);
    }

    // Allow implementing classes to perform any additional checking, prevent
    // the addition or replace the element being added.
    $event = new AddElementEvent($element);
    $this->onAdd($event);

    // Check if the event has been prevented
    if ($event->prevented()) {
      return $this;
    }

    // Pull the element out of the event in case the implementation has
    // decided to change it
    $element = $event->getElement();

    // This method will throw an exception if it is not a valid element
    self::_checkElement($this, $element);

    if ($push) {
      $this->_elements[] = $element;
    } else {
      array_unshift($this->_elements, $element);
    }

    $return = $event->getReturn();
    if ($return === null) {
      return $this;
    } else {
      return $return;
    }
  }

  /**
   * Get the number of children contained by the element.
   *
   * @return integer
   */
  public function getChildCount() {
    return count($this->_elements);
  }

  /**
   * This method removes all of the element's children.
   */
  public function removeAll() {
    $this->_elements = array();
    return $this;
  }

  /**
   * Intended to be overriden by implementing classes in order to perform any
   * additional checking when an element is added.  If the item being added is
   * not allowed, an exception should be generated using
   * self::invalidElementException(...) and thrown.  If the implementing element
   * wishes to swallow the add, i.e. not add the element but continue
   * processing, it should return boolean false.  This is useful in cases where
   * the implementation wants to defer addition of the element.
   *
   * @param AddElementEvent $event Event object which encapsulates the element
   *   being added and methods for prevent or change the element being added as
   *   well to specify what to return from the add() method invocation that
   *   resulted in the event.
   */
  protected function onAdd(AddElementEvent $event) {
  }

  /**
   * Intended to be overriden by implementing classes in order to perform any
   * necessary work immediately prior to output, e.g. adding elements that have
   * a required position in the element's children.
   */
  protected function onDump() {
  }

  /**
   * This function checks that any objects added to the composite are of
   * the right type.
   *
   * @param ElementComposite $parent Parent element
   * @param mixed Child $child element
   */
  protected static function _checkElement(ElementComposite $parent, $child) {
    // If the child is not an object make sure that non-object's can be added to
    // the composite
    if (!is_object($child)) {
      if (!$parent->_allowText) {
        $msg = 'Text cannot be added directly to a ' . get_class($parent)
          . ' object';
        throw self::invalidElementException($msg);
      }
      return;
    }

    // Make sure that object's can be added to the composite
    if ($parent->_objectTypes === null || count($parent->_objectTypes) === 0) {
      $msg = 'Objects cannot be added to a '. get_class($parent) . ' element';
      throw self::invalidElementException($msg);
    }

    // Handle zpt\oobo\Composite implementations
    if ($child instanceof Composite) {
      if (in_array($child->getElementType(), $parent->_objectTypes)) {
        return;
      }
    }

    // Check if the object is a valid type for the composite
    foreach ($parent->_objectTypes AS $validType) {
      if ($child instanceof $validType) {
        return;
      }
    }

    $msg = 'Only objects of type '. implode(',', $parent->_objectTypes)
      . ' can be added to a ' .  get_class($parent) . ' object';
    throw self::invalidElementException($msg);
  }

  /**
   * Build a new invalid element exception.  This is to be used whenever an
   * element is added to another element whose content model does not accept the
   * given element.
   *
   * @param string $msg
   * @return Exception
   */
  protected static function invalidElementException($msg) {
    return new Exception($msg);
  }

  /**
   * Apply the given function to all of the children of the given element.
   *
   * The given function must accept a single parameter, which will be a child
   * object and return a boolean indicating whether or not the traversal should
   * continue.
   *
   * The traversal is breadth-first.
   *
   * @param ElementComposite $elm The element to traverse
   * @param function $fn
   */
  protected static function visit(ElementComposite $elm, $fn) {
    self::_visitBreadthFirst($elm, $fn);
  }

  private static function _visitBreadthFirst(ElementComposite $elm, $fn) {
    $queue = array($elm);

    while (count($queue) > 0) {
      $node = array_shift($queue);
      if (!$fn($node)) {
        break;
      }

      if ($node instanceof ElementComposite) {
        array_merge($queue, $node->_elements);
      }
    }
  }
}
