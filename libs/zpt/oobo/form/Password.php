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

/**
 * This class encapsulates a <input/> element with type="password".
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Password extends Input {

  /**
   * Constructor.
   *
   * @param string The name of the element
   */
  public function __construct($name) {
    parent::__construct(Input::TYPE_PASSWORD, $name);
    $this->addClass(Input::TYPE_PASSWORD);
  }
}
