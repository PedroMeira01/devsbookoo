<?php
require "models/User.php";

class UserDAO {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function generateUser($array) {
        $u = new User();

        $u->id = $array['id'];
        $u->name = $array['name'] ?? '';
        $u->email = $array['email'] ?? '';
        $u->password = $array['password'] ?? '';
        $u->birthdate = $array['birthdate'] ?? '';
        $u->city = $array['city'] ?? '';
        $u->work = $array['work'] ?? '';
        $u->avatar = $array['avatar'] ?? '';
        $u->cover = $array['cover'] ?? '';
        $u->token = $array['token'] ?? '';

        return $u;
    }

    public function findByToken($token) {
        if (!empty($token)) {
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);

                $user = $this->generateUser($data);

                return $user;
            }

        }

        return false;
    }

    public function findByEmail($email) {
        if ($email) {
            $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
            $sql->bindValue(':email', $email);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $user = $this->generateUser($data);
                
                return $user;
            }
        }

        return false;
    }

    public function update(User $u) {
        
        $sql = $this->pdo->prepare("UPDATE users SET 
            name = :name,
            email = :email,
            password = :password,
            birthdate = :birthdate,
            city = :city,
            work = :work,
            avatar = :avatar,
            cover = :cover,
            token = :token
        ");

        $sql->bindValue(':name', $u->nome);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', password_hash($u->password, PASSWORD_DEFAULT));
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':city', $u->city);
        $sql->bindValue(':work', $u->work);
        $sql->bindValue(':avatar', $u->avatar);
        $sql->bindValue(':cover', $u->cover);
        $sql->bindValue(':token', $u->token);

        $sql->execute();
    }

    public function insert(User $u) {
        
        $sql = $this->pdo->prepare("INSERT INTO users
            (
                name,
                email,
                password,
                birthdate,
                token
            ) 
            VALUES (
                :name,
                :email,
                :password,
                :birthdate,
                :token
            )"
        );
        
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password',  password_hash($u->password, PASSWORD_DEFAULT));
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':token', $u->token);
        $sql->execute();
    }
}