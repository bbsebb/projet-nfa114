<?php

namespace App\routers;

require '../vendor/autoload.php';

use AltoRouter;
use App\configs\ConfigRouteToController;

class Router implements RouterI
{

    private AltoRouter $altoRouter;

    public function __construct(array $routes = [])
    {
        $this->altoRouter = new AltoRouter();
        $routes = (new ConfigRouteToController())->get();
        $this->altoRouter->addRoutes($routes);
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
        } else {
            echo '404';
        }
    }
}
