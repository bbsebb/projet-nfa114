<?php

namespace App\routers;

use App\configs\ConfigI;
use App\configs\ConfigRoutePermissions;
use App\models\Auth;

require '../vendor/autoload.php';
class ProxyConnection implements RouterI
{
    private Router $router;
    private array $permission;
    private string $urlErreur = "/error/proxy";

    /**
     * Create a router with a connexion management 
     * @param RouterI $router is the concret router
     * @param ConfigI $permissionConfig is the concret configuration for the url permission
     */
    public function __construct(RouterI $router = new Router(), ConfigI $permissionConfig = new ConfigRoutePermissions())
    {
        $this->router  = $router; 
        $this->permission = $permissionConfig->get();
    }

    public function generate($route): string
    {
        return $this->router->generate($route);
    }

    public function run(): void
    {
        session_start();
        $auth = $_SESSION['auth'] ?? null;
        $uri = strtok($_SERVER["REQUEST_URI"], '?');
        //Si la page demande une authentification et que le client n'est pas authentifié
        if ($this->match($uri)['auth'] && !$this->isAuth($auth)) {
            header("location: /signin{$_SERVER['REQUEST_URI']}");
            die();
        }
        //Si la page demande une autorisation et que le client n'a pas les bon roles.
        if (!$this->hasRole($this->match($uri)['roles'], $auth)) {
            header("location: {$this->urlErreur}");
            die();
        }
        $this->router->run();
    }


    private function isAuth(Auth|null $auth): bool
    {
        return ($auth === null) ? false : true;
    }

    private function hasRole(array $roles, Auth|null $auth): bool
    {
        $flag = true;
        if ($auth !== null && count($roles)>0) {
            $flag = count(array_intersect($roles, $auth->rolesToArray())) > 0;
        }
        return $flag;
    }

    private function match(string $uri): array
    {
        $rtr = ["auth" => false, "roles" => []];
        if (key_exists($uri, $this->permission)) {
            $rtr = $this->permission[$uri];
        }
        return $rtr;
    }
}
