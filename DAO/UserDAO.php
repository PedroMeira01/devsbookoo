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
            $sql->bindValue('token', $token);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);

                $user = $this->generateUser($data);

                return $user;
            }

        }

        return false;
    }

}