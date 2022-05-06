<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(-1);
require_once "isql2.php";
	$db=new AS400DB("alias1","web","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    $rut = $_GET['rut'];
    //$rut = '121164434';
    $contrato = $_GET['contrato'];
    //$contrato = '24/08/2015';
    $nacimiento = $_GET['nacimiento'];
    //$nacimiento = '22/05/1974';
    $hash = $_GET['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    if(strcmp($hasheado,$hash) != 0 )
    //die();


    $lines = array();
	//FECHA CONTRATACION
    $contrato = explode( '/', $contrato );
    $query= "SELECT *
    FROM [procesadorabd].[dbo].[MovimientoMensual]  
    WHERE ltrim(rtrim(EmplRut)) = ltrim(rtrim('".$rut."')) AND MovMenFechaContrato = convert(date,'".$contrato[2]."/".$contrato[1]."/".$contrato[0]."',0)
    and emprcod='1' and '01/'+cast(habdesmes as varchar(2))+'/'+cast(habdesano as varchar(4)) 
	between dateadd(mm,-3, '01/'+cast(habdesmes as varchar(2))+'/'+cast(habdesano as varchar(4))) and
	getdate()";
                //print_r($query);
    $result=$db->query($query);
	//$result=$db->query("SELECT  COUNT(mm.MovMenFechaContrato) as cont FROM [procesadorabd].[dbo].[MovimientoMensual] as mm WHERE mm.EmplRut = '  ".$rut."' AND MovMenFechaContrato ='".$contrato[2]."-".$contrato[1]."-".$contrato[0]."' " );
    //$result=$db->query("SELECT  COUNT(mm.MovMenFechaContrato) as cont FROM MovimientoMensual as mm WHERE mm.EmplRut = '  59210009' AND MovMenFechaContrato ='2013-03-14' " );

	echo $query;
	echo $result->num_rows;
    $num_results = $result->num_rows;
	if($num_results){
        $lines["fecha_contrato"] =  $num_results;
	}else{
        $lines["fecha_contrato"] =  0;
    }
	//else echo $db->ODBCerror;

    //FECHA NACIMIENTO
    $nacimiento = explode( '/', $nacimiento );

    $query = "SELECT
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

        dbo.Empleados.EmplFechaNac AS Fecha_Nacimiento, 
        
        (SELECT  top 1  PaisDescripcion	
        FROM          Pais
        WHERE      PaisCodigo = dbo.Empleados.emplnacionalidad ) AS Nacionalidad, 
        
        (CASE WHEN dbo.Empleados.EmplEstadoCivil = 0 THEN 'SOLTERO' ELSE 'CASADO' END) AS Estado_Civil, 
        (CASE WHEN dbo.Empleados.EmplSexo = 0 THEN 'MASCULINO' ELSE 'FEMENINO' END) AS Sexo, 

        dbo.Personas.PersDireccion AS Direccion, 
        dbo.Personas.PersNumDire AS Numero_Direccion, 

        (SELECT  top 1  ComuNombre	
        FROM          Comunas
        WHERE      ComuCodigo = dbo.personas.ComuCodigo) AS Comuna, 

        (SELECT  top 1  CiudNombre	
        FROM          Ciudades
        WHERE      CiudCodigo = dbo.personas.CiudCodigo) AS Ciudad, 

        dbo.Personas.PersrFono AS Telefono, 
        ' ' as Celular, 
        dbo.Personas.PersMail AS Correo_Electronico, 
        dbo.MovimientoMensual.MovMenFechaContrato AS Fecha_Ingreso, 
        
        (CASE WHEN dbo.MovimientoMensual.MovMenCodigo = 2 then dbo.MovimientoMensual.MovMenFechaFiniquito else CONVERT(date,'01/01/1900',103) end) AS Fecha_Finiquito,
        (CASE WHEN dbo.MovimientoMensual.MovMenTipContrato = 1 THEN 'INDEFINIDO' ELSE 'PLAZO FIJO' END) AS Tipo_Contrato, 
        dbo.MovimientoMensual.MovMenNCuenta AS Nro_Cuenta_bancaria,
        (CASE WHEN dbo.MovimientoMensual.MovMenFormaPago = 1 THEN 'EFECTIVO' ELSE (CASE WHEN dbo.MovimientoMensual.MovMenFormaPago = 2 THEN 'DEPOSITO' ELSE 'CHEQUE' END) END) AS Forma_Pago,


        (SELECT  top 1  InprNombre	
        FROM          InstPrevisional
        WHERE      EmprCod = dbo.MovimientoMensual.EmprCod
        and InprCodigo = dbo.MovimientoMensual.MovMenAFPCod
        and InprTipo = 1) AS AFP, 


        (SELECT  top 1  InprNombre	
        FROM          InstPrevisional
        WHERE      EmprCod = dbo.MovimientoMensual.EmprCod
        and InprCodigo = dbo.MovimientoMensual.MovMenISACod
        and InprTipo = 2) AS ISAPRE, 

        dbo.MovimientoMensual.MovMenISACotAdicMonto AS PLAN_UF,	

        (SELECT TOP 1   Count(*) as Total	
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Nro_Cargas, 

        (SELECT  top 1 CarFaRut
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Rut_Carga, 

        (SELECT  top 1 CarfaNombre
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Nombre_Carga, 

        (SELECT  top 1 CarFaFechaNac
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Fecha_Nacimiento_carga, 

        (SELECT  top 1 CarFaFechaNac
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Fecha_inicio_Beneficio_carga, 

        (SELECT  top 1 CarFaFechaVenc
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero) AS Fecha_Termino_Beneficio_carga, 

        (SELECT  top 1 (CASE WHEN CarFaTipo = 1 THEN 'SIMPLE' ELSE (CASE WHEN CarFaTipo = 2 THEN 'MATERNAL' ELSE 'INVALIDEZ' END) END) 
        FROM          CargasFamiliares
        WHERE      dbo.CargasFamiliares.EmprCod = dbo.MovimientoMensual.EmprCod AND 
                        dbo.CargasFamiliares.EmplRut = dbo.MovimientoMensual.EmplRut and 
                        dbo.CargasFamiliares.EmplExtranjero = dbo.MovimientoMensual.EmplExtranjero)  AS Tipo_Carga 


    ,(SELECT   TOP 1 EmplNombre  + ' ' + EmplApellidoP + ' ' + EmplApellidoM  AS Nombre
                                FROM          dbo.Empleados
                                WHERE      (Empleados.EmprCod = '1') 
                                
        AND Empleados.EmplRutF = (SELECT TOP 1 LLAVE6 
        FROM SubTablaGeneral 
        WHERE SubTablaGeneral.DoctAno = MovimientoMensual.HabDesAno 
        AND SubTablaGeneral.DoctMes = MovimientoMensual.HabDesMes 
        AND SubTablaGeneral.EmprCod = MovimientoMensual.EmprCod 
        AND SubTablaGeneral.llave4 = MovimientoMensual.EmplRut 
        AND SubTablaGeneral.Codigo = 'REPONEDOR' )) AS NOMBRE_SUPERVISOR


        
        ,	(SELECT TOP 1     ZgNombre AS Nombre
        FROM          dbo.Zonas
        WHERE      (dbo.Zonas.EmprCod = dbo.MovimientoMensual.EmprCod) AND (dbo.Zonas.ZgCodigo = dbo.MovimientoMensual.MovMenSubZona)) AS DEPARTAMENTO
                            
    , dbo.Empleados.EmplCodigo as Codigo_empleado	
    ,dbo.MovimientoMensual.MovMenAsigMovilizacion  AS MOVILIZACION

    ,(SELECT     TOP (1) VataValor
    FROM          dbo.ValoresAtributoAdicional WITH (NOLOCK)
    WHERE      (ValoresAtributoAdicional.EmprCod = dbo.Empleados.EmprCod) 
    AND (AtadCodigo = 'FECHA_TERMINO_CONTRATO_PLAZO_FIJO') 
    AND (CataNomTabla = 'Empleados') 
    AND (ValorCataLlave1 = dbo.Empleados.EmplCodigo)) AS FECHA_TERMINO_CONTRATO

    ,dbo.Empleados.EmplNivelEducacional as NIVEL_EDUCACIONAL                       

    ,(select TOP 1 ContDuracion from contratos where emprcod = MovimientoMensual.EmprCod 
    and contratos.EmplRut = MovimientoMensual.EmplRut 
    and contratos.EmplExtranjero = MovimientoMensual.EmplExtranjero 
    ORDER BY ContAno desc) as DURACION

    FROM         dbo.MovimientoMensual LEFT OUTER JOIN
                        dbo.Personas  ON dbo.Personas.PersRut = dbo.MovimientoMensual.EmplRut AND 
                        dbo.Personas.PersExtranjero = dbo.MovimientoMensual.EmplExtranjero INNER JOIN
                        dbo.Empleados ON dbo.MovimientoMensual.EmprCod = dbo.Empleados.EmprCod 
                AND dbo.MovimientoMensual.EmplRut = dbo.Empleados.EmplRutF  
                AND dbo.MovimientoMensual.EmplExtranjero = dbo.Empleados.EmplExtranjero 
                AND ltrim(rtrim(dbo.MovimientoMensual.EmplRut))= ltrim(rtrim('".$rut."')) OR ltrim(rtrim(dbo.MovimientoMensual.EmplRut)) = ltrim(rtrim('".$rut."')) and dbo.MovimientoMensual.EmprCod='1'
                AND dbo.Empleados.EmplFechaNac = convert(date,'".$nacimiento[2]."/".$nacimiento[1]."/".$nacimiento[0]."',0) ";


    /*
and dbo.MovimientoMensual.HabDesMes=".date("m").") OR (dbo.MovimientoMensual.HabDesAno=".date("Y",strtotime("-1 month"))." 
                and dbo.MovimientoMensual.HabDesMes=".date("m",strtotime("-1 month")).") OR (dbo.MovimientoMensual.HabDesAno=".date("Y",strtotime("-2 month"))." 
                and dbo.MovimientoMensual.HabDesMes=".date("m",strtotime("-2 month")).")  )
            AND dbo.Empleados.EmplFechaNac = convert(date,'".$nacimiento[2]."/".$nacimiento[1]."/".$nacimiento[0]."',0) 

    */
	//$result=$db->query("SELECT  COUNT(ap.Fecha_Nacimiento) as nac FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] as ap WHERE ap.Rut = '  ".$rut."' AND ap.Fecha_Nacimiento = '".$nacimiento[2]."-".$nacimiento[1]."-".$nacimiento[0]."'" );
    //$result=$db->query("SELECT  COUNT(ap.Fecha_Nacimiento) as nac FROM ANTECEDENTES_PERSONALES as ap WHERE ap.Rut = '  59210009' AND ap.Fecha_Nacimiento = '1950-05-03'" );
    $result=$db->query($query );
    $num_results = $result->num_rows;
    if($num_results){
        //$lines["fecha_nacimiento"] =  $result->fetch_array()['nac'];
        $lines["fecha_nacimiento"] =  $num_results;
        $result=$db->query("SELECT  ap.Nombre , ap.Apellido_P,ap.Apellido_M FROM [procesadorabd].[dbo].[ANTECEDENTES_PERSONALES] as ap WHERE ltrim(rtrim(ap.Rut)) = ltrim(rtrim('".$rut."'))  AND ap.Fecha_Nacimiento = '".$nacimiento[2]."-".$nacimiento[1]."-".$nacimiento[0]."'" );
        $resultado =$result->fetch_array();
        $registro = array_map('utf8_encode', $resultado);
        $lines["nombre"] =  $registro['Nombre'];
        $lines["apellido_p"] =  $registro['Apellido_P'];
        $lines["apellido_m"] =  $registro['Apellido_M'];
	}else{
        $lines["fecha_nacimiento"] =  0;
    }

    
	//else echo $db->ODBCerror;
     

    echo json_encode($lines, JSON_UNESCAPED_UNICODE);
    
?>