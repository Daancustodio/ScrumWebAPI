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

use zpt\oobo\item\Body as BodyItem;

/**
 * This class encapsulates a radio box.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class RadioBox extends Input implements BodyItem {

  /**
   * Create a new radio box.
   *
   * @param string $name The name of the group to which the box belongs.
   * @param string $value The value of the radio box
   */
  public function __construct($name, $value) {
    parent::__construct('radio', 'radio', $name, $value);
  }
}
