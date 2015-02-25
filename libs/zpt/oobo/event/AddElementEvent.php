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
namespace zpt\oobo\event;

/**
 * This class encapsulates an event for when an element is added to an
 * {@link zpt\oobo\ElementComposite} implementation.  The event is dispatched by
 * ElementComposite to the implementation and provides capabilities to prevent
 * the element from being added and replace the element being added.
 *
 * Preventing the element from being added is useful when the element has a
 * required order in it's parent so addition is deferred until the element is
 * output.
 *
 * Replacing the element is useful for providing an interface that automatically
 * wraps text in an element, as with &lt;ol&gt;, &lt;ul&gt; wrapping text in
 * &lt;li&gt; elements or &lt;select&gt; wrapping text in &lt;option&gt;
 * elements.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class AddElementEvent {

  private $_element;
  private $_prevented = false;
  private $_return;

  public function __construct($elm) {
    $this->setElement($elm);
  }

  public function getElement() {
    return $this->_element;
  }

  /**
   * Getter for the element to return as a result of the AddElementEvent.
   * If null then the default is to maintain chainability by return the element
   * on which the AddElementEvent occured.
   *
   * @todo Where is this used?  It does not seem like a good design to not be
   *   able to guarantee the return type of the add() method.
   *
   * @return string|zpt\oobo\struct\HtmlElement Default null
   */
  public function getReturn() {
    return $this->_return;
  }

  public function prevented($prevented = null) {
    if ($prevented === null) {
      return $this->_prevented;
    }

    $this->_prevented = $prevented;
  }

  public function setElement($elm, $return = false) {
    $this->_element = $elm;

    if ($return) {
      $this->setReturn($elm);
    }
  }

  public function setReturn($elm) {
    $this->_return = $elm;
  }

}
