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

/**
 * This class ecapsulates a <<li>> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class ListItem extends ElementComposite {

  /**
   * Constructor.
   */
  public function __construct($ctnt = null) {
    parent::__construct('li');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');

    if ($ctnt !== null) {
      $this->add($ctnt);
    }
  }
}
