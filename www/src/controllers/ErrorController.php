<?php
namespace App\controllers;

class ErrorController extends AbstractController
{
    public function error(array $typeErreur)
    {
        $messageError = 'Une erreur est servenue de type : ';
        $messageError .= (count($typeErreur)==0)? 'Inconnu': implode(" ",$typeErreur);
        
        ob_start();
        require_once DIR_VIEW . "error.php";
        return ob_get_clean();
    }
}