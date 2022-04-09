<?php

namespace App\routers;

use App\configs\ConfigRoutePermissions;
use App\models\Auth;

require '../vendor/autoload.php';
class ProxyConnection implements RouterI
{
    private Router $router;
    private array $permission;
    private string $urlErreur = "/error/proxy";

    public function __construct(RouterI $router = new Router(), array $permission = [])
    {
        $this->router  = $router;
        $permission = (new ConfigRoutePermissions())->get();
        $this->permission = $permission;
    }

    public function generate($route): string
    {
        return $this->router->generate($route);
    }

    public function run(): void
    {
        session_start();
        $auth = $_SESSION['auth'] ?? null;
        //Si la page demande une authentification et que le client n'est pas authentifié
        if ($this->match($_SERVER['REQUEST_URI'])['auth'] && !$this->isAuth($auth)) {
            header("location: {$this->urlErreur}");
            die();
        }
        //Si la page demande une autorisation et que le client n'a pas les bon roles.
        if (!$this->hasRole($this->match($_SERVER['REQUEST_URI'])['roles'], $auth)) {
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
        $flag = (count($roles)==0)?true: false;
        if ($auth !== null) {
           // dump($roles);
           // dump($auth->getRole());
            //dump(array_intersect($roles, $auth->getRole()));
            $flag = count(array_intersect($roles, $auth->getRole())) > 0;
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
