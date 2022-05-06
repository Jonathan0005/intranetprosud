<?php
error_reporting(-1);


  session_start();

  require '../database/database_1.php';



  $valida_id = $_SESSION['user_id'];
  $tipo    = $_SESSION['tipo'];
  $nombre  = $_SESSION['nombre'];
  $nomperfil  = $_SESSION['nomperfil'];
  $usuario  = $_SESSION['usuario'];
  $valida_pass   = $_SESSION['valida_pass'];




  if(isset($valida_id)) {

   $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];

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
<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>
  <title>Intranet Prosud </title>
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

<style>
 
  
#pequeña2{
 width: 105%;

 height : 105%;


  

}
  


  
  </style>
  


</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

<?php
    require_once('../layout/header.php');
?>
  <!-- Left side column. contains the logo and sidebar -->
<?php
    require_once('../layout/aside_lateral.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->


    <section class="content-header">
      <h1>
        Intranet Prosud
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Intranet Prosud</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class=''>

	<div class='row'>
		    <div class="col-xs-4 col-sm-2"><a href="http://190.196.131.250/ProcesosProsud/Vista/Home.aspx?username=<?php echo  $usuario ?>&password=<?php echo  $valida_pass ?>" target="_blank"><img onmouseover="this.src='imgh/1.jpg';" onmouseout="this.src='img/1.jpg';" src="img/1.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://talana.com/es/acceso-a-portal-del-trabajador" target="_blank"><img onmouseover="this.src='imgh/2.jpg';" onmouseout="this.src='img/2.jpg';" src="img/2.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://prosudmarket.cl" target="_blank"><img onmouseover="this.src='imgh/16.jpg';" onmouseout="this.src='img/16.jpg';" src="img/16.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://www.ventasprosud.cl" target="_blank"><img onmouseover="this.src='imgh/4.jpg';" onmouseout="this.src='img/4.jpg';" src="img/4.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://beneficios.prosud.cl"><img onmouseover="this.src='imgh/5.jpg';" onmouseout="this.src='img/5.jpg';" src="img/5.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://productos.prosud.cl" target="_blank"><img onmouseover="this.src='imgh/6.jpg';" onmouseout="this.src='img/6.jpg';" src="img/6.jpg" id="pequeña2"></a></div>
        </div>
        <div class='row'>
        <div class='col-xs-4 col-sm-2'><a href="https://www.hcmfront.com/signin/" target="_blank"><img onmouseover="this.src='imgh/7.jpg';" onmouseout="this.src='img/7.jpg';" src="img/7.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://mundopro.prosud.cl" target="_blank"><img onmouseover="this.src='imgh/8.jpg';" onmouseout="this.src='img/8.jpg';" src="img/8.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="http://portal.office.com/" target="_blank"><img onmouseover="this.src='imgh/9.jpg';" onmouseout="this.src='img/9.jpg';" src="img/9.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://salas.prosud.cl" target="_blank" ><img onmouseover="this.src='imgh/10.jpg';" onmouseout="this.src='img/10.jpg';" src="img/10.jpg" id="pequeña2"></a></div>
        <div class="col-xs-4 col-sm-2"><a href="https://www.instoreview.cl" target="_blank"><img onmouseover="this.src='imgh/11.jpg';" onmouseout="this.src='img/11.jpg';" src="img/11.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://wms.prosud.cl" target="_blank" ><img onmouseover="this.src='imgh/12.jpg';" onmouseout="this.src='img/12.jpg';" src="img/12.jpg" id="pequeña2"></a></div>
        </div>
        <div class='row'>
        <div class='col-xs-4 col-sm-2'><a href="http://gestiondocumental.prosud.cl/" target="_blank" ><img onmouseover="this.src='imgh/13.jpg';" onmouseout="this.src='img/13.jpg';" src="img/13.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://prosud.agilepromoter.com" target="_blank" ><img onmouseover="this.src='imgh/14.jpg';" onmouseout="this.src='img/14.jpg';" src="img/14.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://app.relojcontrol.com" target="_blank" ><img onmouseover="this.src='imgh/15.jpg';" onmouseout="this.src='img/15.jpg';" src="img/15.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://prosudsa.sharepoint.com/sites/InfoPRO/Documentos%20compartidos/Forms/AllItems.aspx" target="_blank" ><img onmouseover="this.src='imgh/17.jpg';" onmouseout="this.src='img/17.jpg';" src="img/17.jpg" id="pequeña2"></a></div>
        <div class='col-xs-4 col-sm-2'><a href="https://forms.office.com/r/4TwDuQPLHm" target="_blank" ><img onmouseover="this.src='imgh/18.png';" onmouseout="this.src='img/18.png';" src="img/18.png" id="pequeña2"></a></div>
	</div>






</div>

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
