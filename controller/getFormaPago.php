<?php
	require ('../database/database_1.php');
	
	$cliente = $_POST['cli'];
	$sucursal = $_POST['sucursal_select'];
	
	$queryM = "SELECT distinct descripcion FROM tbl_formapago_sap ";
	$resultadoM = mysqli_query($conn, $queryM);
	
	$html= "<option value='0'>Seleccione Forma de Pago</option>";
	
	while($rowM = mysqli_fetch_row($resultadoM))
	{
		$html.= "<option value='".$rowM[0]."'>".$rowM[0]."</option>";
	}
	
	echo utf8_encode($html);
?>