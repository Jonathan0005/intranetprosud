<?php
error_reporting(-1);

  session_start();

  require '../database/database_1.php';





  $valida_id = $_SESSION['user_id'];
  $tipo    = $_SESSION['tipo'];
  $usuario = $_SESSION['codigo'];
  
  


  if(isset($valida_id)) {

     $query = "SELECT Valor FROM flag where Tipo='AVANCE METAS' ";
	 $res = mysqli_query($conn, $query);
	
	 	
		
if($row = mysqli_fetch_array($res)){
	//print_r($row)."######";
	if($row["Valor"]=='1')
		$estado_act=1;
	else
		$estado_act=0;
	}
else
	$estado_act=0;
$pagina = 'Metas';
$insert_reg = " insert into LOGSYSAUDIT(nom_pagina, nom_usuario,audit_fecha) values ('".$pagina."','".$valida_id."', NOW())";
print_r($insert_reg)
mysqli_query($insert_reg);


$mes = array(
				1 => 'Enero',
				'Febrero',
				'Marzo',
				'Abril',
				'Mayo',
				'Junio',
				'Julio',
				'Agosto',
				'Septiembre',
				'Octubre',
				'Noviembre',
				'Diciembre'
);

if ($tipo == '0') {
				$KAMfijo = "";
}
if ($tipo == '1') {
				$KAMfijo = " CodigoKAM = " . $_SESSION['codigo'] . " and ";
} else {
				$KAMfijo = "";
}

if ($tipo == '2') {
				$Venfijo = " CodigoVendedor = " . $_SESSION['codigo'] . " and ";
} else {
				$Venfijo = "";
}

if ($tipo == '3') {
				$Supfijo = " CodigoSupervisor = " . $_SESSION['codigo'] . " and ";
} else {
				$Supfijo = "";
}

if ($tipo == '4') {
				$Repfijo = " CodigoReponedor = " . $_SESSION['codigo'] . " and ";
} else {
				$Repfijo = "";
}

$query  = "SELECT distinct CodigoKAM, NombreKAM FROM metas_resumidas where codigoKam = " . $KAMfijo . " and NombreKAM <> '' order by NombreKAM ASC";
$result = mysqli_query($query);
$totKAM = mysqli_num_rows($result);

$query    = "SELECT distinct CodigoVendedor, Vendedor FROM metas_resumidas where " . $KAMfijo . $Venfijo . " Vendedor <> '' order by Vendedor ASC";
$vendedor = mysqli_query($query);
$totVen   = mysqli_num_rows($vendedor);

$query      = "SELECT distinct CodigoSupervisor, Supervisor FROM metas_resumidas where "  . $KAMfijo . $Venfijo . $Supfijo . " Supervisor <> '' order by Supervisor ASC";
$supervisor = mysqli_query($query);
$totSup     = mysqli_num_rows($supervisor);

$query     = "SELECT distinct CodigoReponedor, Reponedor FROM metas_resumidas where "  . $KAMfijo . $Venfijo . $Supfijo . $Repfijo . " Reponedor <> '' order by Reponedor ASC";
$reponedor = mysqli_query($query);
$totRep    = mysqli_num_rows($reponedor);




#query con fecha y hora de actualizacion de tabla METAS_KAM
#--------------------------------------------------------------------------------------------------------------------------------------------------------------
$sqlQuery = "SELECT date_add(UPDATE_TIME, INTERVAL -1 DAY) as Sellin FROM information_schema.`TABLES` WHERE TABLE_NAME='metas_resumidas' ";
$datos    = mysqli_query($sqlQuery);
$wiiiiiii = mysqli_fetch_array($datos);
#--------------------------------------------------------------------------------------------------------------------------------------------------------------

$actualizaDatos1   = "select * from HORA_ACTU_METAS where NombreHora = 'CENCOSUD' ";
$actualizaDatos1_1 = mysqli_query($actualizaDatos1);
$actualizaDatos1_2 = mysqli_fetch_array($actualizaDatos1_1);

$actualizaDatos2   = "select * from HORA_ACTU_METAS where NombreHora = 'RENDIC' ";
$actualizaDatos2_1 = mysqli_query($actualizaDatos2);
$actualizaDatos2_2 = mysqli_fetch_array($actualizaDatos2_1);

$actualizaDatos3   = "select * from HORA_ACTU_METAS where NombreHora = 'WALMART' ";
$actualizaDatos3_1 = mysqli_query($actualizaDatos3);
$actualizaDatos3_2 = mysqli_fetch_array($actualizaDatos3_1);

$actualizaDatos4   = "select * from HORA_ACTU_METAS where NombreHora = 'TOTTUS' ";
$actualizaDatos4_1 = mysqli_query($actualizaDatos4);
$actualizaDatos4_2 = mysqli_fetch_array($actualizaDatos4_1);
	
}
else 
{
session_destroy();
header("Location: ../index.php");
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intranet Prosud | Metas</title>
  <link rel="stylesheet" type="text/css" href="estilo.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/jquery.colorbox.js"></script>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



<link href="css/shadowbox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript"> 
Shadowbox.init({ language: "es", players:  ['img', 'html', 'iframe', 'qt', 'wmp', 'swf', 'flv'] }); 
</script>
<style type="text/css">
.ejemplo {
    float:left;
    width:100%;
    padding:0px;
    margin:0px;
}

.ejemplo img {
    float:left;
    padding:2px;
    border:1px solid #999;
    margin-right:10px;
    margin-bottom:10px;
}
.auto-style1 {
	color: #0101DF;
	text-align: center;
	font-size: 15px;
}
.auto-style2 {
	font-weight: 600;
}
.auto-style3 {
	font-size: 20px;
	color: #38610B;
}
.auto-style4 {
	font-size: xx-large;
}
</style>

<script type="text/javascript" visible="true"> 
var x='<?php echo $_SESSION['tipo']; ?>';
var country='<?=$countryId ?>';
var alerta_per=true;
var testQA=false;
var userid='<?php echo $_SESSION['codigo']; ?>';

</script>
<title>Metas</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="javascript" type="text/javascript">



function getXMLHTTP() { 
	var xmlhttp=false;	
	
	try{
		xmlhttp=new XMLHttpRequest();
	}
	catch(e)	{		
		try{			
			xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e){
			try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}
			catch(e1){
				xmlhttp=false;
			}
		}
	}

	return xmlhttp;
}





