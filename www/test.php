<?php
echo 0;
try {
$pdo = new PDO('mysql:host=mysql-nfa114-projet;dbname=db-projet', "user", "ga9399ghr");
} catch (Exception $e) {
    print_r($e);
}

$sql = 'SELECT * 
        FROM users';
        echo 1;
        $statement = $pdo->prepare($sql);
        echo 2;
        $statement->execute();
        echo 3;
        $user = $statement->fetch();
        var_dump($user);