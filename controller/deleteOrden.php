<?php 
require '../database/database_1.php';

$id = $_GET['id'];

$query = "delete from ordenesencabezado where OVOP_ID = '$id'";



$resultado = mysqli_query($conn, $query);

$query2 = "delete from ordenesdetalle where OVOP_ID = '$id'";


$resultado2 = mysqli_query($conn, $query2);

echo "<script> alert('Orden Eliminada Correctamente'); window.open('../views/ordenes.php'); </script>";

echo "<script>window.close();</script>";
?>