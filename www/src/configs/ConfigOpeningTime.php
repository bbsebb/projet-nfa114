<?php

namespace App\configs;

use DateTime;

class ConfigOpeningTime implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
            "monday" => array("AM" => array('08:00','12:00'),"PM" => array('14:00','17:00')),
            "tuesday" => array("AM" => array('08:00','12:00'),"PM" => array('14:00','17:00')),
            "wednesday" => array("AM" => array('08:00','12:00'),"PM" => array('14:00','17:00')),
            "thursday" => array("AM" => array('08:00','12:00'),"PM" => array('14:00','17:00')),
            "friday" => array("AM" => array('08:00','12:00'),"PM" => array('14:00','17:00')),
            "saturday" => array("AM" => array(),"PM" => array()),
            "sunday" => array("AM" => array(),"PM" => array())
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