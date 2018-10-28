<!doctype html>
<html>
<link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<body>
<div class="row"><div class="col">

<?php
use eftec\MessageList;
use eftec\ValidationOne;
include "common.php";

$f=new \eftec\FormOne();
$f->classType('label','col-sm-2 col-form-label'); // for all labels
$f->classType('text','col-sm-10 form-control'); // for all labels
$f->classType('select','col-sm-10 form-control'); // for all labels

echo $f->start();
echo $f->id('field1')
    ->label('field 1:')
    ->type('label')
    ->render();
echo $f->id('field1')
    ->type('text')
    ->render();
echo $f->renderRaw('<br>');
echo $f->id('field2')
    ->label('field 2:')
    ->addExtra('style','cursor: pointer;')
    ->onClick('alert("ok");')
    ->type('label')->render();
echo $f->id('field2')
    ->type('text')
    ->render();
echo $f->renderRaw('<br>');
echo $f->id('field3')
    ->label('field 3:')
    ->type('label')
    ->addExtra('style','cursor: pointer;')
    ->onClick('alert(\'ok\');')
    ->render();
echo $f->id('field3')
    ->label('field 2:')
    ->type('select')
    ->addItem('','--select a field--')
    ->onChange('alert("changed")')
    ->bind(['id'=>'id','text'=>'text','extra'=>''])
    ->addItems(
        [
            ['id'=>1,'text'=>'America'],
            ['id'=>2,'text'=>'Asia'],
            ['id'=>3,'text'=>'Europa'],
        ])
    ->render();

echo $f->end();
?>
    </div>
</div>
</body>
</html>


