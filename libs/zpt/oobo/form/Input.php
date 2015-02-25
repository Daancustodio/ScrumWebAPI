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
namespace zpt\oobo\form;

use \zpt\oobo\attr\HasName;
use \zpt\oobo\attr\HasValue;
use \zpt\oobo\attr\HasType;
use \zpt\oobo\attr\HasPlaceHolder;
use \zpt\oobo\struct\PhrasingContent;

use \zpt\oobo\ElementBase;

/**
 * This class encapsulates an <input/> element.
 *
 * TODO - Create a HasValue interface and have this class implement it
 * TODO - Implement HTML5 conformant constraints for the name attribute
 *
 * @author Philip Graham <philip@lightbox.org>
 */
abstract class Input extends ElementBase implements PhrasingContent, HasName,
  HasValue, HasType,HasPlaceHolder
{

  const TYPE_BUTTON     = 'button';
  const TYPE_PASSWORD   = 'password';
  const TYPE_SUBMIT     = 'submit';
  const TYPE_TEXT_INPUT = 'text'; // TODO Rename to TYPE_TEXT
  const TYPE_FILE       = 'file';
  const TYPE_NUMBER     = 'number';
  const TYPE_TIME       = 'time';
  const TYPE_DATE       = 'date';
  
  /**
   * Constructor.
   *
   * @param string The type of the <input /> element
   * @param string The default class for the input element.
   * @param string Optional name
   * @param string Optional value
   */
  public function __construct($type, $name = null, $value = null) {
    if($type == self::TYPE_BUTTON){
      parent::__construct(self::TYPE_BUTTON);
    }else{
      parent::__construct('input');
    }
    $this->setAttribute('type', $type);

    if ($name !== null) {
      $this->setName($name);
      $this->setId($name);
    }

    if ($value !== null) {
      $this->setValue($value);
    }
  }

  public function getName() {
    return $this->getAttribute(HasName::ATTR_NAME);
  }

  public function getValue() {
    return $this->getAttribute(HasValue::ATTR_VALUE);
  }

  public function setName($name) {
    return $this->setAttribute(HasName::ATTR_NAME, $name);
  }

  public function setValue($value) {
    return $this->setAttribute(HasValue::ATTR_VALUE, $value);
  }
  
  public function getType(){
    return $this->getAttribute(HasType::ATTR_TYPE);
  }

  public function setType($type){
      return $this->setAttribute(HasType::ATTR_TYPE, $type);
  }
  
  public function getPlaceHolder(){
      return $this->getAttribute(HasPlaceHolder::ATTR_PLACEHOLDER);
  }

  public function setPlaceHolder($PlaceHolder){
      return $this->setAttribute(HasPlaceHolder::ATTR_PLACEHOLDER, $PlaceHolder);
  }
  
  
  public function clonar($id, $type = null, $class = null) {
      $clone = clone $this;
      $clone->unsetAttribute('placeholder');
      $clone->setId($id);
      $clone->setName($id);
      if(!is_null($class)){
          $this->setClass($class);
      }
      if (!is_null($type)){
          $clone->unsetAttribute(HasType::ATTR_TYPE);
          $clone->setAttribute(HasType::ATTR_TYPE,$type);
      }
      return $clone;    
  }
}
