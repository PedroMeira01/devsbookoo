<?php
session_start();

$base = 'http://localhost/devsbookoo';

$dbname = 'devsbook;';
$dbhost = 'localhost';
$dbuser = 'root';

$pdo = new PDO("mysql:dbname=".$dbname."host=".$dbhost, $dbuser, '');