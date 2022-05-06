<?php
header("Content-Type: text/html;charset=utf-8");
	require ('../database/database_1.php');
	
	$cliente= $_POST['cli'];
	$sucursal = $_POST['sucursal_select'];
	
	$queryM = "SELECT direccion FROM clientes2 WHERE descripcion = '$cliente' and sucursal = '$sucursal'  ORDER BY sucursal";
	$resultadoM = mysqli_query($conn, $queryM);

	$html='<input type="text" class="form-control" id="direccion_op" placeholder="" value="" disabled>';

	
	while($rowM = mysqli_fetch_row($resultadoM))
	{
		$html= '<input type="text" class="form-control" id="direccion_op" placeholder="" value="'.$rowM[0].'" disabled>';
	}
	
	echo utf8_encode($html);
?>