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

/**
 * This class implements attribute getters and setters.  It also provides
 * syntactic sugar for the id, class and style attributes.
 *
 * @author Philip Graham <philip@lightbox.org>
 */
abstract class ElementBase
{

    /** The element's tag name */
    protected $tag;

    /** The element's id attribute */
    protected $id;

    /** The element's css class attribute */
    protected $class = array();

    /** The element's style attribute */
    protected $style;

    /** The element's attributes */
    protected $attributes;

    /** THe element's data attributes */
    protected $data = array();

    /**
     * Base class constructor.
     *
     * @param string tag The element's tag name
     * @param string id The element's id attribute
     * @param string class The element's class attribute
     */
    protected function __construct($tag, $id = null, $class = null)
    {
        $this->tag = $tag;
        $this->id = $id;
        $this->attributes = array();
        $this->style = array();

        if ($class !== null) {
            $this->setClass($class);
        }
    }

    /**
     * Generates the HTML markup for the element.
     *
     * @return string
     */
    public function __toString()
    {
        // Get the opening tag for the element
        $str = self::openTag($this);
        
        // Make the opening tag self closing
        return substr($str, 0, -1).'/>';
    }

    /** 
     * Add the given class name to the element.
     *
     * @param string $class
     * @return $this For chainability
     */
    public function addClass($class)
    {
        $this->class[] = $class;

        return $this;
    }

    /**
     * This method adds the element to the <body> element.  In order for this
     * method to work the implementing class needs to implement the
     * item\Body interface.
     */
    public function addToBody()
    {
        Page::addElementToBody($this);
        return $this;
    }

    /**
     * This method adds the element to the <head> element.  In order for this
     * method to work the implementing class needs to implement the
     * item\Head interface.
     */
    public function addToHead()
    {
        Page::addElementToHead($this);
        return $this;
    }

    /**
     * Retriever for an attribute value.  If the attribute is not set null is
     * returned.
     *
     * @param string The name of the attribute to retrieve
     * @return string The value of the given attribute
     */
    public function getAttribute($attribute)
    {
        if ($attribute == 'id') {
            return $this->getId();
        } elseif ($attribute == 'class') {
            return $this->getClass();
        } elseif ($attribute == 'style') {
            return $this->getStyle();
        } elseif (substr($attribute, 0, 5) === 'data-') {
            return $this->getData($attribute);
        } elseif (array_key_exists($attribute, $this->attributes)) {
            return $this->attributes[$attribute];
        } else {
            return null;
        }
    }

    /**
     * Getter for the element's class attribute.
     *
     * @return string
     */
    public function getClass()
    {
        return implode(' ', $this->class);
    }

