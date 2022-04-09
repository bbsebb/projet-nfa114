<?php

namespace App\configs;

class ConfigRouteToController implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
        array('GET|POST', '/', 'HomeController#test', 'home'),
        array('GET', '/signin', 'signin', 'signin'),
        array('GET', '/signup', 'signup', 'signup'),
        array('GET', '/signout', 'signout', 'signout'),
        array('GET|POST', '/office', 'OfficeController#test', 'office'),
        array('GET', '/myappointment', 'myappointment', 'myappointment'),
        array('GET', '/profile', 'profile', 'profile'),
        array('GET', '/docagenda', 'docagenda', 'docagenda'),
        array('GET', '/admin', 'admin', 'admin'),
        array('GET', '/agenda', 'agenda', 'agenda'),
        array('GET', '/test', 'TestController#test', 'php.ini'),
        array('GET', '/error/[a:type]', 'ErrorController#error', 'error'));
    }
    public function add(mixed $args):self 
    {
        return $this;
    }
    public function get():array {
        return $this->config ;
    }
}