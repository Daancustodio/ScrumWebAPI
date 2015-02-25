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

use \zpt\oobo\struct\EmbeddedContent;

/**
 * This class encapsulates an <img> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/embedded-content-1.html#the-img-element
 *
 * TODO Implement support for all img attributes:
 *        crossorigin, usemap, ismap, width, height
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Image extends ElementBase implements EmbeddedContent {

  /**
   * Constructor.
   *
   * TODO Add validation for the src attribute
   *
   * @param string The logical path to the image.
   * @param string The XHTML 1.1 standard requires an alt attribute
   * @param string The DOM id of the image element.
   * @param string The css class of the image element.
   */
  public function __construct($src, $alt = '') {
    parent::__construct('img');
    $this->setAttribute('src', $src);
    if ($alt) {
      $this->setAttribute('alt', $alt);
    }
  }
}
