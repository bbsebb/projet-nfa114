<?php

namespace App\utils\validators;



class Validator implements ValidatorI{

    private  $condition;
    private string $fieldToValidate;
    private string $messageError;

    /**
     * @param callable $condition a function who return true if the condition checked otherwise return false
     * @param string $messageError is the error message returned id the condition is not valid.
     */
    function __construct(callable $condition,string $messageError = "Une erreur sur ce champs") {
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