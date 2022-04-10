<h1>home</h1>

<?php

use App\models\Auth;
use App\repository\UserRepository;
use App\services\UserService;

require '../vendor/autoload.php';

try {

$service = new UserService();
dump($service->getAuth("sebastien.burckhardt@gmail.com","1234"));
dump($_SERVER);
} catch(Exception $e) {
    print $e->getMessage();
}

?>