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
namespace zpt\oobo\text;

use \zpt\oobo\struct\FlowContent;
use \zpt\oobo\struct\PhrasingContent;
use \zpt\oobo\ElementComposite;

/**
 * This class encapsulates a <<pre>> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Preformatted extends ElementComposite implements PhrasingContent {

  /**
   * Constructor.
   *
   * @param string The preformatted text.
   * @param string The value of the element's id attribute
   * @param string The value of the element's class attribute
   */
  public function __construct($text = null) {
    parent::__construct('pre');
    $this->_objectTypes = array();

    if ($text !== null) {
      $this->add($text);
    }
  }
}
