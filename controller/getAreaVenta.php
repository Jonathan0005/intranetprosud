<?php
	require ('../database/database_1.php');
	
	$cliente_select = $_POST['cliente_select'];
	
	$queryM = "SELECT distinct a.area_venta FROM  vw_clientes_sap a  where a.cliente = '$cliente_select' ORDER BY a.area_venta";
	$resultadoM = mysqli_query($conn, $queryM);
	
	$html= "<option value='0'>Seleccionar Area de Venta</option>";
	
	while($rowM = mysqli_fetch_row($resultadoM))
	{
		$html.= "<option value='".$rowM[0]."'>".$rowM[0]."</option>";
	}
	
	echo utf8_encode($html);
?>