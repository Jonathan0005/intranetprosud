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
        Estatus Ordenes de Pedido
        <small>visualizacion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">MegaLogistica</a></li>
        <li class="active">Estatus</li>
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
            <h3 class="box-title">MegaLogistica</h3>
              <!-- DataTable que contiene las ordenes del vendor que inicio -->
              <div class="panel-body">


               
                  <table id="MLGrilla" class="table table-bordered table-striped" >  
                    <thead>
                      <tr >
                        <th >Numero Pedido</th>
                        <th >Estado</th>
                        <th >Info</th>
                        <th >Fecha</th>
                        <th >Estado Documento</th>
                        <th >Tipo Documento</th>    
                        <th >Hora</th>  
                        <th >Detalle      


                       

                        </th>                            
                      </tr>    
                      </thead>
                      <tbody>
                      </tbody>
                  </table>          

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

        $(document).ready(function() {
        var dataTable = $('#MLGrilla').DataTable( {
          "paging":   true,
        "ordering": true,	
          
         "language":  {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar   _MENU_   registros",
          "sZeroRecords":    "No se encontraron resultados",
          "sEmptyTable":     "Ningún dato disponible en esta tabla",
          "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
          "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
          "sInfoPostFix":    "",
          "sSearch":         "Buscar:     ",
          "sUrl":            "",
          "sInfoThousands":  ",",
          "sLoadingRecords": "Cargando...",
          "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
          },
          "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
          }
        },

          "processing": true,
          "serverSide": true,
          "ajax":{
            url :"../controller/grid_status.php", // json datasource
            type: "post",  // method  , by default get
            error: function(){  // error handling
              
            },

          }
        } );
      } );

      function loadDynamicContentModal(modal){
    var options = {
            modal: true,
            height:300,
            width:600
        };
// Realiza la consulta al fichero php para obtener información de la BD.

    $('#conte-modal').load('Detalle.php?my_modal='+modal, function() {
        $('#bootstrap-modal').modal({show:true});
    });    
}
      
</script>



