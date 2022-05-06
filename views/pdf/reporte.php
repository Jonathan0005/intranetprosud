<?php
ob_start();
 	
	require '../../controller/convertMoneda.php';
	require '../../controller/convertRut.php';
	require '../bower_components/fpdf/fpdf.php';
	require '../../database/database_1.php';

	$id = $_GET['id'];
	
	$query = "SELECT CodigoProducto, DescripcionProducto, Precio, Cantidad, Subtotal,Descuento,  Total from vw_ordenes_detalle_pdf where ID = $id ";
	$resultado = mysqli_query($conn, $query);

	$query_encabezado= "select rut_cliente, nombre_cliente, fecha, direccion, formapago, total_neto, total_impto, otros_impto, total, case when observacion = '' then 'Sin Observacion' else observacion end as observacion, fechadespacho  from vw_ordenes_encabezado where id = $id ";
	$resultado_encabezado = mysqli_query($conn, $query_encabezado);
	$rowM = mysqli_fetch_row($resultado_encabezado);
	$rut = $rowM[0];
	$nombre = $rowM[1];
	$fecha =  $rowM[2];
	$direccion = utf8_encode($rowM[3]);
	$formapago = $rowM[4];
	$total_neto = $rowM[5];
	$total_iva = $rowM[6];
	$otros_impto = $rowM[7];
	$total = $rowM[8];
	$observacion = $rowM[9];
	$fecha_despacho = $rowM[10];
	
	$pdf = new FPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	

	$pdf->Image('images/logo.jpg', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, utf8_encode('Orden de Pedido ['.$id.']'),0,0,'C');
	$pdf->Ln(30);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10, 'RUT: '.RutChileno($rut).'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Cliente: '.$nombre.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Fecha: '.date("d-m-Y", strtotime($fecha)).'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Direccion: '.$direccion.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Forma de Pago: '.$formapago.'',0,0,'L');

	$pdf->Ln(15);


	$pdf->SetFont('Arial','B',7);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(20,6,'Cod. Producto',1,0,'C',1);
	$pdf->Cell(80,6,'Descripcion Producto ',1,0,'C',1);
	$pdf->Cell(20,6,'Precio Prod.',1,0,'C',1);
	$pdf->Cell(15,6,'Cant.',1,0,'C',1);
	$pdf->Cell(20,6,'Subtotal',1,0,'C',1);
	$pdf->Cell(15,6,'%Dscto',1,0,'C',1);
	$pdf->Cell(20,6,'Total',1,0,'C',1);
	
	$pdf->SetFont('Arial','',7);
	
		while($row = mysqli_fetch_row($resultado))
	{
		$pdf->Ln();
		$pdf->Cell(20,6,utf8_decode($row[0]),1,0,'C');
		$pdf->SetFont('Arial','B',5);
		$pdf->Cell(80,6,$row[1],1,0,'C');
		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(20,6,utf8_decode(moneda_chilena($row[2])),1,0,'C');
		$pdf->Cell(15,6,utf8_decode($row[3]),1,0,'C');
		$pdf->Cell(20,6,utf8_decode(moneda_chilena($row[4])),1,0,'C');
		$pdf->Cell(15,6,utf8_decode($row[5]),1,0,'C');
		$pdf->Cell(20,6,utf8_decode(moneda_chilena($row[6])),1,0,'C');
	}

	$pdf->Ln();
	$pdf->Ln();
	$pdf->Cell(18,10, 'Observacion: '.$observacion.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Fecha Despacho: '.date("d-m-Y", strtotime($fecha_despacho)).'',0,0,'L');
	$pdf->Ln();

	$pdf->SetFont('Arial','B',10);

	$pdf->Cell(180,10, 'Total Neto: '.moneda_chilena($total_neto).'',0,0,'R');
	$pdf->Ln();
	$pdf->Cell(180,10, 'IVA: '.moneda_chilena($total_iva).'',0,0,'R');
	$pdf->Ln();
	$pdf->Cell(180,10, 'Impto: '.moneda_chilena($otros_impto).'',0,0,'R');
	$pdf->Ln();
	$pdf->Cell(180,10, 'Total a Pagar: '.moneda_chilena($total).'',0,0,'R');


	$pdf->Output('D','OrdenPedido-'.$id.'.pdf');
	ob_end_flush(); 
?>