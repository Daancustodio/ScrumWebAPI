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

use \zpt\oobo\struct\FlowContent;

/**
 * This class encapsulates a <hr/> element.
 *
 * TODO Rename this class HorizontalRule
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Divider extends ElementBase implements FlowContent {

  /**
   * Constructor.
   *
   * @param integer The width of the hr as percentage of its
   *     container's width.
   */
  public function __construct($width = null) {
    parent::__construct('hr');
    if ($width !== null) {
      $this->setStyle('width', $width.'%');
    }
  }
}
