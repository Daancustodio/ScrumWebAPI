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

use \zpt\oobo\struct\PhrasingContent;

/**
 * This class encapsulates a <em> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage//text-level-semantics.html#the-em-element
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Em extends ElementComposite implements PhrasingContent {

  /**
   * Constructor.
   */
  public function __construct() {
    parent::__construct('em');
    $this->_objectTypes = array('zpt\oobo\struct\PhrasingContent');
  }
}
