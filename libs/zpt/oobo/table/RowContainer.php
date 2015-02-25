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
use \zpt\oobo\ElementComposite;

/**
 * This class encapsulates the functionality common to elements that contain
 * <tr> elements.  These include <thead>, <tfoot> and
 * <tbody> elements.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
abstract class RowContainer extends ElementComposite {

  /**
   * Constructor.
   *
   * @param string The element's tag
   * @param string The value of the element's id attribute
   * @param string The value of the element's class attribute
   */
  public function __construct($tag, $id = null, $class = null) {
    parent::__construct($tag, $id, $class);
    $this->_objectTypes = array('zpt\oobo\table\Row');
    $this->_allowText = false;
  }

  /**
   * Getter for the row at the specified index.  Null if it does not exist.
   *
   * @param integer Index of the row to retrieve
   */
  public function getRow($index) {
    if (array_key_exists($index, $this->_elements)) {
      return $this->_elements[$index];
    }
    return null;
  }
}
