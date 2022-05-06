<?php 
error_reporting(-1);
  include_once "../database/database_1.php";


    $rutfoto= $_POST['rutfoto'];
    $campo2= $_POST['campo2'];

    $codigo_rendi = "select  max(id) as codigo from rendicion";
    $codigo_ejec = mysqli_query($conn, $codigo_rendi);
    $r_codigo = mysqli_fetch_row($codigo_ejec);
    $codigo = $r_codigo[0];

    $ruta = "../imagenes_rindepro/".$campo2;

    if ($campo2 != '')
    {
    $query_datos = "INSERT INTO rendi_foto VALUES(NULL,".$codigo.",'".$campo2."','".$ruta."')";
    }


    $results = mysqli_query($conn, $query_datos);
    echo $query_datos; 

?>