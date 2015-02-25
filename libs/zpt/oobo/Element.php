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

use zpt\oobo\form\Password;
use zpt\oobo\form\Select;
use zpt\oobo\form\Submit;
use zpt\oobo\form\TextArea;
use zpt\oobo\form\TextInput;
use zpt\oobo\head\MetaTag;
use zpt\oobo\head\StyleSheet;
use zpt\oobo\table\Data;
use zpt\oobo\text\VSpace;

/**
 * This class provides factory methods for different elements.  The purpose of
 * this is to allow chaining with creation:
 *
 * $div = Element::div()
 *   ->setId('my-div')
 *   ->addClass('a-class')
 *   ->add("Some text");
 *
 * This is necessary because PHP does not allow chaining as part of the new
 * statement:
 *
 * $div = new Div()->setId('my-div');  // FATAL ERROR
 *
 * @author Philip Graham <philip@zeptech.ca>
 */
class Element {

  /**
   * <a/> element factory method.  Alias for anchor().
   *
   * @param string $href The value of the anchor's href attribute.
   *   [default: '#']
   * @param mixed $ctnt The anchor's content. [optional]
   * @return Anchor
   */
  public static function a($href = '#', $ctnt = null) {
    return self::anchor($href, $ctnt);
  }

  /**
   * <address> element factory method.
   *
   * @return Address
   */
  public static function address() {
    return new Address();
  }

  /**
   * <a/> element factory method. Aliases by a().
   *
   * @param string $href The value of the anchor's href attribute.
   *   [default: '#']
   * @param mixed $ctnt The anchor's content. [optional]
   * @return Anchor
   */
  public static function anchor($href = '#', $ctnt = null) {
    return new Anchor($href, $ctnt);
  }

  /**
   * <br/> element factory method.
   *
   * @return text\VSpace;
   */
  public static function br() {
    return new VSpace();
  }

  /**
   * <button/> element factory method.
   *
   * @param string $lbl The button's label. [optional]
   * @return Button
   */
  public static function button($lbl = null) {
    return new Button($lbl);
  }

  /**
   * <link/> element with rel="stylesheet" factory method. Aliased by css().
   *
   * @param string $href Path to the stylesheet
   * @return StyleSheet
   */
  public static function css($href) {
    return self::styleSheet($href);
  }

  /**
   * <div/> element factory method.
   *
   * @return Div
   */
  public static function div() {
    return new Div();
  }

  /**
   * <em/> element factory method.
   *
   * @return Em
   */
  public static function em($ctnt = null) {
    $em = new Em();

    if ($ctnt !== null) {
      $em->add($ctnt);
    }
    return $em;
  }

  /**
   * <fieldset/> factory method.
   *
   * @return Fieldset
   */
  public static function fieldset() {
    return new Fieldset();
  }

  /**
   * <footer> element factory method.
   *
   * @return Footer
   */
  public static function footer() {
    return new Footer();
  }

  /**
   * <form/> factory method.
   *
   * @return Form
   */
  public static function form() {
    return new Form();
  }

  /**
   * <h1> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h1($text = null) {
    return self::heading(1, $text);
  }

  /**
   * <h2> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h2($text = null) {
    return self::heading(2, $text);
  }

  /**
   * <h3> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h3($text = null) {
    return self::heading(3, $text);
  }

  /**
   * <h4> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h4($text = null) {
    return self::heading(4, $text);
  }

  /**
   * <h5> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h5($text = null) {
    return self::heading(5, $text);
  }

  /**
   * <h6> factory method.
   *
   * @param string $text
   * @return Heading
   */
  public static function h6($text = null) {
    return self::heading(6, $text);
  }

  /**
   * <header/> element factory method.
   *
   * @return Header
   */
  public static function header() {
    return new Header();
  }

  /**
   * <h#> factory method.
   *
   * @param integer $prominence The heading element's prominence. Default: 1
   * @return Heading
   */
  public static function heading($prominence = 1, $text = null) {
    return new Heading($prominence, $text);
  }

  /**
   * <hr/> factory method.  Aliased by for hr()
   *
   * @return Divider
   */
  public static function horizontalRule() {
    return new Divider();
  }

  /**
   * <hr/> factory method.  Alias for horizontalRule()
   *
   * @return Divider
   */
  public static function hr() {
    return self::horizontalRule();
  }

