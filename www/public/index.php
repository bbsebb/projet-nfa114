<?php

use App\routers\ProxyConnection;
use App\routers\Router;

require_once "../vendor/autoload.php";

define("DIR_VIEW","view/");
define("DIR_TEMPLATE",DIR_VIEW."template");
global $_router;

$_router = new ProxyConnection();
$_router->run();



?>


