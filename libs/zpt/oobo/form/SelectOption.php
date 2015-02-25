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

use \zpt\oobo\ElementComposite;

/**
 * This class encapsulates an <option> element.
 *
 * TODO Rename this class Option and move into the \zpt\oobo namespace
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class SelectOption extends ElementComposite {

  /**
   * Constructor.
   *
   * @param string The option's value
   * @param string The option's label
   * @param boolean Whether or not the option is selected.  Default, false
   */
  public function __construct($value, $text = null, $selected = false) {
    parent::__construct('option');

    $this->setAttribute('value', $value);

    if ($text !== null) {
      $this->add($text);
    }

    if($selected) {
      $this->setAttribute('selected');
    }
  }
}
