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
 * This class encapsulates a `<button>` element.
 *
 * TODO This class needs to filter Interactive content.
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Button extends ElementComposite implements PhrasingContent {

  /**
   * Construtor da Classe
   * @param string $lbl [Optional] Label for the button 
   * @param string $class Classe HTML
   * @param string $type  Tipo do Botão ex: Submit OR button
   */
  public function __construct($lbl = null, $class = null, $type = 'button') {
    parent::__construct('button');
    $this->_objectTypes = array('zpt\oobo\struct\PhrasingContent');
    if (!is_null($class)) {
      $this->addClass($class);
    }
    $this->setAttribute('type', $type);

    if ($lbl !== null) {
      $this->setValue($lbl);
    }
  }
}
