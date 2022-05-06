<?php
  include_once "../database/database_1.php";
  include_once "convertMoneda.php";

  $id_orden = $_POST['id_orden']; 

    $query = "select ID, CodigoProducto, concat('[',CodigoProducto,'] ', DescripcionProducto) as DescripcionProducto, Cantidad, Subtotal, Total, Precio, Descuento  from vw_ordenes_detalle_pdf where ID = ".$id_orden." ";

    $results = mysqli_query($conn, $query);


    $unidadquery = "select UnimCodigo from ordenesencabezado where OVOP_ID = ".$id_orden." ";
    $result_unidad = mysqli_query($conn, $unidadquery);
    $unidad = mysqli_fetch_row($result_unidad);


    $html= '';
    
    $contador = 0;
    while($row = mysqli_fetch_row($results))
    {

    $precio = $row[6];
    $descuento = $row[7];
    $impto_adicional = 0;
    $iva = 0;
    $produ_impto_adic = 0;
    $subtotal = $row[4];
    $subtotal_1 = $row[4];
    $total =  $row[5];
    $total_total = $row[5];;
    $total_neto = 0;
    $total_iva = 0;
    $total_impto = 0;

   $contador  = $contador +1;
   $html.= "<tr id='row".$contador."'>";
   $html.= "<td id='data1' readonly='readonly' class='producto_pri'>".$row[2]."</td>";
   $html.= "<td id='data2' readonly='readonly' class='um_pri'>".$unidad[0]."</td>";
   $html.= "<td id='data3' contenteditable class='cantidad_pri'>".$row[3]."</td>";
   $html.= "<td id='data4' contenteditable class='precio_pri'>".$precio."</td>";
   $html.= "<td id='data6' readonly='readonly' class='impto_pri'>".$produ_impto_adic."</td>";
   $html.= "<td id='data7' contenteditable class='subtotal_pri'>".$subtotal_1."</td>";
   $html.= "<td id='data8' contenteditable class='descuento_pri'>".$descuento."</td>";
   $html.= "<td id='data9' contenteditable class='tipodscto_pri'>0</td>";
   $html.= "<td id='data10' contenteditable class='total_pri'>".$total."<td>";
   $html.= '</tr>';


    }


echo utf8_encode($html);



?>

