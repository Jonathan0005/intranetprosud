<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'oficinaprosud_appsprosud';

try {

    $conn = mysqli_connect($server, $username, $password, $database);


} catch (Exception $e) {

    die('Conexion fallida: '.$e->getMessage());
}

?>