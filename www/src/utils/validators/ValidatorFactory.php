<?php

namespace App\utils\validators;

use App\services\UserService;
use Exception;

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
    public static function sizeStr(int|null $min = 0, int|null $max = PHP_INT_MAX): ValidatorI
    {

        $closure = function ($str) use ($min, $max): bool {
            $rtr = false;
            if (strlen($str) >= $min && strlen($str) <= $max) {
                $rtr = true;
            };
            return $rtr;
        };
        $str = 'La taille doit être';
        $str .= ($max == PHP_INT_MAX) ? " au minimue de $min" : "entre $min et $max";
        return new Validator($closure, $str);
    }

    public static function passwordVerify(): ValidatorI
    {
        $closure = function ($email): bool {
            $flag = false;
            try {
                $userService = new UserService();
                $flag = !$userService->userExist($email);
            } catch (Exception $e) {
                $flag = false;
            }
            return $flag;
        };
        return new Validator($closure, "l'utilisateur existe déjà");
    }

    public static function sameEmail(): ValidatorI
    {
        $closure = function ($email): bool {
            $flag = false;
            try {             
                $userService = new UserService();
                if (isset($_SESSION['auth']) && $_SESSION['auth']->getEmail() != $email) {
                    if (!$userService->userExist($email)) {
                        $flag = true;
                    } else {
                        $flag = false;
                    }
                } else {
                    $flag = true;
                }
            } catch (Exception $e) {
                $flag = false;
            }
            return $flag;
        };
        return new Validator($closure, "l'utilisateur existe déjà");
    }

    public static function isEmail(): ValidatorI
    {

        $closure = function ($email): bool {
            $rtr = false;
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $rtr = true;
            }
            return $rtr;
        };
        $str = "l'email n'est pas valide";
        return new Validator($closure, $str);
    }
}
