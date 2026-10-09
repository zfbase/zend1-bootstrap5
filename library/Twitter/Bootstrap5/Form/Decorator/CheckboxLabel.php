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
 * Renders an element checkbox label
 * 
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 */
class Twitter_Bootstrap5_Form_Decorator_CheckboxLabel extends Zend_Form_Decorator_HtmlTag
{
    /**
     * HTML tag to use
     * @var string
     */
    protected $_tag = 'label';
    
    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $tag     = $this->getTag();
        $options = $this->getOptions();
        $element = $this->getElement();
        
        $options['class'] = Twitter_Bootstrap5_Form::addClassName('form-check-label', $options['class'] ?? '');
        if (!array_key_exists('for', $options)) {
            $options['for'] = $element->getId();
        }
        
        $xhtml = $content
               . $this->getSeparator()
               . $this->_getOpenTag($tag, $options)
               . $element->getLabel()
               . $this->_getCloseTag($tag);

        return $xhtml;
    }
}
