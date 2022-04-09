<h1>home</h1>

<?php

use App\models\Auth;

require '../vendor/autoload.php';

dump($_SESSION);
try {
    $dbh = new PDO('mysql:host=172.20.0.4:3306;dbname=db-projet', "user", "ga9399ghr",array(
        PDO::ATTR_PERSISTENT => true
    ));

    
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
}


?>