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

use \zpt\oobo\table\Data;
use \zpt\oobo\ElementComposite;

/**
 * This class encapsulates a <tr> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Row extends ElementComposite {

  /**
   * Constructor.
   *
   * @param string The value of the element's id attribute
   * @param string The value of the element's class attribute
   */
  public function __construct($id = null, $class = null) {
    parent::__construct('tr', $id, $class);
    $this->_objectTypes = array('zpt\oobo\table\Data');
    $this->_allowText = false;
  }

  /**
   * Add a cell with the given content and return the cell.
   *
   * @param mixed $content The content to add in the cell.  If a Data instance
   *   is given as the content then the Data is added to the row, the class
   *   parameter is ignored and nothing is returned.
   * @param string $class Optional CSS class to apply to the cell.
   * @return Data The created cell.
   */
  public function addCell($content, $class = null) {
    if ($content instanceof Data) {
      $this->add($content);
      return;
    }

    $cell = new Data($content);
    $this->add($cell);

    if ($class !== null) {
      $cell->setClass($class);
    }
    return $cell;
  }
}
