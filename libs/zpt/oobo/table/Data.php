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

use \zpt\oobo\struct\FlowContent;
use \zpt\oobo\ElementComposite;
use \zpt\oobo\Exception;

/**
 * This class encapsulates a <td> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/tabular-data.html#the-td-element
 *
 * TODO Add support for the 'headers' attribute
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Data extends ElementComposite {

  /**
   * Constructor.
   *
   * @param mixed $ctnt The contents of the cell
   */
  public function __construct($ctnt = null) {
    parent::__construct('td');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');

    if ($ctnt !== null) {
      $this->add($ctnt);
    }
  }

  public function setRowSpan($rowSpan) {
    if (!is_int($rowSpan)) {
      throw new Exception('Row span must be an integer value');
    }

    $this->setAttribute('rowspan', $rowSpan);
    return $this;
  }

  public function setColSpan($colSpan) {
    if (!is_int($colSpan)) {
      throw new Exception('Col span must be an integer value');
    }

    $this->setAttribute('colspan', $colSpan);
    return $this;
  }
}
