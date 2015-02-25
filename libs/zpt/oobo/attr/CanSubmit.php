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

/**
 * Interface for elements that contain attributes for form submission.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/association-of-controls-and-forms.html#attributes-for-form-submission
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
interface CanSubmit {

  const ATTR_ACTION     = 'action';
  const ATTR_ENCTYPE    = 'enctype';
  const ATTR_METHOD     = 'method';
  const ATTR_NOVALIDATE = 'novalidate';
  const ATTR_TARGET     = 'target';

  const METHOD_GET      = 'get';
  const METHOD_POST     = 'post';

  public function getAction();

  public function getEncType();

  public function getMethod();

  public function getNoValidate();

  public function getTarget();

  public function setAction($action);

  public function setEncType($encType);

  public function setMethod($method);

  public function setNoValidate($noValidate);

  public function setTarget($target);
}
