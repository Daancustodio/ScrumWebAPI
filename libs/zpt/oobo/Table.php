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
use \zpt\oobo\table\Body as Tbody;
use \zpt\oobo\table\Data as Td;
use \zpt\oobo\table\Head as Thead;
use \zpt\oobo\table\Row  as Tr;

/**
 * This class encapsulates a `<table>` element. The table class can contain at
 * most one `<thead>` and `<tfoot>` elements and one or more `<tbody>` elements
 *
 * <http://www.whatwg.org/specs/web-apps/current-work/multipage/tabular-data.html#the-table-element>
 *
 * @todo Update this class to properly support a table's content model and
 *      attributes.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Table extends ElementComposite implements FlowContent {

  /* The table's <thead> element */
  private $_head;

  /* The table's <tbody> elements */
  private $_bodies;

  /* The table's <tfoot> element */
  private $_foot;

  /**
   * Constructor.
   *
   * @param string $id The id attribute of the `<table>` element.
   * @param string $class The class attribute of the `<table>` element.
   */
  public function __construct($id = null, $class = null) {
    parent::__construct('table', $id, $class);
    $this->_objectTypes = array(
      'zpt\oobo\table\Head',
      'zpt\oobo\table\Body',
      'zpt\oobo\table\Foot'
    );
    $this->_bodies = array();
  }

  /**
   * Override the add() method to enforce table structure rules.
   *
   * @param object $element The item to add to the table
   * @param boolean $push `true` to push the element, `false` to shift.
   *   Default: `true`
   */
  public function add($element, $push = true) {
    self::_checkElement($this, $element);
    if (!is_object($element)) {
      throw new Exception('Only objects can be added to a ' . __CLASS__
        . ' object');
    }

    $type = get_class($element);
    switch ($type) {

      case 'zpt\oobo\table\Head':
      if ($this->_head !== null) {
        throw new Exception('Only one head can be added to a table');
      }
      $this->_head = $element;
      break;

      case 'zpt\oobo\table\Body':
      if ($push) {
        $this->_bodies[] = $element;
      } else {
        array_unshift($this->_bodies, $element);
      }
      break;

      case 'zpt\oobo\table\Foot':
      if ($this->_foot !== null) {
        throw new Exception('Only one foot can be added to a table');
      }
      $this->_foot = $element;
      break;

      default:
      throw new Exception('Only objects of type '
        . implode(',', $this->_objectTypes) . ' can be added to a '.__CLASS__
        . ' object');
    }
  }

  /**
   * Add the table's components JIT for output.
   *
   * @return string HTML markup for the table
   */
  public function __toString() {
    if ($this->_head !== null) {
      parent::add($this->_head);
    }

    if ($this->_foot !== null) {
      parent::add($this->_foot);
    }

    foreach ($this->_bodies AS $tBody) {
      parent::add($tBody);
    }

    return parent::__toString();
  }

  /*
   * ========================================================================
   * Interface icing
   * ---------------
   * These function are provided for convenience when constructing a table.
   * They mostly hide the use of the thead, tbody and tfoot elements since
   * most tables don't add anything special to these tags.
   * ========================================================================
   */

  /**
   * Adds a `<td>` to the table's `<thead>` and returns it
   *
   * @param string $header The header to add.  If the table doesn't already have
   *   a `<thead>` element one will be added automatically.  The given element
   *   is wrapped in a {@link table\Data} element.
   * @todo Create a class for `<th>` elements and wrap the given element with
   *   it instead of `<td>`.
   * @todo Accept a `<th>` element directly and only wrap if given element is
   *   not a `<th>`.
   */
  public function addHeader($header) {
    if ($this->_head === null) {
      $this->add(new Thead());
    }

    $tHeadRow = $this->_head->getDefaultRow();
    $tHeader = new Td($header);
    $tHeadRow->add($tHeader);
    return $tHeader;
  }

  /**
   * Adds a row to the table body and returns it.
   *
   * @return table\Row
   */
  public function addRow() {
    $this->_checkBody();
    $row = new Tr();
    $this->_bodies[0]->add($row);
    return $row;
  }

  /**
   * Adds a cell to the table.  In order to build a table using this notation
   * you need to give a row id.
   *
   * @param integer $rowIndex The index of the row to add the cell to.  If the
   *   row doesn't exist it will be created.
   * @param string $cellContents The cell's content
   * @return table\Data
   */
  public function addCell($rowIndex, $cellContents = null) {
    $this->_checkBody();

    $row = $this->_bodies[0]->getRow($rowIndex);
    if ($row === null) {
      $row = new Tr();
      $this->_bodies[0]->add($row);
    }

    if ($cellContents instanceof Td) {
      $cell = $cellContents;
    } else {
      $cell = new Td();
      $cell->add($cellContents);
    }
    $row->add($cell);
    return $this;
  }

  /**
   * Populates the table with empty objects for the given dimensions and
   * returns a 2d array containing references to the table's elements
   *
   * @param integer $numHeaders Number of headers to add
   * @param integer $numRows Number of rows to add
   * @param integer $numCols Number of columns to add
   */
  public function populate($numHeaders, $numRows, $numCols) {
    $tArr = array();

    if ($numHeaders > 0) {
      $tHead = new Thead();
      $tHeadRow = $tHead->getDefaultRow();

      $this->add($tHead);
      $tArr['head']['ele'] = $tHead;

      for ($i = 0; $i < $numHeaders; $i++) {
        $header = new Td();
        $tHeadRow->add($header);
        $tArr['head'][$i] = $header;
      }
    }
       
    if ($numRows == 0 || $numCols == 0) {
      return $tArr;
    }

    $tBody = new Tbody();
    $this->add($tBody);
    $tArr['ele'] = $tBody;
    for ($i = 0; $i < $numRows; $i++) {
      $row = new Tr();
      $tArr[$i]['ele'] = $row;

      for ($j = 0; $j < $numCols; $j++) {
        $cell = new Td();
        $row->add($cell);
        $tArr[$i][$j] = $cell;
      }
      $tBody->add($row);
    }

    return $tArr;
  }

  /*
   * ========================================================================
   * Integrity
   * ---------
   * These function help make sure that the structure of the table is valid
   * ========================================================================
   */

  /* This function ensures that the table has at least one tbody element */
  private function _checkBody() {
    if (count($this->_bodies) == 0) {
      $this->add(new Tbody());
    }
  }
}
