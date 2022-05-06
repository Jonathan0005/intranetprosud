<?php

header('Content-Type: text/html; charset=utf-8');
require_once "isql.php";
	$db=new AS400DB("alias1","web.desarrollo","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    //$rut = $_POST['rut'];
    $rut = '57118083';
    //$contrato = $_POST['contrato'];
    $contrato = '07/01/2005';
    //$nacimiento = $_POST['nacimiento'];
    $nacimiento = '13/07/1953';
    //$hash = $_POST['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    //if(strcmp($hasheado,$hash) != 0 )
    //die();


    $lines = array();
	//FECHheader('Content-Type: text/html; charset=utf-8');A CONTRATACION
    /*
    $contrato = explode( '/', $contrato );
	$result=$db->query("SELECT  COUNT(mm.MovMenFechaContrato) as cont FROM [procesadorabd].[dbo].[MovimientoMensual] as mm WHERE mm.EmplRut = '  ".$rut."' AND MovMenFechaContrato ='".$contrato[2]."-".$contrato[1]."-".$contrato[0]."' " );
    //$result=$db->query("SELECT  COUNT(mm.MovMenFechaContrato) as cont FROM MovimientoMensual as mm WHERE mm.EmplRut = '  59210009' AND MovMenFechaContrato ='2013-03-14' " );

	if($result->num_rows){
        $lines["fecha_contrato"] =  $result->fetch_array()['cont'];
	}else{
        $lines["fecha_contrato"] =  0;
    }
	//else echo $db->ODBCerror;

    //FECHA NACIMIENTO
    $nacimiento = explode( '/', $nacimiento );
	$result=$db->query("SELECT  COUNT(ap.Fecha_Nacimiento) as nac FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] as ap WHERE ap.Rut = '  ".$rut."' AND ap.Fecha_Nacimiento = '".$nacimiento[2]."-".$nacimiento[1]."-".$nacimiento[0]."'" );
    //$result=$db->query("SELECT  COUNT(ap.Fecha_Nacimiento) as nac FROM ANTECEDENTES_PERSONALES as ap WHERE ap.Rut = '  59210009' AND ap.Fecha_Nacimiento = '1950-05-03'" );

    */

    /* SELECT *
FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] as ap 
WHERE ap.Rut= ' 121164434'  and Empresa='1' and Año=2017 and mes=7
AND ap.Fecha_Nacimiento = convert(date,'1974/05/22',0) */

    //if($result->num_rows){
        //$lines["fecha_nacimiento"] =  $result->fetch_array()['nac'];
        //$result=$db->query("SELECT @@VERSION AS 'SQL Server Version';  " );
        /*$query = "SELECT count(*) as cont
        FROM [dbo].[ANTECEDENTES_PERSONALES] as ap 
        WHERE ap.Rut= ' 121164434'  and ap.[Empresa]='1'  and ap.[mes]=5
        AND ap.Fecha_Nacimiento = convert(date,'1974/05/22',0)";*/
        

/*
        $query = "
SELECT TOP (1) [EmprCod]
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
      ,[MovMenDepositoConvenido]
      ,[MovMenZonaExtrema]
      ,[MovMenPorZonaExtrema]
      ,[MovMenAfiliadoCCHC]
      ,[MovMenTipoPlanCCHC]
      ,[MovMenNoProporcional]
      ,[MovMenActual]
      ,[MovMenFechaIRetro]
      ,[MovMenFechaTRetro]
      ,[MovMenLey20255]
      ,[MovMenTrabLey20255]
      ,[MovMenISACotAdicMonto_2]
      ,[MovMenSubZona]
      ,[MovMenHXDom]
      ,[MovMenHXDomMonto]
  FROM [web.desarrollo].[dbo].[MovimientoMensual] Where EmplRut = ' 121164434' OR EmplRut = ' 121164434' AND [HabDesAno] = 2017 AND [HabDesMes] = 3
     

  

";

*/


        $query = "
SELECT [EmplRut]
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
      ,[MovMenActual]
      ,[MovMenRelDifImponible]
      ,[MovMenRelISADifMonto]
      ,[MovMenRelAFCAporteEmple]
      ,[MovMenLey20255]
      ,[MovMenSdoImponibleSIS]
  FROM [web.desarrollo].[dbo].[VW_WEB_LIQUIDACIONES]
  where EmplRut = ' 121164434' and habdesmes=3 and habdesano=2017
  order by habdesano desc ,habdesmes desc " ;



/*

SELECT TOP (1) [PEmpr]
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
  FROM [web.desarrollo].[dbo].[ParametrosMensuales] WHERE PAno = ".$anio." AND PMes = ".$mes."   
*/
/*
 SELECT 
 [DiasTomados]
       ,[FechaInicio]
      ,[FechaTermino] 
    
     
  FROM [web.desarrollo].[dbo].[DETALLE_VACACIONES]
  WHERE  Rut = ' 121164434' 
*/

//date("Y",strtotime("-2 month"))
        //print $query;
        $result=$db->query( $query);


		$lines = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
             
				//print_r($line);
                //print("<BR>");
                //print("<BR>");
                //$ultimo_registro = $line;
				$lines[]  = $line;
			}
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           //$lines[] = $ultimo_registro;
        echo json_encode($lines);
	}else if($result->num_rows == 0){
		 array_push($lines,array("TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0") );
         echo json_encode($lines);
	}
	else {echo $db->ODBCerror;}



	die();
        echo  $db->ODBCerror;
        print_r($result->num_rows);
        
        die();
        $resultado =$result->fetch_array();
        print_r($resultado);
        $lines[] =  $resultado;


         /*$query = "SELECT *
        FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] as ap 
        WHERE ap.Rut= ' 121164434'  and ap.[Empresa]='1' and ap.[Año]=2017 and ap.[mes]=7
        AND ap.Fecha_Nacimiento = convert(date,'1974/05/22',0)";
        print $query;
        $result=$db->query( $query);
        $resultado =$result->fetch_array();
        print_r($resultado);
        $lines[] =  $resultado;*/
        
        //$lines["apellido_p"] =  $resultado['Apellido_P'];
        //$lines["apellido_m"] =  $resultado['Apellido_M'];
	//}else{
      //  $lines["fecha_nacimiento"] =  0;
    //}

    
	//else echo $db->ODBCerror;
    
     

    echo json_encode($lines);
    
?>