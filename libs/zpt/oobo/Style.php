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

use \zpt\oobo\struct\MetadataContent;

/**
 * This class encapsulates a <style> element.
 *
 *   http://www.whatwg.org/specs/web-apps/current-work/multipage/semantics.html#the-style-element
 *
 * TODO Have this class implement a SometimesFlowContent interface with an
 *      isFlowContent() method that returns true if the "scoped" attribute is
 *      set.  Update ElementComposite to unshift any style elements.  Style
 *      elements added to an ElementComposite should be added the beginning of
 *      the composite's children, IN THE ORDER THEY ARE ADDED, i.e. A stack of
 *      <style> elements unshifted into the composite.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Style extends ElementComposite implements MetadataContent {

  /* Array of style rules belonging to the style element */
  private $_rules;

  /**
   * Constructor.
   */
  public function __construct() {
    parent::__construct('style');
    $this->_objectTypes = array('zpt\oobo\style\Rule');
    $this->_rules = array();
  }

  /**
   * Override the toString() method to add the rules to the element JIT for
   * output
   *
   * @return string
   */
  public function __toString() {
    foreach ($this->_rules AS $rule) {
      parent::add($rule);
    }
    return parent::__toString();
  }

  /**
   * Override the add() method to allow for a more expresive signature and to
   * store rules in an intermediate location until output.
   *
   * @param mixed Either a style\Rule or a string selector of a style
   *     rule, if a style\Rule object is provided it will override any
   *     existing properties with the same selector, otherwise the property is
   *     added (possibling overriding the property value) to any existing
   *     rule.
   * @param mixed if a string selector is provided for the first parameter
   *     this can either be a style\Property to add to the rule or the
   *     name of the property to add to the rule
   * @param mixed if a string selector and string property name are provided
   *     this is the property value
   * @return style\Rule The object that was added
   */
  public function add($rule, $property = null, $value = null) {
    if ($rule instanceof style\Rule) {
      $this->_rules[$rule->getSelector()] = $rule;
      return $rule;
    } else {
      if (array_key_exists($rule, $this->_rules)) {
        $ruleObj = $this->_rules[$rule];
      } else {
        $ruleObj = new style\Rule($rule);
        $this->_rules[$rule] = $ruleObj;
      }

      if ($property instanceof style\Property) {
        $ruleObj->add($property);
      } else {
        $ruleObj->add(new style\Property($property, $value));
      }
      return $ruleObj;
    }
  }
}
