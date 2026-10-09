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
 * Декоратор контейнеров элементов управления для горизонтальных форм
 * 
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 */
class Twitter_Bootstrap5_Form_Decorator_HorizontalControls extends Zend_Form_Decorator_HtmlTag
{
    /**
     * У элемента нету этикетки?
     * @var bool 
     */
    protected $_noLabel = false;
    
    /**
     * Controls container dimension
     * @var string 
     */
    protected $_dimension = 'sm-10';
    
    /**
     * Label dimension
     * @var string 
     */
    protected $_dimensionLabel= 'sm-2';
    
    /**
     * Class of controls container for file elements (aligns the content with the label)
     * @var string
     */
    protected $_fileControlsClass = 'pt-2';
    
    /**
     * Обернуть элементы управления в контейнер
     * 
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        $class = ' ' . $this->getOption('class');
        
        $controlsClasses = Twitter_Bootstrap5_Form::getGridClasses($this->getDimension());
        $class .= ' ' . implode(' ', $controlsClasses);
        
        if (true == $this->isNoLabel() || null == $element->getLabel()) {
            // Explicit offsets of the controls take precedence over offsets made from the label size
            $explicitOffsets = array();
            foreach ($controlsClasses as $controlsClass) {
                if (preg_match('/^(offset(?:-[a-z]+)?)-\d+$/', $controlsClass, $m)) {
                    $explicitOffsets[] = $m[1];
                }
            }
            foreach (Twitter_Bootstrap5_Form::getGridClasses($this->getDimensionLabel(), true) as $offsetClass) {
                if (!in_array(preg_replace('/-\d+$/', '', $offsetClass), $explicitOffsets)) {
                    $class .= ' ' . $offsetClass;
                }
            }
        }
        
        if ($this->_isFileElement($element)) {
            $class .= ' ' . $this->_fileControlsClass;
        }
        
        $class = trim($class);
        if (!empty($class)) {
            $this->setOption('class', $class);
        }
        
        return parent::render($content);
    }
    
    /**
     * У элемента нету этикетки?
     * @return bool
     */
    public function isNoLabel()
    {
        if (null !== ($noLabel = $this->getOption('noLabel'))) {
            $this->_noLabel = $noLabel;
            $this->removeOption('noLabel');
        }
        
        return $this->_noLabel;
    }
    
    /**
     * Get controls container dimension
     * 
     * @return null|string
     */
    public function getDimension()
    {
        $element = $this->getElement();
        if (null !== ($dimension = $this->getOption('dimension'))) {
            $this->_dimension = $dimension;
            $this->removeOption('dimension');
        } elseif (null !== ($dimension = $element->getAttrib('dimensionControls'))) {
            $this->_dimension = $dimension;
            $element->setAttrib('dimensionControls', null);
        }
        
        return $this->_dimension;
    }
    
    /**
     * Get label dimension
     * 
     * @return null|string
     */
    public function getDimensionLabel()
    {
        $element = $this->getElement();
        if (null !== ($dimension = $this->getOption('dimensionLabel'))) {
            $this->_dimensionLabel = $dimension;
            $this->removeOption('dimensionLabel');
        } elseif (null !== ($dimension = $element->getAttrib('dimensionLabel'))) {
            $this->_dimensionLabel = $dimension;
            $element->setAttrib('dimensionLabel', null);
        }
        
        return $this->_dimensionLabel;
    }
    
    /**
     * Is element a file element?
     * 
     * @param  Zend_Form_Element $element
     * @return bool
     */
    protected function _isFileElement($element)
    {
        return '_File' == substr($element->getType(), -5);
    }
}
