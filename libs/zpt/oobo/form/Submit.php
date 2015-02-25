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
 * This class encapsulates an <input/> element with type="submit".
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Submit extends Input {

  /**
   * Constructor.
   *
   * @param string The prompt that appreas on the submit button.
   * @param string An optional name for the submit button
   */
  public function __construct($label = null, $class = null) {
    parent::__construct(Input::TYPE_SUBMIT);
    if(!is_null($class)){
      $this->addClass($class);
    }else{
      $this->addClass(Input::TYPE_SUBMIT);
    }
    if ($label !== null) {
      $this->setValue($label);
    }
  }
}
