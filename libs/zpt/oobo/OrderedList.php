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
 * This class encapsulates a &lt;ol&gt; element.
 *
 * <ul>
 * <li><a href=http://www.whatwg.org/specs/web-apps/current-work/multipage/grouping-content.html#the-ol-element>http://www.whatwg.org/specs/web-apps/current-work/multipage/grouping-content.html#the-ol-element</a>
 * </ul>
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class OrderedList extends BaseList {

  /** Constant for specifying that the list should use decimal numbering. */
  const MARKER_TYPE_DECIMAL     = 'decimal';

  /**
   * Constant for specifying that the list should use lower-case alphabetic
   * numbering.
   */
  const MARKER_TYPE_LOWER_ALPHA = 'lower-alpha';

  /**
   * Constant for specifying that the list should use upper-case alphabetic
   * numbering.
   */
  const MARKER_TYPE_UPPER_ALPHA = 'upper-alpha';

  /**
   * Constant for specifying that the list should use lower-case roman
   * numerals.
   */
  const MARKER_TYPE_LOWER_ROMAN = 'lower-roman';

  /**
   * Constant for specifying that the list should use upper-case roman numerals.
   */
  const MARKER_TYPE_UPPER_ROMAN = 'upper-roman';

  /** List of accepted values for the element's type attribute */
  protected static $_acceptedTypes = array(
    self::MARKER_TYPE_DECIMAL,
    self::MARKER_TYPE_LOWER_ALPHA,
    self::MARKER_TYPE_UPPER_ALPHA,
    self::MARKER_TYPE_LOWER_ROMAN,
    self::MARKER_TYPE_UPPER_ROMAN
  );

  public function __construct() {
    parent::__construct('ol');
  }

  public function isReversed($reversed = null) {
    if ($reversed === null) {
      return $this->hasAttribute('reversed');
    }

    if ($reversed) {
      return $this->setAttribute('reversed');
    } else {
      return $this->unsetAttribute('reversed');
    }
  }

  public function setStart($start) {
    if ($start === null) {
      return $this->unsetAttribute('start');
    }

    if (!is_int($start)) {
      throw new Exception('OrderedList "start" attribute must be an integer');
    }

    return $this->setAttribute('start', $start);
  }

  public function setType($type) {
    if ($type === null) {
      return $this->unsetAttribute('type');
    }

    if (!in_array($type, self::$_acceptedTypes)) {
      throw new Exception('OrderedList "type" attribute must be one of '
        . implode(', ', self::$_acceptedTypes) . ".  $type given.");
    }

    return $this->setAttribute('type', $type);
  }
}
