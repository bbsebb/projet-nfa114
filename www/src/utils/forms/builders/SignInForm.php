<?php
namespace App\utils\forms\builders;

use App\utils\forms\components\AbstractForm;
use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\SpanError;
use App\utils\forms\components\Submit;

class SignInForm extends AbstractFormBuilder{
    public static function get(string $action = ""):AbstractForm {
        $emailFiel = new Field(
            new Label("Email"),
            new Input("email","","email",[]),
            new SpanError()
        );
        $passwordFiel = new Field(
            new Label("Password"),
            new Input("password","","password",[]),
            new SpanError()
        );
        $submit = new Submit();
        return new Form(array( $emailFiel,$passwordFiel,$submit),array("action"=>$action,"method"=>"POST"));
    }
}