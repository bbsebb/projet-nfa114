<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Chris Mills">
    <meta name="description" content="<?= $description ?? "inconnu" ?>">
    <title><?= $title ?? "inconnu" ?></title>
    <?php require_once "meta.php"?>
</head>

<body>
    <?php require_once "header.php"?>
    <?php require_once "nav.php"?>
    <div id="container"><?= $pageContent ?></div>
    <?php require_once "footer.php"?>
</body>
</html>