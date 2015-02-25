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
use \zpt\oobo\struct\SectioningRoot;

/**
 * This class encapsulates a <fieldset> element.
 *
 *  http://www.whatwg.org/specs/web-apps/current-work/multipage/forms.html#the-fieldset-element
 *
 * TODO - Add support for form-associated elements
 *        Add support for form Listed elements
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Fieldset extends ElementComposite implements FlowContent, SectioningRoot {

  private $_legend;

  public function __construct() {
    parent::__construct('fieldset');

    $this->_objectTypes = array('zpt\oobo\struct\FlowContent');
  }

  public function setLegend($legend) {
    if (!($legend instanceof Legend)) {
      $legendCtnt = $legend;
      $legend = new Legend();
      $legend->add($legendCtnt);
    }

    $this->_legend = $legend;
  }

  protected function onDump() {
    if ($this->_legend !== null) {
      array_unshift($this->_elements, $this->_legend);
    }
  }
}
