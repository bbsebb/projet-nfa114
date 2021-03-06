<?php

namespace App\configs;

class ConfigRoutePermissions implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
            
            "/admin*"=> array("auth"=>true,"roles"=>["ADMIN"]),
            "/profile"=> array("auth"=>true,"roles"=>[]),
            "/agenda"=> array("auth"=>true,"roles"=>["USER","ADMIN"]),
            "/test*"=> array("auth"=>true,"roles"=>["ADMIN"]),
            "/myappointment*"=> array("auth"=>true,"roles"=>["USER","ADMIN"]),
            "/docagenda"=> array("auth"=>true,"roles"=>["DOCTOR"]),
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