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

$lenguaje= "SET lc_time_names = 'es_ES';";
$lenguaje_result = mysqli_query($conn, $lenguaje);

$insert_logs = "insert into tbl_oficina_logs values(NULL, '$valida_id', 'Metas - Reporte Metas', '', NOW());"; 
//echo $insert_logs;
$insert_logs_result = mysqli_query($conn, $insert_logs);   

$periodo = "select distinct Proceso from tbl_metas_meses";
$periodo_result = mysqli_query($conn, $periodo); 

$usuario_metas = "select Usuario, Tipo from tbl_usuario_metas where Usuario = '$valida_id' ";

$usuariom_result = mysqli_query($conn, $usuario_metas); 
  $row2=mysqli_fetch_row($usuariom_result);
  $usuario_me = $row2[0];
  $tipo_me = $row2[1];

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
  <title>Intranet Prosud | Sistema Metas</title>
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

  <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js"></script>


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

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Metas
        <small>visualizacion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Metas</a></li>
        <li class="active">Reporte Metas</li>
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
              <h3 class="box-title"> <i class="fa fa-bar-chart"></i> Reporte Metas</h3>
  </br>
        <div class="card-body">
            <div class="row">
            <div class="col-md-12">
            <form role="form">
              <div class="box-body">

              <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                <label>Seleccionar Proceso</label>
                <select class="form-control select2" style="width: 100%;" id="periodo">
                    <option value='0'>Seleccionar Proceso</option>
                    <?php 
                            while ($rows = mysqli_fetch_row($periodo_result))
                            {
                              ?><option value="<?php echo utf8_encode($rows[0])?>"><?php echo utf8_encode($rows[0])?></option>
                          <?php }
                          
                          ?>
                  </select></div>
                <div class="col-sm-3"></div>
              </div>
              <div class="row"></br></div>
              <div class="row">                
                <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <button  id="exportExcel" type="button" class="btn btn-block btn-success"><i class="fa fa-file-excel-o"></i> Exportar Reporte a Excel</button>
                  </div>
                  <div class="col-sm-3">               
                </div>
              </div>
              <div class="row"></br></div>
              <div class="row">                
                <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <button  id="preguntas_frecuentes" type="button" class="btn btn-block btn-warning"><i class="fa fa-question-circle"></i> Preguntas Frecuentes</button>
                  </div>
                  <div class="col-sm-3">               
                </div>
              </div>
              <div class="row"></br></div>
              <div id="log">
              <div class="row">                
                <div class="col-sm-3"></div>
                  <div class="col-sm-6">
                    <button  id="exportExcel_log" type="button" class="btn btn-block btn-primary"><i class="fa fa-file-excel-o"></i> Exportar Reporte Logs a Excel</button>
                  </div>
                  <div class="col-sm-3">               
                </div>
              </div>
              </div>
              <div class="row"></br></div>
              <div class="row"></br></div>
              <iframe id="reporte_metas" width="100%" height="1080" src="" frameborder="0" allowFullScreen="true"></iframe>
                </div>
              <!-- /.box-body -->
              </form>
              </div>
             </div>
            </div>       
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <div class="modal" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Preguntas Frecuentes</h4>
      </div>
      <div class="modal-body">
      <?php 
        require_once('preguntas_frecuentes.php');
      ?>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar_modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div id="Noticia" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Aviso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">

    <p><b>Metas Octubre no Disponibles.</b> Estimados, informamos que debido a una incidencia se realizara un recalculo de Metas para Octubre 2021. Estaremos notificando cuando esten las metas de Octubre correctamente en el portal.                      </p>

<p>Saludos.</p>
                    </div>
                    <div class="modal-footer">Tienes alguna consulta? Envianos un correo <a href="mailto:sos@prosud.cl">Mail IT Prosud</a></div>
                </div>
            </div>
        </div>



<?php 
    require_once('../layout/footer.php');
?>  

  <!-- Control Sidebar -->
