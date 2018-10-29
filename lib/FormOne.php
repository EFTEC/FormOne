<?php

namespace eftec;

/**
 * It is an html generator of code.
 * Class FormOne
 * @package eftec
 * @author Jorge Castro Castillo
 * @version 1.7 2018-oct-29
 * @copyright (c) Jorge Castro C. LGLPV2 License  https://github.com/EFTEC/FormOne
 * @see https://github.com/EFTEC/FormOne
 */
class FormOne
{
    private $idForm='';
    private $prefix='';
    private $name;
    private $id;
    private $type;
    private $classes=[];
    private $value;
    private $itemValue;
    private $label;
    private $items=[];
    /** @var string[]  */
    private $extras=[];
    private $htmlInner;
    private $bind=['id'=>'id','text'=>'text','extra'=>''];
    private $classXType=[];


    /**
     * @var ValidationOne
     */
    private $validationParent;

    private $htmlContainer=[];

    private $jsResult=[];
    public $container=[];
    /** @var boolean */
    private $disabled=false;
    private $readonly=false;
    private $required=false;

    /**
     * ValidationHtmlOne constructor.
     * @param string $idForm
     * @param string $prefix
     */
    public function __construct($idForm='form1',$prefix='')
    {
        $this->idForm=$idForm;
        $this->prefix = $prefix;
    }



    public function render() {
        $html="";
        switch ($this->type) {
            case 'select':
                $html=$this->renderSelect();
                break;
            case 'text':
            case 'hidden':
            case 'email':
            case 'number':
            case 'password':
                $html=$this->renderInput($this->type);
                break;
            case 'checkbox':
                $html=$this->renderCheckbox();
                break;
            case 'radio':
                $html=$this->renderRadio();
                break;
            case 'textarea':
                $html=$this->renderTextArea();
                break;
            case 'label':
                $html=$this->renderLabel();
                break;
            case 'submit':
            case 'button':
                $html=$this->renderButton($this->type);
                break;
            default:
                trigger_error("type not defined {$this->type}");

        }
        $this->cleanChain();
        return $html;
    }
    private function cleanChain() {
        $this->name=null;
        $this->id=null;
        $this->type=null;
        $this->classes=[];
        $this->value=null;
        $this->itemValue=null;
        $this->label=null;
        $this->items=[];
        $this->bind=['id'=>'id','text'=>'text','extra'=>''];
        $this->extras=[];
        $this->htmlInner=null;
        $this->disabled=false;
        $this->readonly=false;
        $this->required=false;

    }

    /**
     * It sets a class per type of element. <br>
     * This value is keep for other elements so it could be used to skips repetitive classes.
     * @param $type
     * @param $class
     */
    public function classType($type,$class) {
        $this->classXType[$type]=$class;
    }

    //<editor-fold desc="render methods">
    public function renderRaw($html) {
        return $html;
    }
    /**
     * Start a form (<form>)
     * @param string $method
     * @param string $enctype=['application/x-www-form-urlencoded','multipart/form-data','text/plain][$i]
     * @param string $action
     * @return string
     */
    public function start($method='POST',$enctype='multipart/form-data',$action='') {
        $actHtml=($action)?"action='$action'":'';
        return "<form method='$method' enctype='$enctype' $actHtml>";
    }
    /**
     * End a form (</form>)
     * @return string
     */
    public function end() {
        return "</form>";
    }
    private function renderSelect() {
        $html="<select {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()}>\n";
        foreach($this->items as $item) {
            $selected=($this->value==$item['id'])?'selected':'';
            $html.="<option value='{$item['id']}' {$item['extra']} $selected>{$item['text']}</option>\n";
        }
        $html.=$this->htmlInner."\n";
        $html.="</select>\n";
        return $html;
    }
    private function renderInput($type) {
        $html="<input type='$type' {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()} {$this->renderValue()} />\n";
        return $html;
    }
    private function renderCheckbox() {
        $this->itemValue=(!$this->itemValue)?1:$this->itemValue;
        $checked=($this->value==$this->itemValue)?'checked':'';
        $html="<input type='checkbox' {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()} {$this->renderItemValue()} $checked />\n{$this->label}";
        return $html;
    }
    private function renderRadio() {
        $this->itemValue=(!$this->itemValue)?1:$this->itemValue;
        $checked=($this->value==$this->itemValue)?'checked':'';
        $html="<input type='radio' {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()} {$this->renderItemValue()} $checked />\n{$this->label}";
        return $html;
    }
    private function renderTextArea() {
        $html="<textarea {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()}>\n";
        $html.=$this->escape($this->value);
        $html.="</textarea>\n";
        return $html;
    }
    private function renderLabel() {
        $name=($this->name)?$this->prefix.$this->name:$this->prefix.$this->id;
        $html="<label for='$name' {$this->renderClasses()} {$this->renderExtra()}>\n";
        $html.=$this->label.$this->htmlInner;
        $html.="</label>\n";
        return $html;
    }
    private function renderValue() {
        return "value='".htmlentities($this->value, ENT_QUOTES, 'UTF-8', false)."'";
    }
    private function renderItemValue() {
        return "value='".htmlentities($this->itemValue, ENT_QUOTES, 'UTF-8', false)."'";
    }
    private function escape($content) {
        return htmlentities($content, ENT_QUOTES, 'UTF-8', false);
    }

