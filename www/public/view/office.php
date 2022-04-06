<h1>office</h1>
<?php

use App\utils\forms\Form;
use App\utils\validators\ValidatorFactory;

require '../vendor/autoload.php';



$form = new Form();
$val = function ($str):bool {
    $rtr = false;
    if(strlen($str)>5) {
        $rtr =true;
    }
    return $rtr;
};
$form   ->addInputText('login','Login')
        ->addInputPassword('password','Mot de passe',"",[],[ValidatorFactory::sizeStr(0,5)])
        ->addInputEmail('email','Email')
        ->addInputSubmit('sub','Envoyer');
        
if(!empty($_POST)) {
    $form->fillOut($_POST);
}
$form->show();

?>