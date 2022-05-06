<?php
	require ('../database/database_1.php');
	
	$cliente_select = $_POST['cliente_select'];
	
	$queryM = "SELECT distinct a.nom_suc FROM vw_sucursales_sap a inner join vw_clientes_sap b on a.cod_cliente = b.rut where b.cliente = '$cliente_select' ORDER BY a.nom_suc";
	$resultadoM = mysqli_query($conn, $queryM);
	
	$html= "<option value='0'>Seleccionar Sucursal</option>";
	
	while($rowM = mysqli_fetch_row($resultadoM))
	{
		$html.= "<option value='".$rowM[0]."'>".$rowM[0]."</option>";
	}
	
	echo utf8_encode($html);
?>