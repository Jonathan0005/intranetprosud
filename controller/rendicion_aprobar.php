<?php 
session_start();
require '../database/database_1.php';
$valida_id = $_SESSION['user_id'];

$id = $_GET['ID'];



$query = "update rendicion set rendi_estado = 2 where id = '$id'";

$resultado = mysqli_query($conn, $query);



echo "<script> alert('Rendicion Aprobada'); window.open('../views/aprobar_rendiciones.php'); </script>";

echo "<script>window.close();</script>";
?>