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

use \zpt\oobo\attr\HasName;
use \zpt\oobo\struct\Labelable;
use \zpt\oobo\struct\PhrasingContent;
use \zpt\oobo\ElementComposite;
use \zpt\oobo\Label;

/**
 * This class encapsulates a <textarea> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class TextArea extends ElementComposite implements PhrasingContent, Labelable,
    HasName
{

  /**
   * Constructor.
   *
   * @param string The name of the text area
   * @param string The original contents of the text area
   */
  public function __construct($name, $text = null) {
    parent::__construct('textarea');
    $this->setName($name);
    $this->_objectTypes = array();

    if ($text !== null) {
      $this->add($text);
    }
  }

  /**
   * Getter for the element's name.
   *
   * @return string
   */
  public function getName() {
    return $this->getAttribute($name);
  }

  /**
   * Setter for the element's label
   *
   * @param Label $label
   */
  public function setLabel(Label $label) {
    $label->setFor($label);
  }

  /**
   * Setter for the element's name.
   *
   * @param string $name
   */
  public function setName($name) {
    return $this->setAttribute(HasName::ATTR_NAME, $name);
  }

}
