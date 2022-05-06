<?php

require ('../database/database_1.php');

$rango_fechas = $_POST['rango_fechas'];



$fecha1 = substr($rango_fechas, 0, 10);
$fecha2 = substr($rango_fechas, 12,23);


$fecha1_replace = str_replace('/', '-', $fecha1);
$fecha2_replace = str_replace('/', '-', $fecha2);

$query = "SELECT distinct id from vw_ordenes_encabezado where fecha between '".date("Y-m-d", strtotime($fecha1_replace))."' and  '".date("Y-m-d", strtotime($fecha2_replace))."' ";


$resultado = mysqli_query($conn, $query);

	while($row = mysqli_fetch_row($resultado)){

		 echo "<script>window.open('../views/pdf/reporte.php?id=".$row[0]."', '_blank'); window.open('../views/impresion_masiva.php'); </script>";
			
	}

echo "<script>window.close();</script>";


?>