<?php

namespace App\utils;

interface ValidatorI {
    public function isValid():bool  ;

    public function getMessageError():string ;

    public function setFieldToValidate($fieldToValidate):void ;
}