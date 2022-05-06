<?php
	require ('../database/database_1.php');
	
	$cliente = $_POST['cli'];
	$sucursal = $_POST['sucursal_select'];
	
	$queryMed = "select distinct descripcion from tbl_umedida_sap";
	$resultadoMed = mysqli_query($conn, $queryMed);
	
	$html= "<option value='0'>Seleccione Unidad de Medida</option>";
	
	while($rowM = mysqli_fetch_row($resultadoMed))
	{
		$html.= "<option value='".$rowM[0]."'>".$rowM[0]."</option>";
	}
	
	echo utf8_encode($html);
?>