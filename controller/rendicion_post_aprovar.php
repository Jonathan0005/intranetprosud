<?php 
session_start();
require '../database/database_1.php';
$valida_id = $_SESSION['user_id'];

$id = $_GET['ID'];

$query_validar = "select distinct rendi_estado from rendicion where id = '$id'";
$resultado_v = mysqli_query($conn, $query_validar);
$row=mysqli_fetch_row($resultado_v);
$rendicion = $row[0];

if ($rendicion == 2)
{
    $query = "update rendicion set rendi_estado = 3 where id = '$id'";

    $resultado = mysqli_query($conn, $query);
}
else if ($rendicion == 3)
{
    $query = "update rendicion set rendi_estado = 4 where id = '$id'";

    $resultado = mysqli_query($conn, $query);
}
else if ($rendicion == 4)
{
    $query = "update rendicion set rendi_estado = 5 where id = '$id'";

    $resultado = mysqli_query($conn, $query);
}
else if ($rendicion == 5)
{
    $query = "update rendicion set rendi_estado = 6 where id = '$id'";

    $resultado = mysqli_query($conn, $query);
}


echo "<script> alert('Rendicion Aprobada'); window.open('../views/aprobar_rendiciones.php'); </script>";

echo "<script>window.close();</script>";
?>