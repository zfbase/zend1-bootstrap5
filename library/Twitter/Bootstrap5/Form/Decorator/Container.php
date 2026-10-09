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
 * Renders an element main container
 *
 * @category Forms
 * @package Twitter_Bootstrap5_Form
 * @subpackage Decorator
 */
class Twitter_Bootstrap5_Form_Decorator_Container extends Zend_Form_Decorator_HtmlTag
{
    /**
     * Snippets for positioning before content
     * @var array
     */
    protected $_beforeContent = array();

    /**
     * Snippets for positioning after content
     * @var array
     */
    protected $_afterContent = array();

    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     */
    public function render($content)
    {
        $element = $this->getElement();
        $state = Twitter_Bootstrap5_Form_Decorator_ViewHelper::getElementState($element);

        $class = Twitter_Bootstrap5_Form::addClassName('form-group', $this->getOption('class'));
        if (null !== $state) {
            $class = Twitter_Bootstrap5_Form::addClassName($class, 'has-' . $state);
        }
        $this->setOption('class', $class);

        $before = implode('', $this->_beforeContent);
        $after = implode('', $this->_afterContent);
        return parent::render($before . $content . $after);
    }

    /**
     * Add HTML fragment to position before content
     *
     * @param string $html
     * @return Twitter_Bootstrap5_Form_Decorator_Container
     */
    public function addBeforeContent($html)
    {
        $this->_beforeContent[] = $html;
        return $this;
    }

    /**
     * Add HTML fragment to position after content
     *
     * @param string $html
     * @return Twitter_Bootstrap5_Form_Decorator_Container
     */
    public function addAfterContent($html)
    {
        $this->_afterContent[] = $html;
        return $this;
    }

    /**
     * Clear all registered HTML fragments to position before content
     *
     * @return Twitter_Bootstrap5_Form_Decorator_Container
     */
    public function clearBeforeContent()
    {
        $this->_beforeContent = array();
        return $this;
    }

    /**
     * Clear all registered HTML fragments to position after content
     *
     * @return Twitter_Bootstrap5_Form_Decorator_Container
     */
    public function clearAfterContent()
    {
        $this->_afterContent = array();
        return $this;
    }
}
