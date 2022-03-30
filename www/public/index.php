<?php
require_once "../vendor/autoload.php";

$routeur = new AltoRouter();
$routeur->map('GET','/', function() {
    require_once "view/home.php";
});
$routeur->match();
?>

<!-- <!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    
    
</head>

<body>
    
    <main>
        <h1>Index</h1>
    </main>
    
</body>

</html> -->
