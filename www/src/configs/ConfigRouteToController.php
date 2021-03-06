<?php

namespace App\configs;

class ConfigRouteToController implements ConfigI {
    private array $config;
    public function __construct()
    {
        $this->config = array(
        array('GET|POST', '/', 'OfficeController#office', 'home'),
        array('GET', '/signin/[a:url]?', 'SignInController#signInGet', 'signin'),
        array('POST', '/signin/[a:url]?', 'SignInController#signInPost'),
        array('GET', '/signup', 'SignUpController#signUpGet', 'signup'),
        array('POST', '/signup', 'SignUpController#signUpPost'),
        array('GET', '/signout', 'SignOutController#signOut', 'signout'),
        array('GET|POST', '/office', 'OfficeController#office', 'office'),
        array('GET', '/myappointment', 'MyappointmentController#myappointment', 'myappointment'),
        array('GET', '/myappointment/del/[i:id]', 'MyappointmentController#delAppointment'),
        array('GET', '/profile', 'ProfileController#profile', 'profile'),
        array('POST', '/profile', 'ProfileController#profilePost'),
        array('GET', '/docagenda', 'DocagendaController#docagenda', 'docagenda'),
        array('GET', '/admin', 'AdminController#adminGet', 'admin'),
        array('POST', '/admin', 'AdminController#adminPost'),
        array('GET', '/admin/del/[i:id]', 'AdminController#delDoc'),
        array('GET', '/agenda', 'AgendaController#agenda', 'agenda'),
        array('GET', '/agenda/[i:id]/[:date]', 'AgendaController#ajaxGet'),
        array('POST', '/agenda/[i:id]/[:date]', 'AgendaController#ajaxPost'),
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