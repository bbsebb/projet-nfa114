<h2><?= $this->bind['title']?></h2>

<?php

use App\configs\ConfigRouteToController;
use App\models\Auth;
use App\repository\UserRepository;
use App\routers\ProxyConnection;
use App\services\UserService;

require '../vendor/autoload.php';

$alto = new ProxyConnection();


?>