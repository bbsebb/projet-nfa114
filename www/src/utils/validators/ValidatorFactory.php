<?php

namespace App\utils\validators;


/**
 * This class is a collection de ValidatorI
 */
class ValidatorFactory
{
    /**
     * This method check the string length
     * @param int $min is the min length
     * @param int $max is the max length
     * @return ValidatorI 
     */
    public static function sizeStr(int $min = 0,int $max = 0): ValidatorI
    {
        $closure = function ($str) use($min,$max): bool {
            $rtr = false;
            if (strlen($str) >= $min && strlen($str) <= $max) {
                $rtr = true;
            };
            return $rtr;
        };
        return new Validator($closure, "La taille doit être entre $min et $max");
    }
}
