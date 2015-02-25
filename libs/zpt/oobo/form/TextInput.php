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
namespace zpt\oobo\form;

use \zpt\oobo\struct\Labelable;
use \zpt\oobo\Label;

/**
 * This class encapsulates a <input/> element with type="text".
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class TextInput extends Input implements Labelable {

  /**
   * Constructor.
   *
   * @param string The name of the text box.
   * @param string An optional initial value for the element
   */
  public function __construct($name,$class = Input::TYPE_TEXT_INPUT,$value = null, $type = Input::TYPE_TEXT_INPUT) {
    parent::__construct($type, $name, $value);
    $this->addClass($class);
  }

  /**
   * Setter for the element's label.
   *
   * @param Label $label
   */
  public function setLabel(Label $label) {
    $label->setFor($this);
    return $this;
  }

  /**
   * Setter for the textbox's text.
   *
   * @param string $text The text to set.
   */
  public function setText($text) {
    $this->setAttribute('value', $text);
    return $this;
  }
  
}
