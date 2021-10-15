<?php
require "config.php";
require "services/Auth.php";

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password');

if ($email && $password) {
    $auth = new Auth($pdo, BASE);
    if ($auth->validateLogin($email, $password)) {
      header('Location:'.BASE);
      exit;
    }
}

$_SESSION['flash'] = 'Preencha todos os campos!';
header('Location:'.BASE.'login.php');
exit;