<?php
  require "config.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?=BASE?>assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href=""><img src="<?=BASE?>assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?=BASE?>signup_action.php">
            <input placeholder="Digite seu nome completo" class="input" type="text" name="name" />

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input placeholder="Digite sua data de nascimento" class="input" type="date" name="birthdate" />

            <input class="button" type="submit" value="Fazer cadastro" />

            <a href="<?=BASE?>login.php">Já tem conta? Faça login</a>
        </form>
    </section>
</body>
</html>