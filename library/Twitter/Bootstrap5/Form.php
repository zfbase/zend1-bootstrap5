<?php
/**
 * Twitter Bootstrap v.5 Form for Zend Framework v.1
 *
 * @category Forms
 * @package Twitter
 * @subpackage Bootstrap5
 * @author Ilya Serdyuk <ilya.serdyuk@youini.org>
 */

/**
 * This is the base abstract form for the Twitter's Bootstrap UI
 *
 * @category Forms
 * @package Twitter
 * @subpackage Bootstrap5
 */
abstract class Twitter_Bootstrap5_Form extends Zend_Form
{
    /**#@+
     * Disposition type constants
     */
    const DISPOSITION_HORIZONTAL = 'horizontal';
    const DISPOSITION_VERTICAL   = 'vertical';
    const DISPOSITION_INLINE     = 'inline';

    /**
     * Disposition type class
     * @var array
     */
    static public $_dispositionClasses = array(
        self::DISPOSITION_HORIZONTAL => 'form-horizontal',
        self::DISPOSITION_VERTICAL => 'form-vertical',
        self::DISPOSITION_INLINE => 'form-inline',
    );

    /**
     * Grid breakpoints known by dimension options
     * @var array
     */
    static public $gridBreakpoints = array('xs', 'sm', 'md', 'lg', 'xl', 'xxl');

    /**
     * Disposition
     * @var integer
     */
    protected $_disposition;

    /**
     * Mark valid elements after validation (adds .is-valid to the controls)
     * @var bool
     */
    protected $_markValidElements = true;

    /**
     * Default display group class
     * @var string
     */
    protected $_defaultDisplayGroupClass = 'Twitter_Bootstrap5_Form_DisplayGroup';

    /**
     * Prefixes is initialized?
     * @var bool
     */
    protected $_prefixesInitialized = false;

    /**
     * Global decorators to apply to all elements types: text, password, dateTime,
     * dateTimeLocal, date, month, time, week, number, email, url, search, tel and color
     * @var array
     */
    protected $_simpleElementDecorators;

    /**
     * Global decorators to apply to all elements type checkbox
     * @var array
     */
    protected $_checkboxDecorators;

    /**
     * Global decorators to apply to all elements type captcha
     * @var array
     */
    protected $_captchaDecorators;

    /**
     * Global decorators to apply to all elements types: button, submit and reset
     * @var array
     */
    protected $_buttonsDecorators;

    /**
     * Global decorators to apply to all elements type image
     * @var array
     */
    protected $_imageDecorators;

    /**
     * Override the base form constructor
     *
     * @param mixed $options
     */
    public function __construct($options = null)
    {
        $this->_initializePrefixes();
        $this->loadDefaultElementDecorators();

        parent::__construct($options);
    }

    /**
     * Prefixes initialize of all form elements
     */
    protected function _initializePrefixes()
    {
        if (!$this->_prefixesInitialized) {
            if (null !== $this->getView()) {
                $this->getView()->addHelperPath('Twitter/Bootstrap5/View/Helper', 'Twitter_Bootstrap5_View_Helper');
            }

            $this->addPrefixPath('Twitter_Bootstrap5_Form_Element', 'Twitter/Bootstrap5/Form/Element', 'element');
            $this->addElementPrefixPath('Twitter_Bootstrap5_Form_Decorator', 'Twitter/Bootstrap5/Form/Decorator', 'decorator');
            $this->addDisplayGroupPrefixPath('Twitter_Bootstrap5_Form_Decorator', 'Twitter/Bootstrap5/Form/Decorator');

            $this->_prefixesInitialized = true;
        }
    }

    /**
     * Override the default decorators
     *
     * @return Twitter_Bootstrap5_Form
     */
    public function loadDefaultDecorators()
    {
        if ($this->loadDefaultDecoratorsIsDisabled()) {
            return $this;
        }

        $decorators = $this->getDecorators();
        if (empty($decorators)) {
            $this->addDecorator('FormElements')
                 ->addDecorator('Form');
        }

        return $this;
    }

