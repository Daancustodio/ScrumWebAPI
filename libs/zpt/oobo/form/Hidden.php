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
 * This class encapsulates an <input/> item with type="hidden".
 *
 * @author <a href="mailto:philip@lightbox.com">Philip Graham</a>
 */
class Hidden extends Input {

  /**
   * Constructor.
   *
   * @param string The name of the hidden input item.
   * @param string The value of the hidden input item.
   */
  public function __construct($name, $value) {
    parent::__construct('hidden', $name, $value);
  }
}
