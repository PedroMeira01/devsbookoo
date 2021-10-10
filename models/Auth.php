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
        $userDAO = new UserDAO($this->$pdo);
        $user = $userDAO->findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password)) {
                $token = md5(time().rand(0,9));
                $_SESSION['token'] = $token;

                $user->token = $token;
                $user->update($user);
                
                return true;
            }
        }

        return false;
    }

}