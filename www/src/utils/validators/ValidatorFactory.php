<?php

namespace App\utils\validators;



class ValidatorFactory
{
    public static function sizeStr($min = 0, $max = 0): ValidatorI
    {
        $closure = function ($str) use($min,$max): bool {
            $rtr = false;
            if (strlen($str) > $min && strlen($str) < $max) {
                $rtr = true;
            };
            return $rtr;
        };
        return new Validator($closure, "La taille doit être entre $min et $max");
    }
}
