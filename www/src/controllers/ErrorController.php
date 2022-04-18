<?php
namespace App\controllers;

class ErrorController extends AbstractController
{

    private array $bind = ["title" => "Erreur"];
    private static string $pageName = "error.php";

    public function error(array $typeErreur)
    {
        $this->bind['errorMessage'] = '';
        $this->bind['errorMessage'] = 'Une erreur est servenue de type : ';
        $this->bind['errorMessage'] .= (count($typeErreur)==0)? 'Inconnu': implode(" ",$typeErreur);
        
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}