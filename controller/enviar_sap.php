<?php

error_reporting(E_ALL);

include_once "../database/database_1.php";
$json_poscicion = '';
$json_reparto = '';

function zero_fill ($valor, $long = 0)
{
    return str_pad($valor, $long, '0', STR_PAD_LEFT);
}

 //obtenemos el la ultima orden creada
$codigo_op = "select max(OVOP_ID) as codigo from ordenesencabezado";
$codigo_ejec = mysqli_query($conn, $codigo_op);
$r_codigo = mysqli_fetch_row($codigo_ejec);
$codigo = $r_codigo[0];
//echo $codigo; 

//obtenemos el encabezado de la orden 
$cabecera = "select trim(RelcRut) as BP, OVOP_ID as ID, DATE_FORMAT(OVOPFechaIngreso,'%Y%m%d') as FechaIngreso from ordenesencabezado where OVOP_ID = $codigo";
$cabecera_ejec =  mysqli_query($conn, $cabecera);
$fetch_cabecera = mysqli_fetch_row($cabecera_ejec);
$rut_partner = $fetch_cabecera[0];
$id_partner = $fetch_cabecera[1];
$fecha_ingreso = $fetch_cabecera[2];

$posicion = "select o.OVOPD_CodigoProducto as 'material', 'PS00' as plant, '1010' as store_loc, o.OVOPD_Cantidad as target_qty,'CJ' as target_qu from ordenesdetalle o where o.OVOPD_ID = $codigo"; 
$resultado_p = mysqli_query($conn,$posicion);
$json_posicion = '';
$contador_posicion_p = 10;
while($row_r2 = mysqli_fetch_row($resultado_p))
    {
        $json_material = $row_r2[0];
        $json_plant = $row_r2[1];
        $json_store_loc = $row_r2[2];
        $json_target_qty = $row_r2[3];
        $json_target_qu = $row_r2[4];
        $posicion_p = zero_fill($contador_posicion_p, 6);
        $json_posicion = $json_posicion.'{"ITM_NUMBER": "'.$posicion_p.'", "MATERIAL": "'.$json_material.'","PLANT": "PS01","STORE_LOC": "1010","TARGET_QTY": "'.$json_target_qty.'","TARGET_QU": "CS"},';
        $contador_posicion_p= $contador_posicion_p + 10;     
    }

$json_posicion = substr($json_posicion, 0, strlen($json_posicion) -1); 
  
$posicion_nueva = $json_posicion;

$reparto = "select DATE_FORMAT(ordenesencabezado.OVOPFechaDespacho,'%Y%m%d') as fecha, OVOPD_Cantidad as cantidad FROM ordenesdetalle inner join ordenesencabezado on ordenesdetalle.OVOPD_ID = ordenesencabezado.OVOP_ID where ordenesdetalle.OVOPD_ID = $codigo"; 
//echo $reparto; 
$resultado = mysqli_query($conn,$reparto);
$json_reparto = '';
$contador_posicion = 10;
while($row_r = mysqli_fetch_row($resultado))
    {
        $json_fecha = $row_r[0];
        $json_cantidad = $row_r[1];

        $posicion = zero_fill($contador_posicion, 6);

        $json_reparto = $json_reparto.' {"ITM_NUMBER": "'.$posicion.'","REQ_DATE": "'.$json_fecha.'","REQ_QTY": "'.$json_cantidad.'"},';
        $contador_posicion = $contador_posicion + 10;     
    }
$json_reparto = substr($json_reparto, 0, strlen($json_reparto) -1); 




//credenciales para la autentificacion basica
$username = 'PIQ_WEB';
$password = 'Prosud$2022';
//Armar json 
$json_pedido_sap = '{"Cabecera": {"DOC_TYPE": "ZVDI", "SALES_ORG": "PS01", "DISTR_CHAN": "11","DIVISION": "00","REQ_DATE_H": "'.$fecha_ingreso.'","PURCH_NO_C": "'.$id_partner.'", "PMNTTRMS": "P030", "PYMT_METH": "C", "PO_METHOD": "ZOWB"},"Posicion": ['.$posicion_nueva.'],"Partner": [{"PARTN_ROLE": "AG","PARTN_NUMB": "0'.$rut_partner.'"}],"Reparto": ['.$json_reparto.']}';

echo $json_pedido_sap; 

$url = "http://40.90.238.44:50000/RESTAdapter/CrearPedidoVenta_Sender";

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

$data = $json_pedido_sap;
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);



        
?>