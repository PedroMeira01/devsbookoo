<?php
session_start();

const BASE = 'http://localhost/devsbookoo/';

$dbname = 'devsbook;';
$dbhost = 'localhost';
$dbuser = 'root';

$pdo = new PDO("mysql:dbname=".$dbname."host=".$dbhost, $dbuser, '');