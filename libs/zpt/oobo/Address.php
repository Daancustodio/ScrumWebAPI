<?php
/**
 * Copyright (c) 2010, Philip Graham
 * All rights reserved.
 *
 * This file is part of Oboe and is licensed by the Copyright holder under the
 * 3-clause BSD License.  The full text of the license can be found in the
 * LICENSE.txt file included in the root directory of this distribution or at
 * the link below.
 *
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
namespace zpt\oobo;

use \zpt\oobo\struct\FlowContent;

/**
 * This class encapsulates an `<address>` element.
 *
 * <href=http://www.whatwg.org/specs/web-apps/current-work/multipage/sections.html#the-address-element>
 *
 * @TODO `<address>` elements cannot contain [heading content](http://www.whatwg.org/specs/web-apps/current-work/multipage/elements.html#heading-content),
 *   [sectioning content](http://www.whatwg.org/specs/web-apps/current-work/multipage/elements.html#sectioning-content),
 *   `<header>`, `<footer>` or `<address>` descendants
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Address extends ElementComposite implements FlowContent {

  /**
   * Create a new `<address>` element.
   */
  public function __construct() {
    parent::__construct('address');
    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');
  }
}
