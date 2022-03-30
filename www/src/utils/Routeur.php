<?php
namespace App\utils;

use AltoRouter;

class Routeur {
    public AltoRouter $altoRouteur;

    public function __construct()
    {
        $this->altoRouteur = new AltoRouter();
    }
}