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

/**
 * This class encapsulates a check box input control.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Checkbox extends Input {

  /**
   * Create a new check box.
   *
   * @param string $name The name of the checkbox.
   * @param string $value The value of the checkbox.
   */
  public function __construct($name, $value = 'y') {
    parent::__construct('checkbox', 'checkbox', $name, $value);
  }

  /**
   * Set the checked state of the checkbox.
   *
   * @param boolean $checked Whether or not to check the box.
   */
  public function setChecked($checked) {
    if ($checked) {
      $this->setAttribute('checked');
    } else {
      $this->unsetAttribute('checked');
    }
  }
}
