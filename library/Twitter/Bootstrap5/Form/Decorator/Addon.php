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
 * Renders an form field with an add on (appended or prepended)
 * 
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 */
class Twitter_Bootstrap5_Form_Decorator_Addon extends Zend_Form_Decorator_Abstract
{
    /**
     * Support element types
     * @var array 
     */
    protected $_types = array(
        'text', 'password', 'dateTime', 'dateTimeLocal', 'date', 'month', 
        'time', 'week', 'number', 'email', 'url', 'search', 'tel', 'color',
    );
    
    /**
     * Append addon element
     * @var string
     */
    protected $_appendAddon;
    
    /**
     * Prepend addon element
     * @var string
     */
    protected $_prependAddon;
    
    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $prependAddon = $this->getPrependAddon();
        $appendAddon = $this->getAppendAddon();
        
        if (empty($prependAddon) && empty($appendAddon)) {
            return $content;
        }
        
        if (!empty($prependAddon)) {
            $prependAddon = $this->_renderAddon($prependAddon);
        }
        
        if (!empty($appendAddon)) {
            $appendAddon = $this->_renderAddon($appendAddon);
        }
        
        $class = 'input-group';
        if ($this->getElement()->hasErrors()) {
            $class .= ' has-validation';
        }
        
        $xhtml = '<div class="' . $class . '">'
               . $prependAddon
               . $content
               . $appendAddon
               . '</div>';
        
        return $xhtml;
    }
    
    /**
     * Render addon: buttons and dropdowns are placed as is, the rest is wrapped in .input-group-text
     * 
     * @param  string $addon
     * @return string
     */
    protected function _renderAddon($addon)
    {
        if (preg_match('/^\s*<(button|a|select)\b|^\s*<[a-z]+[^>]*class="[^"]*\b(btn|form-select|dropdown-menu)\b/i', $addon)) {
            return $addon;
        }
        
        return '<span class="input-group-text">' . $addon . '</span>';
    }
    
    /**
     * Get prepend element addon
     * 
     * @return null|string
     */
    public function getPrependAddon()
    {
        $element = $this->getElement();
        if (null !== ($prepend = $this->getOption('prepend'))) {
            $this->_prependAddon = $prepend;
            $this->removeOption('prepend');
        } elseif (null !== ($prepend = $element->getAttrib('addon_prepend'))) {
            $this->_prependAddon = $prepend;
            $element->setAttrib('addon_prepend', null);
        }
        
        return $this->_prependAddon;
    }
    
    /**
     * Get append element addon
     * 
     * @return null|string
     */
    public function getAppendAddon()
    {
        $element = $this->getElement();
        if (null !== ($append = $this->getOption('append'))) {
            $this->_appendAddon = $append;
            $this->removeOption('append');
        } elseif (null !== ($append = $element->getAttrib('addon_append'))) {
            $this->_appendAddon = $append;
            $element->setAttrib('addon_append', null);
        }
        
        return $this->_appendAddon;
    }
}
