<?php
error_reporting(-1);
  include_once "../database/database_1.php";

    $id_orden = $_POST['id_orden'];
    $cliente_insert= $_POST['cliente_insert'];
    $sucursal_insert = $_POST['sucursal_insert'];
    $fecha_insert = $_POST['fecha_insert'];
    $formapago_insert = $_POST['formapago_insert'];
    $direccion_insert = $_POST['direccion_insert'];
    $fecha_despacho_insert = $_POST['fecha_despacho_insert'];
    $observacion_insert = $_POST['observacion_insert'];
    $neto_insert = $_POST['neto_insert'];
    $iva_insert = $_POST['iva_insert'];
    $impto_insert = $_POST['impto_insert'];
    $unidad_insert = $_POST['unidad_insert'];
    $general_insert = $_POST['general_insert'];

    $fecha = str_replace('/', '-', $fecha_insert);
    $fecha_despacho = str_replace('/', '-', $fecha_despacho_insert);

    $query_rut_sucursal = "select rut, codSuc  from clientes2 where descripcion = '".$cliente_insert."' and sucursal= '".$sucursal_insert."'";
    $r_rut_sucursal = mysqli_query($conn, $query_rut_sucursal);

    $rut_sucursal=mysqli_fetch_row($r_rut_sucursal);
    $cliente = $rut_sucursal[0];
    $sucursal = $rut_sucursal[1];

    $query_cod_fpago="select TpagCodigo from clientes_data where descripcion = '$cliente_insert' and CodigoPago2 = '$formapago_insert'";
    $r_codpago = mysqli_query($conn, $query_cod_fpago);
    $result_codpago = mysqli_fetch_row($r_codpago);
    $formapago = $result_codpago[0];

    $no_moneda = array("$ ", ".", "");
    $total_neto = str_replace($no_moneda, "", $neto_insert);
    $total_iva = str_replace($no_moneda, "", $iva_insert);
    $total_impto = str_replace($no_moneda, "", $impto_insert);
    $total_general = str_replace($no_moneda, "", $general_insert);

    $delete_query = "delete from ordenesencabezado where OVOP_ID = ".$id_orden."";
    $delete_result = mysqli_query($conn, $delete_query);

$query = "INSERT INTO ordenesencabezado (OVOP_ID,RelcRut,RelcExtranjero,OVOPFormaPago,OVOPFechaIngreso,OVOPTotalNeto,OVOPIVA,OVOPOtrosImpuestos,OVOPTotal,OVOPDireccionDespacho,OVOPFechaDespacho,OVOPDescripcion,OVOPEstado,Rel_CodSuc, UnimCodigo)VALUES('".$id_orden."', '".$cliente."','1','".$formapago."', '". date("Y-m-d", strtotime($fecha) )."', ".$total_neto.",".$total_iva.", ".$total_impto.",".$total_general.", '".$direccion_insert."', '".date("Y-m-d", strtotime($fecha_despacho) )."', '".$observacion_insert."', 'NUEVO', '".$sucursal."', '".$unidad_insert."');";


$results = mysqli_query($conn, $query);


echo "orden actualizada correctamente";

?>