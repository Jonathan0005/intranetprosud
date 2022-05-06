<?php 
error_reporting(-1);
  include_once "../database/database_1.php";


    $rut= $_POST['rut'];
    $cuenta= $_POST['cuenta'];
    $tipod= $_POST['tipod'];
    $banco= $_POST['banco'];
    $email= $_POST['email'];

    $rut = str_replace('.', '', $rut);
    $rut = str_replace('-', '', $rut);

    echo $email; 

    $query_datos = "INSERT INTO rendi_usuario_banco VALUES('$rut','$cuenta', $tipod, $banco, '$email') ON DUPLICATE KEY UPDATE numero_cuenta = '$cuenta', tipo_cuenta_id = $tipod, banco_id = $banco, email = '$email'";

    echo ($query_datos);
    $results = mysqli_query($conn, $query_datos);


?>