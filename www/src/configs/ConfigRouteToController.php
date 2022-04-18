<?php

namespace App\configs;

class ConfigRouteToController implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
        array('GET|POST', '/', 'HomeController#home', 'home'),
        array('GET', '/signin/[a:url]?', 'SignInController#signInGet', 'signin'),
        array('POST', '/signin/[a:url]?', 'SignInController#signInPost'),
        array('GET', '/signup', 'SignUpController#signUpGet', 'signup'),
        array('POST', '/signup', 'SignUpController#signUpPost'),
        array('GET', '/signout', 'SignOutController#signOut', 'signout'),
        array('GET|POST', '/office', 'OfficeController#office', 'office'),
        array('GET', '/myappointment', 'myappointment', 'myappointment'),
        array('GET', '/profile', 'ProfileController#profile', 'profile'),
        array('POST', '/profile', 'ProfileController#profilePost'),
        array('GET', '/docagenda', 'docagenda', 'docagenda'),
        array('GET', '/admin', 'AdminController#adminGet', 'admin'),
        array('POST', '/admin', 'AdminController#adminPost'),
        array('GET', '/admin/del/[i:id]', 'AdminController#delDoc'),
        array('GET', '/agenda', 'AgendaController#agenda', 'agenda'),
        array('GET', '/test', 'TestController#test', 'php.ini'),
        array('GET', '/error/[a:type]', 'ErrorController#error', 'error'));
    }
    public function add(mixed $args):self 
    {
        $this->config[] = $args;
        return $this;
    }
    public function get():array {
        return $this->config ;
    }
}