<?php
namespace App\utils\forms\builders;

use App\utils\forms\components\AbstractForm;

abstract class AbstractFormBuilder {
    abstract public  static function get(string $action = ""):AbstractForm ;
}