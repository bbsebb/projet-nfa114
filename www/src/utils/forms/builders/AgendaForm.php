<?php
namespace App\utils\forms\builders;

use App\services\DoctorService;
use App\utils\forms\components\AbstractForm;
use App\utils\forms\components\Form;
use App\utils\forms\components\Option;
use App\utils\forms\components\Select;

class AgendaForm extends AbstractFormBuilder{
    public static function get(string $action = ""):AbstractForm {
        $doctors = (new DoctorService())->getAll();
        $option = new Option("doctors1","doctor1");
        $select = new Select("doctors",[$option],["id"=>"doctors"]);
        
        return new Form(
            array(
                $select

            ),
            array());
    }
}