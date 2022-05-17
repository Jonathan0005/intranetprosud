<?php
error_reporting(-1);

  session_start();

  require '../database/database_1.php';
  include "../controller/convertMoneda.php";

  $valida_id = $_SESSION['user_id'];


  if(isset($valida_id)) {
 
    $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];

        $lenguaje= "SET lc_time_names = 'es_ES';";
        $lenguaje_result = mysqli_query($conn, $lenguaje);
        $query_gastos = "select CASE WHEN sum(rendi_monto) IS NULL THEN 0 ELSE sum(rendi_monto) END as Gastos from rendicion where rut = '$valida_id' and month(rendi_fecha) = month(now()) and year(rendi_fecha) = year(now()) ";
        $results_gastos = mysqli_query($conn, $query_gastos);
        $row_gastos = mysqli_fetch_row($results_gastos);
        $gasto = $row_gastos[0];
        $gasto = moneda_chilena($gasto);

        $query_gant = "select CASE WHEN sum(rendi_monto) IS NULL THEN 0 ELSE sum(rendi_monto) END as Gastos from rendicion where rut = '$valida_id' and MONTH(rendi_fecha) = MONTH(DATE_ADD(FIRST_DAY(NOW()), INTERVAL -1 MONTH)) and year(rendi_fecha) = YEAR(DATE_ADD(FIRST_DAY(NOW()), INTERVAL -1 MONTH));";
        $results_gant = mysqli_query($conn, $query_gant);
        $row_gant = mysqli_fetch_row($results_gant);
        $gant = $row_gant[0];
        $gant = moneda_chilena($gant);
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
		<title>Intranet Prosud | RindePro</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.7 -->
		<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css">
       
		<link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
		<!-- bootstrap datepicker -->
		<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins/iCheck/all.css">
		<!-- Bootstrap Color Picker -->
		<link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
		<link rel="stylesheet" href="../../bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet"  href="style.css">	
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

       

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
		<!-- Google Font -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> </head>
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
        RindePro
        <small>Mis Rendiciones</small>
      </h1>
					<ol class="breadcrumb">
						<li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
						<li><a href="#">RindePro</a></li>
						<li class="active">Mis Rendiciones</li>
					</ol>
				</section>
				<!-- Main content -->
				<section class="content">
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Mis Rendiciones</h3>
							<div class="box-tools pull-right"> </div>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-md-3 col-sm-6 col-xs-12"> </div>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box bg-aqua"> <span class="info-box-icon"><i class="fa fa-money"></i></span>
										<div class="info-box-content"> <span class="info-box-text">Gastos Mes Actual</span> <span class="info-box-number"><?php echo $gasto; ?></span>
											<div class="progress">
												<div class="progress-bar" style="width: 100%"></div>
											</div> <span class="progress-description">
               Aprobadas-No Aprobadas 
                </span> </div>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<div class="info-box bg-orange"> <span class="info-box-icon"><i class="fa fa-money"></i></span>
										<div class="info-box-content"> <span class="info-box-text">Gastos Mes Anterior</span> <span class="info-box-number"><?php echo $gant; ?></span>
											<div class="progress">
												<div class="progress-bar" style="width: 100%"></div>
											</div> <span class="progress-description">
											Aprobadas-No Aprobadas  
                </span> </div>
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-12"> </div>
							</div>
                        <div class ="row">
							<div class="col-md-12">
								<table id="tbl_rendiciones" class="responsive display nowrap" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th data-priority="1">ID gasto</th>
											<th>Fecha</th>
											<th>C. Contable</th>
											<th>Tipo Documento</th>
											<th>Detalle</th>
											<th data-priority="2">Monto</th>
											<th>Estado</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody> 


                                    </tbody>
								</table>
							</div>
						</div>
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
		<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
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
		<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
		<!-- InputMask -->
		<script src="plugins/input-mask/jquery.inputmask.js"></script>
		<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<!-- date-range-picker -->
		<script src="bower_components/moment/min/moment.min.js"></script>
		<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<!-- bootstrap datepicker -->
		<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- bootstrap color picker -->
		<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<!-- bootstrap time picker -->
		<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
		<script src="bower_components/datatables.net/api/sum().js"></script>
		<script src="bower_components/datatables.net-bs/api/sum().js"></script>
		<script>
			$(function () {
			    //Initialize Select2 Elements
			    $('.select2').select2()
			
			    //Datemask dd/mm/yyyy
			    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
			    //Datemask2 mm/dd/yyyy
			    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
			
			    $('#number').inputmask('#,##0.00', { 'placeholder': '#,##0.00' })
			    //Money Euro
			    $('[data-mask]').inputmask()
			
			
			
			    //Date range picker
			    $('#reservation').daterangepicker()
			    //Date range picker with time picker
			    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
			    //Date range as a button
			    $('#daterange-btn').daterangepicker(
			      {
			        ranges   : {
			          'Today'       : [moment(), moment()],
			          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
			          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
			          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			        },
			        startDate: moment().subtract(29, 'days'),
			        endDate  : moment()
			      },
			      function (start, end) {
			        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
			      }
			    )
			
			    //Date picker
			    $('#datepicker').datepicker({
			      autoclose: true
			    })
			
			    //iCheck for checkbox and radio inputs
			    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
			      checkboxClass: 'icheckbox_minimal-blue',
			      radioClass   : 'iradio_minimal-blue'
			    })
			    //Red color scheme for iCheck
			    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
			      checkboxClass: 'icheckbox_minimal-red',
			      radioClass   : 'iradio_minimal-red'
			    })
			    //Flat red color scheme for iCheck
			    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			      checkboxClass: 'icheckbox_flat-green',
			      radioClass   : 'iradio_flat-green'
			    })
			
			    //Colorpicker
			    $('.my-colorpicker1').colorpicker()
			    //color picker with addon
			    $('.my-colorpicker2').colorpicker()
			
			    //Timepicker
			    $('.timepicker').timepicker({
			      showInputs: false
			    })
			  })
			
		</script>
	</body>
	</html>
	<script>
		$(document).ready(function() {
		
		var dataTable = $('#tbl_rendiciones').DataTable( {
				"language":{
					"processing": "Procesando...",
					"lengthMenu": "Mostrar _MENU_ registros",
					"zeroRecords": "No se encontraron resultados",
					"emptyTable": "Ningún dato disponible en esta tabla",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
					"infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
					"infoFiltered": "(filtrado de un total de _MAX_ registros)",
					"search": "Buscar:",
					"infoThousands": ",",
					"loadingRecords": "Cargando...",
					"paginate": {
						"first": "Primero",
						"last": "Último",
						"next": "Siguiente",
						"previous": "Anterior"
				}
			},
                  "responsive": true, 
				  "scrollX": true,
				  "columnDefs": [
		            { responsivePriority: 1, targets: 0 },
		            { responsivePriority: 2, targets: 5 }
		        		],
		          "ajax":{
		            url :"../controller/get_rendiciones.php", // json datasource
		            type: "post",  // method  , by default get
		            error: function(){  // error handling
		              
		            }
		          }
		   });
		});
		
	</script>

	