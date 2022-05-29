<?php
namespace App\utils\forms\builders;

use App\utils\forms\components\AbstractForm;
use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\SpanError;
use App\utils\forms\components\Submit;
use App\utils\validators\ValidatorFactory;

class SignUpForm extends AbstractFormBuilder{
    public static function get(string $action = ""):AbstractForm {
        $name = new Field(
            new Label("Nom"),
            new Input("name","","text",[ValidatorFactory::sizeStr(3)]),
            new SpanError()
        );
        $forname = new Field(
            new Label("Prenom"),
            new Input("forname","","text",[ValidatorFactory::sizeStr(3)]),
            new SpanError()
        );
        $tel = new Field(
            new Label("Téléphone"),
            new Input("tel","","text",[ValidatorFactory::sizeStr(10)]),
            new SpanError()
        );
        $emailFiel = new Field(
            new Label("Email"),
            new Input("email","","email",[ValidatorFactory::sameEmail(),ValidatorFactory::isEmail()]),
            new SpanError()
        );
        $passwordFiel = new Field(
            new Label("Votre mot de passe"),
            new Input("password","","password",[ValidatorFactory::sizeStr(3)]),
            new SpanError()
        );
        $passwordFiel2 = new Field(
            new Label("Retaper votre mot de passe"),
            new Input("password2","","password",[]),
            new SpanError()
        );
        $submit = new Submit();
        return new Form(
            array(
                $name,
                $forname,
                $tel, 
                $emailFiel,
                $passwordFiel,
                $passwordFiel2,
                $submit
            ),
            array("action"=>$action,"method"=>"POST"));
    }
}