<?php 
error_reporting(-1);
  include_once "../database/database_1.php";


    $flag_t= $_POST['flag_t'];
    $texto= $_POST['texto'];

    $query_datos = "INSERT INTO tbl_alertas_prosud VALUES('".$flag_t."','".$texto."',1) ON DUPLICATE KEY UPDATE alerta_flag = '".$flag_t."' , alerta_texto = '".$texto."'";

    $results = mysqli_query($conn, $query_datos);
    echo $query_datos; 

?>