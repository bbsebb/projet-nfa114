<?php

namespace App\routers;

require '../vendor/autoload.php';

use AltoRouter;
use App\configs\ConfigRouteToController;

class Router implements RouterI
{
    private AltoRouter $altoRouter;

    /**
     * Create router in one call from config.
     *
     * @param array $routes
     * @throws Exception
     */
    public function __construct(array $routes = [])
    {
        $this->altoRouter = new AltoRouter();
        $routes = (new ConfigRouteToController())->get();
        $this->addRoutes($routes);
    }

    public function addRoutes(array $routes) {
        $this->altoRouter->addRoutes($routes);
    }

    public function match($requestUrl = null, $requestMethod = null):array|bool {
        return $this->altoRouter->match($requestUrl, $requestMethod);
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
        $title = "";
        if (is_array($match) && !empty($match)) {
            list($controller, $action) = explode('#', $match['target']);
            $controller = 'App\controllers\\'.$controller;
            $controller = new $controller();
            if (is_callable(array($controller, $action))) {
                $pageContent = call_user_func_array(array($controller, $action), array($match['params']));
                $title = $match['name'];
            } else {
                header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
                die();
            }
            $auth = $_SESSION['auth']??null;
            require_once DIR_TEMPLATE . "/layout.php";
        } else {
            header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            die();
        }
    }
}
