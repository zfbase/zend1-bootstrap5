<?php
/**
 * Twitter Bootstrap v.5 Form for Zend Framework v.1
 * 
 * @category Forms
 * @package Twitter_Bootstrap5
 * @subpackage Form
 * @author Ilya Serdyuk <ilya.serdyuk@youini.org>
 */

/**
 * An "horizontal" Twitter Bootstrap's UI form
 * 
 * @category Forms
 * @package Twitter_Bootstrap5
 * @subpackage Form
 */
class Twitter_Bootstrap5_Form_Horizontal extends Twitter_Bootstrap5_Form
{
    /**
     * Disposition
     * @var integer 
     */
    protected $_disposition = self::DISPOSITION_HORIZONTAL;
    
    /**
     * Retrieve all decorators for all simple type elements
     * 
     * @return array
     */
    public function getDefaultSimpleElementDecorators()
    {
        return array(
            array('ViewHelper'),
            array('Addon'),
            array('Warnings'),
            array('Errors'),
            array('Description', array(
                'tag' => 'div',
                'class' => 'form-text',
            )),
            array('HorizontalControls'),
            array('HorizontalLabel'),
            array('Container', array(
                'class' => 'row',
            )),
            array('FieldSize'),
        );
    }
    
    /**
     * Retrieve all decorators for all captcha elements
     * 
     * @return array
     */
    public function getDefaultCaptchaDecorators()
    {
        return array(
            array('Warnings'),
            array('Errors'),
            array('Description', array(
                'tag' => 'div',
                'class' => 'form-text',
            )),
            array('HorizontalControls'),
            array('HorizontalLabel'),
            array('Container', array(
                'class' => 'row',
            )),
            array('FieldSize'),
        );
    }
    
    /**
     * Retrieve all decorators for all checkbox elements
     * 
     * @return array
     */
    public function getDefaultCheckboxDecorators()
    {
        return array(
            array('ViewHelper'),
            array('CheckboxLabel'),
            array('Warnings'),
            array('Errors'),
            array('Description', array(
                'tag' => 'div',
                'class' => 'form-text',
            )),
            array('CheckboxControls'),
            array('HorizontalControls', array(
                'noLabel' => true,
            )),
            array('Container', array(
                'class' => 'row',
            )),
            array('FieldSize'),
        );
    }
    
    /**
     * Retrieve all decorators for all elements types: button, submit and reset
     * 
     * @return array
     */
    public function getDefaultButtonsDecorators()
    {
        return array(
            array('Tooltip'),
            array('Description', array(
                'tag' => 'div',
                'class' => 'form-text',
            )),
            array('ViewHelper'),
            array('HorizontalControls', array(
                'noLabel' => true,
            )),
            array('Container', array(
                'class' => 'row',
            )),
            array('FieldSize'),
        );
    }
    
    /**
     * Retrieve all decorators for all elements type image
     * 
     * @return array
     */
    public function getDefaultImageDecorators()
    {
        return array(
            array('Tooltip'),
            array('Description', array(
                'tag' => 'div',
                'class' => 'form-text',
            )),
            array('Image'),
            array('Warnings'),
            array('Errors'),
            array('HorizontalControls', array(
                'noLabel' => true,
            )),
            array('Container', array(
                'class' => 'row',
            )),
            array('FieldSize'),
        );
    }
}
