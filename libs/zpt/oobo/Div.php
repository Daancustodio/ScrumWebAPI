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
 * This class encapsulates a `<div>` element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Div extends ElementComposite implements FlowContent {

  /**
   * Constructor.
   *
   * @param string $id [Optional] The value for the element's id attribute.
   */
  public function __construct($id = null, $class = null) {
    parent::__construct('div',$id,$class);
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');

    if ($id !== null) {
      $this->setId($id);
    }
  }
}
