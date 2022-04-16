<?php
echo 0;
try {
$pdo = new PDO('mysql:host=mysql-nfa114-projet;dbname=db-projet', "user", "ga9399ghr");
} catch (Exception $e) {
    print_r($e);
}

// Le message
$message = "Line 1\r\nLine 2\r\nLine 3";

// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Envoi du mail
mail('sebastien.burckhardt@gmail.com', 'Mon Sujet', $message);
