# Twitter Bootstrap 5 Form for Zend Framework 1

Form decorators and view helpers which render Zend Framework 1 forms with [Bootstrap 5](https://getbootstrap.com/docs/5.3/forms/overview/) markup.

The library is the successor of [zfbase/zend1-bootstrap3](https://github.com/zfbase/zend1-bootstrap3): the PHP API is the same, the classes are named `Twitter_Bootstrap5_*` and the generated markup is Bootstrap 5.

```sh
composer require zfbase/zend1-bootstrap5
```

Include `library/Twitter/Bootstrap5/patch.css` (or the same rules in your styles): Bootstrap 5 has no `.form-group`, `.form-inline` and warning state, which the library uses.

## Form types

```php
class Application_Form_Example extends Twitter_Bootstrap5_Form_Vertical // or _Horizontal, _Inline
{
    public function init()
    {
        $this->addElement('email', 'email', array(
            'label' => 'Email',
            'description' => 'We\'ll never share your email',
        ));

        $this->addElement('text', 'price', array(
            'label' => 'Price',
            'addon_prepend' => '$',
            'addon_append' => '<button class="btn btn-outline-secondary" type="button">Go</button>',
        ));

        $this->addElement('checkbox', 'remember', array(
            'label' => 'Remember me',
        ));

        $this->addElement('radio', 'radio', array(
            'label' => 'Radio',
            'multiOptions' => array('a' => 'A', 'b' => 'B'),
            'inline' => true,
        ));

        $this->addElement('submit', 'submit', array(
            'label' => 'Sign in',
        ));
    }
}
```

### Vertical form (`Twitter_Bootstrap5_Form_Vertical`)

```html
<form enctype="application/x-www-form-urlencoded" class="form-vertical" method="post">
    <div class="form-group">
        <label for="email" class="form-label required">Email</label>
        <input type="email" name="email" id="email" value="" class="form-control">
        <div class="form-text">We'll never share your email</div>
    </div>
    <div class="form-group">
        <label for="price" class="form-label optional">Price</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="text" name="price" id="price" value="" class="form-control">
            <button class="btn btn-outline-secondary" type="button">Go</button>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input type="hidden" name="remember" value="0">
            <input type="checkbox" name="remember" id="remember" value="1" class="form-check-input">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
    </div>
    <div class="form-group">
        <label for="radio" class="form-label optional">Radio</label>
        <div class="form-check form-check-inline">
            <input type="radio" name="radio" id="radio-a" value="a" class="form-check-input">
            <label class="form-check-label" for="radio-a">A</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="radio" id="radio-b" value="b" class="form-check-input">
            <label class="form-check-label" for="radio-b">B</label>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" id="submit" value="Sign in" class="btn btn-primary">
    </div>
</form>
```

### Horizontal form (`Twitter_Bootstrap5_Form_Horizontal`)

```html
<form enctype="application/x-www-form-urlencoded" class="form-horizontal" method="post">
    <div class="form-group row">
        <label for="email" class="required col-form-label col-sm-2">Email</label>
        <div class="col-sm-10">
            <input type="email" name="email" id="email" value="" class="form-control">
            <div class="form-text">We'll never share your email</div>
        </div>
    </div>
    <div class="form-group row">
        <label for="price" class="optional col-form-label col-sm-2">Price</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="text" name="price" id="price" value="" class="form-control">
                <button class="btn btn-outline-secondary" type="button">Go</button>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <div class="form-check">
                <input type="hidden" name="remember" value="0">
                <input type="checkbox" name="remember" id="remember" value="1" class="form-check-input">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="radio" class="optional col-form-label col-sm-2">Radio</label>
        <div class="col-sm-10">
            <div class="form-check form-check-inline">
                <input type="radio" name="radio" id="radio-a" value="a" class="form-check-input">
                <label class="form-check-label" for="radio-a">A</label>
            </div>
            <div class="form-check form-check-inline">
                <input type="radio" name="radio" id="radio-b" value="b" class="form-check-input">
                <label class="form-check-label" for="radio-b">B</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-10 offset-sm-2">
            <input type="submit" name="submit" id="submit" value="Sign in" class="btn btn-primary">
        </div>
    </div>
</form>
```

The sizes of the label and controls columns are set by the `dimensionLabel` (default `sm-2`) and `dimensionControls` (default `sm-10`) element attributes; `dimension` wraps the whole element into a column. A size is a breakpoint and a number of columns, several sizes are separated by spaces or commas: `sm-4, lg-3`. Offsets are written as `offset-sm-2`; Bootstrap 3 notation (`col-xs-6`, `col-sm-offset-2`) is converted too. Other tokens are added as is, so custom classes may be mixed in.

### Inline form (`Twitter_Bootstrap5_Form_Inline`)

```html
<form enctype="application/x-www-form-urlencoded" class="form-inline" method="post">
    <div class="form-group">
        <label for="email" class="visually-hidden required">Email</label>
        <input type="email" name="email" id="email" value="" class="form-control">
    </div>
    <div class="form-group">
        <label for="price" class="visually-hidden optional">Price</label>
        <div class="input-group">
            <span class="input-group-text">$</span>
            <input type="text" name="price" id="price" value="" class="form-control">
            <button class="btn btn-outline-secondary" type="button">Go</button>
        </div>
    </div>
    <div class="form-group">
        <div class="form-check">
            <input type="hidden" name="remember" value="0">
            <input type="checkbox" name="remember" id="remember" value="1" class="form-check-input">
            <label class="form-check-label" for="remember">Remember me</label>
        </div>
    </div>
    <div class="form-group">
        <label for="radio" class="visually-hidden optional">Radio</label>
        <div class="form-check form-check-inline">
            <input type="radio" name="radio" id="radio-a" value="a" class="form-check-input">
            <label class="form-check-label" for="radio-a">A</label>
        </div>
        <div class="form-check form-check-inline">
            <input type="radio" name="radio" id="radio-b" value="b" class="form-check-input">
            <label class="form-check-label" for="radio-b">B</label>
        </div>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" id="submit" value="Sign in" class="btn btn-primary">
    </div>
</form>
```

## Validation state

After `isValid()` the controls of the invalid elements get the `.is-invalid` class and the errors are rendered as `.invalid-feedback`; the controls of the valid elements get `.is-valid` (disable with `setMarkValidElements(false)`). Warnings (`'warning'` element attribute) are rendered as `.warning-feedback` and the controls get `.is-warning`. The element container gets `has-error`, `has-warning` or `has-success` class for styling labels.

## Buttons

`button` and `reset` without own style get `btn-secondary`, `submit` gets `btn-primary`. Defaults can be changed:

```php
Twitter_Bootstrap5_View_Helper_FormButton::$defaultClass = 'btn-outline-secondary';
Twitter_Bootstrap5_View_Helper_FormReset::$defaultClass = 'btn-outline-secondary';
Twitter_Bootstrap5_View_Helper_FormSubmit::$defaultClass = 'btn-success';
```

## Migration from zend1-bootstrap3

- Rename `Twitter_Bootstrap3_` to `Twitter_Bootstrap5_`.
- `select` gets `.form-select` instead of `.form-control`, checkboxes get `.form-check-input`.
- Labels get `.form-label` (vertical) and `.col-form-label` (horizontal) instead of `.control-label`; descriptions are rendered as `div.form-text` instead of `p.help-block`; errors as `ul.invalid-feedback` instead of `ul.help-block`.
- Checkboxes and radios are rendered as `.form-check` (`.form-check-inline` for `'inline' => true`) with the label after the input instead of `.checkbox`/`.radio` with the input inside the label. `label_class` and `wrapper_class` attributes are still supported.
- Addons are rendered as `.input-group-text`; buttons, links and selects passed as addons are placed into the group as is.
- `note`/`static` elements are rendered with `.form-control-plaintext`.
- Decorators `Feedback` and `Feedback_State` (state icons) are removed, validation state is shown with `.is-valid`/`.is-invalid` of the controls.
