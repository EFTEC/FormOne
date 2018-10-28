# FormOne
Creates HTML web Form on PHP

[![Packagist](https://img.shields.io/packagist/v/eftec/formone.svg)](https://packagist.org/packages/eftec/formone)
[![Maintenance](https://img.shields.io/maintenance/yes/2018.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E1.6-blue.svg)]()
[![php](https://img.shields.io/badge/php->5.6-green.svg)]()
[![php](https://img.shields.io/badge/php-7.x-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()

## render()

It's the end of the chain. It generates the end result (html)

## start()

Start a form (<form>)

## end()

End a form (</form>)

## idForm($idForm)

It sets the identifier of the current form.

## prefix($prefix)

It marks the prefix used by the name fields. Example "frm_"

## name($name)

Sets the name of the current chain. 

> Note: if id() is not set at the end of the chain then, it also sets the **id**

## id($id)

it sets the id of the current chain.

> Note: if name() is not set at the end of the chain then, it also sets the **name**

## disabled($disabled=true)

It sets the attribute disable of the chain

## type($type)

| type     | Description             |
|----------|-------------------------|
| select   | <select>                |
| text     | <input type='text'>     |
| password | <input type='password'> |
| email    | <input type='email'>    |
| number   | <input type='number'>   |
| checkbox | <input type='checkbox'> |
| radio    | <input type='radio'>    |
| textarea | <textarea></textarea>   |
| label    | <label>label</label>    |
| submit   | <button type='submit'>submit</button>  |
| button   | <button type='button'>button</button>  |

## Example
```php
form()->type('label')
    ->id('id')
    ->addClass("col-sm-2 col-form-label")
    ->inner('Id 1:')
    ->render()
```

it renders
```html
<label for='id' class="col-sm-2 col-form-label">Id 1:</label>
```



## version

* 1.4 2018-20-27 start(),end(),prefix(),idform() and "password" type.
* 1.2 2018-10-22 Some cleanup.
* 1.1 2018-10-22 new features
* 1.0 2018-10-21 first version



## License. 
Copyright Jorge Castro Castillo Eftec 2018

This program is supplied as dual license, LGPLV2 or commercial. 

