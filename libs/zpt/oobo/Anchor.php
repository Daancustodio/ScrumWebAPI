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

use \zpt\oobo\struct\PhrasingContent;

/**
 * This class encapsulates an &lt;a&gt; element.
 *
 * http://www.whatwg.org/specs/web-apps/current-work/multipage/text-level-semantics.html#the-a-element
 *
 * @TODO Figure out a way of implementing a transparent interface
 *       and have ElementComposite handle elements that implement the
 *       Transparent interface differently.
 *       http://www.whatwg.org/specs/web-apps/current-work/multipage/content-models.html#transparent
 *
 * @TODO Add support for all attributes: href, target, ping, rel, media,
 *       hreflang, type
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Anchor extends ElementComposite implements PhrasingContent {

  private $_item;

  /**
   * Constructor.
   *
   * @param string $href The link's URL
   * @param mixed $item A valid item to add to the anchor.
   */
  public function __construct($href = '#', $item = null) {
    parent::__construct('a');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');

    $this->setAttribute('href', $href);

    if ($item !== null) {
      $this->add($item);
    }
  }
}
