<?php
require "config.php";
require "services\Auth.php";

$auth = new Auth($pdo, BASE);
$userInfo = $auth->checkToken();

echo "Usuário logado!";