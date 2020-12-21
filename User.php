<?php
require_once 'config.php';

class User
{
    private $id;
    private $email;
    private $password;
    private $username;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function register()
    {
        $message = null;
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['register'])) {

            try {
                $cnx = new PDO("mysql:host=" . DATABASE['host'] . ";dbname=" . DATABASE['dbname'] . ";charset=utf8", DATABASE['user'], DATABASE['password']);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
            $verif_statement = $cnx->prepare("SELECT COUNT(email) AS existing_email   FROM `user` WHERE email LIKE :email ");
            $verif_statement->execute([
                "email" => $_POST['email']
            ]);
            $result = $verif_statement->fetch();

            if ($result["existing_email"] == 0) {
                $stmt = $cnx->prepare("INSERT INTO `user` (username, email, `password`) VALUES (? , ?, ?)");
                $stmt->execute([
                    $_POST['username'],
                    $_POST['email'],
                   password_hash($_POST['password'], PASSWORD_BCRYPT)
                ]);
               header("Location: ../index.php");
            } else {
                echo <<<HTML
                    <div>
                        Un compte utilisateur existe déjà avec cette adresse !
                    </div>
HTML;
            }
        }
    }

    public function login()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        if(isset($_SESSION['logged']))
        {
            if($_SESSION["logged"])
            {
                header("Location: ../index.php");
            }
        }elseif(!isset($_SESSION['logged']) ||  !$_SESSION['logged'])
        {
            if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST['login']))
            {
                try {
                    $cnx = new PDO("mysql:host=" . DATABASE['host'] . ";dbname=" . DATABASE['dbname'] . ";charset=utf8", DATABASE['user'], DATABASE['password']);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                $stmt = $cnx->prepare("SELECT * FROM user WHERE email LIKE :email");
                $stmt->execute([
                    "email" => $_POST["email"]
                ]);

                $user = $stmt->fetch();

                if ($user)
                {
                    if (password_verify($_POST["password"], $user["password"]))
                    {
                        $_SESSION = [
                            "username" => $user["username"],
                            "logged" => true,
                            "id" => $user["id"],
                            "email" => $user['email'],
                        ];
                        header("Location: ../index.php");
                    }
                }
            }
        }

    }
    public function isLogged()
    {
        if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) return true;
        else return false;
    }

    public function logout()
    {
        session_start();
        $_SESSION = [];
        header("Location: ../index.php");
    }

    public function getUsernameById($id)
    {
        try {
            $cnx = new PDO("mysql:host=" . DATABASE['host'] . ";dbname=" . DATABASE['dbname'] . ";charset=utf8", DATABASE['user'], DATABASE['password']);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $statement = $cnx->prepare('SELECT `username` FROM `user`
                                        WHERE id = ?');
        $statement->execute([$id]);

        return $statement->fetch();
    }
}