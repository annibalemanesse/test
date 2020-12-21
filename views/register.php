<?php
require '../User.php';

$user = new User();
$user->register();
include '../header.php';
?>
    <h1 class="blue">S'inscrire</h1>

    <form action="" method="post" id="register-form" class="user-form">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" required>
        <label for="email">Votre e-mail :</label>
        <input type="email" name="email" required>
        <label for="password">Votre mot de passe :</label>
        <input type="password" name="password" required>
        <input type="submit" name="register" class="btn send-comment" value="S'inscrire">
    </form>

<?php include '../footer.php';
