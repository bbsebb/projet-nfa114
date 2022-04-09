<?php

namespace App\configs;

interface ConfigI {
    public function add(mixed $args):self;
    public function get():array;
}