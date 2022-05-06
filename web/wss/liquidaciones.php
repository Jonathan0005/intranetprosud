<?php
error_reporting(0);
require_once "isql.php";
	$db=new AS400DB("alias1","web","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    $rut = $_POST['rut'];
    //$rut = '85119168';
    $hash = $_POST['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    if(strcmp($hasheado,$hash) != 0 )
    die();
    //print_r($hasheado);


	//$result=$db->query('SELECT @@VERSION');

    

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
	/*
    $result=$db->query("SELECT TOP (1000) [Empresa]
      ,[Mes]
      ,[Rut]
      ,[Apellido_P]
      ,[Apellido_M]
      ,[Nombre]
      ,[Cargo]
      ,[CentroCosto]
      ,[Sueldo_Base]
      ,[Sueldo_Base_Ganado]
      ,[Dias_Trabajados]
      ,[Dias_NO_Trabajados]
      ,[Dias_Licencia]
      ,[Dias_Ausentes]
      ,[Gratificacion]
      ,[Aguinaldo_Fiestas_Patrias]
      ,[Aguinaldo_Navidad]
      ,[Horas_Extras_Monto]
      ,[Cant_horas_extras]
      ,[Minutos_horas_extras]
      ,[BONOS]
      ,[Comisiones]
      ,[Promociones]
      ,[Produccion_equivalente]
      ,[Movilizacion2]
      ,[Movilizacion]
      ,[Colacion]
      ,[Bono_Movilizacion]
      ,[Bono_Colacion]
      ,[Sala_Cuna]
      ,[AFC_Trabajador]
      ,[AFC_Empleador]
      ,[APORTE_PATRONAL]
      ,[Sueldo_Diario]
      ,[Semana_Corrida]
      ,[Monto_SIS]
      ,[TipoContrato]
      ,[BANCO]
      ,[SueldoLiquido]
      ,[DEPARTAMENTO]
      ,[Anticipo]
      ,[Monto_Isapre]
      ,[Sueldo_Imponible]
      ,[Monto_AFP]
      ,[SueldoTributable]
      ,[CargaFamiliar]
      ,[BONO_MATRICULA]
      ,[BONO_METAS]
      ,[BONO_RESPONSABILIDAD]
      ,[BONO_ADICIONAL]
      ,[BONO_INVENTARIO]
      ,[BONO_PRODUCCION]
      ,[MOVILIZACION_EXTRAORDINARIA]
      ,[BONO_REEMPLAZO]
      ,[TOTAL_HABERES]
  FROM [procesadorabd].[dbo].[REMUNERACIONES] Where Rut = '  59210009' " );
*/
/*
$result=$db->query("SELECT TOP (1000) [EmprCod]
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
  FROM [procesadorabd].[dbo].[MovimientoMensual] Where EmplRut = '  59210009' " );
  */


/*
//nombre del usuario
$result=$db->query("SELECT TOP (1) 
      [PersNombre]
      ,[PersPaterno]
     
  FROM [procesadorabd].[dbo].[Personas] where PersRut = '  ".$rut."' " );

	//REMUNERACIONES PARA LIQUIDACION DE SUELDO?????
	
	$lines = array();
    
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
			   $lines["persona"] =  $line;
			}
       // echo json_encode($lines);
	}
	else echo $db->ODBCerror;
    */

//Listado Mes y anio
/*
$result=$db->query("SELECT TOP (1000) 
      [HabDesAno]
      ,[HabDesMes]    
  FROM [procesadorabd].[dbo].[MovimientoMensual] Where EmplRut = ' ".$rut."' OR EmplRut = '  ".$rut."' AND ((HabDesAno >= ".date("Y",strtotime("-1 year"))." AND HabDesMes >= ".date("m" ) .") OR HabDesAno = ".date("Y").")"  );
*/

$result=$db->query("
SELECT TOP 12 [EmplRut]
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
  FROM [procesadorabd].[dbo].[VW_WEB_LIQUIDACIONES]
  where ltrim(rtrim(EmplRut)) = '".$rut."' OR ltrim(rtrim(EmplRut)) = '".$rut."'
  order by habdesano desc ,habdesmes desc 

"  );


/*

SELECT TOP 12 [EmplRut]
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
  FROM [procesadorabd].[dbo].[VW_WEB_LIQUIDACIONES]
  where EmplRut = ' 121164434'
  order by habdesano desc ,habdesmes desc 

*/
	//REMUNERACIONES PARA LIQUIDACION DE SUELDO?????
	
	$lines_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
                $lines_tmp[] = $line;

			}
			$lines["liquidaciones"] =  $lines_tmp;
        echo json_encode($lines);
		//$lines["resumen"] =  $ultimo_registro;
	}else if($result->num_rows == 0){
		 //array_push($lines_tmp,array("HabDesAno"=>"0","HabDesMes"=>"0") );
         //$lines["liquidaciones"] =  $lines_tmp;
         $lines["liquidaciones"] =  array();
        echo json_encode($lines);
	}
	else {echo $db->ODBCerror;}
	
?>