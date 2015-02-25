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

use \zpt\oobo\attr\CanSubmit;
use \zpt\oobo\attr\CanSubmitAttributeManager;
use \zpt\oobo\attr\HasName;
use \zpt\oobo\event\AddElementEvent;
use \zpt\oobo\struct\FlowContent;
use \InvalidArgumentException;

/**
 * This class encapulates a <form> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/forms.html#the-form-element
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Form extends ElementComposite implements FlowContent, HasName, CanSubmit {

  /** Constant for specifying a form that uses a GET method */
  const GET = 'get';

  /** Constant for specifying a form that uses a POST method - Default */
  const POST = 'post';

  /* Object that handles setting the attributes defined by CanSubmit. */
  private $_canSubmitAttributeManager;

  /**
   * Constructor.
   *
   * @param string The name of the form
   * @param string The file that will process the form.  If not given the
   *     value of $_SERVER['SCRIPT_NAME'] is used
   * @param string The submit method for the form.  Either 'post' (default) or
   *     'get'
   */
  public function __construct() {
    parent::__construct('form');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');

    $this->_canSubmitAttributeManager = new CanSubmitAttributeManager($this);
  }

  public function getAction() {
    return $this->_canSubmitAttributeManager->getAction();
  }

  public function getEncType() {
    return $this->_canSubmitAttributeManager->getEncType();
  }

  public function getMethod() {
    return $this->_canSubmitAttributeManager->getMethod();
  }

  /**
   * Getter for the form's name attribute:
   * http://www.whatwg.org/specs/web-apps/current-work/multipage/forms.html#attr-form-name
   *
   * @return string
   */
  public function getName() {
    return $this->getAttribute(HasName::ATTR_NAME);
  }

  public function getNoValidate() {
    return $this->_canSubmitAttributeManager->getNoValidate();
  }

  public function getTarget() {
    return $this->_canSubmitAttributeManager->getTarget();
  }

  public function setAction($action) {
    // TODO - Transform relative paths into absolute URLs
    return $this->_canSubmitAttributeManager->setAction($action);
  }

  public function setEncType($encType) {
    return $this->_canSubmitAttributeManager->setEncType($encType);
  }

  public function setMethod($method) {
    return $this->_canSubmitAttributeManager->setMethod($method);
  }

  /**
   * Setter for the form's name attribute:
   *
   * @param string $name
   * @see #getName()
   */
  public function setName($name) {
    return $this->setAttribute(HasName::ATTR_NAME, $name);
  }

  public function setNoValidate($noValidate) {
    return $this->_canSubmitAttributeManager->setNoValidate($noValidate);
  }

  public function setTarget($target) {
    return $this->_canSubmitAttributeManager->setTarget($target);
  }

  protected function onAdd(AddElementEvent $event) {
    $elm = $event->getElement();
    if (is_string($elm)) {
      return;
    }

    if ($elm instanceof ElementComposite) {
      $e = null;
      ElementComposite::visit($elm, function ($elm) use (&$e) {
        if ($elm instanceof Form) {
          $e = new InvalidArgumentException('Cannot nest forms');
        }
      });

      if ($e !== null) {
        throw $e;
      }
    }
  }
}
