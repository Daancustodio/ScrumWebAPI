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
 * This class encapsulates a <select> element.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Select extends ElementComposite implements PhrasingContent, Labelable,
    HasName
{

  /**
   * Constructor.
   *
   * @param string The name of the select box
   */
  public function __construct($name) {
    parent::__construct('select');
    $this->_objectTypes = array(
      'zpt\oobo\form\SelectOption',
      'zpt\oobo\OptGroup'
    );
    $this->_allowText = false;

    $this->setName($name);
  }

  /**
   * Override the add function to also allow adding by passing the parameters
   * for the SelectOption constructor.
   *
   * @param mixed Either the SelectOption to add to the list or the value of
   *     the select option to create
   * @param string The label for the select option, ignored if the first
   *     parameter is a SelectOption
   * @param boolean Whether or not the added option should be selected by
   *     default, ignored of the first parameter is a SelectOption
   * @param boolean Whether to push or shift the element into the container
   * @return zpt\oobo\form\SelectOption The <option> element that was added to 
   *     the <select> element
   */
  public function add($element, $lbl = null, $selected = false, $push = true) {
    if ($element instanceof SelectOption) {
      parent::add($element, $push);
      return $this;
    }

    $opt = new SelectOption($element, $lbl, $selected);
    parent::add($opt, $push);
    return $this;
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
   * Setter for the element's label.
   *
   * @param Label $label
   */
  public function setLabel(Label $label) {
    $label->setFor($label);
    return $this;
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
