<?php

namespace App\controllers;

class OfficeController extends AbstractController
{
    public function office()
    {
        ob_start();
        require_once DIR_VIEW . "office.php";
        return ob_get_clean();
    }
}