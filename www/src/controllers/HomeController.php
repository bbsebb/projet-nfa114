<?php

namespace App\controllers;

class HomeController extends AbstractController
{


    private array $bind = ["title" => "Accueil"];
    private static string $pageName = "home.php";
    public function home()
    {
        ob_start();
        require_once DIR_VIEW . self::$pageName;
        return ob_get_clean();
    }
}
