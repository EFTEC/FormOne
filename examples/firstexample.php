<!doctype html>
<html>
<?php
use eftec\MessageList;
use eftec\ValidationOne;
include "common.php";

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
</html>


