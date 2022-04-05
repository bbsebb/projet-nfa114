<?php

namespace App\utils;

require '../vendor/autoload.php';

class Validator implements ValidatorI{

    private  $condition;
    private string $fieldToValidate;
    private string $messageError;

    function __construct(callable $condition,$messageError) {
        $this->condition = $condition;
        $this->messageError = $messageError;
    }

    public function isValid():bool  {
        return call_user_func($this->condition, $this->fieldToValidate);
    }

    public function getMessageError():string {
        return $this->messageError;
    }

    public function setFieldToValidate($fieldToValidate):void {
        $this->fieldToValidate = $fieldToValidate;
    }

}