function getPeriodo(countryId,stateId) {		
	var tipoId = window.sLevel='<?php echo $_SESSION['tipo']; ?>';
	var strURL="findPeriodo_v3.php?KAM="+countryId+"&CLI="+stateId+"&TIPO="+tipoId;
	var req = getXMLHTTP();
	
	if (req) {

		req.onreadystatechange = function() {
			if (req.readyState == 4) {

				if (req.status == 200) {	
				document.getElementById('peridiv').innerHTML=req.responseText;						
				} else {
					alert("06 - There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
	}
	//document.getElementById("xls").style.visibility = "visible";
} 
function limpiar()
{
   document.getElementById("citydiv").innerHTML="";
}

function QuitarGrid()
{
   document.getElementById("grilladiv").innerHTML="";
}

</script>
<script src="funciones_v2.js" language="javascript" type="text/javascript"></script>




</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


  <!-- Left side column. contains the logo and sidebar -->
<?php 
    require_once('../layout/aside_lateral.php');
?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Info Metas
        <small>Visualización de Metas</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Metas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    
<div class="header_resize">
<center>
<form method="POST" action="" name="form1">
<span class="listview-item bg-color-orange">
	<center><h6 class="listview-item-heading">SELL IN</h6>
	<?
echo date("d-m-Y", strtotime($wiiiiiii['Sellin']));
?></center>
</span>
<span class="listview-item bg-color-blue">
	<center><h6 class="listview-item-heading">CENCOSUD</h6>
	<?
echo date("d-m-Y", strtotime($actualizaDatos1_2['Fecha']));
?></center>
</span>
<span class="listview-item bg-color-red ">
	<center><h6 class="listview-item-heading">RENDIC</h6>
	<?
echo date("d-m-Y", strtotime($actualizaDatos2_2['Fecha']));
?></center>
</span>
<span class="listview-item bg-color-grayLight">
	<center><h6 class="listview-item-heading">WALLMART</h6>
	<?
echo date("d-m-Y", strtotime($actualizaDatos3_2['Fecha']));
?></center>
</span>
<span class="listview-item bg-color-green ">
	<center><h6 class="listview-item-heading">TOTTUS</h6>
	<?
echo date("d-m-Y", strtotime($actualizaDatos4_2['Fecha']));
?></center>
</span>
<center>
	<div id="peridiv">
		<select name="perifecha" style="display:none;">
		<option value="0"></option>
		</select>
	</div>
	
</center>

	<table>
<tr>

<td style="height: 32px">
<div id="kam" style="visibility: hidden">
<span class="css3-metro-dropdown">
<select name="country" onchange="carga(this.value,6);" id="sel_kam" style="display:none;">
<option value="0">KAM</option>
</select>
</span>
</div>
</td>

<td style="width: 12px; height: 32px;" >
<div id="vendedor" style="visibility: hidden">
<span class="css3-metro-dropdown">
<select name="Svendedor" onchange="carga(this.value,5);" id="sel_ven" style="display:none;">
<option value="0">Vendedor</option>
</select>
</span>
</div>
</td>

<td style="height: 32px" >
<div id="supervisor" style="visibility: hidden">
<span class="css3-metro-dropdown">
<select name="Ssupervisor" onchange="carga(this.value,4);" id="sel_sup" style="display:none;">
<option value="0">Supervisor</option>
</select>
</span>
</div>
</td>

<td style="height: 32px" >
<div id="reponedor" style="visibility: hidden">
<span class="css3-metro-dropdown" >
<select name="Sreponedor" id="sel_rep" onchange="carga(this.value,3);" style="display:none;">
<option value="0">Reponedor</option>
</select>
</span>
</div>
</td>

</tr>

</table>
	&nbsp;<div>
<script>
getPeriodo(country,x);
</script>

</div>
<?

if($estado_act=='1'){
?>
<div class="auto-style1">
<table align="center" wight="40%" bordercolor="#5882FA">
<tr><td style="border-style: 5; border-width: 5px; height: 82px; width: 552px; " class="align-center"><strong>
	<br><span class="auto-style3">Disculpe las molestias</span><br class="auto-style4"> 
		<br class="auto-style4">Estamos cargando el avance diario.
	<br class="auto-style4">Por favor, revise mas tarde.<br><br></strong><span class="auto-style2">Muchas 
	Gracias</span><br></td></tr></table>
	</div>
<?
}?>

<?

if($estado_act=='2'){
?>
<div class="auto-style1">
<table align="center" wight="40%" bordercolor="#FF0000">
<tr><td style="border-style: 5; border-width: 5px; height: 82px; width: 552px; " class="align-center"><strong>
	<br><span class="auto-style3">Disculpe las molestias</span><br class="auto-style4"> 
		<br class="auto-style4">En este momento la web no se encuentra disponible 
	<br class="auto-style4">Por favor, revise mas tarde o pongase en contacto con Soporte Prosud.<br><br></strong><span class="auto-style2">Muchas 
	Gracias</span><br></td></tr></table>
	</div>
<?
}?>


<div>
<div id="kam2div">
	<select name="kamkam" onchange="carga(this.value,2);" id="sel_kam2" style="display:none;">
		<option value="0"></option>
	</select>
	</div>
</div>

<div id="statediv">
	<select name="state" onchange="carga(this.value,1);" id="sel_cli" style="display:none;">
		<option value="0"></option>
	</select>
</div>
<div id="citydiv">
	<select name="city" onchange="getGrilla(<?=$countryId?>)" id="sel_suc" style="display:none;">
		<option value="0"></option>
	</select>
</div>
<div id="xls" style="visibility:hidden" >
<a href="#" onclick="ver_XLS(0);">
	<img alt="" src="images/icons/excel-150x150.png" style="width: 40px; height: 40px;"></a>
</div>
<div id="grilladiv"></div>
</form>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
    require_once('../layout/footer.php');
?> 

  <!-- Control Sidebar -->
<?php 
    require_once('../layout/aside_final.php');
?> 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
</html>