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
 * Interface for elements that support or require the 'value' attribute.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
interface HasPlaceHolder {

  const ATTR_PLACEHOLDER = Attr::ATTR_PLACEHOLDER;

  public function getPlaceHolder();

  public function setPlaceHolder($name);
}
