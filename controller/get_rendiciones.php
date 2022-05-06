<?php 
error_reporting(-1);
include "convertMoneda.php";
session_start();

require '../database/database_1.php';

$valida_id = $_SESSION['user_id'];


if(isset($valida_id)) {

  $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
  $results = mysqli_query($conn, $query);

   $user = "";


    $row=mysqli_fetch_row($results);
    $user = $row[0];

$lenguaje= "SET lc_time_names = 'es_ES';";
$lenguaje_result = mysqli_query($conn, $lenguaje);


}
else 
{
session_destroy();
header("Location: ../index.php");
}
   $requestData= $_REQUEST;

   $columns = array( 
   // datatable column index  => database column name
       0 => 'id',
       1 => 'rendi_fecha', 
       2 => 'cuenta_contable',
       3 => 'tipo_doc',
       4 => 'rendi_detalle',
       5 => 'rendi_monto' ,
       6 => 'rendi_estado'     
    );

    // getting total number records without any search
$sql = "SELECT distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones where rut = '$valida_id' order by id desc";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  	

	$sql = "select distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones where trim(rut) = trim('$valida_id')";
    $sql.=" ORDER BY id";
    //$sql.=" ORDER BY estado ";
    //echo $sql;
    $query=mysqli_query($conn, $sql);

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
   // echo 3;
	$nestedData=array(); 

	$nestedData[] = '<tr>'.$row["id"];
    $nestedData[] = $row["rendi_fecha"];
	$nestedData[] = $row["cuenta_contable"];
	$nestedData[] = $row["tipo_doc"];
    $nestedData[] = $row["rendi_detalle"];
    $nestedData[] = moneda_chilena($row["rendi_monto"]);
    $nestedData[] = $row["rendi_estado"];
    $nestedData[] = '<td><center>
                         <a href="../views/fotos_rendicion.php?ID='.$row['id'].'" class="btn btn-sm btn-success"><i class="fa fa-fw fa-image"></i> Ver Fotos</a></center>
                     </td></tr>';	
	
    $data[] = $nestedData;
    
}



$json_data = array( 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

            //print_r($json_data);

           
echo json_encode($json_data);  // send data as json format

?>