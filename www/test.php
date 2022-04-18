<?php
echo 0;
try {
$pdo = new PDO('mysql:host=mysql-nfa114-projet;dbname=db-projet', "user", "ga9399ghr");
} catch (Exception $e) {
    print_r($e);
}

$sql = 'SELECT *
        FROM have_appointment
        ';
        $statement = $pdo->prepare($sql);
        $statement->execute(array());
        $appointmentArray = $statement->fetchAll();
        var_dump($appointmentArray);
