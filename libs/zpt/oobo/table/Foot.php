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
namespace zpt\oobo\table;

/**
 * This class encapsulates a <tfoot> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Foot extends RowContainer {

  /**
   * Constructor.
   *
   * @param string The value of the element's id attribute
   * @param string The value of the element's class attribute
   */
  public function __construct($id = null, $class = null) {
    parent::__construct('tfoot', $id, $class);
  }
}
