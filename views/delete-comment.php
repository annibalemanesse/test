<?php
require_once '../Comment.php';
include '../header.php';
$comment_manager = new Comment();
$comment = $comment_manager->getCommentById($_GET['id']);
!$comment ? header('Location: HTTP/1.0 404 Not Found') : $comment->deleteComment();
?>
<h1 class="blue">Suppression d'un commentaire</h1>
<form action="" class="delete-form" method="post">
    <p>Êtes-vous bien certain de vouloir supprimer ce commentaire ? </p>
    <div>
        <input type="radio" id="yes" name="delete" value="yes">
        <label for="yes">Oui</label>
    </div>
    <div>
        <input type="radio" id="no" name="delete" value="no" checked>
        <label for="no">Non</label>
    </div>
    <input type="submit" name="delete-for-good-<?= $_GET['id'] ?>" class="btn edit-comment" value="Supprimer définitivement">
</form>
