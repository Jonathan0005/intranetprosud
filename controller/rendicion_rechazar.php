<?php 
require '../database/database_1.php';

$id = $_GET['ID'];

echo $id;

$query = "update rendicion set rendi_estado = 8 where id = '$id'";



$resultado = mysqli_query($conn, $query);



echo "<script> alert('Rendicion Rechazada'); window.open('../views/aprobar_rendiciones.php'); </script>";

echo "<script>window.close();</script>";
?>