    private function renderButton($type) {
        $html="<button type='$type' {$this->renderId()} {$this->renderClasses()} {$this->renderExtra()} {$this->renderValue()} > {$this->label}\n";
        $html.=$this->htmlInner."\n";
        $html.="</button>\n";
        return $html;
    }
    private function renderId() {
        if ($this->id===null) $this->id=$this->name;
        if ($this->name===null) $this->name=$this->id;
        return "name='".$this->prefix.$this->name."' id='".$this->prefix.$this->id."'";
    }
    private function renderClasses() {
        if (isset($this->classXType[$this->type])) {
            $this->classes[]=$this->classXType[$this->type];
        }
        if (count($this->classes)) {
            return "class='" . implode(' ', $this->classes) . "'";
        } else {
            return ''; // no class.
        }
    }
    private function renderExtra() {
        $html="";
        foreach($this->extras as $key=>$extra) {
            if ($extra===null) {
                $html.=" {$key}";
            } else {
                $html.=" {$key}='{$extra}'";
            }
        }
        $html.=' '.(($this->disabled)?'disabled':'');
        $html.=' '.(($this->readonly)?'readonly':'');
        $html.=' '.(($this->required)?'required':'');
        return $html;
    }
    //</editor-fold>

    /**
     * @param string $idForm
     * @return FormOne
     */
    public function idForm($idForm)
    {
        $this->idForm = $idForm;
        return $this;
    }
    /**
     * @param string $prefix
     * @return FormOne
     */
    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }



    public function name($name) {
        $this->name=$name;
        return $this;
    }
    public function id($id) {
        $this->id=$id;
        return $this;
    }

    /**
     * @param boolean $disabled
     * @return FormOne $this
     */
    public function disabled($disabled=true) {
        $this->disabled=$disabled;
        return $this;
    }

    /**
     * @param $type=['select','text','hidden','password','email','number','checkbox','radio','textarea','label','submit','button'][$i]
     * @return $this
     */
    public function type($type) {
        $this->type=$type;
        return $this;
    }

    /**
     * It adds a new class to the current element
     * @param $classes
     * @return $this
     */
    public function addClass($classes) {
        $this->classes[]=$classes;
        return $this;
    }

    /**
     * It sets the value of the element
     * @param string|integer|boolean|double $value
     * @return $this
     */
    public function value($value) {
        $this->value=$value;
        return $this;
    }

    /**
     * It sets the value of the element. It's different to value because it's used when the value is "checked"
     * @param $value
     * @return $this
     * @see FormOne::renderCheckbox()
     * @see FormOne::renderRadio()
     */
    public function itemValue($value) {
        $this->itemValue=$value;
        return $this;
    }

    /**
     * It sets the label of the element.<br>
     * It is used for label,checkbox,radiobuttons and buttons (inner html)
     * @param $label
     * @return $this
     */
    public function label($label) {
        $this->label=$label;
        return $this;
    }

    /**
     * It adds a simple item to a list.<br>
     * It is commonly used by type="select"
     * @param array|mixed $idOrArray =['id'=>0,'text'=>'','extra'=>'']
     * @param null|string $text
     * @param null|string $extra
     * @return $this
     * @see FormOne::bind()
     * @see FormOne::renderSelect()
     */
    public function addItem($idOrArray,$text=null,$extra=null) {
        if ($idOrArray===null) return $this;
        if ($text!==null) {
            $arr = ['id' => $idOrArray, 'text' => $text, 'extra' => $extra];
        } else {
            if (is_object($idOrArray)) {
                $arr['id']=$idOrArray->{$this->bind['id']};
                $arr['text']=$idOrArray->{$this->bind['text']};
                $arr['extra']=(@$this->bind['extra'])?@$idOrArray->{$this->bind['extra']}:'';
            } else {
                if (isset($idOrArray[0])) { // it's an indexed array
                    $arr = ['id' => $idOrArray[0], 'text' => $idOrArray[1], 'extra' => @$idOrArray[2]];
                } else { // it's a associative array
                    $arr['id'] = $idOrArray[$this->bind['id']];
                    $arr['text'] = $idOrArray[$this->bind['text']];
                    $arr['extra'] = (@$this->bind['extra'])?@$idOrArray[@$this->bind['extra']]:'';
                }
            }
        }
        $this->items[]=$arr;
        return $this;
    }

    /**
     * It adds an array of items.
     * @param array $items
     * @return $this
     * @see FormOne::addItem()
     * @see FormOne::bind()
     * @see FormOne::renderSelect()
     */
    public function addItems($items) {
        if ($items===null) return $this;
        foreach($items as $item) {
            $this->addItem($item,null,null);
        }
        return $this;
    }

    /**
     * Alias of addAttr()
     * @param string $type
     * @param string|null $value
     * @return $this
     * @see FormOne::addAttr()
     */
    public function addExtra($type,$value=null) {
        return $this->addAttr($type,$value);
    }
    /**
     * It adds an attribute to the tag. If value is empty then the property is render as simple index without value.
     * @param string $type
     * @param string|null $value
     * @return $this
     */
    public function addAttr($type,$value=null) {
        $this->extras[$type]=$value;
        return $this;
    }
    /**
     * It sets the property onClick
     * @param string $js
     * @return $this
     */
    public function onClick($js) {
        return $this->addJScript('onClick',$js);
    }
    /**
     * It sets the property onClick
     * @param string $js
     * @return $this
     */
    public function onChange($js) {
        return $this->addJScript('onChange',$js);
    }

    /**
     * It adds an attribute of javascript
     * @param $type
     * @param $js
     * @return $this
     */
    public function addJScript($type,$js) {
        $this->extras[$type]=htmlentities($js, ENT_QUOTES, 'UTF-8', false);
        return $this;
    }

    /**
     * It sets the binding of fields. It's used by addItem()
     * @param $bind=['id'=>'id','text'=>'text','extra'=>'']
     * @return $this
     * @see FormOne::addItem()
     */
    public function bind($bind) {
        $this->bind=$bind;
        return $this;
    }

    /**
     * It sets the inner html. It could be used by type=select,label and button
     * @param $htmlInner
     * @return $this
     * @see FormOne::label()
     */
    public function inner($htmlInner) {
        $this->htmlInner=$htmlInner;
        return $this;
    }

    /**
     * Sets the field to read only
     * @param bool $readonly
     * @return $this
     */
    public function readonly($readonly=true) {
        $this->readonly=$readonly;
        return $this;
    }

    /**
     * Sets the field to required
     * @param bool $required
     * @return $this
     */
    public function required($required=true) {
        $this->required=$required;
        return $this;
    }
    /**
     * For use future
     * @param $r
     * @param $cond
     * @param $msg
     */
    public function jsNumericCondition($r,$cond,$msg) {

        switch ($cond->type) {
            case 'req':
                $jsCond = "data !== null && data !== ''";
                break;
            case 'lt':
                $jsCond = "data >='{$cond->value}'";
                break;
            case 'lte':
                $jsCond = "data >'{$cond->value}'";
                break;
            case 'gt':
                $jsCond = "data <='{$cond->value}'";
                break;
            case 'eq':
                $jsCond = "data !='{$cond->value}'";
                break;
            case 'ne':
                $jsCond = "data =='{$cond->value}'";
                break;
            case 'gte':
                $jsCond = "data <'{$cond->value}'";
                break;
            case 'between':
                $jsCond = "data <'{$cond->value[0]}' || data >'{$cond->value[1]}' ";
                break;
            case 'null':
                $jsCond = "data !==null ";
                break;
            case 'notnull':
                $jsCond = "data ===null ";
                break;
            default:
                trigger_error("type not defined {$cond->type}");
        }
        $js="if ($jsCond) { // {$this->name}
            var msg='$msg';
        }\n";
        $this->container[$this->name][]=$js;
    }

    /**
     * For use future
     * @param $r
     * @param $cond
     * @param $msg
     */
    public function jsStringCondition($r,$cond,$msg) {
        $jsCond='';
        switch ($cond->type) {
            case 'req':
                $jsCond = "data !== null && data !== ''";
                break;
            case 'lt':
                $jsCond = "data >='{$cond->value}'";
                break;
            case 'lte':
                $jsCond = "data >'{$cond->value}'";
                break;
            case 'gt':
                $jsCond = "data <='{$cond->value}'";
                break;
            case 'eq':
                $jsCond = "data !='{$cond->value}'";
                break;
            case 'ne':
                $jsCond = "data =='{$cond->value}'";
                break;
            case 'gte':
                $jsCond = "data <'{$cond->value}'";
                break;
            case 'between':
                $jsCond = "data <'{$cond->value[0]}' || data >'{$cond->value[1]}' ";
                break;
            case 'betweenlen':
                $msg = '%field size is not between %first and %second ';
                $jsCond = "data <'{$cond->value[0]}' || data >'{$cond->value[1]}' ";
                break;

            case 'null':
                $jsCond = "data !==null ";
                break;
            case 'notnull':
                $jsCond = "data ===null ";
                break;
            default:
                trigger_error("type not defined {$cond->type}");
        }
        $js="if ($jsCond) { // {$this->name}
            var msg='$msg';
        }\n";
        $this->container[$this->name][]=$js;
    }

    /**
     * For use future.
     * @param ValidationOne $param
     * @param string $fieldId
     */
    public function callBack($param, $fieldId)
    {
    }

}