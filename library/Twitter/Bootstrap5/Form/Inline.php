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
 * An "inline" Twitter Bootstrap's UI form
 * 
 * @category Forms
 * @package Twitter_Bootstrap5
 * @subpackage Form
 */
class Twitter_Bootstrap5_Form_Inline extends Twitter_Bootstrap5_Form
{
    /**
     * Disposition
     * @var integer 
     */
    protected $_disposition = self::DISPOSITION_INLINE;
    
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
            array('Label', array(
                'class' => 'visually-hidden',
            )),
            array('Container'),
        );
    }
}
