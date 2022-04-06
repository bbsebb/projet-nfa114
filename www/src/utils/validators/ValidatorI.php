<?php

namespace App\utils\validators;

interface ValidatorI {
    /**
     * @return bool true if the condition checks the field otherwise false
     */
    public function isValid():bool  ;

    /**
     * @return string is the error message
     */
    public function getMessageError():string ;

    /**
     * @param string $fieldToValidate is the string checked
     */
    public function setFieldToValidate(string $fieldToValidate):void ;
}