<?php
ob_start();
 	
	require '../../controller/convertMoneda.php';
	require '../../controller/convertRut.php';
	require '../bower_components/fpdf/fpdf.php';
	require '../../database/database_1.php';

	$id = $_GET['id'];
	$query_total = "select sum(round(PREMIO, 0)) as total from tbl_bonos_reponedor where RutRepo = '$id'";
	$resultado_total = mysqli_query($conn, $query_total);
	$rowtotal = mysqli_fetch_row($resultado_total);
	$total = $rowtotal[0];
	
	$query = "select Linea, round(MetasCajas,2) as MetasCajas, round(Cajas,2) as AvanceMetas, round(Premio,0) as Bono  from tbl_bonos_reponedor where RutRepo = '$id' and SE_PAGA = 'SE PAGA'";
	$resultado = mysqli_query($conn, $query);

	$query_encabezado= "select distinct RutRepo, NomReponedor, '2021' as ano , Mes, ClasificRepo from tbl_bonos_reponedor where RutRepo ='$id'";
    	//echo $query_encabezado;
	$resultado_encabezado = mysqli_query($conn, $query_encabezado);
	while ($rowM = mysqli_fetch_row($resultado_encabezado))
    {
	$rut = $rowM[0];
	$nombre = $rowM[1];
	$ano =  $rowM[2];
	$mes = $rowM[3];
	$clasificacion = $rowM[4];
    }
	
	$pdf = new FPDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	

	$pdf->Image('images/logo.jpg', 5, 5, 30 );
	$pdf->SetFont('Arial','B',15);
	$pdf->Cell(30);
	$pdf->Cell(120,10, utf8_encode('Detalle Bono Metas ['.RutChileno($rut).']'),0,0,'C');
	$pdf->Ln(30);

	$pdf->SetFont('Arial','',10);
	$pdf->Cell(20,10, 'RUT: '.RutChileno($rut).'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Empleado: '.$nombre.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Mes: '.$mes.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Año: '.$ano.'',0,0,'L');
	$pdf->Ln();
	$pdf->Cell(20,10, 'Clasificacion: '.$clasificacion.'',0,0,'L');

	$pdf->Ln(15);


	$pdf->SetFont('Arial','B',7);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(40,6,'Linea de Producto',1,0,'C',1);
	$pdf->Cell(30,6,'Meta',1,0,'C',1);
	$pdf->Cell(30,6,'Avance de Metas',1,0,'C',1);
	$pdf->Cell(40,6,'Bono Cumplimiento',1,0,'C',1);
	
	$pdf->SetFont('Arial','',7);
	
		while($row = mysqli_fetch_row($resultado))
	{
		$pdf->Ln();
		$pdf->Cell(40,6,utf8_decode($row[0]),1,0,'C');
		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(30,6,$row[1],1,0,'C');
		$pdf->SetFont('Arial','B',7);
		$pdf->Cell(30,6,utf8_decode($row[2]),1,0,'C');
		$pdf->Cell(40,6,utf8_decode(moneda_chilena($row[3])),1,0,'C');
	}
	$pdf->Ln();
	$pdf->Ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(18,10, 'Total Bono Cumplimiento: '.moneda_chilena($total).'',0,0,'L');





	$pdf->Output('D','BonoReponedor-'.$id.'.pdf');
	ob_end_flush(); 
?>