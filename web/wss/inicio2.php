<?php
//header('Content-Type: text/html; charset=ISO-8859-1');
 error_reporting(-1);
require_once "isql.php";
	$db=new AS400DB("alias1","web","web");

    $secret = 'cOnUDxw9zTpcFxWa';
    $rut = $_GET['rut'];
    $hash = $_GET['hash'];
    

    //print_r($_GET);
    //$lines= array();
    /*
    foreach ($_REQUEST as $getted) {

        # code...
        $lines[] = $getted;
    }
    */

    //$lines[] = $_REQUEST['rut'];

    //echo json_encode($lines);
    //die();


    /*if(strcmp($secret,$secret2) != 0 )
    die();*/


    $hasheado = hash('sha256',$rut.$secret);

    //if(strcmp($hasheado,$hash) != 0 )
    //die();
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

	//Detalle de vacaciones del empleado (cada vez que tomÃ³)
	//SELECT CAST(field1 AS TEXT) AS field1 FROM table
	//$result=$db->query("SELECT   dv.DetVarFechaIni,dv.DetVaFechaFin FROM DetVacaciones as dv WHERE dv.EmplRut = 59210009 " );



	//DETALLE_VACACIONES_RESUMEN  TotalDiasVacaciones TotalDiasTomados DiasRestantes DiasPresenteAÃ±o AÃ±o,Mes  Apellido_P, Apellido_M, Nombre Cargo FechaContrato
	//TOP 1  where Rut= 'ELRUTCONGUIONTODOJUNTO' ORDER BY AÃ±o DESC, Mes DESC

	//$result=$db->query("SELECT  TOP 100  * FROM DETALLE_VACACIONES_RESUMEN as dvr WHERE dvr.Rut = 59210009 " );
    /*
    $result=$db->query("SELECT TOP (1000)
       [Empresa]
      ,[AÃ±o]
      ,[Mes]
      ,[Rut]
      ,[Apellido_P]
      ,[Apellido_M]
      ,[Nombre]
      ,[TotalDiasTomados]
      ,[TotalDiasPeriodo2012]
      ,[DiasPresenteAÃ±o]
      ,[DiasProgresivos]
      ,[TotalDiasVacaciones]
      ,[Cargo]
      ,[CentroCosto]
      ,[NOMBRE_SUPERVISOR]
      ,[DEPARTAMENTO]
      ,[FechaContrato]
      ,[Comuna]
      ,[Fecha_Finiquito]
      ,[TotalDiasHabiles]
      ,[TotalDias_NO_Habiles]
      ,[DiasRestantes]
      ,[DiasAcumulados]
      
  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN] WHERE AÃ±o = 2017 AND Mes = 4 AND Rut = '  59210009' " );
  */
  /*
  $result=$db->query("SELECT 
       
      
      
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
      
  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN] WHERE  Rut = ' ".$rut."' OR Rut = '  ".$rut."'" );
*/
  $qry="SELECT [Mes],
[Apellido_P], 
[Apellido_M],
[Nombre],
[TotalDiasTomados],
[DiasProgresivos],
[TotalDiasVacaciones],
[Cargo],
[FechaContrato],
case when [TotalDiasHabiles] is NULL then 0 else [TotalDiasHabiles]  end as [TotalDiasHabiles],
case when [TotalDias_NO_Habiles] is NULL then 0 else [TotalDias_NO_Habiles]  end as [TotalDias_NO_Habiles],
[DiasRestantes],
[DiasAcumulados]  FROM [procesadorabd].[dbo].[DETALLE_VACACIONES_RESUMEN_WEB] WHERE ltrim(rtrim(Rut)) = ltrim(rtrim('".$rut."')) and Empresa='1' and cast('01/'+cast(Mes as varchar(2))+'/'+cast(Anio as varchar(4)) as date) between dateadd(yy,-1,getdate()) and getdate() order by [Mes] asc";
  echo $qry;

  $result=$db->query($qry);
  
  /*ltrim(rtrim(Rut)) = ltrim(rtrim('".$rut."')) OR  ltrim(rtrim(Rut)) = ltrim(rtrim('".$rut."')) ) 
  
   and Empresa='1' and 
   	(
   		(
   			Anio=".date("Y")." 
            and Mes=".date("m")."
        ) 
        OR 
        (Anio=".date("Y",strtotime("-1 month"))." 
                and Mes=".date("m",strtotime("-1 month")).") OR (Anio=".date("Y",strtotime("-2 month"))." 
                and Mes=".date("m",strtotime("-2 month")).") OR (Anio=".date("Y",strtotime("-3 month"))." 
                and Mes=".date("m",strtotime("-3 month")).") )" );*/

//(PARA VACACIONES TOTALES SUMAR PRESENTE ANO + ACUMULADO) Y TOMAR RESTANTES PARA RESTANTES Y TOTAL DIAS TOMADOS ES ESO Y LO MISMO CON DIAS RESTANTES

	//REMUNERACIONES PARA LIQUIDACION DE SUELDO?????
    //TOMAR EL ULTIMO REGISTRO DE REMUNERACIONES PARA SABER HASTA CUANDO SE HA GENERADO
//	$lines = array();
	print_r($result);
	//echo 'fin';
	if($result->num_rows){
		echo "$result->num_rows ROWS RETURNED!\n";
		//	while($line=$result->fetch_array()){
              //echo "$result->num_rows ROWS RETURNED!\n";   
		//		echo json_encode($line);
                //print("<BR>");
                //print("<BR>");
                $i=$result->num_rows-1;
                $result->rowposition=$i;
                $line=$result->fetch_array();
                echo "------------";
                echo $i;
                echo "empezo";
                $ultimo_registro = array_map('utf8_encode',$line);
                echo "#######";
                print_r($ultimo_registro);
                echo "***"; 
                //utf8_encode($ultimo_registro);
                echo json_encode($ultimo_registro, JSON_UNESCAPED_UNICODE);
                echo "***";
                echo "termino";
			//}
      // $ultimo_registro = $num_rows
            //Normalmente ordenariamos por anio desc y mes desc y tomariamos el primero, pero en la base de datos el campo se llama A&tilden;o por lo que no es posible usarlo ni en la query ni en la respuesta
      //echo $ultimo_registro;
           $lines[] = $ultimo_registro;
       // echo json_encode($lines);
        echo "1";
        //print_r($lines);
	}
  else if($result->num_rows == 0){
		 array_push($lines,array("TotalDiasTomados"=>"0","DiasProgresivos"=>"0","TotalDiasHabiles"=>"0","TotalDias_NO_Habiles"=>"0","DiasRestantes"=>"0","DiasAcumulados"=>"0") );
         echo json_encode($lines);
	}
	else {echo $db->ODBCerror;}
  echo "2";	
?>
3