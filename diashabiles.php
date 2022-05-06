<?php

$fecha1 = '10/06/2020';
$dias1 = 3;

function sumasdiasemana($fecha,$dias)
{
	$datestart= strtotime($fecha);
	$datesuma = 15 * 86400;
	$diasemana = date('N',$datestart);
	$totaldias = $diasemana+$dias;
	$findesemana = intval( $totaldias/5) *2 ; 
	$diasabado = $totaldias % 5 ; 
	if ($diasabado==6) $findesemana++;
	if ($diasabado==0) $findesemana=$findesemana-2;
 
	$total = (($dias+$findesemana) * 86400)+$datestart ; 
	return $fechafinal = date('d-m-Y', $total);
}

echo sumasdiassemana($fecha1, $dias1);
?>