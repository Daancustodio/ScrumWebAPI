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
namespace zpt\oobo\struct;

/**
 * Interface for objects that encapsulate and HTML element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/semantics.html#semantics
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
interface HtmlElement {

  /**
   * Returns the HTML representation of the element.  Must conform with the
   * HTML5 specification.
   *
   *   http://www.whatwg.org/specs/web-apps/current-work/multipage/
   *
   * @return string
   */
  public function __toString();
}
