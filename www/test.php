<?php
echo 0;
try {
$pdo = new PDO('mysql:host=mysql-nfa114-projet;dbname=db-projet', "user", "ga9399ghr");
} catch (Exception $e) {
    print_r($e);
}

$tab[0][] = "0.0";
$tab[0][] = "0.1";
$tab[0][] = "0.2";
$tab[0][] = "0.3";
$tab[1][] = "1.0";
$tab[1][] = "1.1";
$tab[1][] = "1.2";
$tab[1][] = "1.3";
$tab[2][] = "2.0";
$tab[2][] = "2.1";
$tab[2][] = "2.2";
$tab[2][] = "2.3";
