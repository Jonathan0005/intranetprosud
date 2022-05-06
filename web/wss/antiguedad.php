<?php
error_reporting(0);
require_once "isql.php";
	$db=new AS400DB("alias1","web","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    $rut = $_POST['rut'];
    //$rut = '71480402';
    $hash = $_POST['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    if(strcmp($hasheado,$hash) != 0 )
    die();
    //print_r($hasheado);

$lines = array();


	$result=$db->query("SELECT TOP (1) [Empresa]
      
      ,[Mes]
      ,[Rut]
      ,[Apellido_P]
      ,[Apellido_M]
      ,[Nombre]
      ,[Cargo]
      ,[CentroCosto]
      ,[Fecha_Nacimiento]
      ,[Nacionalidad]
      ,[Estado_Civil]
      ,[Sexo]
      ,[Direccion]
      ,[Numero_Direccion]
      ,[Comuna]
      ,[Ciudad]
      ,[Telefono]
      ,[Celular]
      ,[Correo_Electronico]
      ,[Fecha_Ingreso]
      ,[Fecha_Finiquito]
      ,[Tipo_Contrato]
      ,[Nro_Cuenta_bancaria]
      ,[Forma_Pago]
      ,[AFP]
      ,[ISAPRE]
      ,[PLAN_UF]
      ,[Nro_Cargas]
      ,[Rut_Carga]
      ,[Nombre_Carga]
      ,[Fecha_Nacimiento_carga]
      ,[Fecha_inicio_Beneficio_carga]
      ,[Fecha_Termino_Beneficio_carga]
      ,[Tipo_Carga]    
      ,[DEPARTAMENTO]
      ,[Codigo_empleado]
      ,[MOVILIZACION]
      ,[FECHA_TERMINO_CONTRATO]
      ,[NIVEL_EDUCACIONAL]
      ,[DURACION]
  FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] WHERE Tipo_contrato = 'INDEFINIDO' AND ltrim(rtrim(Rut)) = ltrim(rtrim('".$rut."')) OR ltrim(rtrim(Rut)) =  ltrim(rtrim('".$rut."')) ORDER BY Fecha_Ingreso ASC" );

	
	
	
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
               ///$lines[] = $line;

          $registro = array_map('utf8_encode', $line);
			   $lines["indefinido"] =  $registro;
				//print_r($line);
                //print("<BR>");
                //print("<BR>");
			}
       // echo json_encode($lines);
	}


//nombre del usuario
$result=$db->query("SELECT TOP (1) [MovimientoMensual].[EmprCod]
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
	  ,[CarNombre]
  FROM [procesadorabd].[dbo].[MovimientoMensual] INNER JOIN [procesadorabd].[dbo].[Cargos] ON MovimientoMensual.MovMenCargoDesem=Cargos.CarCod WHERE ltrim(rtrim(EmplRut)) =  ltrim(rtrim('".$rut."')) OR ltrim(rtrim(EmplRut)) =  ltrim(rtrim('".$rut."')) ORDER BY HabDesAno DESC, HabDesMes DESC  " );

	
	
	
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
               ///$lines[] = $line;

         $registro = array_map('utf8_encode', $line);
			   $lines["persona"] =  $registro;
				//print_r($line);
                //print("<BR>");
                //print("<BR>");
			}
        echo json_encode($lines, JSON_UNESCAPED_UNICODE);
	}
	else echo $db->ODBCerror;


?>