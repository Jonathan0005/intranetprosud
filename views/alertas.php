<?php
error_reporting(-1);

  session_start();

  require '../database/database_1.php';

  $valida_id = $_SESSION['user_id'];


  if(isset($valida_id)) {
 
    $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];    

      $query_alerta = "select alerta_flag, alerta_texto from tbl_alertas_prosud"; 
      $r_alertas = mysqli_query($conn, $query_alerta);
      $row_alertas=mysqli_fetch_row($r_alertas);
      $flag = $row_alertas[0];   
      $texto = $row_alertas[1]; 
}
else 
{
session_destroy();
header("Location: ../index.php");
}
?>


<!DOCTYPE html>
<html>
<head><meta charset="gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intranet Prosud | Status</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


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
        Alertas Oficina Prosud
        <small>visualizacion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Alertas</a></li>
        <li class="active">Alertas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
          
            <div class="box-header with-border">
            <h3 class="box-title">Alertas Prosud</h3>
              <!-- DataTable que contiene las ordenes del vendor que inicio -->
              <div class="panel-body">
              <form role="form">
              <div class="checkbox">
                <label>
                <input type="checkbox" id="activar">
                Activar Alertas
                </label>
                </div>
                <div class="form-group">
                <label>Ingresa tus alertas</label>
                <textarea class="form-control" rows="3" placeholder="Ingresa tu texto ..." id ="texto"><?php echo $texto;?></textarea>
                </div>
                <button type="button" class="btn btn-block btn-primary" id="save"> <i class="fa fa-fw fa-save"></i> Guardar</button>
                </form>         
              </div>
            </div>         
          </div>

        </div>
      </div>

    </section>
  
<style type="text/css">
    .RECIBIDO  {
        background: #BBF1AE ; /* green for solved status */
        text-align:center;
    }
    .ENVIADO  {
        text-align:center;
    }

</style>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php 
    require_once('../layout/footer.php');
?>  

  <!-- Control Sidebar -->
<?php 
    require_once('../layout/aside_final.php');
?>    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
        <script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        
</body>
</html>
<script>
  $( document ).ready(function() {
    var fl = "<?php echo $flag; ?>";
    if(fl == "1"){
      $('#activar').prop('checked', true);
    }else
    {
      $('#activar').prop('checked', false);
    }
});
  </script>

<script> 
$("#save").click(function(){
var texto = $('textarea#texto').val();
var flag_t = 0;
if ($('#activar').is(':checked'))
  {
    flag_t = 1;
  }
  $.ajax({
                    url:'../controller/setAlertas.php',
                    method:'POST',
                    data:{
                      flag_t:flag_t, texto:texto
                    },
                   success:function(data){
                    Swal.fire(
                      'Buen Trabajo!',
                      'Alerta Agregada Correctamente!',
                      'success'
                    )
                   }    
                });  

});
</script>