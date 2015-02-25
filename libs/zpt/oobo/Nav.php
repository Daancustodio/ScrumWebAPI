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
use \zpt\oobo\struct\SectioningContent;

/**
 * This class encapsulates a <section> element.
 *
 *   TODO Create interface for PalpableContent and have this class implement it.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Nav extends ElementComposite implements FlowContent, SectioningContent {

  /**
   * Constructor.
   */
  public function __construct() {
    parent::__construct('nav');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');
  }
}
