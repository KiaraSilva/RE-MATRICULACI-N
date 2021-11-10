<?php

$server = 'localhost';
$username = 'id17554740_admin';
$password = 'h)xAq(jyQB=ZC!2]';
$database = 'id17554740_php_login_database';

try {
    //en la variable conn se almacena la conexion a la bd
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    //en caso de error
  die('Connection Failed: ' . $e->getMessage());
}

?>