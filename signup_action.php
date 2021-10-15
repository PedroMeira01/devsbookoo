<?php
require 'config.php';
require 'services/Auth.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$birthdate = filter_input(INPUT_POST, 'birthdate');

function dataDeNascimentoInvalida() {
    $_SESSION['flash'] = 'Data de nascimento inválida';
    header('Location:'.BASE.'signup.php');
    exit;
}

if ($name && $email && $password && $birthdate) {

    $auth = new Auth($pdo, BASE);
    $birthdate = explode('-', $birthdate);

    if (count($birthdate) != 3) {
        dataDeNascimentoInvalida();
    }

    $birthdate = $birthdate[0].'-'.$birthdate[1].'-'.$birthdate[2];
    if (strtotime($birthdate === false)) {;
        dataDeNascimentoInvalida();
    }

    if ($auth->emailExists($email) === false) {
        $auth->registerUser($name, $email, $password, $birthdate);
    } else {
        $_SESSION['flash'] = 'Este e-mail já está em uso!';
        header('Location:'.BASE.'signup.php');
        exit;
    }

    header('Location:'.BASE);
    exit;

}

$_SESSION['flash'] = 'Preencha todos os campos!';
header('Location:'.BASE.'signup.php');
exit;