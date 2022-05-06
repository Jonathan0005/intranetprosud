<?php

$server = 'localhost';
$username = 'oficinaprosud';
$password = 'of.2102.cl';
$database = 'oficinaprosud_appsprosud';

try {

    $conn = mysqli_connect($server, $username, $password, $database);


} catch (Exception $e) {

    die('Conexion fallida: '.$e->getMessage());
}

?>