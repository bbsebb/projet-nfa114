<h1>office</h1>
<?php

require '../vendor/autoload.php';

use App\utils\Form;
use App\utils\Tag;
use App\utils\Validator;

$form = new Form();
$val = function ($str):bool {
    $rtr = true;
    if(strlen($str)<5) {
        $rtr =false;
    }
    return $rtr;
};



$form->addField('input1',Tag::Input,'text','tzzt',array("class"=>"input"),array(new Validator($val,"taille inferieur à 5")));
$form->addField('input2',Tag::Input,'text','tzzest2',array("class"=>"input"),array(new Validator($val,"taille inferieur à 5")));
$form->show();
?>