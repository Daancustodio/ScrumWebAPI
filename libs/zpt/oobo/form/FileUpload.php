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
 * This class encapsulates an <input/> element with type="file".
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class FileUpload extends Input {

  /**
   * Constructor.  Any form that contains a zpt\oobo\form\FileUpload needs to 
   * have
   * .
   * <code>
   * $form->setHasFileUpload();
   * </code>
   * called on it in order for the file upload to work.
   *
   * @param string The name of the file upload element.  This is the index of
   *     the file's contents in the $_FILES array in the script that processes
   *     the form to which the file upload belongs.
   */
  public function __construct($name) {
    parent::__construct(Input::TYPE_FILE, $name);
    $this->addClass(Input::TYPE_FILE);
  }
}