<?php 
    require_once('../layout/aside_final.php');
?>  
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
  //$('#myModal').modal('show');
  //$('#Noticia').modal('show');

  var tipo = "<?php echo $tipo_me; ?>" ;

  if(tipo == 'administrador')
  {
    $('#log').show();
  }
  else 
  {
    $('#log').hide();
  }

});

document.getElementById("preguntas_frecuentes").addEventListener("click", function (e) {
  $('#myModal').modal('show');
});

</script>

<script>
document.getElementById("periodo").onchange = function(){
var e = document.getElementById("periodo");
var periodo = e.value;

var usuario_metas = "<?php echo $usuario_me; ?>" ;
//alert(usuario_metas);
var tipo_metas = "<?php echo $tipo_me; ?>" ;
//alert(tipo_metas);
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
var baseUrl = "https://app.powerbi.com/reportEmbed?reportId=71d46819-58e6-440f-b831-3fdb286b27c8&autoAuth=true&ctid=ff705123-724b-46e0-ab06-9df1a6b79b2a&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXNvdXRoLWNlbnRyYWwtdXMtcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D"
var newUrl = baseUrl + "&pageName=" + "ReportSection";


if( tipo_metas == 'reponedor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutRepo eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'supervisor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutSup eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'vendedor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutVendedor eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'administrador')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"'"; }
else {
  alert("Tu usuario no tiene acceso a este reporte, favor intentar con otro modulo.");
  window.location.replace("inicio.php");
}
document.getElementById('reporte_metas').src = newUrl;
}
else
{
var baseUrl = "https://app.powerbi.com/reportEmbed?reportId=c500eeeb-16fb-464f-82d7-ed771200e99c&autoAuth=true&ctid=ff705123-724b-46e0-ab06-9df1a6b79b2a&config=eyJjbHVzdGVyVXJsIjoiaHR0cHM6Ly93YWJpLXNvdXRoLWNlbnRyYWwtdXMtcmVkaXJlY3QuYW5hbHlzaXMud2luZG93cy5uZXQvIn0%3D"
var newUrl = baseUrl + "&pageName=" + "ReportSection";


if( tipo_metas == 'reponedor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutRepo eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'supervisor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutSup eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'vendedor')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"' and Metas/RutVendedor eq '"+usuario_metas+"'"; }
else if( tipo_metas == 'administrador')
{ newUrl += "&$filter=Metas/Proceso eq '"+periodo+"'"; }
else {
  alert("Tu usuario no tiene acceso a este reporte, favor intentar con otro modulo.");
  window.location.replace("inicio.php");
}
document.getElementById('reporte_metas').src = newUrl;
}
}
</script>
<script type="text/javascript">
    document.getElementById("exportExcel").addEventListener("click", function (e) {
      var e = document.getElementById("periodo");
      var periodo = e.value;
      var rut = "<?php echo $usuario_me; ?>" ;
      var tipo = "<?php echo $tipo_me; ?>" ;

    if (periodo != '0')
      {
        $.ajax({
            type: "POST",
            url: "../controller/export_excel.php",
            data: {tipo:tipo, periodo:periodo, rut:rut}, // serializes the form's elements.
            success: function(data) {
              window.open('../controller/export_excel.php?rut='+rut+'&tipo='+tipo+'&periodo='+periodo);
            }
        });
      }
    else
      { alert('Favor escoger un periodo, para realizar la descarga del archivo');}      
    });   
</script>
<script type="text/javascript">
    document.getElementById("exportExcel_log").addEventListener("click", function (e) {
        $.ajax({
            type: "POST",
            url: "../controller/export_excel_log.php",
            data: {}, // serializes the form's elements.
            success: function(data) {
              window.open('../controller/export_excel_log.php');
            }
        });       
    });   
</script>
<script>
    (function(d, w, c) {
        w.ChatraID = 'zCAAw9KeYwoYdSeNq';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script>

