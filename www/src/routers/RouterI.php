<?php

namespace App\routers;
require '../vendor/autoload.php';
interface RouterI {
    public function generate($route): string;

    public function run(): void;
}