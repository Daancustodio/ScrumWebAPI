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
namespace zpt\oobo\head;

use \zpt\oobo\struct\MetadataContent;
use \zpt\oobo\ElementBase;

/**
 * This class encapsulates a <link/> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Link extends ElementBase implements MetadataContent {

  /**
   * Constructor.
   *
   * @param string The rel attribute
   * @param string The href attribute
   * @param string The type attribute
   * @param string The media attribute
   */
  public function __construct($rel, $href, $type = null, $media = null) {
    parent::__construct('link');
    $this->setAttribute('rel', $rel);
    $this->setAttribute('href', $href);

    if ($type !== null) {
      $this->setAttribute('type', $type);
    }

    if ($media !== null) {
      $this->setAttribute('media', $media);
    }
  }
}
