<h1>home</h1>

<?php

use App\configs\ConfigRouteToController;
use App\models\Auth;
use App\repository\UserRepository;
use App\routers\ProxyConnection;
use App\services\UserService;

require '../vendor/autoload.php';

$alto = new ProxyConnection();
dump($alto->match("/test/ee"));

?>