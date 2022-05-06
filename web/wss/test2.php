<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
require_once "isql.php";
	$db=new AS400DB("alias1","web.desarrollo","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    //$rut = $_POST['rut'];
    $rut = '57118083';
    $rut = '77363343';
    
    //$contrato = $_POST['contrato'];
    $contrato = '07/01/2005';
    //$nacimiento = $_POST['nacimiento'];
    $nacimiento = '13/07/1953';
    //$hash = $_POST['hash'];

    $hasheado = hash('sha256',$rut.$secret);

    $lines = array();
	


    
    $secret = 'cOnUDxw9zTpcFxWa';
   // $rut = $_POST['rut'];

    $mes = 5;
	$anio = 2017;

   

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
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

/*
	$result=$db->query("SELECT 
       
      
      [DetVaAno]
      ,[DetVarFechaIni]
      ,[DetVaFechaFin]
      ,[DetVaTotalDias]
     
  FROM [procesadorabd].[dbo].[DetVacaciones] WHERE EmplRut = '  ".$rut."' ORDER BY DetVaAno DESC " );

  	//if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
		//$ultimo_DetVaAno=$result->fetch_array();
		//$ultimo_DetVaAno = $ultimo_DetVaAno['DetVaAno'];
		
		if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
                $ultimo_DetVaAno = $line;
				
				$ultimo_DetVaAno = $ultimo_DetVaAno['DetVaAno'];
				//echo $ultimo_DetVaAno;
				break;
			}
		// echo json_encode($lines);
		//$lines["detalle"] =  $detalle_tmp;
		}
		else echo $db->ODBCerror;
		*/
			
       
	//}
	//else echo $db->ODBCerror;

	//print_r($ultimo_DetVaAno);

	if(isset($desde) && isset($hasta)){//rango custom

		$result=$db->query("SELECT TOP (1000) 
		
		[DetVaAno]
		,[DetVarFechaIni]
		,[DetVaFechaFin]
		,[DetVaTotalDias]
		,CAST([DetVaObs] as TEXT) as DetVaObs
		,[DetVaDiasHabiles]
		,[DetVaDiasNOHabiles]
		,[DetVaDiasProgresivos]
	FROM [web.desarrollo].[dbo].[DetVacaciones] WHERE ( EmplRut = '  ".$rut."' OR EmplRut = ' ".$rut."' ) AND [DetVaFechaFin] <= TRY_PARSE('".$hasta."' AS DATETIME USING 'en-gb') AND [DetVarFechaIni] >= TRY_PARSE('".$desde."' AS DATETIME USING 'en-gb') AND [EmplCodigo] != 0 " );

	}else{//12 meses

		
		/*
        $result=$db->query("SELECT TOP (1000) 
		
		[DetVaAno]
		,[DetVarFechaIni]
		,[DetVaFechaFin]
		,[DetVaTotalDias]
		,CAST([DetVaObs] as TEXT) as DetVaObs
		,[DetVaDiasHabiles]
		,[DetVaDiasNOHabiles]
		,[DetVaDiasProgresivos]
	FROM [web.desarrollo].[dbo].[DetVacaciones] WHERE EmplRut = '  ".$rut."' OR EmplRut = ' ".$rut."' AND DATEDIFF(year,[DetVaFechaFin], GETDATE()) <= 0 AND [EmplCodigo] != 0 " );
	*/

	 $result=$db->query("SELECT TOP (1000) 
		
		[DetVaAno]
		,[DetVarFechaIni]
		,[DetVaFechaFin]
		,[DetVaTotalDias]
		,CAST([DetVaObs] as TEXT) as DetVaObs
		,[DetVaDiasHabiles]
		,[DetVaDiasNOHabiles]
		,[DetVaDiasProgresivos]
	FROM [web.desarrollo].[dbo].[DetVacaciones] WHERE ( EmplRut = '  ".$rut."' OR EmplRut = ' ".$rut."' ) AND [DetVaAno] = ".date("Y")." AND [EmplCodigo] != 0 " );
    
    /*
    $result=$db->query("SELECT TOP (1000) 
		
		[DetVaAno]
		,[DetVarFechaIni]
		,[DetVaFechaFin]
		,[DetVaTotalDias]
		,CAST([DetVaObs] as TEXT) as DetVaObs
		,[DetVaDiasHabiles]
		,[DetVaDiasNOHabiles]
		,[DetVaDiasProgresivos]
	FROM [web.desarrollo].[dbo].[DetVacaciones] WHERE  EmplRut = '  ".$rut."' OR EmplRut = ' ".$rut."' 
    
    AND 
     DATEDIFF(year,[DetVaFechaFin], GETDATE()) = 0

     AND [Empresa] = '1' " ); */
	
/*
	$result=$db->query("SELECT     TOP 1000
       dbo.MovimientoMensual.EmprCod AS Empresa, 
	   
	   dbo.DetVacaciones.DetVaObs AS DetVaObs, 
       dbo.MovimientoMensual.HabDesAno AS Anio, 
       dbo.MovimientoMensual.HabDesMes AS Mes, 
       dbo.MovimientoMensual.EmplRut AS Rut, 
       dbo.Empleados.EmplApellidoP AS Apellido_P, 
       dbo.Empleados.EmplApellidoM AS Apellido_M, 
       dbo.Empleados.EmplNombre AS Nombre, 
       
       dbo.DetVacaciones.DetVarFechaIni AS DetVarFechaIni, 
       
       dbo.DetVacaciones.DetVaFechaFin AS DetVaFechaFin,
       
       case when (dbo.DetVacaciones.DetVarFechaIni = CONVERT(datetime,'03/12/2012',103)) 
       THEN  0 
       else (case when (dbo.DetVacaciones.DetVaOrigen = 2) then dbo.DetVacaciones.DetVaDiasHabiles else 0 end  ) end 
       as DiasTomados,  
       
       case when (dbo.DetVacaciones.DetVaOrigen = 2) 
       THEN  0 
       else dbo.DetVacaciones.DetVaTotalDias end 
       as TotalDiasAcu,
       
       dbo.DetVacaciones.detvadias2012 as DiasPeriodo2012,
       
       ((CASE WHEN (year(dbo.MovimientoMensual.MovMenFechaContrato) = dbo.MovimientoMensual.HabDesAno) 
       THEN dbo.movimientoMensual.HabDesMes - month(dbo.MovimientoMensual.MovMenFechaContrato)
       ELSE dbo.movimientoMensual.HabDesMes END) * 1.25)
       AS DiasPresenteAnio,
       
       
       
       
       case when  dbo.DetVacaciones.DetVaDiasProgresivos is NULL then 0 else dbo.DetVacaciones.DetVaDiasProgresivos end   as DiasProgresivos,
       ((dbo.DetVacaciones.DetVaTotalDias + dbo.movimientoMensual.MovMenFeLeProgresivo + (dbo.movimientoMensual.HabDesMes * 1.25))- ( datediff(\"DAY\", dbo.DetVacaciones.DetVarFechaIni,DBO.DetVacaciones.DetVaFechaFin )) )as DetVaTotalDias, 

       (SELECT  top 1  CarNombre  
       FROM          Cargos
       WHERE      EmprCod = dbo.movimientoMensual.EmprCod 
       AND CarCod = dbo.MovimientoMensual.MovMenCargoDesem) AS Cargo, 

       (SELECT  top 1  CodRDescrip       
       FROM          CodResult
       WHERE      EmprCod = dbo.movimientoMensual.EmprCod 
       AND CodRCodigo = dbo.MovimientoMensual.CodResultado
       AND CodRAno = dbo.MovimientoMensual.HabDesAno) AS CentroCosto 



,(SELECT  top 1 EmplNombre  + ' ' + EmplApellidoP + ' ' + EmplApellidoM  AS Nombre
                            FROM          dbo.Empleados
                            WHERE      (Empleados.EmprCod = '1') 
                            
    AND Empleados.EmplRutF = (SELECT TOP 1 LLAVE6 
       FROM SubTablaGeneral 
       WHERE SubTablaGeneral.DoctAno = MovimientoMensual.HabDesAno 
       AND SubTablaGeneral.DoctMes = MovimientoMensual.HabDesMes 
       AND SubTablaGeneral.EmprCod = MovimientoMensual.EmprCod 
       AND SubTablaGeneral.llave4 = MovimientoMensual.EmplRut 
       AND SubTablaGeneral.Codigo = 'REPONEDOR' )) AS NOMBRE_SUPERVISOR

,      (SELECT     ZgNombre AS Nombre
    FROM          dbo.Zonas
    WHERE      (dbo.Zonas.EmprCod = dbo.MovimientoMensual.EmprCod) AND (dbo.Zonas.ZgCodigo = dbo.MovimientoMensual.MovMenSubZona)) AS DEPARTAMENTO

,dbo.MovimientoMensual.MovMenFechaContrato  AS FechaContrato
,(SELECT  top 1  ComuNombre       
       FROM          Comunas
       WHERE      ComuCodigo = dbo.personas.ComuCodigo) AS Comuna, 

(CASE WHEN dbo.MovimientoMensual.MovMenCodigo = 2 then dbo.MovimientoMensual.MovMenFechaFiniquito else CONVERT(date,'01/01/1900',103) end) AS Fecha_Finiquito 

, case when (dbo.DetVacaciones.DetVarFechaIni = CONVERT(datetime,'03/12/2012',103)) 
       THEN  0 
       else DetVacaciones.DetVaDiasHabiles end 
as DiasHabiles
,DetVacaciones.DetVaDiasNOHabiles as Dias_NO_Habiles

FROM         dbo.MovimientoMensual 
LEFT OUTER JOIN dbo.Personas  
ON dbo.Personas.PersRut = dbo.MovimientoMensual.EmplRut 
AND dbo.Personas.PersExtranjero = dbo.MovimientoMensual.EmplExtranjero 
INNER JOIN dbo.Empleados 
ON dbo.MovimientoMensual.EmprCod = dbo.Empleados.EmprCod 
AND dbo.MovimientoMensual.EmplRut = dbo.Empleados.EmplRutF  
AND dbo.MovimientoMensual.EmplExtranjero = dbo.Empleados.EmplExtranjero  
LEFT OUTER JOIN dbo.DetVacaciones 
ON dbo.MovimientoMensual.EmprCod = dbo.DetVacaciones.EmprCod 
AND dbo.MovimientoMensual.EmplRut = dbo.DetVacaciones.EmplRut  
AND dbo.MovimientoMensual.EmplExtranjero = dbo.DetVacaciones.EmplExtranjero 
AND dbo.MovimientoMensual.HabDesAno = dbo.DetVacaciones.DetVaAno 
  WHERE  dbo.MovimientoMensual.EmplRut = '  ".$rut."' OR  dbo.MovimientoMensual.EmplRut = ' ".$rut."' and dbo.MovimientoMensual.EmprCod='1'
	
	and ((dbo.MovimientoMensual.HabDesAno=".date("Y")." 
                and dbo.MovimientoMensual.HabDesMes=".date("m").") OR (dbo.MovimientoMensual.HabDesAno=".date("Y",strtotime("-1 month"))." 
                and dbo.MovimientoMensual.HabDesMes=".date("m",strtotime("-1 month")).") OR (dbo.MovimientoMensual.HabDesAno=".date("Y",strtotime("-2 month"))." 
                and dbo.MovimientoMensual.HabDesMes=".date("m",strtotime("-2 month")).")  )

	 
       
 " );
*/

	}

    

//,CAST([DetVaObs] as TEXT) as DetVaObs
//      ,'VACACIONES PROPORCIONALES' as DetVaObs	
	
	$lines = array();
	$detalle_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
                $detalle_tmp[] = $line;
			}
       // echo json_encode($lines);
	   
	}else if($result->num_rows == 0){
		if(isset($desde) && isset($hasta)){//rango custom
		 array_push($detalle_tmp,array("DetVaAno"=>"2015","DetVarFechaIni"=>"","DetVaFechaFin"=>"","DetVaTotalDias"=>"0","DetVaObs"=>"No has tomado vacaciones en el rango seleccionado") );
		 }else{//12 meses
		 array_push($detalle_tmp,array("DetVaAno"=>"2015","DetVarFechaIni"=>"","DetVaFechaFin"=>"","DetVaTotalDias"=>"0","DetVaObs"=>"No has tomado vacaciones en el &uacute;ltimo a&ntilde;o") );
		 }
	}
	else {echo $db->ODBCerror;}

	$lines["detalle"] =  $detalle_tmp;
	//ESTO ES PARA EL CUADRO

	/*$result=$db->query("SELECT TOP (1000)
       
      [Mes]
      ,[Apellido_P]
      ,[Apellido_M]
      ,[Nombre]
      ,[TotalDiasTomados]
      ,[DiasProgresivos]
      ,[TotalDiasVacaciones]
      ,[Cargo]
      ,[FechaContrato]
      ,[TotalDiasHabiles]
      ,[TotalDias_NO_Habiles]
      ,[DiasRestantes]
      ,[DiasAcumulados]
      
  FROM [web.desarrollo].[dbo].[DETALLE_VACACIONES_RESUMEN_WEB] WHERE   Rut = '  ".$rut."' OR  Rut = ' ".$rut."' 
  and Empresa='1' and ((Anio=".date("Y")." 
                and Mes=".date("m").") OR (Anio=".date("Y",strtotime("-1 month"))." 
                and Mes=".date("m",strtotime("-1 month")).") OR (Anio=".date("Y",strtotime("-2 month"))." 
                and Mes=".date("m",strtotime("-2 month")).")  )
				" ); */

	$result=$db->query("SELECT TOP (1000)
       
      [Mes]
      ,[Apellido_P]
      ,[Apellido_M]
      ,[Nombre]
      ,[TotalDiasTomados]
      ,[DiasProgresivos]
      ,[TotalDiasVacaciones]
      ,[Cargo]
      ,[FechaContrato]
      ,[TotalDiasHabiles]
      ,[TotalDias_NO_Habiles]
      ,[DiasRestantes]
      ,[DiasAcumulados]
      
  FROM [web.desarrollo].[dbo].[DETALLE_VACACIONES_RESUMEN_WEB] WHERE  ( Rut = '  ".$rut."' OR  Rut = ' ".$rut."' )  
  and Empresa='1' and ((Anio=".date("Y")." 
                and Mes=".date("m").") OR (Anio=".date("Y",strtotime("-1 month"))." 
                and Mes=".date("m",strtotime("-1 month")).") OR (Anio=".date("Y",strtotime("-2 month"))." 
                and Mes=".date("m",strtotime("-2 month")).") OR (Anio=".date("Y",strtotime("-3 month"))." 
                and Mes=".date("m",strtotime("-3 month")).")  )
				" );

/*
SELECT 
    top 1  DiasAcumulados+DiasPresenteAño+DiasProgresivos as Total
  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN] WHERE  Rut = ' 146042805' and año=2017 and Mes=7 and empresa='1'
  order by  DiasAcumulados+DiasPresenteAño+DiasProgresivos Des

*/

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES




	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
	$detalle_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
            
                $ultimo_registro = $line;
			}
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
           $lines["resumen"] =  $ultimo_registro;
        //echo json_encode($lines);
	}else if($result->num_rows == 0){
		 //array_push($detalle_tmp,array("Mes"=>"0","TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasVacaciones"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0") );
		 $lines["resumen"] =  array("Mes"=>"0","TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasVacaciones"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0");
		 //echo json_encode($lines);
	}
	else {echo $db->ODBCerror;}



















$result=$db->query("
SELECT 
    top 1  DiasAcumulados+DiasPresenteAnio+DiasProgresivos as Total
  
  FROM [web.desarrollo].[dbo].[DETALLE_VACACIONES_RESUMEN_WEB] WHERE   ( Rut = '  ".$rut."' OR  Rut = ' ".$rut."' )
  and Empresa='1' and ((Anio=".date("Y")." 
                and Mes=".date("m").") OR (Anio=".date("Y",strtotime("-1 month"))." 
                and Mes=".date("m",strtotime("-1 month")).") OR (Anio=".date("Y",strtotime("-2 month"))." 
                and Mes=".date("m",strtotime("-2 month")).")  )
                order by  DiasAcumulados+DiasPresenteAnio+DiasProgresivos Desc
				" );

/*
SELECT 
    top 1  DiasAcumulados+DiasPresenteAño+DiasProgresivos as Total
  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN] WHERE  Rut = ' 146042805' and año=2017 and Mes=7 and empresa='1'
  order by  DiasAcumulados+DiasPresenteAño+DiasProgresivos Des

*/

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES




	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
	$detalle_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
            
                $ultimo_registro = $line;
			}
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
        $lines["resumen_total_dias"] =  $ultimo_registro;
        //echo json_encode($lines);
	}else if($result->num_rows == 0){
		 //array_push($detalle_tmp,array("Mes"=>"0","TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasVacaciones"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0") );
		 $lines["resumen_total_dias"] =  array("Total"=>"0");
		 //echo json_encode($lines);
	}
	else {echo $db->ODBCerror;}








    	$result=$db->query("
        SELECT 
   top 1  TotalDiasTomados

  FROM [web.desarrollo].[dbo].[DETALLE_VACACIONES_RESUMEN_WEB] WHERE  ( Rut = '  ".$rut."' OR  Rut = ' ".$rut."' )
  and Empresa='1' and ((Anio=".date("Y")." 
                and Mes=".date("m").") OR (Anio=".date("Y",strtotime("-1 month"))." 
                and Mes=".date("m",strtotime("-1 month")).") OR (Anio=".date("Y",strtotime("-2 month"))." 
                and Mes=".date("m",strtotime("-2 month")).")  )
                order by  TotalDiasTomados Desc
				" );

/*
SELECT 
    top 1  DiasAcumulados+DiasPresenteAño+DiasProgresivos as Total
  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN] WHERE  Rut = ' 146042805' and año=2017 and Mes=7 and empresa='1'
  order by  DiasAcumulados+DiasPresenteAño+DiasProgresivos Des

*/

//TODO ESTO DEL ULTIMO REGISTRO
//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES




	//TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
	//$lines = array();
	$detalle_tmp = array();
	if($result->num_rows){
		//echo "$result->num_rows ROWS RETURNED!\n";
			while($line=$result->fetch_array()){
            
                $ultimo_registro = $line;
			}
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
        $lines["resumen_total_dias_tomados"] =  $ultimo_registro;
        echo json_encode(utf8ize($lines));
	}else if($result->num_rows == 0){
		 //array_push($detalle_tmp,array("Mes"=>"0","TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasVacaciones"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0") );
		 $lines["resumen_total_dias_tomados"] =  array("TotalDiasTomados"=>"0");
		 echo json_encode(utf8ize($lines));
	}
	else {echo $db->ODBCerror;}
    
?>