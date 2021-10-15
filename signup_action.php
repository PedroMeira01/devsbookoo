<?php
require 'config.php';
require 'models/User.php';
require 'DAO/UserDAO.php';

$name = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);
$birthdate = filter_input(INPUT_POST, 'data');

if ($nome && $email && $senha && $data_nasc) {
    $userDAO = new UserDAO($pdo);

    $user = new User();
    $user->name = $nome;
    $user->email = $email;
    $user->password = $password;
    $user->birthdate = $birthdate;

    $userDAO->store($user);

}

$_SESSION['flash'] = 'Preencha todos os campos!';
header('Location:'.$base.'signup.php');
exit;