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
 * This class encapsulates a css style propery -> value combination.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Property {
    
  /* The property */
  private $_name;

  /* The property's value */
  private $_value;

  /**
   * Constructor.
   *
   * @param string The css property's name
   * @param string The property's value
   */
  public function __construct($name, $value) {
    $this->_name = $name;
    $this->_value = $value;
  }

  /**
   * Returns the css property as a string
   *
   * @return string CSS property value combination
   */
  public function __toString() {
    return $this->_name.':'.$this->_value;
  }

  /**
   * Getter for the property's name.
   *
   * @return string The name of the encapsulates style property
   */
  public function getName() {
    return $this->_name;
  }
}
