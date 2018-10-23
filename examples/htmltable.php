<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>
<body><form><div class="container"><div class="row"><div class="col">
<?php

use eftec\FormOne;
use eftec\ValidationOne;

$array=[1,2,3];

$instance=&$array[1];

$instance=20;



include "common.php";

$form=new FormOne('form1','frm_');
$valid=new ValidationOne('frm_');

$id=$valid->type('integer')
    ->ifFailThenOrigin()
    ->required()
    ->notempty()
    ->isArray(false)
    ->isColumn(true)
    ->get('id');
$id2=$valid->type('integer')
    ->ifFailThenOrigin()
    ->notempty()
    ->isArray(false)
    ->isColumn(true)
    ->get('id2');
$id3=$valid->type('string')
    ->ifFailThenOrigin()
    ->condition('betweenlen',"",[3,10])
    ->isArray(false)
    ->isColumn(true)
    ->get('id3');

$button=$valid->type('string')->get('button');

if ($button) {
    $result=['id'=>$id,'id2'=>$id2,'i3'=>$id3];
} else {
    $result=[];
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

                <div class="form-group row">
                    <div class="col">
                        <table  class="table">
                            <?php for($i=0;$i<3;$i++) { ?>
                            <tr>
                                <td><?=$form->name("id[$i]")->value($id[$i])
                                        ->addExtra('onchange','console.log("changed");')
                                        ->type("select")
                                        ->addExtra('style','width:400px')
                                        ->addItem(["","--Select a country--"])
                                        ->addItems($countries)
                                        ->addClass('form-control')
                                        ->render(); ?>
                                    <div class="text-danger"><?= $valid->messageList->get("id[$i]")->firstError();?></div>
                                </td>
                                <td><?=$form->name("id2[$i]")->value($id2[$i])
                                        ->type("text")
                                        ->addClass('form-control')
                                        ->render(); ?>
                                    <div class="text-danger"><?=$valid->messageList->get("id2[$i]")->firstError();?>
                                </td>
                                <td><?=$form->name("id3[$i]")->value($id3[$i])
                                        ->type("text")
                                        ->addClass('form-control')
                                        ->render(); ?>
                                    <div class="text-danger"><?= $valid->messageList->get("id3[$i]")->firstError();?>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <?= $form->name("button")
                            ->type('submit')
                            ->label('button')
                            ->addClass('btn btn-primary')
                            ->value(1)
                            ->render() ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Result</label>
                    <div class="col-sm-10">
                        <pre><?= json_encode($result, JSON_PRETTY_PRINT) ?></pre>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Errors</label>
                    <div class="col-sm-10">
                        <pre><?= json_encode($valid->messageList->allErrorArray(), JSON_PRETTY_PRINT) ?></pre>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>
</body>
</html>
