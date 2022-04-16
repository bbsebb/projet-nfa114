<?php

namespace App\configs;

class ConfigRoutePermissions implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
            
            "/admin"=> array("auth"=>true,"roles"=>["ADMIN"]),
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