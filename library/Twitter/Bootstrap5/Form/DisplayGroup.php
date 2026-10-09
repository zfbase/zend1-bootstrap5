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
 * Displays the fieldsets the Bootstrap's way
 * 
 * @category Forms
 * @package Twitter_Bootstrap5
 * @subpackage Form
 */
class Twitter_Bootstrap5_Form_DisplayGroup extends Zend_Form_DisplayGroup
{
    /**
     * Override the default decorators
     *
     * @return Twitter_Bootstrap5_Form_DisplayGroup
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Fieldset');
        }
        
        return $this;
    }
}