  /**
   * <img/> element factory method. Aliased by img().
   *
   * @param string $src The value of the img's src attribute.
   * @return Image
   */
  public static function image($src) {
    return new Image($src);
  }

  /**
   * <img/> element factory method. Alias for image().
   *
   * @param string $src The value of the img's src attribute.
   * @return Image
   */
  public static function img($src) {
    return self::image($src);
  }

  /**
   * <script/> element factory method. Aliased by js()
   *
   * @param string $src URL of the script
   * @return
   */
  public static function javascript($src = null) {
    $js = new Javascript();
    if ($src !== null) {
      $js->setAttribute('src', $src);
    }
    return $js;
  }

  /**
   * <script/> element factory method. Alias for javascript()
   *
   * @param string $src URL of the script
   * @return
   */
  public static function js($src = null) {
    return self::javascript($src);
  }

  /**
   * <label/> element factory method.
   *
   * @param String $text The label's text. [optional]
   * @return Label
   */
  public static function label($text = null) {
    $lbl = new Label();
    if ($text !== null) {
      $lbl->add($text);
    }
    return $lbl;
  }

  /**
   * <li/> element factory method. Alias for listItem().
   *
   * @param string $text Text content for the list item.
   * @return ListItem
   */
  public static function li($text = null) {
    return self::listItem($text);
  }

  /**
   * <li/> element factory method.  Alised by li().
   *
   * @param string $text Text content for the list item.
   * @return ListItem
   */
  public static function listItem($text = null) {
    return new ListItem($text);
  }

  /**
   * <meta/> element factory method.
   *
   * @param string $name The name of the meta data
   * @param string $content The content of the meta content
   */
  public static function meta($name, $content) {
    return new MetaTag($name, $content);
  }

  /**
   * <nav/> element factory method.
   *
   * @return Nav
   */
  public static function nav() {
    return new Nav();
  }

  /**
   * <p/> element factory method.  Alias for paragraph().
   *
   * @return Paragraph
   */
  public static function p() {
    return self::paragraph();
  }

  /**
   * <p/> element factory method.  Aliased by p().
   *
   * @return Paragraph
   */
  public static function paragraph() {
    return new Paragraph();
  }

  /**
   * <input/> element with type="password" factory method.
   *
   * @param string $name The input element's name attribute
   * @return Password
   */
  public static function password($name) {
    return new Password($name);
  }

  /**
   * <section/> element factory method.
   *
   * @return Section
   */
  public static function section() {
    return new Section();
  }

  /**
   * <select/> element factory method.
   *
   * @param string $name The select input element's name attribute
   * @return Select
   */
  public static function select($name) {
    return new Select($name);
  }

  /**
   * <span/> element factory method.
   *
   * @return Span
   */
  public static function span() {
    return new Span();
  }

  /**
   * <link/> element with rel="stylesheet" factory method. Aliased by css().
   *
   * @param string $href Path to the stylesheet
   * @return StyleSheet
   */
  public static function styleSheet($href) {
    return new StyleSheet($href);
  }

  /**
   * <input/> element with type="submit" factory method.
   *
   * @param string $lbl
   * @return Submit
   */
  public static function submit($lbl = null) {
    return new Submit($lbl);
  }

  /**
   * <table/> element factory method.
   *
   * @return Table
   */
  public static function table() {
    return new Table();
  }

  /**
   * <td/> element factory method.  Aliased by td().
   *
   * @param Content of the cell
   * @return table\Data
   */
  public static function tableData($ctnt = null) {
    return new Data($ctnt);
  }

  /**
   * <td/> element factory method. Alias for tableData().
   *
   * @param Content of the cell.
   * @return table\Data
   */
  public static function td($ctnt = null) {
    return self::tableData($ctnt);
  }

  /**
   * <textarea/> element factory.
   *
   * @param string $name
   * @return form\TextArea
   */
  public static function textarea($name) {
    return new TextArea($name);
  }

  /**
   * <input/> element with type="text" factory method.
   *
   * @param string $name The input element's name attribute
   * @return TextInput
   */
  public static function textInput($name) {
    return new TextInput($name);
  }

  /**
   * <ul> element factory method. Alias for unorderedList().
   *
   * @return UnorderedList
   */
  public static function ul() {
    return self::unorderedList();
  }

  /**
   * <ul> element factory method.  Aliases by ul().
   *
   * @return UnorderedList
   */
  public static function unorderedList() {
    return new UnorderedList();
  }
}
