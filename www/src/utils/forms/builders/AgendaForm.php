<?php
namespace App\utils\forms\builders;

use App\services\DoctorService;
use App\utils\forms\components\AbstractForm;
use App\utils\forms\components\Field;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Label;
use App\utils\forms\components\Option;
use App\utils\forms\components\Select;
use App\utils\forms\components\SpanError;

class AgendaForm extends AbstractFormBuilder{
    public static function get(string $action = ""):AbstractForm {
        $doctors = (new DoctorService())->getAll();
        if(!empty($doctors)) {
        foreach ($doctors as $doctor) {
            $options[] = new Option("D. {$doctor->getName()} {$doctor->getForname()}",$doctor->getId_doctor());
        }
        } else {
            $options = array();
        }  
        
        $select = new Select("doctors",$options,["id"=>"doctors"]);
        $input = new Input("Date","","date",[],["id"=>"date"]);
        
        $field1 = new Field(
            new Label("Docteur"),
            $select,
            new SpanError()
        );
        $field2 = new Field(
            new Label("Date"),
            $input,
            new SpanError()
        );
        return new Form(
            array(
                $field1,
                $field2
            ),
            array());
    }
}