<?php

namespace App\controllers;

class HomeController extends AbstractController
{
    public function test()
    {
        ob_start();
        require_once DIR_VIEW . "home.php";
        return ob_get_clean();
    }
}
