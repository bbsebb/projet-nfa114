<?php
echo 0;
try {
$pdo = new PDO('mysql:host=mysql-nfa114-projet;dbname=db-projet', "user", "ga9399ghr");
} catch (Exception $e) {
    print_r($e);
}

$table = array(array("1.1"));

var_dump($table);