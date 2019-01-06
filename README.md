# FormOne
Creates HTML web Form on PHP

[![Packagist](https://img.shields.io/packagist/v/eftec/formone.svg)](https://packagist.org/packages/eftec/formone)
[![Total Downloads](https://poser.pugx.org/eftec/FormOne/downloads)](https://packagist.org/packages/eftec/formone)
[![Maintenance](https://img.shields.io/maintenance/yes/2019.svg)]()
[![composer](https://img.shields.io/badge/composer-%3E1.8-blue.svg)]()
[![php](https://img.shields.io/badge/php->5.6-green.svg)]()
[![php](https://img.shields.io/badge/php-7.x-green.svg)]()
[![CocoaPods](https://img.shields.io/badge/docs-70%25-yellow.svg)]()

Instead of write this code

```html
<form method='POST' enctype='multipart/form-data' >
<label for='field1'>field 1:</label>
<input type='text' name='field1' id='field1'value='' />
<br>
</form>
```
Use instead this one

```php
<?php
$f=new \eftec\FormOne();

echo $f->start();
echo $f->id('field1')
    ->label('field 1:')
    ->type('label')
    ->render();
echo $f->id('field1')
    ->type('text')
    ->render();
echo $f->renderRaw('<br>');
echo $f->end();
```


- [FormOne](#formone)
  * [render()](#render--)
  * [start()](#start--)
  * [end()](#end--)
  * [idForm($idForm)](#idform--idform-)
  * [prefix($prefix)](#prefix--prefix-)
  * [name($name)](#name--name-)
  * [id($id)](#id--id-)
  * [disabled($disabled=true)](#disabled--disabled-true-)
  * [type($type)](#type--type-)
  * [addClass($classes)](#addclass--classes-)
  * [value($value)](#value--value-)
  * [itemValue($value)](#itemvalue--value-)
  * [label($label)](#label--label-)
  * [addItem($idOrArray,$text=null,$extra=null)](#additem--idorarray--text-null--extra-null-)
  * [addItems($items)](#additems--items-)
  * [addExtra($type,$value=null)](#addextra--type--value-null-)
  * [addAttr($type,$value=null)](#addattr--type--value-null-)
  * [onClick($js)](#onclick--js-)
  * [onChange($js)](#onchange--js-)
  * [addJScript($type,$js)](#addjscript--type--js-)
  * [bind($bind)](#bind--bind-)
  * [inner($htmlInner)](#inner--htmlinner-)
  * [readonly($readonly=true)](#readonly--readonly-true-)
  * [required($required=true)](#required--required-true-)
  * [Example](#example)
  * [version](#version)
  * [License.](#license)



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
| select   | ```<select>```             |
| text     | ```<input type='text'>```     |
| hidden     | ```<input type='hidden'>```     |
| password | ```<input type='password'>``` |
| email    | ```<input type='email'>```    |
| number   | ```<input type='number'>```   |
| checkbox | ```<input type='checkbox'>``` |
| radio    | ```<input type='radio'>```    |
| textarea | ```<textarea></textarea> ```  |
| label    | ```<label>label</label>```    |
| submit   | ```<button type='submit'>submit</button>```  |
| button   | ```<button type='button'>button</button>```  |

## addClass($classes)

It adds a class to the current element. You could add many classes using different calls. Examples: 

```php
$form
    ->addClass("col-sm-2 col-form-label")
```    

```php
$form
    ->addClass("col-sm-2")
    ->addClass("col-form-label")
```

## classType($type,$classes)

It adds a class to all elements of a type 

```php
$f->classType('label','col-sm-2 col-form-label'); // for all labels
$f->classType('text','col-sm-10 form-control'); // for all textbox
$f->classType('select','col-sm-10 form-control'); // for all select
```    

    
## value($value)

It sets the current value, for example the default value of a textbox

## itemValue($value)

It sets the value of the element. It's different to value because it's used when the value is "checked"

## label($label)

It sets the label of the element.   
It is used for label,checkbox,radiobuttons and buttons (inner html)  

## addItem($idOrArray,$text=null,$extra=null)

It adds a simple item to a list.
It is commonly used by type="select"

```php
$form->addItem('','--select a field--')
```

```php
$form->addItem(['id'=>'','text'=>'--select a field--'])
```
## addItems($items)

it adds multiple items to a list.  

```php
$array=[
            ['id'=>1,'text'=>'America'],
            ['id'=>2,'text'=>'Asia'],
            ['id'=>3,'text'=>'Europa'],
        ];
$form->addItem($array)
```
## addExtra($type,$value=null)

## addAttr($type,$value=null)

## onClick($js)

## onChange($js)

## addJScript($type,$js)

## bind($bind)

## inner($htmlInner)

## readonly($readonly=true)

## required($required=true)

## Example
```php
$form->type('label')
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
* 1.7 2018-20-29 A small optimization. Now if the class is empty then it doesn't render class='' 
* 1.6 2018-20-28 Added "hidden" type.
* 1.5 2018-20-27 Some cleanup and classType()
* 1.4 2018-20-27 start(),end(),prefix(),idform() and "password" type.
* 1.2 2018-10-22 Some cleanup.
* 1.1 2018-10-22 new features
* 1.0 2018-10-21 first version



## License. 
Copyright Jorge Castro Castillo Eftec 2018

This program is supplied as dual license, LGPLV2 or commercial. 

