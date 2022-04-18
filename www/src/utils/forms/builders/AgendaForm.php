<?php
namespace App\utils\forms\builders;

use App\services\DoctorService;
use App\utils\forms\components\AbstractForm;
use App\utils\forms\components\Form;
use App\utils\forms\components\Input;
use App\utils\forms\components\Option;
use App\utils\forms\components\Select;

class AgendaForm extends AbstractFormBuilder{
    public static function get(string $action = ""):AbstractForm {
        $doctors = (new DoctorService())->getAll();
        foreach ($doctors as $doctor) {
            $options[] = new Option("D. {$doctor->getName()} {$doctor->getForname()}",$doctor->getId_doctor());
        }
        $select = new Select("doctors",$options,["id"=>"doctors"]);
        $input = new Input("Date","","date",[],["id"=>"date"]);
        
        return new Form(
            array(
                $select,
                $input

            ),
            array());
    }
}