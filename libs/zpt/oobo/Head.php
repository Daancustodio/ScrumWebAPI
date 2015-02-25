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

use \zpt\oobo\event\AddElementEvent;
use \zpt\oobo\head\Charset;
use \zpt\oobo\head\Title;
use \zpt\oobo\struct\HtmlElement;

/**
 * This class encapsulates the <head> element.  Since a document can only have
 * one <head> element it is implemented as a singleton.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
class Head extends ElementComposite implements HtmlElement {

  const SHIV_URL = 'http://html5shiv.googlecode.com/svn/trunk/html5.js';
    
  /*
   * ========================================================================
   * SINGLETON
   * ========================================================================
   */

  private static $_instance;
    
  /**
   * Getter for the Head singleton.
   *
   * @return Head Singleton.
   */
  public static function getInstance() {
    if (self::$_instance === null) {
      self::$_instance = new Head();
    }
    return self::$_instance;
  }

  /*===================================*
   * INSTANCE
   *===================================*/

  /* The character set of the page being constructed */
  private $_charset = 'utf-8';

  /* The text to output between the head's <title> tag */
  private $_title;

  /**
   * Constructor.
   */
  protected function __construct() {
    parent::__construct('head');

    // This object only accepts zpt\oobo_Item_Header implementations
    $this->_objectTypes = array(
      'zpt\oobo\struct\MetadataContent',
      'zpt\oobo\head\Charset'
    );
    $this->_allowText = false;
  }

  /**
   * Overrides the removeAll() method to unset any title in addition to
   * removing all elements.
   *
   * @Override
   */
  public function removeAll() {
    $this->_title = null;
    return parent::removeAll();
  }

  /**
   * Setter for the page's character set.
   *
   * @param string $charset
   */
  public function setCharset($charset) {
    $this->_charset = $charset;
    return $this;
  }

  /**
   * Setter for the page's title.
   *
   * @param string The page's title
   */
  public function setTitle($title) {
    if (is_string($title)) {
      $title = new Title($title);
    }

    if (!($title instanceof Title)) {
      $msg = "Title must be a string or zpt\oobo\\head\\Title instance: "
        . print_r($title, true) . " given.";
      throw new Exception($msg);
    }

    $this->_title = $title;

    return $this;
  }

  protected function onAdd(AddElementEvent $event) {
    $elm = $event->getElement();

    // Only perform special processing for Title elements, all other elements
    // are treated normally
    if (!($elm instanceof Title)) {
      return;
    }

    if ($this->_title !== null) {
      $msg = "Cannot add <title> element to head: A title is already set,"
        . " use setTitle() instead.";
      throw new Exception($msg);
    }
    $this->_title = $elm;
    
    // Prevent the parent from adding the element to the list as it will be
    // added onDump
    $event->prevented(true);
  }

  protected function onDump() {
    // If specified, add the title element
    if ($this->_title !== null) {
      array_unshift($this->_elements, $this->_title);
    }

    // Add the character set declaration
    array_unshift($this->_elements, new Charset($this->_charset));

    $this->_elements[] =
        "<!--[if lt IE 9]>\n"
      .   "<script src=\"" . self::SHIV_URL . "\"></script>\n"
      . "<![endif]-->\n";
  }
}
