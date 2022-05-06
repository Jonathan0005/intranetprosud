<?php


 include "../database/database_1.php";
 //include "convertMoneda.php";




$requestData= $_REQUEST;




$columns2 = array( 
  // datatable column index  => database column name
  0 => 'RutCliente',
  1 => 'NrOP',
    2 => 'CodProducto',
    3 => 'Cantidad',
    4 => 'UnidadMedida',
    5 => 'FechaCreacion'
  );

// require ("DBController.php");
// $dbController = new DBController();

//$query = " select * from modal_contenido where Modal = '" . $_GET["my_modal"] . "'";

$sql2 =" select a.RutCliente, a.NrOP, a.CodProducto, case when a.UnidadMedida = 'CAJA' then (a.Cantidad)/(c.UMPEquivalencia) else a.Cantidad END as Cantidad, a.UnidadMedida, b.FechaCreacion from MLPedidoDetalle a inner join MLPedidoEncabezado b on b.NrOP = a.NrOP inner join equivalencia c on a.CodProducto = c.ProdCodigo ";
$sql2 .=" where a.NrOP = '".$_GET["my_modal"]."'";
$sql2 .=" ORDER BY a.CodProducto ";

$result=mysqli_query($conn, $sql2);


// $data = array();
// while( $row4=mysqli_fetch_array($result) ) {  // preparing an array
//   $nestedData4=array(); 

//    $nestedData4[] = $row4["RutCliente"];
//    $nestedData4[] = $row4["CodProducto"];
//    $nestedData4[] = $row4["Cantidad"];
//    $nestedData4[] = $row4["UnidadMedida"];
//    $nestedData4[] = $row4["FechaCreacion"];
   
//    $data[] = $nestedData4; 
// }

$data[] = $result; 

?>



<table id="tabla" class="table table-bordered table-striped " >
         <tr>
        <th>Rut Cliente</th>
        <th>Codigo Producto</th>
        <th>Cantidad</th>
        <th>Unidad de Medida</th>
        <th>Fecha Creacion</th>
      </tr> 
<?php
      foreach ( $data as $r ) { ?>
        
        <?php foreach ( $r as $v ) {      
            //echo $_GET["my_modal"];
            //echo $v["RutCliente"];
            ?>
        
        <tr>
                  <td><?php echo $v["RutCliente"]; ?> </td>    
                  <td><?php echo $v["CodProducto"]; ?> </td> 
                  <td><?php echo $v["Cantidad"]; ?> </td> 
                  <td><?php echo $v["UnidadMedida"]; ?> </td> 
                  <td><?php echo $v["FechaCreacion"]; ?> </td> 

                  </tr>
                  
                  <?php  } ?>
         
         
         
         <?php  }?>

         <?php //echo $_GET["my_modal"];
       //echo $f;
       ?>




      </table>



