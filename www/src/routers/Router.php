<?php

namespace App\routers;

require '../vendor/autoload.php';

use AltoRouter;
use App\controllers\HomeController;

class Router
{

    private AltoRouter $altoRouter;

    public function __construct()
    {
        $this->altoRouter = new AltoRouter();
        $this->altoRouter->map('GET|POST', '/', 'HomeController#test', 'home');
        $this->altoRouter->map('GET', '/signin', 'signin', 'signin');
        $this->altoRouter->map('GET', '/signup', 'signup', 'signup');
        $this->altoRouter->map('GET', '/signout', 'signout', 'signout');
        $this->altoRouter->map('GET|POST', '/office', 'OfficeController#test', 'office');
        $this->altoRouter->map('GET', '/myappointment', 'myappointment', 'myappointment');
        $this->altoRouter->map('GET', '/profile', 'profile', 'profile');
        $this->altoRouter->map('GET', '/docagenda', 'docagenda', 'docagenda');
        $this->altoRouter->map('GET', '/admin', 'admin', 'admin');
        $this->altoRouter->map('GET', '/agenda', 'agenda', 'agenda');
    }

    public function generate($route): string
    {
        return $this->altoRouter->generate($route);
    }

    public function run(): void
    {
        $match = $this->altoRouter->match();
        $router = $this;
        $pageContent = "";
        if (is_array($match) && !empty($match)) {
            list($controller, $action) = explode('#', $match['target']);
            $controller = 'App\controllers\\'.$controller;
            $controller = new $controller();
            if (is_callable(array($controller, $action))) {
                $pageContent = call_user_func_array(array($controller, $action), array($match['params']));
            } else {
                echo '405';
            }

            require_once DIR_TEMPLATE . "/layout.php";

            /* if (is_callable($match['target'])) {
                call_user_func_array($match['target'], $match['params']);
            } else {
                $params = $match['params'];
                ob_start();
                require_once DIR_VIEW . "{$match['target']}.php";
                $pageContent = ob_get_clean();
            }
            require_once DIR_TEMPLATE . "/layout.php";
        } else {
            echo '404';
        } */
        } else {
            echo '404';
        }
    }
}
