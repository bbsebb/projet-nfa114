<?php

use App\utils\Routeur;

require_once "../vendor/autoload.php";

define("DIR_VIEW","view/");
define("DIR_TEMPLATE",DIR_VIEW."template");


$router = new Routeur();
$router->map('GET','/', 'home','home');
$router->map('GET','/signin', 'signin','signin');
$router->map('GET','/signup', 'signup','signup');
$router->map('GET','/signout', 'signout','signout');
$router->map('GET|POST','/office', 'office','office');
$router->map('GET','/myappointment', 'myappointment','myappointment');
$router->map('GET','/profile', 'profile','profile');
$router->map('GET','/docagenda', 'docagenda','docagenda');
$router->map('GET','/admin', 'admin','admin');
$router->map('GET','/agenda', 'agenda','agenda');
$match = $router->match();
dump($match);
if(is_array($match) && !empty($match)) {
    if(is_callable($match['target'])) {
        call_user_func_array($match['target'],$match['params']);
    } else {
        $params = $match['params'];
        ob_start();
        require_once DIR_VIEW."{$match['target']}.php";
        $pageContent = ob_get_clean();
    }
    require_once DIR_TEMPLATE."/layout.php";
} else {
    echo '404';
}


?>


