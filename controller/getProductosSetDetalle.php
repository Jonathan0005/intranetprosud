<?php
  include_once "../database/database_1.php";
  include_once "convertMoneda.php";

    $linea= $_POST['linea_arr'];
    $producto = $_POST['producto_arr'];
    $cantidad = $_POST['cantidad_arr'];
    $tipo = $_POST['tipo_arr'];
    $dscto = $_POST['dscto_arr'];
    $cliente = $_POST['cliente_select'];
    $medida = $_POST['medida_select'];
    $area = $_POST['area_select']; 

    $iva = 0;
    $impto_adicional = 0;
    $precio = '0';
    $um = 'CAJA';
    $subtotal = 0; 
    $total= 0; 
    $total_impto = 0;
    $total_neto = 0;
    $total_iva = 0;
    $total_total = 0;
    $produ_impto_adic = 0;
    $contador = 0;
    $subtotal_1= 0;

    $html= '';

    for($count = 0; $count<count($cantidad); $count++)
    {
     $linea_clean = mysqli_real_escape_string($conn, $linea[$count]);
     $producto_clean = mysqli_real_escape_string($conn, $producto[$count]);
     $cantidad_clean = mysqli_real_escape_string($conn, $cantidad[$count]);
     $tipo_clean = mysqli_real_escape_string($conn, $tipo[$count]);
     $dscto_clean = mysqli_real_escape_string($conn, $dscto[$count]);
     preg_match_all("/\\[(.*?)\\]/", $producto_clean, $matches); 
     $pro2 = $matches[1][0];

     $queryM = "select distinct a.codigo as ProdNombre from tbl_material_sap a where concat('[',a.codigo,'] ',a.descripcion) = '".$producto_clean."'";
     $resultadoM = mysqli_query($conn, $queryM);
     $rowM = mysqli_fetch_row($resultadoM);
     $producto_sap = $rowM[0];

     $queryC = "SELECT distinct rut from vw_clientes_sap where cliente = '".$cliente."'";
     $resultadoC = mysqli_query($conn, $queryC);
     $rowC = mysqli_fetch_row($resultadoC);
     $cliente_sap = $rowC[0];

     $username = 'PIQ_WEB';
     $password = 'Prosud$2022';

     $json_precio_sap ='{"ORGVT": "PS01","CANAL": "'.$area.'","MATERIAL": "'.$producto_sap.'","KUNNR": "'.$cliente_sap.'"}';

     $url = "http://40.90.238.44:50000/RESTAdapter/CONS_Precio_Sender";

     $curl = curl_init($url);
     curl_setopt($curl, CURLOPT_URL, $url);
     curl_setopt($curl, CURLOPT_POST, true);
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
     $headers = array(
        "Accept: application/json",
        "Authorization: Basic UElRX1dFQjpQcm9zdWQkMjAyMg==",
        "Content-Type: application/json",
     );
     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
     
     $data = $json_precio_sap;
     curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
     
     //for debug only!
     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
     
     $resp = curl_exec($curl);
     curl_close($curl);
     var_dump($resp);
     

 

    $precio = 0;
    $impto_adicional = 0;
    $sub = round($precio * $cantidad_clean);
    $imp = round(($precio * $impto_adicional)/100);
    $subtotal = round(($precio * $cantidad_clean)-(($precio * $cantidad_clean) * ($dscto_clean/100)));
    $iva = round($subtotal * (19/100));
    $produ_impto_adic = round($subtotal * ($impto_adicional/100));
    $total_general = round($subtotal + $iva + $produ_impto_adic);
    $imp_adi = round($imp * $cantidad_clean);

    $total_neto = round($total_neto + $subtotal);
    $total_iva = round($total_iva + $iva);
    $total_impto = round($total_impto + $produ_impto_adic);
    $total_total = round($total_total + $total_general);
   



    $contador  = $contador +1;
   $html.= "<tr id='row".$contador."'>";
   $html.= "<td id='data1' readonly='readonly' class='producto_pri'>".$producto_clean."</td>";
   $html.= "<td id='data2' readonly='readonly' class='um_pri'>".$medida."</td>";
   $html.= "<td id='data3' readonly='readonly' class='cantidad_pri'>".$cantidad_clean."</td>";
   $html.= "<td id='data4' readonly='readonly' class='precio_pri'>".moneda_chilena($precio)."</td>";
   $html.= "<td id='data6' readonly='readonly' class='impto_pri'>".moneda_chilena($imp_adi)."</td>";
   $html.= "<td id='data7' readonly='readonly' class='subtotal_pri'>".moneda_chilena($sub)."</td>";
   $html.= "<td id='data8' readonly='readonly' class='descuento_pri'>".$dscto_clean."</td>";
   $html.= "<td id='data8' readonly='readonly' class='tipo_pri'>".$resp."</td>";
   $html.= "<td id='data9' readonly='readonly' class='total_pri'>".moneda_chilena($subtotal)."<td>";
   $html.= '</tr>';


    }


echo $html;



?>

