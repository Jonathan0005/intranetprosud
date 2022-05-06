<?php
error_reporting(-1);
session_start();
 include "../database/database_1.php";
 include "convertMoneda.php";

  $valida_id = $_SESSION['user_id'];


if(isset($valida_id)) {
 $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];    


}

/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$columns = array( 
// datatable column index  => database column name
	0 => 'id',
    1 => 'estado', 
	2 => 'fecha',
	3 => 'rut_cliente',
    4 => 'nombre_cliente',
    5 => 'total_neto',
    6 => 'total_impto',
    7 => 'total',
    8 => 'estado_erp',
    9 => 'correlativo_erp',
    10 => 'solicitante',
    11 => 'fecha_erp'  
);

// getting total number records without any search
$sql = "select distinct id, estado, fecha, rut_cliente, nombre_cliente, total_neto, total_impto, total, estado_erp, correlativo_erp, solicitante, fecha_erp from vw_ordenes_encabezado where trim(solicitante) = trim('$valida_id') order by id desc";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "select distinct id, estado, fecha, rut_cliente, nombre_cliente, total_neto, total_impto, total, estado_erp, correlativo_erp, solicitante, fecha_erp from vw_ordenes_encabezado ";
	$sql.=" where (trim(solicitante) = trim('$valida_id')) and id LIKE '".$requestData['search']['value']."%' ";    // 
	$sql.=" OR estado LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR rut_cliente LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR estado_erp LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR correlativo_erp LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR solicitante LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nombre_cliente LIKE '".$requestData['search']['value']."%'  ";
	$query=mysqli_query($conn, $sql) ;
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
    $sql.=" ORDER BY estado, ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."  "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) ; // again run query with limit
    //echo 1;
	
} else {	

	$sql = "select distinct id, estado, fecha, rut_cliente, nombre_cliente, total_neto, total_impto, total, estado_erp, correlativo_erp, solicitante, fecha_erp from vw_ordenes_encabezado where trim(solicitante) = trim('$valida_id')";
    $sql.=" ORDER BY estado, ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    //$sql.=" ORDER BY estado ";
    //echo $sql;
    $query=mysqli_query($conn, $sql);

// echo 2;
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
   // echo 3;
	$nestedData=array(); 

	$nestedData[] = $row["id"];
    $nestedData[] = $row["estado"];
	$nestedData[] = $row["fecha"];
	$nestedData[] = $row["rut_cliente"];
    $nestedData[] = $row["nombre_cliente"];
    $nestedData[] = moneda_chilena($row["total_neto"]);
    $nestedData[] = moneda_chilena($row["total_impto"]);
    $nestedData[] = moneda_chilena($row["total"]);
    $nestedData[] = $row["estado_erp"];
    $nestedData[] = $row["correlativo_erp"];
    $nestedData[] = $row["solicitante"];
    $nestedData[] = $row["fecha_erp"];
    if ($row["estado"] != 'PROCESADO'){
    if ($valida_id == '130332676' )
    {
    $nestedData[] = '<td><center><a href="../views/editarOrden.php?id='.$row['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Editar</a> <a href="../controller/deleteOrden.php?id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
    <a href="../views/pdf/reporte.php?id='.$row['id'].'" data-toggle="tooltip" title="PDF" class="btn btn-sm btn-success"><i class="fa fa-fw fa-file-pdf-o"></i> PDF</a></center></td>';
    }
    $nestedData[] = '<td><center>
                     <a href="../controller/deleteOrden.php?id='.$row['id'].'"  data-toggle="tooltip" title="Eliminar" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
                     <a href="../views/pdf/reporte.php?id='.$row['id'].'"  data-toggle="tooltip" title="PDF" class="btn btn-sm btn-success"><i class="fa fa-fw fa-file-pdf-o"></i> PDF</a></center>
                     </td>';	
} else
{
 
    $nestedData[] = '<td><center>
    <a href="../views/pdf/reporte.php?id='.$row['id'].'"  data-toggle="tooltip" title="PDF" class="btn btn-sm btn-success"><i class="fa fa-fw fa-file-pdf-o"></i> PDF</a></center>
    </td>';

}	
	
    $data[] = $nestedData;
    
   // print_r($nestedData);
    
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

            //print_r($json_data);

           
echo json_encode($json_data);  // send data as json format

?>
