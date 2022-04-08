<h1>home</h1>

<?php

use App\utils\forms2\Field;
use App\utils\forms2\Form;
use App\utils\forms2\Input;
use App\utils\forms2\Label;
use App\utils\forms2\SpanError;
use App\utils\forms2\Submit;
use App\utils\forms2\VisiteurFillOut;
use App\utils\forms2\VisiteurToHTML;
use App\utils\validators\ValidatorFactory;

require '../vendor/autoload.php';
$input = new Input("login","zzzzzzzzzzz", "text", [ValidatorFactory::sizeStr(1, 5)]);
$label = new Label("Votre login");
$spanError = new SpanError(["class" => "error"]);

$input1 = new Input("password","", "password", [ValidatorFactory::sizeStr(1, 5)]);
$label1 = new Label("Votre mot de passe");
$spanError1 = new SpanError(["class" => "error"]);

$input2 = new Input("email","", "email", [ValidatorFactory::sizeStr(1, 5)]);
$label2 = new Label("Votre email");
$spanError2 = new SpanError(["class" => "error"]);

$form = new Form([], ["method" => "POST", "action" => ""]);
$form->addChild(new Field( $label, $input, $spanError))
    ->addChild(new Field( $label1, $input1, $spanError1))
    ->addChild(new Field( $label2, $input2, $spanError2))
    ->addChild(new Submit());

if (!empty($_POST)) {
    $form->accept(new VisiteurFillOut($_POST));
}
echo $form->accept(new VisiteurToHTML());
?>