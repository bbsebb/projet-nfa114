<?php

namespace App\routers;
require '../vendor/autoload.php';
interface RouterI {
    public function generate($route): string;


    /**
     * run the application
     */
    public function run(): void;
}