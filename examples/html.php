
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body><div class="container"><div class="row"><div class="col">
<?php

use eftec\FormOne;
use eftec\ValidationOne;

$array=[1,2,3];

$instance=&$array[1];

$instance=20;

$form=null;

/**
 * @param string $id
 * @param string $prefix
 * @return FormOne|null
 */
function form($id="form1",$prefix="frm_") {
    global $form;
    if ($form===null) {
        $form=new FormOne($id,$prefix);
    }
    return $form;
}


include "common.php";


$valid=new ValidationOne('frm_');

$id=$valid->type('integer')
    ->def(20)
    ->ifFailThenOrigin()
    ->required()
    ->notempty()
    ->get('id');
$id2=$valid->type('integer')
    ->initial('200')
    ->notempty()
    ->useForm($form)
    ->get('id2');
$id3=$valid->type('string')
    ->ifFailThenOrigin()
    ->condition('betweenlen',"",[3,10])
    ->useForm($form)
    ->get('id3');
$id4=$valid->type('string')
    ->ifFailThenOrigin()
    ->condition('eq','','hello')
    ->useForm($form)
    ->get('id4');
$id5=$valid->type('boolean')
    ->isArray(true)
    ->useForm($form)
    ->get('id5');
$id6=$valid->type('integer')
    ->useForm($form)
    ->get('id6');
$button=$valid->type('string')->get('button');

if ($button) {
    $result=['id'=>$id,'id2'=>$id2,'i3'=>$id3,'id4'=>$id4,'id5'=>$id5,'id6'=>$id6];
} else {
    $result=['id'=>$id,'id2'=>$id2,'i3'=>$id3,'id4'=>$id4,'id5'=>$id5,'id6'=>$id6];
}

//echo "<pre>";
//var_dump($valid->conditions);
//echo "<pre>";

$countries=[
    ["1","Chile"],
    ["2","USA"],
    ["3","Canada"]
];

?>

            <h1>Example of form</h1>
            <div class="border border-black p-2">
            <form>
            <div class="form-group row">
                <?=form()->type('label')->id('id')->addClass("col-sm-2 col-form-label")->inner('Id 1:')->render() ?>
                <div class="col-sm-10">
                    <?=form()->name("id")->value($id)
                        ->addExtra('onchange','console.log("changed");')
                        ->type("select")
                        ->addExtra('style','width:400px')
                        ->addItem(["","--Select a country--"])
                        ->addItems($countries)
                        ->addClass('form-control')
                        ->render(); ?>
                    <div class="text-danger"><?=$valid->messageList->get('id')->firstError();?></div>
                </div>

            </div>
            <div class="form-group row">
                <?=form()->type('label')->id('id2')->addClass("col-sm-2 col-form-label")->inner('Id 2:')->render() ?>
                <div class="col-sm-10">
                    <?=form()->name("id2")->value($id2)
                        ->type("text")
                        ->addClass('form-control')
                        ->render(); ?>
                    <div class="text-danger"><?=$valid->messageList->get('id2')->firstError();?></div>
                </div>
            </div>
            <div class="form-group row">
                <?=form()->type('label')->id('id3')->addClass("col-sm-2 col-form-label")->inner('Id 3:')->render() ?>
                <div class="col-sm-10">
                    <?=form()->name("id3")->value($id3)
                        ->type("text")
                        ->addClass('form-control')
                        ->render(); ?>
                    <div class="text-danger"><?= $valid->messageList->get('id3')->firstError();?></div>
                </div>
            </div>
            <div class="form-group row">
                <?=form()->type('label')->id('id4')->addClass("col-sm-2 col-form-label")->inner('Id 4:')->render() ?>
                <div class="col-sm-10">
                    <?=form()->name("id4")->value($id4)
                        ->type("textarea")
                        ->addClass('form-control')
                        ->render(); ?>
                    <div class="text-danger"><?= $valid->messageList->get('id4')->firstError();?></div>
                </div>
            </div>
                <div class="form-group row">
                    <?=form()->type('label')->id('id5')->addClass("col-sm-2 col-form-label")->inner('Id 5:')->render() ?>
                    <div class="col-sm-10">



                        <div class="custom-control custom-checkbox">
                            <?=form()->name("id5[0]")->id('id5a')->value(@$id5[0])
                                ->type("checkbox")
                                ->itemValue('1')
                                ->addClass('custom-control-input')
                                ->render(); ?>
                            <label class="custom-control-label" for="frm_id5a">Check this custom checkbox</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <?=form()->name("id5[1]")->id('id5b')->value(@$id5[1])
                                ->type("checkbox")
                                ->itemValue('2')
                                ->addClass('custom-control-input')
                                ->render(); ?>
                            <label class="custom-control-label" for="frm_id5b">Check this custom checkbox</label>
                        </div>

                        <div class="text-danger"><?= $valid->messageList->get('id5')->firstError();?></div>
                    </div>
                </div>
                <div class="form-group row">
                    <?=form()->type('label')->id('id6')->addClass("col-sm-2 col-form-label")->inner('Id 6:')->render() ?>
                    <div class="col-sm-10">



                        <div class="custom-control custom-radio">
                            <?=form()->name("id6")->id('id6a')->value($id6)
                                ->type("radio")
                                ->itemValue('1')
                                ->addClass('custom-control-input')
                                ->render(); ?>
                            <label class="custom-control-label" disabled for="frm_id6a">Value=1</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <?=form()->name("id6")->id('id6b')->value($id6)
                                ->type("radio")
                                ->itemValue('2')
                                ->addClass('custom-control-input')
                                ->render(); ?>
                            <label class="custom-control-label" disabled for="frm_id6b">Value=2</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <?=form()->name("id6")->id('id6c')->value($id6)
                                ->type("radio")
                                ->disabled()
                                ->itemValue('3')
                                ->addClass('custom-control-input')
                                ->render(); ?>
                            <label class="custom-control-label" disabled for="frm_id6c">Value=3 (disabled)</label>
                        </div>

                        <div class="text-danger"><?= $valid->messageList->get('id6')->firstError();?></div>
                    </div>
                </div>
            <div class="form-group row">
                <?=form()->type('label')->id('id6')->addClass("col-sm-2 col-form-label")->inner('&nbsp;')->render() ?>
                <div class="col-sm-10">
                    <?=form()->name("button")
                        ->type('submit')
                        ->label('button')
                        ->addClass('btn btn-primary')
                        ->value(1)
                        ->render() ?>
                </div>
            </div>
                <div class="form-group row">
                    <?=form()->type('label')->id('id6')->addClass("col-sm-2 col-form-label")->inner('Result :')->render() ?>
                    <div class="col-sm-10">
                        <pre><?=json_encode($result,JSON_PRETTY_PRINT)?></pre>
                    </div>
                </div>
                <div class="form-group row">
                    <?=form()->type('label')->id('id6')->addClass("col-sm-2 col-form-label")->inner('Result Container :')->render() ?>
                    <div class="col-sm-10">
                        <pre><?=json_encode(form()->container,JSON_PRETTY_PRINT)?></pre>
                    </div>
                </div>
            </form>
                </div>
        </div> </div>


</div>
</body>
</html>
