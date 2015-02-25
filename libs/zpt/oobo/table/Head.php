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
 * This class encapsulates a <thead> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Head extends RowContainer {

  /**
   * Constructor.  The thead element can only contain a single <tr> element.
   *
   * @param string The value of the element's id attribute
   * @param string The value of the element's class attribute
   */
  public function __construct($id = null, $class = null) {
    parent::__construct('thead', $id, $class);
  }

  /**
   * This method returns a default row for the thead element.  If the element
   * does not contain a row when the method is invoked, one is created.
   *
   * @return Row
   */
  public function getDefaultRow() {
    if (count($this->_elements) == 0) {
      $this->add(new Row());
    }
    return $this->_elements[0];
  }
}
