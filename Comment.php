<?php

class Comment {
    private $id;
    private $code_product;
    private $id_author;
    private $content;
    private $createdAt;
    private $cnx;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return PDO
     */
    public function getCnx()
    {
        return $this->cnx;
    }
    /**
     * @return mixed
     */
    public function getCodeProduct()
    {
        return $this->code_product;
    }
    /**
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * @param mixed $id_author
     */
    public function setIdAuthor($id_author)
    {
        $this->id_author = $id_author;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    public function __construct()
    {
        try {
            $cnx = new PDO("mysql:host=".DATABASE['host'].";dbname=".DATABASE['dbname'].";charset=utf8",DATABASE['user'],DATABASE['password'] );
        } catch (PDOException $e) {
            die($e->getMessage());
        } return $this->cnx = $cnx;
    }

    public function getCommentsByIdProduct($id_product)
    {
        $statement = $this->cnx->prepare('SELECT * FROM `comments` WHERE `code_product` = ?');
        $statement->execute([$id_product]);

        return $statement->fetchAll(PDO::FETCH_CLASS,'Comment');
    }

    public function addComment($id_product,$id_author)
    {
        if(isset($_POST['comment-submit-'.$id_product]) && isset($_POST['content']) && !empty($_POST['content'])) {
                $content = htmlspecialchars( $_POST['content']);
                $statement = $this->cnx->prepare('INSERT INTO `comments` (`id_author`, `content`, `code_product`, `createdAt`) VALUES (?,?,?,NOW())');
                $result = $statement->execute([
                    $id_author,
                    $content,
                    $id_product
                ]);
            }  else $message = "Tous les champs doivent être remplis";
    }

    public function editComment($id_product)
    {
            if(isset($_POST['edit-comment-'.$this->getId()]) && isset($_POST['content'])  && !empty($_POST['content'])) {
                $this->setContent($_POST['content']);
                $statement = $this->cnx->prepare('UPDATE `comments` SET  `content` = ?, `code_product` = ?, `editedAt` = NOW() WHERE  id = ?');
                $statement->execute([
                    htmlspecialchars($this->getContent()),
                    $id_product,
                    $this->getId()
                ]);
            }
    }

    public function deleteComment()
    {
        $user = new User();
        if($user->isLogged() && ($_SESSION['id']) == $this->getIdAuthor()) {
            if(isset($_POST['delete-for-good-'.$this->getId()]) && isset($_POST['delete'])) {
                if ($_POST['delete'] == 'yes') {
                    $statement = $this->cnx->prepare("DELETE FROM `comments` WHERE id = ?");
                    $statement->execute([
                        $this->getId()
                    ]);
                    header('Location: ../index.php');
                    $message = "Votre commentaire a été supprimé!";
                } elseif ($_POST['delete'] == 'no') {
                    header('Location: ../index.php');
                }
            }
        } else header("Location: HTTP/1.0 404 Not Found");

    }

    public function getCommentById($id)
    {
        $statement = $this->cnx->prepare('SELECT * FROM `comments` WHERE `id` = ?');
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Comment');

        return $statement->fetch();
    }
}
