<?php
require_once 'User.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$user = new User();
?>
<!-- Vue ultra simplifiée de la page d'accueil présentant une liste de 15 produits récupérés via l'API -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/public/style.css">
    <script src="https://kit.fontawesome.com/a330a8542c.js" crossorigin="anonymous"></script>

    <title>Echantillon de produits</title>
</head>
<body>
    <header>
        <h1>Shop </h1>
            <div class="user-checker">
                <?php
                if($user->isLogged()) :?>
                    <p>Bienvenue <?= $_SESSION['username'] ?> !</p>
                    <a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/views/logout.php">Se déconnecter </a>
                <?php else : ?>
                    <a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/views/register.php">S'inscrire</a> / <a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/views/login.php">Se connecter</a>
                <?php endif ?>

            </div>
    </header>
    <section class="container">
        <?php if(isset($message)) : ?>
        <span><?= $message ?></span>
        <?php endif ?>
