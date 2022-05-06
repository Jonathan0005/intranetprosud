<?php
	require ('../database/database_1.php');
	
	$cliente= $_POST['cli'];
	$linea = $_POST['linea_select'];
	
	$queryM = "select distinct concat('[',a.codigo,'] ',a.descripcion) as ProdNombre from tbl_material_sap a where a.codigolinea_text = '$linea'";
	$resultadoM = mysqli_query($conn, $queryM);
	
	$html= "<option value='0'>Seleccionar Producto</option>";
	
	while($rowM = mysqli_fetch_row($resultadoM))
	{
		$html.= "<option value='".$rowM[0]."'>".$rowM[0]."</option>";
	}
	
	echo utf8_encode($html);
	?>