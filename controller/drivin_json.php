<?php
 include_once "../database/database_1.php";

$hr= $_POST['hr'];
//$hr=124757;
 
$query_principal = "select  json_ruta from tbl_drivin_json where hr = $hr";
$resultado = mysqli_query($conn, $query_principal);
$row=mysqli_fetch_row($resultado);
$principal=$row[0]; 



echo utf8_encode($principal);
                                  
$url = "http://external.driv.in/api/external/v2/scenarios";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
   "X-API-KEY: e8cf34b9-78ae-4a6b-9fdc-5126c9984227",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_POSTFIELDS, utf8_encode($principal));

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp); 



?>