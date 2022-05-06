<?php
  include_once "../database/database_1.php";
	include_once "transformTilde.php";


    $producto_insert= $_POST['producto_insert'];
    $cantidad_insert= $_POST['cantidad_insert'];
    $precio_insert = $_POST['precio_insert'];
    $subtotal_insert = $_POST['subtotal_insert'];
    $descuento_insert = $_POST['descuento_insert'];
    $tipo_insert = $_POST['tipo_insert'];
    $total_insert = $_POST['total_insert'];

    for($count = 0; $count<count($total_insert); $count++)
    {
     $producto = mysqli_real_escape_string($conn, $producto_insert[$count]);
     $cantidad = mysqli_real_escape_string($conn, $cantidad_insert[$count]);
     $precio = mysqli_real_escape_string($conn, $precio_insert[$count]);
     $subtotal = mysqli_real_escape_string($conn, $subtotal_insert[$count]);
     $descuento = mysqli_real_escape_string($conn, $descuento_insert[$count]);
     $tipo = mysqli_real_escape_string($conn, $tipo_insert[$count]);
     $total = mysqli_real_escape_string($conn, $total_insert[$count]);

     $pro = $producto;
     preg_match_all("/\\[(.*?)\\]/", $pro, $matches); 
     $pro2 = $matches[1][0];

     $query_producto = "select ProdCodigo from productos where ProdCodigo = '".$pro2."'  ";
     $produ_ejec = mysqli_query($conn, $query_producto);
     $r_produ = mysqli_fetch_row($produ_ejec);
     $prodcodigo = $r_produ[0];

    $no_moneda = array("$ ", ".", "");
    $precio1 = str_replace($no_moneda, "", $precio);
    $subtotal_1 = str_replace($no_moneda, "", $subtotal);
    $total_1 = str_replace($no_moneda, "", $total);

    $codigo_op = "select  max(OVOP_ID) as codigo from ordenesencabezado";
    $codigo_ejec = mysqli_query($conn, $codigo_op);
    $r_codigo = mysqli_fetch_row($codigo_ejec);
    $codigo = $r_codigo[0];

    $query_insercion = "INSERT INTO ordenesdetalle (OVOPD_ID, OVOPD_CodigoProducto, OVOPD_Cantidad, OVOPD_PrecioNeto, OVOPD_SubTotal, OVOPD_PorcentajeDescuento, OVOPD_Total, OVOP_ID, OVOPD_TipoDescuento) VALUES($codigo, '$prodcodigo', $cantidad, $precio1, $subtotal_1, $descuento, $total_1, $codigo,'$tipo');";


    $r_detalle = mysqli_query($conn, $query_insercion);


	}

	echo 'Orden creada correctamente';
?>