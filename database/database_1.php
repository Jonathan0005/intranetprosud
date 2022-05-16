<?php

$server = 'prosud.cl';
$username = 'root';
$password = 'Masofejo.88';
$database = 'appsprosud_test';

try {

    $conn = mysqli_connect($server, $username, $password, $database);


} catch (Exception $e) {

    die('Conexion fallida: '.$e->getMessage());
}

?>