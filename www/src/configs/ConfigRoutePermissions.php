<?php

namespace App\configs;

class ConfigRoutePermissions implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
            "/office"=> array("auth"=>true,"roles"=>["ADMIN","USER"]),
        );
    }
    public function add(mixed $args):self 
    {
        return $this;
    }
    public function get():array {
        return $this->config ;
    }
}