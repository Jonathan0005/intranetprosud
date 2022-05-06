<?php 
error_reporting(-1);
  include_once "../database/database_1.php";


    $rut= $_POST['rut'];
    $fecha= $_POST['fecha'];
    $cuenta_contable= $_POST['cuenta_contable'];
    $tipodoc= $_POST['tipodoc'];
    $numerodoc= $_POST['numerodoc'];
    $detalledoc= $_POST['detalledoc'];
    $montodoc= $_POST['montodoc'];

    $query_datos = "INSERT INTO rendicion VALUES(NULL,curdate(),$cuenta_contable, $tipodoc, $numerodoc, '$detalledoc', $montodoc,'$rut',1)";



    $results = mysqli_query($conn, $query_datos);
    echo $query_datos; 

?>