<?php
/**
 * Twitter Bootstrap v.5 Form for Zend Framework v.1
 * 
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 * @author Ilya Serdyuk <ilya.serdyuk@youini.org>
 */

/**
 * Renders an element checkbox controls container
 * 
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 */
class Twitter_Bootstrap5_Form_Decorator_CheckboxControls extends Zend_Form_Decorator_HtmlTag
{
    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $tag = $this->getTag();
        $attribs = $this->getOptions();
        $element = $this->getElement();
        
        $class = (array_key_exists('class', $attribs) && is_string($attribs['class'])) ? $attribs['class'] : '';
        $attribs['class'] = Twitter_Bootstrap5_Form::addClassName('form-check', $class);
        
        $xhtml = $this->_getOpenTag($tag, $attribs)
               . $content
               . $this->_getCloseTag($tag);
        
        return $xhtml;
    }
}
