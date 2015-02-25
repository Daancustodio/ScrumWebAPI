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
namespace zpt\oobo\style;

/**
 * This class encapsulates a css style rule.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Rule {

  /* The rule's style selector */
  private $_selector;

  /* The rule's styles */
  private $_styles;

  /**
   * Constructor.
   *
   * @param string CSS selector for the rule
   */
  public function __construct($selector) {
    $this->_selector = $selector;
    $this->_styles = array();
  }

  /**
   * Returns the rule as string.
   *
   * @return string CSS representing the encapsulated rule
   */
  public function __toString() {
    $str = $this->_selector . '{';

    foreach ($this->_styles AS $styleProp) {
      $str.= $styleProp.';';
    }
    $str = substr($str, 0, -1) . '}';
    return $str;
  }

  /**
   * Adds a propery to the style rule.
   *
   * @param mixed Either a Property instance or the property to use
   *     for a Property
   * @param string The value to apply to the given property, ignored if
   *     $property is a zpt\oobo\StyleProperty object
   */
  public function add($property, $value = null) {
    if ($property instanceof Property) {
      $this->_styles[$property->getName()] = $property;
      return $property;
    }
    return $this->add(new Property($property, $value));
  }

  /**
   * Getter for the rule's selector.
   *
   * @return string
   */
  public function getSelector() {
    return $this->_selector;
  }
}
