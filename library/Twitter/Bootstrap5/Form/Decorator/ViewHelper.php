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
class Twitter_Bootstrap5_Form_Decorator_ViewHelper extends Zend_Form_Decorator_ViewHelper
{
    /**
     * Retrieve element attributes
     *
     * Set id to element name and/or array item.
     *
     * @return array
     */
    public function getElementAttribs()
    {
        $attribs = parent::getElementAttribs();
        
        unset($attribs['addon_append']);   // Twitter_Bootstrap5_Form_Decorator_Addon
        unset($attribs['addon_prepend']);  // Twitter_Bootstrap5_Form_Decorator_Addon
        unset($attribs['success']);        // Twitter_Bootstrap5_Form_Decorator_Container
        unset($attribs['warning']);        // Twitter_Bootstrap5_Form_Decorator_Container
        unset($attribs['dimension']);          // Twitter_Bootstrap5_Form_Decorator_FieldSize
        unset($attribs['dimensionLabel']);     // Twitter_Bootstrap5_Form_Decorator_HorizontalLabel
        unset($attribs['dimensionControls']);  // Twitter_Bootstrap5_Form_Decorator_HorizontalControls
        
        $state = static::getElementState($this->getElement());
        if (null !== $state && isset(static::$stateClasses[$state]) && !empty($attribs['class'])) {
            $classes = explode(' ', $attribs['class']);
            if (array_intersect($classes, static::$controlClasses)) {
                $attribs['class'] = Twitter_Bootstrap5_Form::addClassName($attribs['class'], static::$stateClasses[$state]);
            }
        }
        
        return $attribs;
    }
    
    /**
     * Control classes of the validation state
     * @var array
     */
    public static $stateClasses = array(
        'error' => 'is-invalid',
        'warning' => 'is-warning',
        'success' => 'is-valid',
    );
    
    /**
     * Controls which support the validation state
     * @var array
     */
    public static $controlClasses = array('form-control', 'form-select', 'form-check-input');
    
    /**
     * Get the validation state of the element: error, warning, success or null
     * 
     * @param  Zend_Form_Element $element
     * @return null|string
     */
    public static function getElementState(Zend_Form_Element $element)
    {
        $warnings = $element->getAttrib('warning');
        
        if ($element->hasErrors()) {
            return 'error';
        } elseif (!empty($warnings)) {
            return 'warning';
        } elseif (true === $element->getAttrib('success')) {
            return 'success';
        }
        
        return null;
    }
}
