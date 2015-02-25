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
 * This class encapsulates a <div> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage//sections.html#the-footer-element
 *
 * TODO Footer and header elements are not allowed
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Footer extends ElementComposite implements FlowContent {

  /**
   * Constructor.
   */
  public function __construct() {
    parent::__construct('footer');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');
  }
}
