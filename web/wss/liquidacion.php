<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(0);
require_once "isql.php";
	$db=new AS400DB("alias1","web","web");

    
    $secret = 'cOnUDxw9zTpcFxWa';
    $rut = $_POST['rut'];

    $mes = $_POST['mes'];
	$anio = $_POST['anio'];
    
    //$rut = '57118083';
    //$contrato = $_POST['contrato'];
    //$contrato = '07/01/2005';
    //$nacimiento = $_POST['nacimiento'];
    //$nacimiento = '13/07/1953';
    $hash = $_POST['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    if(strcmp($hasheado,$hash) != 0 )
    die();

    
    /* Asi funciona 
    $numero = 13041111.22; 
    $cambio = valorEnLetras($numero); 


    echo "numero = $numero"; 
    echo "<br>"; 
    echo "cambio = $cambio"; 
    */ 


    function valorEnLetras($x) 
    { 
    if ($x<0) { $signo = "menos ";} 
    else      { $signo = "";} 
    $x = abs ($x); 
    $C1 = $x; 

    $G6 = floor($x/(1000000));  // 7 y mas 

    $E7 = floor($x/(100000)); 
    $G7 = $E7-$G6*10;   // 6 

    $E8 = floor($x/1000); 
    $G8 = $E8-$E7*100;   // 5 y 4 

    $E9 = floor($x/100); 
    $G9 = $E9-$E8*10;  //  3 

    $E10 = floor($x); 
    $G10 = $E10-$E9*100;  // 2 y 1 


    $G11 = round(($x-$E10)*100,0);  // Decimales 
    ////////////////////// 

    $H6 = unidades($G6); 

    if($G7==1 AND $G8==0) { $H7 = "Cien "; } 
    else {    $H7 = decenas($G7); } 

    $H8 = unidades($G8); 

    if($G9==1 AND $G10==0) { $H9 = "Cien "; } 
    else {    $H9 = decenas($G9); } 

    $H10 = unidades($G10); 

    if($G11 < 10) { $H11 = "0".$G11; } 
    else { $H11 = $G11; } 

    ///////////////////////////// 
        if($G6==0) { $I6=" "; } 
    elseif($G6==1) { $I6="Millón "; } 
            else { $I6="Millones "; } 
            
    if ($G8==0 AND $G7==0) { $I8=" "; } 
            else { $I8="Mil "; } 
            
    $I10 = "Pesos "; 
    $I11 = "/100 M.N. "; 

    //$C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10.$H11.$I11; 
    $C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10; 

    return str_replace("Y", "y", ucwords(strtolower($C3))); //Retornar el resultado 

    } 

    function unidades($u) 
    { 
        if ($u==0)  {$ru = " ";} 
    elseif ($u==1)  {$ru = "Un ";} 
    elseif ($u==2)  {$ru = "Dos ";} 
    elseif ($u==3)  {$ru = "Tres ";} 
    elseif ($u==4)  {$ru = "Cuatro ";} 
    elseif ($u==5)  {$ru = "Cinco ";} 
    elseif ($u==6)  {$ru = "Seis ";} 
    elseif ($u==7)  {$ru = "Siete ";} 
    elseif ($u==8)  {$ru = "Ocho ";} 
    elseif ($u==9)  {$ru = "Nueve ";} 
    elseif ($u==10) {$ru = "Diez ";} 

    elseif ($u==11) {$ru = "Once ";} 
    elseif ($u==12) {$ru = "Doce ";} 
    elseif ($u==13) {$ru = "Trece ";} 
    elseif ($u==14) {$ru = "Catorce ";} 
    elseif ($u==15) {$ru = "Quince ";} 
    elseif ($u==16) {$ru = "Dieciseis ";} 
    elseif ($u==17) {$ru = "Decisiete ";} 
    elseif ($u==18) {$ru = "Dieciocho ";} 
    elseif ($u==19) {$ru = "Diecinueve ";} 
    elseif ($u==20) {$ru = "Veinte ";} 

    elseif ($u==21) {$ru = "Veintiun ";} 
    elseif ($u==22) {$ru = "Veintidos ";} 
    elseif ($u==23) {$ru = "Veintitres ";} 
    elseif ($u==24) {$ru = "Veinticuatro ";} 
    elseif ($u==25) {$ru = "Veinticinco ";} 
    elseif ($u==26) {$ru = "Veintiseis ";} 
    elseif ($u==27) {$ru = "Veintisiente ";} 
    elseif ($u==28) {$ru = "Veintiocho ";} 
    elseif ($u==29) {$ru = "Veintinueve ";} 
    elseif ($u==30) {$ru = "Treinta ";} 

    elseif ($u==31) {$ru = "Treinta y un ";} 
    elseif ($u==32) {$ru = "Treinta y dos ";} 
    elseif ($u==33) {$ru = "Treinta y tres ";} 
    elseif ($u==34) {$ru = "Treinta y cuatro ";} 
    elseif ($u==35) {$ru = "Treinta y cinco ";} 
    elseif ($u==36) {$ru = "Treinta y seis ";} 
    elseif ($u==37) {$ru = "Treinta y siete ";} 
    elseif ($u==38) {$ru = "Treinta y ocho ";} 
    elseif ($u==39) {$ru = "Treinta y nueve ";} 
    elseif ($u==40) {$ru = "Cuarenta ";} 

    elseif ($u==41) {$ru = "Cuarenta y un ";} 
    elseif ($u==42) {$ru = "Cuarenta y dos ";} 
    elseif ($u==43) {$ru = "Cuarenta y tres ";} 
    elseif ($u==44) {$ru = "Cuarenta y cuatro ";} 
    elseif ($u==45) {$ru = "Cuarenta y cinco ";} 
    elseif ($u==46) {$ru = "Cuarenta y seis ";} 
    elseif ($u==47) {$ru = "Cuarenta y siete ";} 
    elseif ($u==48) {$ru = "Cuarenta y ocho ";} 
    elseif ($u==49) {$ru = "Cuarenta y nueve ";} 
    elseif ($u==50) {$ru = "Cincuenta ";} 

    elseif ($u==51) {$ru = "Cincuenta y un ";} 
    elseif ($u==52) {$ru = "Cincuenta y dos ";} 
    elseif ($u==53) {$ru = "Cincuenta y tres ";} 
    elseif ($u==54) {$ru = "Cincuenta y cuatro ";} 
    elseif ($u==55) {$ru = "Cincuenta y cinco ";} 
    elseif ($u==56) {$ru = "Cincuenta y seis ";} 
    elseif ($u==57) {$ru = "Cincuenta y siete ";} 
    elseif ($u==58) {$ru = "Cincuenta y ocho ";} 
    elseif ($u==59) {$ru = "Cincuenta y nueve ";} 
    elseif ($u==60) {$ru = "Sesenta ";} 

    elseif ($u==61) {$ru = "Sesenta y un ";} 
    elseif ($u==62) {$ru = "Sesenta y dos ";} 
    elseif ($u==63) {$ru = "Sesenta y tres ";} 
    elseif ($u==64) {$ru = "Sesenta y cuatro ";} 
    elseif ($u==65) {$ru = "Sesenta y cinco ";} 
    elseif ($u==66) {$ru = "Sesenta y seis ";} 
    elseif ($u==67) {$ru = "Sesenta y siete ";} 
    elseif ($u==68) {$ru = "Sesenta y ocho ";} 
    elseif ($u==69) {$ru = "Sesenta y nueve ";} 
    elseif ($u==70) {$ru = "Setenta ";} 

    elseif ($u==71) {$ru = "Setenta y un ";} 
    elseif ($u==72) {$ru = "Setenta y dos ";} 
    elseif ($u==73) {$ru = "Setenta y tres ";} 
    elseif ($u==74) {$ru = "Setenta y cuatro ";} 
    elseif ($u==75) {$ru = "Setenta y cinco ";} 
    elseif ($u==76) {$ru = "Setenta y seis ";} 
    elseif ($u==77) {$ru = "Setenta y siete ";} 
    elseif ($u==78) {$ru = "Setenta y ocho ";} 
    elseif ($u==79) {$ru = "Setenta y nueve ";} 
    elseif ($u==80) {$ru = "Ochenta ";} 

    elseif ($u==81) {$ru = "Ochenta y un ";} 
    elseif ($u==82) {$ru = "Ochenta y dos ";} 
    elseif ($u==83) {$ru = "Ochenta y tres ";} 
    elseif ($u==84) {$ru = "Ochenta y cuatro ";} 
    elseif ($u==85) {$ru = "Ochenta y cinco ";} 
    elseif ($u==86) {$ru = "Ochenta y seis ";} 
    elseif ($u==87) {$ru = "Ochenta y siete ";} 
    elseif ($u==88) {$ru = "Ochenta y ocho ";} 
    elseif ($u==89) {$ru = "Ochenta y nueve ";} 
    elseif ($u==90) {$ru = "Noventa ";} 

    elseif ($u==91) {$ru = "Noventa y un ";} 
    elseif ($u==92) {$ru = "Noventa y dos ";} 
    elseif ($u==93) {$ru = "Noventa y tres ";} 
    elseif ($u==94) {$ru = "Noventa y cuatro ";} 
    elseif ($u==95) {$ru = "Noventa y cinco ";} 
    elseif ($u==96) {$ru = "Noventa y seis ";} 
    elseif ($u==97) {$ru = "Noventa y siete ";} 
    elseif ($u==98) {$ru = "Noventa y ocho ";} 
    else            {$ru = "Noventa y nueve ";} 
    return $ru; //Retornar el resultado 
    } 

    function decenas($d) 
    { 
        if ($d==0)  {$rd = "";} 
    elseif ($d==1)  {$rd = "Ciento ";} 
    elseif ($d==2)  {$rd = "Doscientos ";} 
    elseif ($d==3)  {$rd = "Trescientos ";} 
    elseif ($d==4)  {$rd = "Cuatrocientos ";} 
    elseif ($d==5)  {$rd = "Quinientos ";} 
    elseif ($d==6)  {$rd = "Seiscientos ";} 
    elseif ($d==7)  {$rd = "Setecientos ";} 
    elseif ($d==8)  {$rd = "Ochocientos ";} 
    else            {$rd = "Novecientos ";} 
    return $rd; //Retornar el resultado 
    } 
    

	//FECHA CONTRATACION
	//$result=$db->query("SELECT TOP 1  mm.MovMenFechaContrato FROM MovimientoMensual as mm WHERE mm.EmplRut = 16901148 " );

	//CARGO (en num)
	//MovMenCargoDesem 
	//CARGO EN TEXTO
	//$result=$db->query("SELECT TOP 1 c.CarNombre FROM Cargos as c WHERE c.CarCod = 18 " );


	// [MovMenSdoBasePactado] => 214410 [MovMenDiasContra] => 8 [MovMenDiasAusente] => 0 [MovMenDiasNoContratado] => 22 [MovMenDiasLicencia] => 0 
	//$result=$db->query("SELECT TOP 1  * FROM MovimientoMensual as mm WHERE mm.EmplRut = 16901148 " );


	//Rut 
	//Apellido_P
	//Apellido_M
	//Nombre
	//Cargo
	//CentroCosto
	//Fecha_Nacimiento
	//Fecha_Ingreso
	//AFP
	//ISAPRE
	//Codigo_empleado
	//$result=$db->query("SELECT TOP 1  * FROM ANTECEDENTES_PERSONALES as ap WHERE ap.Rut = 16901148 " );

	//Detalle de vacaciones del empleado (cada vez que tomó)
	//SELECT CAST(field1 AS TEXT) AS field1 FROM table
	//$result=$db->query("SELECT   dv.DetVarFechaIni,dv.DetVaFechaFin FROM DetVacaciones as dv WHERE dv.EmplRut = 59210009 " );



	//DETALLE_VACACIONES_RESUMEN  TotalDiasVacaciones TotalDiasTomados DiasRestantes DiasPresenteAño Año,Mes  Apellido_P, Apellido_M, Nombre Cargo FechaContrato
	//TOP 1  where Rut= 'ELRUTCONGUIONTODOJUNTO' ORDER BY Año DESC, Mes DESC

	//$result=$db->query("SELECT  TOP 100  * FROM DETALLE_VACACIONES_RESUMEN as dvr WHERE dvr.Rut = 59210009 " );

	//ESTO ES PARA EL DETALLE


	$result=$db->query("SELECT TOP (1) a.[EmprCod]
      ,[EmplRut]
      ,[EmplExtranjero]
      ,[HabDesAno]
      ,[HabDesMes]
      ,[MovMenCorrel]
      ,[MovMenCodigo]
      ,[MovMenFechaInicial]
      ,[MovMenFechaTermino]
      ,[MovMenRut]
      ,[MovMenExt]
      ,[MovMenTrabAgric]
      ,[MovMenSdoBasePactado]
      ,[MovMenDiasContra]
      ,[MovMenDiasAusente]
      ,[MovMenDiasNoContratado]
      ,[MovMenDiasLicencia]
      ,[MovMenHXNormales]
      ,[MovMenHXNocturnas]
      ,[MovMenHDescuento]
      ,[MovMenHXFestivos]
      ,[MovMenXHNorMonto]
      ,[MovMenXHNocMonto]
      ,[MovMenXHFesMonto]
      ,[MovMenHDesMonto]
      ,[MovMenOtroImponible]
      ,[MovMenOtroIsapre]
      ,[MovMenImptoUnico]
      ,[MovMenImptoUnicoRel]
      ,[MovMenAFPCod]
      ,[MovMenAFPCotAdicTipo]
      ,[MovMenAFPCotAdicMonto]
      ,[MovMenAFPCotObli]
      ,[MovMenAFPCotVolu]
      ,[MovMenAFPCtaAhorroTipo]
      ,[MovMenAFPCtaAhorroMonto]
      ,[MovMenISACod]
      ,[MovMenISATipoCot]
      ,[MovMenISACotAdicTipo]
      ,[MovMenISACotAdicMonto]
      ,[MovMenTieneDosPor]
      ,[MovMenISATipoDosPor]
      ,[MovMenISADosPorMonto]
      ,[MovMenGratificaTipo]
      ,[MovMenGratificaMonto]
      ,[InstCodigo]
      ,[SucuCodigo]
      ,[CodResultado]
      ,[MovMenCargoDesem]
      ,[MovMenRetroSimple]
      ,[MovMenRetroMaternales]
      ,[MovMenRetroInvalidez]
      ,[MovMenTipoSueldo]
      ,[MovMenTipMonedaCodigo]
      ,[MovMenDiaCambio]
      ,[MovMenAsigColacion]
      ,[MovMenAsigMovilizacion]
      ,[MovMenAsigZonaEx]
      ,[MovMenLabor]
      ,[MovMenHorario]
      ,[MovMenNCuenta]
      ,[MovMenFormaPago]
      ,[MovMenDiasLaborales]
      ,[MovMenHorasSemanales]
      ,[MovMenFechaContrato]
      ,[MovMenRetroMonto]
      ,[MovMenCargaSimple]
      ,[MovMenCargaMaternal]
      ,[MovMenCargaInvalidez]
      ,[MovMenCargaMonto]
      ,[MovMenDiasColacion]
      ,[MovMenDiasMovilizacion]
      ,[MovMenFechaFiniquito]
      ,[MovMenISAServicios]
      ,[MovMenAFPExtranjero]
      ,[MovMenIsaExtranjero]
      ,[MovMenSdoProporcional]
      ,[MovMenTipoHE]
      ,[MovMenFeLeProgresivo]
      ,[MovMenSegDes]
      ,[MovMenInstSegDes]
      ,[MovMenTipContrato]
      ,case when [MovMenDepositoConvenido] is NULl then '0' else [MovMenDepositoConvenido] end  as MovMenDepositoConvenido
      ,[MovMenZonaExtrema]
      ,[MovMenPorZonaExtrema]
      ,[MovMenAfiliadoCCHC]
      ,[MovMenTipoPlanCCHC]
      ,case when [MovMenNoProporcional] is NULL then '0' else [MovMenNoProporcional] end as MovMenNoProporcional
      ,[MovMenActual]
      ,[MovMenFechaIRetro]
      ,[MovMenFechaTRetro]
      ,[MovMenLey20255]
      ,[MovMenTrabLey20255]
      ,[MovMenISACotAdicMonto_2]
      ,[MovMenSubZona]
      ,case when [MovMenHXDom] is NULL then '0' else [MovMenHXDom] end as MovMenHXDom
      ,[MovMenHXDomMonto]
	  ,b.TaCotTazaCotizacion  FROM [procesadorabd].[dbo].[MovimientoMensual] a left join [TasaCotizaci�n] b on 
      a.MovMenAFPCod = b.InprCodigo and a.HabDesMes = b.TacotMes and a.HabDesAno = b.TacotAno and a.EmprCod = b.EmprCod Where ltrim(rtrim(EmplRut)) = ltrim(rtrim('".$rut."')) AND [HabDesAno] = ".$anio." AND [HabDesMes] = ".$mes." ");
  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	$lines = array();
    $lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
      $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["liq"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;



/*
    $result=$db->query("SELECT TOP (1) [InprNombre]
    
  FROM [procesadorabd].[dbo].[InstPrevisional]" );

  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	$lines = array();
    $lines_tmp = array();
	if($result->num_rows){
        */
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
/*
            $lines["instPrev"] =  $line=$result->fetch_array();
           
  
	}
	else echo $db->ODBCerror;

*/

	
    $result=$db->query("SELECT TOP (1) [InprNombre]
    
  FROM [procesadorabd].[dbo].[InstPrevisional] Where InprCodigo = ".$lines["liq"]["MovMenAFPCod"] );


  //'  71480402'


//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO

	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
      $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["instPrev"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;

/*
  $result=$db->query("SELECT TOP (1000) [EmprCod]
      ,[TacotAno]
      ,[TacotMes]
      ,[InprCodigo]
      ,[TaCotTazaCotizacion]
      ,[TaCotTasaCotizacion]
  FROM [procesadorabd].[dbo].[TasaCotización] WHERE InprCodigo = ".$lines["liq"]["MovMenAFPCod"]. " AND TacotAno = ".$anio. " AND TacotMes = ".$mes );


  //'  71480402'


//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO

	if($result->num_rows){
		
            $lines["TasaCot"] =  $line=$result->fetch_array();
           
  
	}
	else echo $db->ODBCerror;
*/

$result=$db->query("SELECT TOP (1) [InprNombre]
    
  FROM [procesadorabd].[dbo].[InstPrevisional] Where InprCodigo = ".$lines["liq"]["MovMenISACod"] );


  //'  71480402'


//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO

	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
            $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["instPrevSalud"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;




	$result=$db->query("SELECT TOP (1) [EmprCod]
      ,[EmplRut]
      ,[EmplExtranjero]
      ,[HabDesAno]
      ,[HabDesMes]
      ,[MovMenCorrel]
      ,[MovMenSdoBaseGanado]
      ,[MovMenSdoImponible]
      ,[MovMenSdoTributable]
      ,case when [MovMenISADifIsap] is NULL then 0 else [MovMenISADifIsap] end as MovMenISADifIsap
      ,[MovMenOtrosImponibles]
      ,[MovMenOtrosNoImponible]
      ,[MovMenTotHaber]
      ,[MovMenOtroDescuentos]
      ,[MovMenTotDescuentos]
      ,[MovMenTotAnticipos]
      ,[MovMenAlcLiquido]
      ,[MovMenTotPagar]
      ,[MovMenSaldoNeg]
      ,[MovMenGratificacionPagada]
      ,[MovMenAsigColacionPagada]
      ,[MovMenAsigMovilizacionPagada]
      ,[MovMenValorCargaFamiliarPagada]
      ,[MovMenAFPTotalPagada]
      ,[MovMenISATotPagada]
      ,[MovMenTotDosPorPagado]
      ,[MovMenDiasAusenteMonto]
      ,[MovMenDiasLicenciaMonto]
      ,[MovMenTotalNoImponoble]
      ,[MovMenAFPCtaAhorroMontoPagada]
      ,[MovMenTotImponible]
      ,[MovMenAFPCotAdicPagada]
      ,[MovMenRelTotal]
      ,[MovMenRelImponible]
      ,[MovMenRelAFP]
      ,[MovMenRelIsa]
      ,[MovMenRelImpto]
      ,[MovMenRelAnticipo]
      ,[MovMenAFCMonto]
      ,[MovMenRelAFC]
      ,[MovMenAFCAporteEmple]
      ,[MovMenSdoImponibleAFC]
      ,case when [MovMenActual] is NULL then '0' else [MovMenActual] end as MovMenActual
      ,[MovMenRelDifImponible]
      ,[MovMenRelISADifMonto]
      ,case when [MovMenRelAFCAporteEmple] is NULL then '0' else [MovMenRelAFCAporteEmple] end as MovMenRelAFCAporteEmple
      ,[MovMenLey20255]
      ,[MovMenSdoImponibleSIS]  
      FROM [procesadorabd].[dbo].[MovimientoMensualAPagar] Where ltrim(rtrim(EmplRut)) = ltrim(rtrim('".$rut."'))  AND [HabDesAno] = ".$anio." AND [HabDesMes] = ".$mes." ");
  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
    //$lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
            $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["liq3"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;

    

    /*
    SELECT     TOP 100 PERCENT 
	dbo.MovimientoMensual.EmprCod AS Empresa, 
	dbo.MovimientoMensual.HabDesAno AS Anio, 
	dbo.MovimientoMensual.HabDesMes AS Mes, 
	dbo.MovimientoMensual.EmplRut AS Rut, 
	dbo.Empleados.EmplApellidoP AS Apellido_P, 
	dbo.Empleados.EmplApellidoM AS Apellido_M, 
	dbo.Empleados.EmplNombre AS Nombre, 

	(SELECT  top 1  CarNombre	
	FROM          Cargos
	WHERE      EmprCod = dbo.movimientoMensual.EmprCod 
	AND CarCod = dbo.MovimientoMensual.MovMenCargoDesem) AS Cargo, 

	(SELECT  top 1  CodRDescrip	
	FROM          CodResult
	WHERE      EmprCod = dbo.movimientoMensual.EmprCod 
	AND CodRCodigo = dbo.MovimientoMensual.CodResultado
	AND CodRAno = dbo.MovimientoMensual.HabDesAno) AS CentroCosto, 

	dbo.MovimientoMensual.MovMenSdoBasePactado AS Sueldo_Base, 
	(dbo.MovimientoMensualAPagar.MovMenSdoBaseGanado - dbo.MovimientoMensualapagar.MovMenDiasLicenciaMonto - dbo.MovimientoMensualAPagar.MovMenDiasAusenteMonto ) AS Sueldo_Base_Ganado, 
	(30 - MovMenDiasAusente - MovMenDiasLicencia - MovMenDiasNoContratado) AS Dias_Trabajados, 
	--(MovMenDiasAusente + MovMenDiasLicencia + MovMenDiasNoContratado) AS Dias_NO_Trabajados, 
	(MovMenDiasNoContratado) as Dias_NO_Trabajados,
	MovMenDiasLicencia AS Dias_Licencia, 
	MovMenDiasAusente AS Dias_Ausentes, 
	dbo.MovimientoMensualAPagar.MovMenGratificacionPagada AS Gratificacion, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo = '23') as Aguinaldo_Fiestas_Patrias, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo = '24') as Aguinaldo_Navidad, 
	
	dbo.MovimientoMensual.MovMenXHNorMonto as Horas_Extras_Monto, 
	convert(float,substring(dbo.MovimientoMensual.MovMenHXNormales,1,3)) as Cant_horas_extras, 
	convert(float,substring(dbo.MovimientoMensual.MovMenHXNormales,5,2)) as Minutos_horas_extras, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	--and HabDesEmpleados.HDCodigo IN ('26','17','16','15','14','13','12','11','10')) as Bonos, 
	and HabDesEmpleados.HDCodigo IN ('10')) as BONOS, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('18')) as Comisiones, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('30')) as Promociones, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('31')) as Produccion_equivalente,
	
	(SELECT  top 1  sum(MovMenAsigMovilizacionPagada)	
	FROM          MovimientoMensualAPagar
	WHERE      MovimientoMensualAPagar.EmprCod = MovimientoMensual.EmprCod
	and MovimientoMensualAPagar.EmplRut = MovimientoMensual.EmplRut
	and MovimientoMensualAPagar.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and MovimientoMensualAPagar.HabDesAno = MovimientoMensual.HabDesAno
	and MovimientoMensualAPagar.HabDesMes = MovimientoMensual.HabDesMes
	and MovimientoMensualAPagar.MovMenCorrel = MovimientoMensual.MovMenCorrel
	) as Movilizacion2,  
	
	(dbo.MovimientoMensualaPagar.MovMenAsigMovilizacionPagada + 
	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('19'))) as Movilizacion, 

	dbo.MovimientoMensualaPagar.MovMenAsigColacionPagada as Colacion, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('28')) as Bono_Movilizacion, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('29')) as Bono_Colacion, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('32')) as Sala_Cuna, 

	dbo.MovimientoMensualaPagar.MovMenAFCMonto as AFC_Trabajador, 
	dbo.MovimientoMensualaPagar.MovMenAFCAporteEmple as AFC_Empleador, 

	convert(float,dbo.MovimientoMensualAPagar.MovMenSdoImponible * 
	(SELECT top 1 ParametrosMensuales.PFacCotiMutual 
	FROM ParametrosMensuales 
	WHERE ParametrosMensuales.PEmpr = MovimientoMensual.EmprCod
	and ParametrosMensuales.PAno = MovimientoMensual.HabDesAno
	and ParametrosMensuales.PMes = MovimientoMensual.HabDesMes) /100) as APORTE_PATRONAL,


	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('25')) as Sueldo_Diario, 

	(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('33')) as Semana_Corrida 

	, dbo.MovimientoMensual.MovMenLey20255 as Monto_SIS
	
	,(CASE WHEN dbo.MovimientoMensual.MovMenTipContrato = 1 THEN 'INDEFINIDO' ELSE 'PLAZO FIJO' END) AS TipoContrato
	
	,(SELECT  top 1  InstNombre
	FROM          InstFinanciera 
	WHERE      InstFinanciera.InstCodigo = dbo.MovimientoMensual.InstCodigo) as BANCO

	, (dbo.MovimientoMensualAPagar.MovMenAlcLiquido - MovimientoMensualAPagar.MovMenTotAnticipos) as SueldoLiquido

,	(SELECT     ZgNombre AS Nombre
    FROM          dbo.Zonas
    WHERE      (dbo.Zonas.EmprCod = dbo.MovimientoMensual.EmprCod) AND (dbo.Zonas.ZgCodigo = dbo.MovimientoMensual.MovMenSubZona)) AS DEPARTAMENTO
 
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('110')) as Anticipo 
	
, (dbo.MovimientoMensualAPagar.MovMenISATotPagada) as Monto_Isapre	
, (dbo.MovimientoMensualAPagar.MovMenSdoImponible) as Sueldo_Imponible
, (dbo.MovimientoMensualAPagar.MovMenAFPTotalPagada) as Monto_AFP	
, (dbo.MovimientoMensualAPagar.MovMenSdoTributable) as SueldoTributable	
, (dbo.MovimientoMensualAPagar.MovMenValorCargaFamiliarPagada) as CargaFamiliar

--****************************************************************************************

,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('13')) as BONO_MATRICULA 

,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('12')) as BONO_METAS
	
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('11')) as BONO_RESPONSABILIDAD 
	 
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('14')) as BONO_ADICIONAL
	
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('17')) as BONO_INVENTARIO

,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('35')) as BONO_PRODUCCION
	
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('135')) as MOVILIZACION_EXTRAORDINARIA
	
,(SELECT  top 1  sum(HabDesValorTot)	
	FROM          HabDesEmpleados
	WHERE      HabDesEmpleados.EmprCod = MovimientoMensual.EmprCod
	and HabDesEmpleados.EmplRut = MovimientoMensual.EmplRut
	and HabDesEmpleados.EmplExtranjero = MovimientoMensual.EmplExtranjero
	and HabDesEmpleados.HabDesAno = MovimientoMensual.HabDesAno
	and HabDesEmpleados.HabDesMes = MovimientoMensual.HabDesMes
	and HabDesEmpleados.MovMenCorrel = MovimientoMensual.MovMenCorrel
	and HabDesEmpleados.HDCodigo IN ('63')) as BONO_REEMPLAZO 

, (dbo.MovimientoMensualAPagar.MovMenTotHaber) as TOTAL_HABERES
--****************************************************************************************	
FROM         dbo.MovimientoMensual INNER JOIN dbo.MovimientoMensualAPagar 
		on dbo.MovimientoMensual.EmprCod = dbo.MovimientoMensualAPagar.EmprCod
		and dbo.MovimientoMensual.EmplRut = dbo.MovimientoMensualAPagar.EmplRut
		and dbo.MovimientoMensual.EmplExtranjero = dbo.MovimientoMensualAPagar.EmplExtranjero
		and dbo.MovimientoMensual.HabDesAno = dbo.MovimientoMensualAPagar.HabDesAno
		and dbo.MovimientoMensual.HabDesMes = dbo.MovimientoMensualAPagar.HabDesMes
		LEFT OUTER JOIN
                      dbo.Personas  ON dbo.Personas.PersRut = dbo.MovimientoMensual.EmplRut AND 
                      dbo.Personas.PersExtranjero = dbo.MovimientoMensual.EmplExtranjero INNER JOIN
                      dbo.Empleados ON dbo.MovimientoMensual.EmprCod = dbo.Empleados.EmprCod 
			AND dbo.MovimientoMensual.EmplRut = dbo.Empleados.EmplRutF  
			AND dbo.MovimientoMensual.EmplExtranjero = dbo.Empleados.EmplExtranjero  

    */

	$result=$db->query(" SELECT TOP (1) a.[Empresa]
      ,a.[Mes]
      ,a.[Rut]
      ,a.[Apellido_P]
      ,a.[Apellido_M]
      ,a.[Nombre]
      ,a.[Cargo]
      ,a.[CentroCosto]
      ,a.[Sueldo_Base]
      ,a.[Sueldo_Base_Ganado]
      ,a.[Dias_Trabajados]
      ,a.[Dias_NO_Trabajados]
      ,a.[Dias_Licencia]
      ,a.[Dias_Ausentes]
      ,a.[Gratificacion]
      ,a.[Aguinaldo_Fiestas_Patrias]
      ,a.[Aguinaldo_Navidad]
      ,a.[Horas_Extras_Monto]
      ,a.[Cant_horas_extras]
      ,a.[Minutos_horas_extras]
      ,case when a.[BONOS] is NULL then '0' else a.[BONOS] end as BONOS
      ,case when a.[Comisiones] is NULL then '0' else a.[Comisiones] end as Comisiones
      ,case when a.[Promociones] is NULL then '0' else a.[Promociones] end as Promociones
      ,case when a.[Produccion_equivalente] is NULL then '0' else a.[Produccion_equivalente] end as Produccion_equivalente
      ,a.[Movilizacion2]
      ,case when a.[Movilizacion] is NULL then '0' else  a.[Movilizacion] end as Movilizacion
      ,a.[Colacion]
      ,case when a.[Bono_Movilizacion] is NULL then '0' else a.[Bono_Movilizacion] end as Bono_Movilizacion
      ,case when a.[Bono_Colacion] is NULL then '0' else a.[Bono_Colacion] end as Bono_Colacion
      ,case when a.[Sala_Cuna] is NULL then '0' else a.[Sala_Cuna] end as Sala_Cuna
      ,a.[AFC_Trabajador]
      ,a.[AFC_Empleador]
      ,a.[APORTE_PATRONAL]
      ,case when a.[Sueldo_Diario] is NULL then '0' else a.[Sueldo_Diario] end as Sueldo_Diario 
      ,case when a.[Semana_Corrida] is NULL then '0' else a.[Semana_Corrida] end as Semana_Corrida
      ,a.[Monto_SIS]
      ,a.[TipoContrato]
      ,a.[BANCO]
      ,a.[SueldoLiquido]
      ,a.[DEPARTAMENTO]
      ,case when a.[Anticipo] is NULL then '0' else a.Anticipo end as Anticipo
      ,a.[Monto_Isapre]
      ,a.[Sueldo_Imponible]
      ,Case when a.BONOS is NULL then '0' else a.BONOS end as BONOS
      ,a.[Monto_AFP]
      ,a.[SueldoTributable]
      ,a.[CargaFamiliar]
      ,a.[BONO_MATRICULA]
      ,a.[BONO_METAS]
      ,a.[BONO_RESPONSABILIDAD]
      ,a.[BONO_ADICIONAL]
      ,a.[BONO_INVENTARIO]
      ,a.[BONO_PRODUCCION]
      ,a.[MOVILIZACION_EXTRAORDINARIA]
      ,a.[BONO_REEMPLAZO]
      ,a.[TOTAL_HABERES]
	  ,case when b.[FACTURAS] is NULL then 0 else b.[FACTURAS] end as FACTURAS
	  ,case when b.[AHORRO HABITACIONAL] is NULL then 0 else  b.[AHORRO HABITACIONAL] end as AHORRO_HABITACIONAL
	  ,case when b.[ANTICIPO EXTRAORDINARIO] is NULL then 0 else b.[ANTICIPO EXTRAORDINARIO] end as ANTICIPO_EXTRAORDINARIO
	  ,case when b.[COMPRA LEASING] is NULL then 0 else b.[COMPRA LEASING] end as COMPRA_LEASING
	  ,case when b.[CONVENIO DENTAL] is NULL then 0 else b.[CONVENIO DENTAL] end as CONVENIO_DENTAL
	  ,case when b.[DONACION] is NULL then 0 else b.[DONACION] end as DONACION
	  ,case when b.[GIMNASIO ENERGY] is NULL then 0 else b.[GIMNASIO ENERGY] end as GIMNASIO_ENERGY
	  ,case when b.[GIMNASIO PACIFIC] is NULL then 0 else b.[GIMNASIO PACIFIC] end as GIMNASIO_PACIFIC
	  ,case when b.[OPTICA] is NULL then 0 else b.[OPTICA] end as OPTICA
	  ,case when b.[OTRO DESCUENTO] is NULL then 0 else b.[OTRO DESCUENTO] end as OTRO_DESCUENTO
	  ,case when b.[OTROS DESCUENTOS] is NULL then 0 else b.[OTROS DESCUENTOS] end as OTROS_DESCUENTOS
	  ,case when b.[PRESTAMO BCO. CHILE] is NULL then 0 else b.[PRESTAMO BCO. CHILE] end as PRESTAMO_BANCO_CHILE
	  ,case when b.[PRESTAMO CAJA LOS ANDES] is NULL then 0 else b.[PRESTAMO CAJA LOS ANDES] end as PRESTAMO_CAJA_LOS_ANDES
	  ,case when b.[PRESTAMO EMPRESA (1)] is NULL then 0 else b.[PRESTAMO EMPRESA (1)] end as PRESTAMO_EMPRESA_1 
	  ,case when b.[PRESTAMO EMPRESA (2)] is NULL then 0 else  b.[PRESTAMO EMPRESA (2)] end as PRESTAMO_EMPRESA_2
	  ,case when b.[SALCOBRAND] is NULL then 0 else b.[SALCOBRAND] end as SALCOBRAND
	  ,case when b.[SEGURO COMPLEMENTARIO] is NULL then 0 else b.[SEGURO COMPLEMENTARIO] end as SEGURO_COMPLEMENTARIO
	  ,case when b.[TELEFONO] is NULL then 0 else b.[TELEFONO] end as TELEFONO 
	  ,case when b.[UNIFORMES] is NULL then 0 else b.[UNIFORMES] end as UNIFORMES
	  ,case when b.[VENTA DE BODEGA] is NULL then 0 else b.[VENTA DE BODEGA] end as VENTA_BODEGA
	   FROM [procesadorabd].[dbo].[REMUNERACIONES] a left join VW_DESCUENTOS b 
  	   on b.[Empresa] = a.Empresa and b.[Rut] = a.Rut and a.Mes = b.Mes and a.A�o = b.A�o Where ltrim(rtrim(a.Rut)) = ltrim(rtrim('".$rut."')) AND a.A�o = ".$anio." and  a.[Mes] = ".$mes." ");




  
  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
    $lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
            $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["liq2"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;
    

    	$result=$db->query("SELECT TOP (1) [PEmpr]
      ,[PMes]
      ,[PAno]
      ,[PUTM]
      ,[PUFAct]
      ,[PUFAnt]
      ,[PFacCotiSalud]
      ,[PFacCotiSSS]
      ,[PFacCotiEmpart]
      ,[PFacCotiMutual]
      ,[PFacCotiCCAF]
      ,[PSueMin]
      ,[PTopeGrati]
      ,[PHorasNor]
      ,[PHorasNoc]
      ,[PHorasFes]
      ,[PSueldoGrado1A]
      ,[PFactorCCHCTrabajador]
      ,[PFactorCCHCEmpleador]
      ,[PTopeMaxCCHC]
      ,[PTopeMinCCHC]
      ,[PValUnaCarga]
      ,[PValDosCargas]
      ,[PValTresCargas]
      ,[PValCuatroCargas]
      ,[PValCincoCargas]
      ,[PvalPlanEjecTrabajador]
      ,[PvalPlanEjecEmpleador]
      ,[PPorceLey20255]
      ,[pTopeImponible]
      ,[pTopeImponibleAFC]
  FROM [procesadorabd].[dbo].[ParametrosMensuales] WHERE PAno = ".$anio." AND PMes = ".$mes." " );
  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
    $lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
            $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["params"] =  $registro;
           
  
	}
	else echo $db->ODBCerror;




	$result=$db->query("SELECT [EmplRut]
      ,[EmplExtranjero]
      ,[HabDesAno]
      ,[HabDesMes]
      ,[MovMenCorrel]
      ,[MovMenSdoBaseGanado]
      ,[MovMenSdoImponible]
      ,[MovMenSdoTributable]
      ,[MovMenISADifIsap]
      ,[MovMenOtrosImponibles]
      ,[MovMenOtrosNoImponible]
      ,[MovMenTotHaber]
      ,[MovMenOtroDescuentos]
      ,[MovMenTotDescuentos]
      ,[MovMenTotAnticipos]
      ,[MovMenAlcLiquido]
      ,[MovMenTotPagar]
      ,[MovMenSaldoNeg]
      ,[MovMenGratificacionPagada]
      ,[MovMenAsigColacionPagada]
      ,[MovMenAsigMovilizacionPagada]
      ,[MovMenValorCargaFamiliarPagada]
      ,[MovMenAFPTotalPagada]
      ,[MovMenISATotPagada]
      ,[MovMenTotDosPorPagado]
      ,[MovMenDiasAusenteMonto]
      ,[MovMenDiasLicenciaMonto]
      ,[MovMenTotalNoImponoble]
      ,[MovMenAFPCtaAhorroMontoPagada]
      ,[MovMenTotImponible]
      ,[MovMenAFPCotAdicPagada]
      ,[MovMenRelTotal]
      ,[MovMenRelImponible]
      ,[MovMenRelAFP]
      ,[MovMenRelIsa]
      ,[MovMenRelImpto]
      ,[MovMenRelAnticipo]
      ,[MovMenAFCMonto]
      ,[MovMenRelAFC]
      ,[MovMenAFCAporteEmple]
      ,[MovMenSdoImponibleAFC]
      ,case when [MovMenActual] is NULL then '0' else [MovMenActual] end as MovMenActual
      ,[MovMenRelDifImponible]
      ,[MovMenRelISADifMonto]
      ,case when [MovMenRelAFCAporteEmple] is NULL then '0' else [MovMenRelAFCAporteEmple] end as MovMenRelAFCAporteEmpl
      ,[MovMenLey20255]
      ,[MovMenSdoImponibleSIS]
        FROM [procesadorabd].[dbo].[VW_WEB_LIQUIDACIONES]
  where 
  ltrim(rtrim(EmplRut)) = ltrim(rtrim('".$rut."'))
   and habdesmes=".$mes." and habdesano=".$anio."
  order by habdesano desc ,habdesmes desc
  " );
  //'  71480402'

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES


	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
    $lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
        /*
			while($line=$result->fetch_array()){
            
                $lines_tmp[] = $line;
			}*/
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines["mm"] =  $lines_tmp; 
            $line=$result->fetch_array();
            $registro = array_map('utf8_encode', $line);
            $lines["liq4"] =  $registro;

           
  
	}
	else echo $db->ODBCerror;

    
     //$cambio = valorEnLetras( $lines["liq2"]["SueldoLiquido"] - $lines["liq2"]["Anticipo"]); 
     $cambio = valorEnLetras( $lines["liq4"]["MovMenTotPagar"]); 
     $lines["valor_palabras"] = $cambio;

    echo json_encode($lines, JSON_UNESCAPED_UNICODE);
    
?>