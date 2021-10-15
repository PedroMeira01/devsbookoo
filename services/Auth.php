<?php
require "DAO/UserDAO.php";

class Auth {

    private $pdo;
    private $base;

    public function __construct(PDO $pdo, $base) {
        $this->pdo = $pdo;
        $this->base = $base;
    }
    // Verifica se o usuário está logado e se tiver retorna informações do usuário
    public function checkToken() {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $userDAO = new UserDAO($this->pdo);
            $user = $userDAO->findByToken($token);
            
            if ($user) {
                return $user;
            }
        }

        header('Location:'.$this->base."/login.php");
        exit;
    }

    public function validateLogin($email, $password) {

        $userDAO = new UserDAO($this->pdo);
        $user = $userDAO->findByEmail($email);

        if ($user) {

            if (password_verify($password, $user->password)) {
                $token = $this->generateToken();
                $_SESSION['token'] = $token;

                $user->token = $token;
                $userDAO->update($user);
                
                return true;
            }
        }

        return false;
    }

    public function emailExists($email) {
        $userDAO = new UserDAO($this->pdo);
        return $userDAO->findByEmail($email) ? true : false;
    }

    public function registerUser($name, $email, $password, $birthdate) {
        $userDAO = new UserDAO($this->pdo);

        $token = $this->generateToken();
        
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->birthdate = $birthdate;
        $user->token = $token;

        $userDAO->insert($user);

        $_SESSION['token'] = $token;
    }

    public function generateToken() {
        return md5(time().rand(0,9));
    }
}