    /**
     * Getter for the element's data attribute of the given name.
     *
     * @param string $name
     * @return string
     */
    public function getData($name)
    {
      if (substr($name, 0, 5) === 'data-') {
        $name = substr($name, 5);
      }
      return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    /**
     * Getter the elements id attribute.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * This method retrieves the value of a given style attribute.  If not set 
     * null is returned.
     *
     * @param string The attribute to retrieve, if null the full
     *     style attribute is returned
     * @return string The value of the element's style attribute
     */
    public function getStyle($attribute = null)
    {
        if ($attribute === null) {
            return self::buildStyleString($this);
        }
        return $this->style[$attribute];
    }

    /**
     * Returns whether or not the element has the given attribute.  This can be
     * useful for checking the state of boolean attributes.
     *
     * @return boolean
     */
    public function hasAttribute($attribute)
    {
        return array_key_exists($attribute, $this->attributes);
    }

    /**
     * This method sets the given attribute to the given value.
     * For style attributes, use the set style method.  For boolean attributes,
     * the value can either be ommitted or a boolean true or false.  If the value
     * is ommitted the value is treated as true.
     * e.g. $element->setAttribute('checked') results in the attribute being
     * output as a boolean attribute.
     *
     *   <input type=checkbox checked/>.
     *
     * This method can also be used as a shorthand for setting the style
     * attribute:
     * <code>
     *     $element->setAttribute('style', 'position:absolute;top:0px;');
     *     $element->getStyle('position');  // absolute
     * </code>
     *
     * @param string The attribute to set
     * @param string The value of the attribute
     * @return $this
     */
    public function setAttribute($attribute, $value = null)
    {
        if ($value === null) {
            $value = true;
        }

        if($attribute == 'id') {
            $this->setId($value);
        } elseif ($attribute == 'class') {
            $this->setClass($value);
        } elseif (substr($attribute, 0, 5) === 'data-') {
          $this->setData($attribute, $value);
        } elseif ($attribute == 'style') {
            $styles = array();
            $validStyle = preg_match_all(
                '/(.+)\h*:\h*(.+)(?:;|$)/U',
                $value,
                $styles,
                PREG_SET_ORDER
            );

            if($validStyle) {
                foreach($styles AS $matches) {
                    $this->setStyle($matches[1], $matches[2]);
                }
            }
        } else {
            $this->attributes[$attribute] = $value;
        }

        return $this;
    }

    /**
     * Setter for the element's class attribute.
     *
     * @param string The value for the element's class attribute.
     * @return $this
     */
    public function setClass($class)
    {
        if ($class === null) {
            $this->class = null;
        } else {
            $this->class = explode(' ', $class);
        }

        return $this;
    }

    /**
     * Setter for the data attribute of the given name.
     *
     * @param string $name Data attribute name. 'data-' prefix will be stripped.
     * @param string $value The data attribute's value.
     * @return $this
     */
    public function setData($name, $value)
    {
        if (substr($name, 0, 5) === 'data-') {
          $name = substr($name, 5);
        }

        $this->data[$name] = $value;
    }

    /**
     * Setter for the element's id attributes.
     *
     * @param string The value for element's id attribute.
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * This method sets the value of the given style attribute to the given
     * value.
     *
     * @param string The attribute to set
     * @param string The value of the attribute
     * @return $this
     */
    public function setStyle($attribute, $value)
    {
        $this->style[$attribute] = $value;

        return $this;
    }

    /**
     * This method unsets the given attribute.
     *
     * NOTE: This method won't work for id, class and style attributes.  To
     * unset these attributes pass null to their respective setter methods.
     *
     * @param string The name of the attribute to unset
     * @return $this
     */
    public function unsetAttribute($attribute)
    {
        if (isset($this->attributes[$attribute])) {
            unset($this->attributes[$attribute]);
        }

        return $this;
    }

    /**
     * This method generates the opening tag for the given element.
     *
     * @param ElementBase The element to open the tag for
     * @return The opening tag for the given element
     */
    protected static function openTag(ElementBase $element)
    {
        $str = '<'.$element->tag;
        if ($element->id !== null) {
            $str.= " id=\"$element->id\"";
        }
        if (count($element->class) > 0) {
            $str.= ' class="' . implode(' ', $element->class) . '"';
        }
            
        if (count($element->style) > 0) {
            $style = self::buildStyleString($element);
            $str.= " style=\"$style\"";
        }

        foreach ($element->data as $data => $value) {
            $str.= " data-$data=\"$value\"";
        }

        $attributes = array();
        foreach ($element->attributes as $attribute => $value) {
            if ($value === true) {
                $attributes[] = $attribute;
            } else if ($value === false) {
                // Don't output anything for a false attribute
            } else {

                // htmlentities won't encode spaces
                if (strpos($value, ' ') === false) {
                    $value = htmlentities(
                        $value,
                        ENT_QUOTES,
                        'UTF-8',
                        false /* Don't double quote */
                    );
                } else {
                    $value = "\"$value\"";
                }

                $attributes[] = "$attribute=$value";
            }
        }
        $attributes = implode(' ', $attributes);

        $str.= " $attributes >";
        return $str;
    }

    /**
     * This method generates the closing tag for the given element.
     *
     * @param ElementBase The element for which to generate the closing tag
     * @return The closing tag for the given element
     */
    protected static function closeTag(ElementBase $element)
    {
        return '</'.$element->tag.'>';
    }

    /**
     * This method generates the style string for the given element
     *
     * @param ElementBase The element for which to generate the style string
     * @return The style string for the given element
     */
    private static function buildStyleString(ElementBase $element)
    {
        $style = '';
        foreach($element->style AS $attribute => $value) {
            $style.= $attribute.':'.$value.';';
        }
        return $style;
    }
}
