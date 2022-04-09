<?php
namespace App\controllers;

class TestController extends AbstractController
{
    public function test()
    {
        ob_start();
        phpinfo();
        return ob_get_clean();
    }
}