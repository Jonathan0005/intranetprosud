<?php
error_reporting(-1);
session_start();
 include "../database/database_1.php";


  $valida_id = $_SESSION['user_id'];
  $valor = $_GET['valor'];


if(isset($valida_id)) {
 $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];    


}

$sql = "select a.hr, a.Fecha as date, a.code_client, a.code_order, a.address  from tbl_drivin a
where a.hr = $valor";

$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
$data[] = $rows;
}
$results = array(
"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
"aaData"=>$data);
echo json_encode($results);
?>