    /**
     * Load the default decorators for all elements
     *
     * @return Twitter_Bootstrap5_Form
     */
    public function loadDefaultElementDecorators()
    {
        $this->_simpleElementDecorators = $this->getDefaultSimpleElementDecorators();
        $this->_captchaDecorators = $this->getDefaultCaptchaDecorators();
        $this->_checkboxDecorators = $this->getDefaultCheckboxDecorators();
        $this->_buttonsDecorators = $this->getDefaultButtonsDecorators();
        $this->_imageDecorators = $this->getDefaultImageDecorators();

        return $this;
    }

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
            array('Label', array(
                'class' => 'form-label',
            )),
            array('Container'),
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
            array('Label', array(
                'class' => 'form-label',
            )),
            array('Container'),
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
            array('Container'),
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
            array('Container'),
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
            array('Container'),
            array('FieldSize'),
        );
    }

    /**
     * Override the create an element
     *
     * @param  string            $type
     * @param  string            $name
     * @param  array|Zend_Config $options
     * @return Zend_Form_Element
     */
    public function createElement($type, $name, $options = null)
    {
        if (null !== $options && $options instanceof Zend_Config) {
            $options = $options->toArray();
        }

        // Load default decorators
        if ((null === $options) || !is_array($options)) {
            $options = array();
        }

        if (!array_key_exists('decorators', $options)) {
            $decorators = $this->getDefaultDecoratorsByElementType($type);
            if (!empty($decorators)) {
                $options['decorators'] = $decorators;
            }
        }

        // Base class of the control
        $controlClass = static::getControlClassByElementType($type);
        if (null !== $controlClass) {
            $options['class'] = static::addClassName($options['class'] ?? null, $controlClass);
        }

        // Helpers: element options: [ 'decorator/option' => value ]
        foreach ($options as $optionKey => $optionValue) {
            $keys = explode('/', $optionKey);

            if (2 != count($keys)) {
                continue;
            }

            $decorator = $keys[0];
            $option = $keys[1];

            foreach ($options['decorators'] as & $setting) {
                if ($decorator == $setting[0]) {
                    $setting[1][$option] = $optionValue;
                    unset($options[$optionKey]);
                }
            }
        }

        return parent::createElement($type, $name, $options);
    }

    /**
     * Retrieve the Bootstrap class of control for type element
     *
     * @param  string $type
     * @return null|string
     */
    public static function getControlClassByElementType($type)
    {
        switch ($type) {
            case 'text':    case 'password':  case 'dateTime':  case 'dateTimeLocal':
            case 'date':    case 'month':     case 'time':      case 'week':
            case 'number':  case 'email':     case 'url':       case 'search':
            case 'tel':     case 'textarea':
                return 'form-control';
            case 'color':
                return 'form-control form-control-color';
            case 'select':
            case 'multiselect':
                return 'form-select';
            case 'checkbox':
                return 'form-check-input';
        }

        return null;
    }

    /**
     * Retrieve a registered decorator for type element
     *
     * @param  string $type
     * @return array
     */
    public function getDefaultDecoratorsByElementType($type)
    {
        switch ($type) {
            case 'button':
            case 'submit':
            case 'reset':
                if (is_array($this->_buttonsDecorators)) {
                    return $this->_buttonsDecorators;
                }
                break;
            case 'image':
                if (is_array($this->_imageDecorators)) {
                    return $this->_imageDecorators;
                }
                break;
            case 'checkbox':
                if (is_array($this->_checkboxDecorators)) {
                    return $this->_checkboxDecorators;
                }
                break;
            case 'captcha':
                if (is_array($this->_captchaDecorators)) {
                    return $this->_captchaDecorators;
                }
                break;
            case 'text':    case 'password':  case 'dateTime':  case 'dateTimeLocal':
            case 'date':    case 'month':     case 'time':      case 'week':
            case 'number':  case 'email':     case 'url':       case 'search':
            case 'tel':     case 'color':
            case 'note':    case 'static':    case 'select':    case 'multiselect':
            case 'file':    case 'textarea':  case 'radio':     case 'multiCheckbox':
                if (is_array($this->_simpleElementDecorators)) {
                    return $this->_simpleElementDecorators;
                }
                break;
            case 'hidden':
            case 'hash':
                return array('ViewHelper');
            default:
                if (is_array($this->_elementDecorators)) {
                    return $this->_elementDecorators;
                }
                break;
        }

        return array();
    }

    /**
     * Set form disposition
     *
     * @param  string $disposition
     * @return Twitter_Bootstrap5_Form
     */
    public function setDisposition($disposition)
    {
        if (array_key_exists($disposition, static::$_dispositionClasses)) {
            $this->_disposition = $disposition;
        }

        return $this;
    }

    /**
     * Get form disposition
     *
     * @return null|string
     * @throws Twitter_Bootstrap5_Exception
     */
    public function getDisposition()
    {
        if (null !== ($disposition = $this->getAttrib('disposition'))) {
            if (in_array($disposition, static::$_dispositionClasses)) {
                $this->_disposition = $disposition;
                $this->removeAttrib('disposition');
            } else {
                throw new Twitter_Bootstrap5_Exception('Set invalid disposition for form');
            }
        }

        return $this->_disposition;
    }

    /**
     * Mark valid elements after validation?
     *
     * @param  bool $flag
     * @return Twitter_Bootstrap5_Form
     */
    public function setMarkValidElements($flag)
    {
        $this->_markValidElements = (bool) $flag;
        return $this;
    }

    /**
     * Override the render form
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(?Zend_View_Interface $view = null)
    {
        if (null !== ($disposition = $this->getDisposition())) {
            $this->addClass(static::$_dispositionClasses[$disposition]);
        }

        return parent::render();
    }

    /**
     * Override validation form
     *
     * @param  array $data
     * @return bool
     */
    public function isValid($data)
    {
        $valid = parent::isValid($data);

        if ($this->_markValidElements) {
            foreach ($this->getElements() as $key => $element) {
                if (!$element->hasErrors()) {
                    $element->setAttrib('success', true);
                }
            }
        }

        return $valid;
    }

    /**
     * Add a class for form
     *
     * @param  string $class
     * @return Twitter_Bootstrap5_Form
     */
    public function addClass($class)
    {
        $this->setAttrib('class', static::addClassName($this->getAttrib('class'), $class));
        return $this;
    }

    /**
     * Append class names to the class attribute value, skipping existing ones
     *
     * @param  null|string $classes
     * @param  string      $add
     * @return string
     */
    public static function addClassName($classes, $add)
    {
        $list = preg_split('/\s+/', trim((string) $classes), -1, PREG_SPLIT_NO_EMPTY);
        foreach (preg_split('/\s+/', trim((string) $add), -1, PREG_SPLIT_NO_EMPTY) as $class) {
            if (!in_array($class, $list)) {
                $list[] = $class;
            }
        }
        return implode(' ', $list);
    }

    /**
     * Convert the dimension option to the grid classes
     *
     * Dimension is a list of sizes separated by spaces or commas. Each size is
     * the breakpoint and the number of columns: `sm-10`, `md-12`. Bootstrap 3
     * notation is supported too: `col-xs-6`, `col-sm-offset-2`, `sm-offset-2`.
     * Tokens that are not grid sizes (custom classes) are passed as is.
     *
     * With `$asOffset` sizes are converted to the offsets (used to shift controls
     * of the element without label); custom classes are skipped in this case.
     *
     * @param  null|string $dimension
     * @param  bool        $asOffset
     * @return array       class names
     */
    public static function getGridClasses($dimension, $asOffset = false)
    {
        $classes = array();
        $breakpoints = implode('|', static::$gridBreakpoints);

        foreach (preg_split('/[\s,]+/', trim((string) $dimension), -1, PREG_SPLIT_NO_EMPTY) as $token) {
            if (preg_match('/^(?:col-)?(?:(' . $breakpoints . ')-)?(offset-)?(\d+|auto)$/', $token, $m)) {
                $breakpoint = ('xs' === $m[1] || '' === $m[1]) ? '' : '-' . $m[1];
                $size = $m[3];
                if ($asOffset || !empty($m[2])) {
                    if ('auto' === $size) {
                        continue;
                    }
                    if ($asOffset && 12 == $size) {
                        $size = 0;
                    }
                    $classes[] = 'offset' . $breakpoint . '-' . $size;
                } else {
                    $classes[] = 'col' . $breakpoint . '-' . $size;
                }
            } elseif (preg_match('/^offset(?:-(?:' . $breakpoints . '))?-\d+$/', $token)) {
                $classes[] = $token;
            } elseif (!$asOffset) {
                $classes[] = $token;
            }
        }

        return array_values(array_unique($classes));
    }
}
