<?php

namespace App\controllers;

class AdminController extends AbstractController
{
    public function admin()
    {
        ob_start();
        require_once DIR_VIEW . "admin.php";
        return ob_get_clean();
    }
}
