<?php
/**
 * =============================================================================
 * Copyright (c) 2011, Philip Graham
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
namespace zpt\oobo\attr;

use \zpt\oobo\ElementBase;
use \InvalidArgumentException;

/**
 * This class implements attribute validation and sanitization for CanSumit
 * attributes.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class CanSubmitAttributeManager implements CanSubmit {
  
  private static $_enumEncType = array(
    'application/x-www-form-urlencoded',
    'multipart/form-data',
    'text/plain'
  );

  private static $_enumMethod = array(
    CanSubmit::METHOD_GET,
    CanSubmit::METHOD_POST
  );

  private static $_targetKeywords = array(
    '_blank',
    '_self',
    '_parent',
    '_top'
  );

  public static function validateAction($action) {
    /* TODO - relative URLs need to be accepted as well */
    /*
    $isUrl = filter_var($action, FILTER_VALIDATE_URL);
    if (!) {
      return "Invalid action attribute: $action is not a valid URL";
    }
    */
    return null;
  }

  public static function validateEncType($encType) {
    if (!in_array($encType, self::$_enumEncType)) {
      return "Invalid enctype attribute: $encType.  Must be one of "
        . implode(',', self::$_enumEncType);
    }
    return null;
  }

  public static function validateMethod($method) {
    if (!in_array($method, self::$_enumMethod)) {
      return "Invalid method attribute: $method.  Must be one of "
        . implode(',', self::$_enumMethod);
    }
    return null;
  }

  public static function validateNoValidate($noValidate) {
    if (!is_bool($noValidate)) {
      return "Invalid novalidate attribute: $noValidate.  Must be a boolean";
    }
    return null;
  }

  public static function validateTarget($target) {
    if (substr($target, 0, 1) === '_' &&
        !in_array($target, self::$_targetKeywords))
    {
      return "Invalid target attribute: $target.  Must be one of "
        . implode(',', self::$_targetKeywords)
        . " or a string of length at least 1 that does not start with an '_'";
    }
    return null;
  }

  /*
   * ===========================================================================
   * Instance
   * ===========================================================================
   */

  private $_elm;

  public function __construct(ElementBase $elm) {
    $this->_elm = $elm;
  }

  public function getAction() {
    return $this->_elm->getAttribute(CanSubmit::ATTR_ACTION);
  }

  public function getEncType() {
    return $this->_elm->getAttribute(CanSubmit::ATTR_ENCTYPE);
  }

  public function getMethod() {
    return $this->_elm->getAttribute(CanSubmit::ATTR_METHOD);
  }

  public function getNoValidate() {
    return $this->_elm->getAttribute(CanSubmit::ATTR_NOVALIDATE);
  }

  public function getTarget() {
    return $this->_elm->getAttribute(CanSubmit::ATTR_TARGET);
  }

  public function setAction($action) {
    $msg = self::validateAction($action);
    if ($msg !== null) {
      throw new InvalidArgumentException($msg);
    }

    return $this->_elm->setAttribute(CanSubmit::ATTR_ACTION, $action);
  }

  public function setEncType($encType) {
    $msg = self::validateEncType($encType);
    if ($msg !== null) {
      throw new InvalidArgumentException($msg);
    }

    return $this->_elm->setAttribute(CanSubmit::ATTR_ENCTYPE, $encType);
  }

  public function setMethod($method) {
    $method = strtolower($method);
    $msg = self::validateMethod($method);
    if ($msg !== null) {
      throw new InvalidArgumentException($msg);
    }

    return $this->_elm->setAttribute(CanSubmit::ATTR_METHOD, $method);
  }

  public function setNoValidate($noValidate) {
    $msg = self::validateNoValidate($noValidate);
    if ($msg !== null) {
      throw new InvalidArgumentException($msg);
    }

    if ($noValidate) {
      return $this->_elm->setAttribute(CanSubmit::ATTR_NOVALIDATE);
    } else {
      return $this->_elm->unsetAttribute(CanSubmit::ATTR_NOVALIDATE);
    }
  }

  public function setTarget($target) {
    $msg = self::validateTarget($target);
    if ($msg !== null) {
      throw new InvalidArgumentException($msg);
    }

    return $this->_elm->setAttribute(CanSubmit::ATTR_TARGET, $target);
  }
}
