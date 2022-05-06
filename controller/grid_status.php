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
0 => 'MLPnroPedido',
1 => 'MLPEstado',
  2 => 'LogInfo',
  3 => 'LogFecha',
  4 => 'LogEstadoDoc',
  5 => 'LogTipoDoc',
  6 => 'Detalle',
  7 => 'LogHora'

);

// getting total number records without any search
$sql = "select MLPnroPedido, MLPEstado,  LogInfo,  LogFecha,  LogEstadoDoc, case when LogTipoDoc = 'P' then 'PEDIDO' else 'RECEPCION' END AS LogTipoDoc, LogHora  from VW_ML_Pedidos";
$query=mysqli_query($conn, $sql) or die("grid_status.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "select MLPnroPedido, MLPEstado, LogInfo,  LogFecha,  LogEstadoDoc, case when LogTipoDoc = 'P' then 'PEDIDO' else 'RECEPCION' END AS LogTipoDoc, LogHora  from VW_ML_Pedidos ";
	$sql.=" where MLPnroPedido LIKE '".$requestData['search']['value']."%' ";   
    $sql.=" OR MLPEstado LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR LogInfo LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR LogFecha LIKE '".$requestData['search']['value']."%'  ";
    $sql.=" OR LogEstadoDoc LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR LogTipoDoc LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR LogHora LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("grid_status.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query 
    $sql.=" ORDER BY LogFecha desc, ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."  "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("grid_status.php: get PO"); // again run query with limit
	
} else {	

    $sql = "select MLPnroPedido, MLPEstado,  LogInfo,  LogFecha,  LogEstadoDoc, case when LogTipoDoc = 'P' then 'PEDIDO' else 'RECEPCION' END AS LogTipoDoc, LogHora  from VW_ML_Pedidos";

    $sql.=" ORDER BY LogFecha desc, ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("grid_status.php: get InventoryItemsget ");
}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
  $nestedData=array(); 
 

      $nestedData[] = $row["MLPnroPedido"];
      $nestedData[] = "<p class=". $row["MLPEstado"].">". $row["MLPEstado"]."</p>";
      $nestedData[] = $row["LogInfo"];
      $nestedData[] = $row["LogFecha"];
      $nestedData[] = $row["LogEstadoDoc"];
      $nestedData[] = $row["LogTipoDoc"];
      $nestedData[] = $row["LogHora"];



      $g = '<div id="fondo">

        <div onClick="loadDynamicContentModal('.$row["MLPnroPedido"].')"
            class="btn btn-info">Ver</div>
        </div>        
          
      <div class="modal fade" id="bootstrap-modal" role="dialog">
        <div class="modal-dialog" role="document"> 
         
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Detalle Orden de Pedido</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body">
              <div id="conte-modal"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>';



   $nestedData[] = $g;


        $data[] = $nestedData;
}

$json_data = array(
      "draw"            => intval( $requestData['draw'] ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
      "data"            => $data
      );

echo json_encode($json_data);  // send data as json format
?>




