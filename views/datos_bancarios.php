<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

  session_start();

  require '../database/database_1.php';

  $valida_id = $_SESSION['user_id'];


  if(isset($valida_id)) {
 
    $query = "SELECT concat(nombre,' ',apellido_p) as user_nom FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0];

      $newDate = date("m-d-Y");
    
      $query_banco = "SELECT  id, nombre FROM rendi_banco";
      $results_banco = mysqli_query($conn, $query_banco);

      $query_tipob = "SELECT id, nombre FROM rendi_tipo_cuenta";
      $results_tipob = mysqli_query($conn, $query_tipob);

      $query_validadb = "SELECT count(*) as Validador FROM rendi_usuario_banco WHERE rut = '$valida_id'";

      $resultsdb = mysqli_query($conn, $query_validadb);
      $rowvbd = mysqli_fetch_row($resultsdb);
      $validador = $rowvbd[0];
      $email = ""; 

      if ($validador !='0'){

      $query_datos = "SELECT email, tipo_cuenta_id, banco_id, numero_cuenta  FROM rendi_usuario_banco WHERE rut = '$valida_id'";
      $resultsdaban = mysqli_query($conn, $query_datos); 
      $rowdb = mysqli_fetch_row($resultsdaban);
      $email = $rowdb[0];
      $tipo_cuenta_id = $rowdb[1];
      $banco_id = $rowdb[2];
      $numero_cuenta = $rowdb[3];
      }
     
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
  <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>


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
        RindePro
        <small>visualizacion</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">RindePro</a></li>
        <li class="active">Datos Bancarios</li>
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
              <h3 class="box-title"> <i class="fa fa-money"></i> Mis datos bancarios</h3>
  </br>
        <div class="card-body">

        <form role="form">
              <div class="box-body">

              <div class="form-group">
                  <label>Nombre </label>
                  <input type="text" class="form-control"  value="<?php echo $user; ?>" disabled>
                </div>
                <div class="form-group">
                  <label>Rut</label>
                  <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingresa Rut sin puntos y sin guion" value="<?php echo $valida_id; ?>" disabled>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" class="form-control" placeholder="nombre@email.com" id="email" name="email" value= "<?php echo $email; ?>">
                </div>
              <div class="form-group">
                  <label>Banco</label>
                  <select class="form-control" id="banco" name="banco">
                    <?php 
                            while ($rows = mysqli_fetch_row($results_banco))
                            {
                              ?><option value="<?php echo utf8_encode($rows[0])?>"><?php echo utf8_encode($rows[1])?></option>
                          <?php }
                          
                          ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tipo de Cuenta</label>
                  <select class="form-control" id="tipod" name="tipod">
                  <?php 
                            while ($rows_b = mysqli_fetch_row($results_tipob))
                            {
                              ?><option value="<?php echo utf8_encode($rows_b[0])?>"><?php echo utf8_encode($rows_b[1])?></option>
                          <?php }
                          
                          ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>N° de Cuenta</label>
                  <input type="number" class="form-control" placeholder="Ingresa el N°" id="cuenta" name="cuenta" value = "<?php echo $numero_cuenta; ?>">
                </div>
              <div class="box-footer">
              <button type="button" class="btn btn-block btn-primary" id="guardar" name="guardar"><i class="fa fa-fw fa-save"></i> Guardar o Actualizar</button>
              </div>
            </form>
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

<?php 


 if($validador != '0')
 {
  echo "<script>       
  Swal.fire({
    icon: 'success',
    title: 'Excelente',
    text: 'Tienes todos tus datos bancarios registrados, si lo requieres puedes actualizar tus datos.',
  })
  </script>";
 }
 else{
   echo "<script>       
   Swal.fire({
     icon: 'error',
     title: 'Oops...',
     text: 'No tienes datos bancarios registrados, favor ingresar datos para realizar rendiciones.',
   })
   </script>";
 }

?>


<script>
function setSelectValue (id, val) {
    document.getElementById(id).value = val;
}
setSelectValue('tipod', <?php echo $tipo_cuenta_id; ?>);
setSelectValue('banco', <?php echo $banco_id; ?>);

$('#guardar').click(function() {

        var rut=$("#rut").val();
        var cuenta=$("#cuenta").val();
        var tipod=$("#tipod").val();
        var banco=$("#banco").val();
        var email=$("#email").val();

  if ($('#email').val().length == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa tu Email'
    })
    return false; 
  }
  else if ($('#cuenta').val().length == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa tu Numero de Cuenta'
    })
    return false; 
  
  }
  else
  {
  $.ajax({
                    url:'../controller/guardar_bancarios.php',
                    method:'POST',
                    data:{
                        rut:rut,
                        cuenta:cuenta,
                        tipod:tipod,
			                  banco:banco,
                        email:email
                    },
                   success:function(data){
                    Swal.fire({
                    icon: 'success',
                    title: 'Datos guardados o actualizados',
                    showConfirmButton: false,
                    })
                   }
          });
        }
});

</script>
</body>
</html>


