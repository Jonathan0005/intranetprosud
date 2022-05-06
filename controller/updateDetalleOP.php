<?php
  include_once "../database/database_1.php";

    $id_orden = $_POST['id_orden'];
    $producto_insert= $_POST['producto_insert'];
    $cantidad_insert= $_POST['cantidad_insert'];
    $precio_insert = $_POST['precio_insert'];
    $subtotal_insert = $_POST['subtotal_insert'];
    $descuento_insert = $_POST['descuento_insert'];
    $tipo_insert = $_POST['tipo_insert'];
    $total_insert = $_POST['total_insert'];

    $delete_query = "delete from ordenesdetalle where OVOP_ID = ".$id_orden."";
    $delete_result = mysqli_query($conn, $delete_query);

    for($count = 0; $count<count($total_insert); $count++)
    {
     $producto = mysqli_real_escape_string($conn, $producto_insert[$count]);
     $cantidad = mysqli_real_escape_string($conn, $cantidad_insert[$count]);
     $precio = mysqli_real_escape_string($conn, $precio_insert[$count]);
     $subtotal = mysqli_real_escape_string($conn, $subtotal_insert[$count]);
     $descuento = mysqli_real_escape_string($conn, $descuento_insert[$count]);
     $total = mysqli_real_escape_string($conn, $total_insert[$count]);
     $query_producto = "select ProdCodigo from productos where concat('[',ProdCodigo,'] ', ProdNombre) = '$producto'  ";
     $produ_ejec = mysqli_query($conn, $query_producto);
     $r_produ = mysqli_fetch_row($produ_ejec);
     $prodcodigo = $r_produ[0];

    $no_moneda = array("$ ", ".", "");
    $subtotal_1 = str_replace($no_moneda, "", $subtotal);
    $total_1 = str_replace($no_moneda, "", $total);


    $query_insercion = "INSERT INTO ordenesdetalle (OVOPD_ID, OVOPD_CodigoProducto, OVOPD_Cantidad, OVOPD_PrecioNeto, OVOPD_SubTotal, OVOPD_PorcentajeDescuento, OVOPD_Total, OVOP_ID) VALUES($id_orden, '$prodcodigo', $cantidad, $precio, $subtotal_1, $descuento, $total_1, $id_orden);";

    $r_detalle = mysqli_query($conn, $query_insercion);


	}

  echo "orden actualizada correctamente";
?>