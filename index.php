<?php
require_once 'Comment.php';
require_once 'ProductRetriever.php';
require_once 'User.php';

$comment_manager = new Comment();
$user_manager = new User();
$product_retriever = new ProductRetriever();
$products = $product_retriever->getFifteenProductsFromAPI("https://fakestoreapi.com/products");

include 'header.php';

foreach ($products as $product) :
$comments = $comment_manager->getCommentsByIdProduct($product->id);
?>
    <div class="product-container">
        <h2><?= $product->title ?></h2>
        <span><?= $product->price ?> €</span>
        <img src='<?= $product->image ?>' alt='<?= $product->title ?>' width="200px">
    </div>
    <div class="comments clear">
    <h3>Commentaires :</h3>
        <?php
        if (!$user_manager->isLogged()) : ?>

<!-- On autorise les commentaires seulement pour les utilisateurs enregistrés et connectés -->

            <span>Vous devez être connecté pour rédiger un commentaire !</span><a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/views/register.php">S'inscrire</a> / <a href="http://<?= $_SERVER['HTTP_HOST'] .'/' ?>blissim/views/login.php">Se connecter</a>

        <?php else :
            $comment = new Comment();
            ?>
            <div class="comments-form">
                <form action="" method="post">
                    <label for="content">Votre commentaire :</label>
                    <textarea name="content" class="comment-card" placeholder="Laissez votre commentaire..."></textarea>
                    <input type="submit" name="comment-submit-<?= $product->id ?>" class="send-comment btn" value="Envoyer le commentaire">
                    <?php
                    $comment->addComment($product->id, intval($_SESSION['id'])); ?>
                </form>
            </div>
            <?php if(isset($message)) : ?>
            <span><?= $message ?></span>
            <?php endif ?>
        <?php endif ?>
        <div class="product-comments">
            <?php
            if(isset($comments)) :
                foreach ($comments as $comment ) :
                   ?>
                <div class="comment-display">
                    <h5><?= ucfirst($user_manager->getUsernameById(intval($comment->getIdAuthor()))[0]) ?><br>a écrit, le <small><em><?= $comment->getCreatedAt() ?></em></small></h5>
                    <p class="comment-card"><?= $comment->getContent() ?></p>
                </div>
<!-- Un utilisateur peut modifier et supprimer uniquement ses propres commentaires, on vérifie que l'auteur du commentaire correspond à l'utilisateur connecté dans la session via son 'id' -->
                    <?php if (isset($_SESSION['logged']) && $_SESSION['logged'] == true && ($_SESSION['id']) == $comment->getIdAuthor()) : ?>
                    <div class="comment-actions">
                    <a href="#" class="edit-comment-btn" id="<?= $comment->getId() ?>" ><i class="fas fa-edit" style="color:yellow"></i></a>
                            <form action="" method="post" class="hidden" id="edit-comment-form-<?= $comment->getId() ?>">
                                Vous avez écrit
                                <textarea name="content" placeholder="<?= $comment->getContent() ?>" class="comment-card"></textarea>
                                <input type="submit" name="edit-comment-<?= $comment->getId() ?>" id="edit-comment"  class="edit-comment btn" value="Modifier le commentaire">
                                <?php     $comment->editComment($comment->getCodeProduct()) ;?>

                            </form>
                    <a href="views/delete-comment.php?id=<?= $comment->getId() ?>" class="delete-comment"><i class="fas fa-times" style="color: red"></i></a>
                    </div>
                    <?php endif ?>
                <?php endforeach; ?>
            <?php endif ?>
        </div>
    </div>
<?php endforeach;
include 'footer.php';
