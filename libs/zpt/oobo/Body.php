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

use \zpt\oobo\struct\FlowContent;
use \zpt\oobo\struct\HtmlElement;

/**
 * This class encapsulates the `<body>` element.  Since a document can only
 * have one `<body>` element it is implemented as a singleton.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
final class Body extends ElementComposite implements HtmlElement {

  /*
   * ========================================================================
   * Singleton
   * ========================================================================
   */
    
  private static $_instance;

  /**
   * Instance method of the Singleton pattern.
   *
   * @return Body The documents `<body>` element.
   */
  public static function getInstance() {
    if (self::$_instance === null) {
        self::$_instance = new Body();
    }
    return self::$_instance;
  }

  /*
   * ========================================================================
   * Instance
   * ========================================================================
   */
    
  /** Constructor. Initializes parent with 'body' tag. */
  protected function __construct() {
    parent::__construct('body');

    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');
  }
}
