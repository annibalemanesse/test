<?php
require '../User.php';
$user = new User();
$user->login();

include '../header.php';
?>
<h1 class="blue">Se connecter </h1>
<form action="" method="POST" class="user-form">
    <label for="email">E-mail :</label>
    <input type="email" name="email"  required>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password"  required>
    <input type="submit" name="login" class="btn send-comment" value="Se connecter">
</form>
<?php include "../footer.php";
