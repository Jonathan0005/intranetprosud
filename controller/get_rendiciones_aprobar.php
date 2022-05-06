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
$sql= ""; 
if($valida_id == '186959329' ){
    $sql = "SELECT distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones where rendi_estado = 'APROBADO SUPERVISOR' order by id desc";
}
else 
{
    $sql = "SELECT distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones where rendi_estado != 'EN PROCESO DE PAGO' order by id desc";
}
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  	
if($valida_id == '186959329' ){
	$sql = "select distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones  where rendi_estado = 'APROBADO SUPERVISOR'";
    $sql.=" ORDER BY id";
}
else
{
    $sql = "select distinct id, rendi_fecha, cuenta_contable, tipo_doc, rendi_detalle, rendi_monto, rendi_estado FROM vw_rendiciones  where rendi_estado != 'EN PROCESO DE PAGO'";
    $sql.=" ORDER BY id";
}
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
    $nestedData[] = '<td>
                         <a href="../views/fotos_rendiciones_aprobadas.php?ID='.$row['id'].'" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-image"></i></a>
                         <a href="../controller/rendicion_aprobar.php?ID='.$row['id'].'" class="btn btn-sm btn-success"><i class="fa fa-fw fa-thumbs-o-up"></i> Aprobar</a>
                         <a href="../controller/rendicion_rechazar.php?ID='.$row['id'].'" class="btn btn-sm btn-danger"><i class="fa fa-fw fa-thumbs-o-down"></i> Rechazar</a>
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