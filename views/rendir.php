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

      $newDate = date("m-d-Y");
    
      $query_cuenta = "SELECT  id, nombre FROM rendi_cuenta_contable";
      $results_cuenta = mysqli_query($conn, $query_cuenta);



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
        <li class="active">Formulario de Rendiciones</li>
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
              <h3 class="box-title"> <i class="fa fa-money"></i> Formulario de Rendiciones</h3>
  </br>
        <div class="card-body">

        <form   enctype="multipart/form-data">
              <div class="box-body">
              <div class="form-group">
                <label>Fecha Hoy</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" id="fecha" class="form-control" data-inputmask="'alias': 'mm-dd-yyyy'" data-mask="" value = '<?php echo $newDate; ?>' disabled>
                </div>
                <!-- /.input group -->
              </div>    
              <div class="form-group">
                  <label>Selecciona Cuenta Contable</label>
                  <select class="form-control" id="cuenta_contable">
                    <?php 
                            while ($rows = mysqli_fetch_row($results_cuenta))
                            {
                              ?><option value="<?php echo utf8_encode($rows[0])?>"><?php echo utf8_encode($rows[1])?></option>
                          <?php }
                          
                          ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Selecciona Tipo de Documento</label>
                  <select class="form-control" id="tipodoc">
                    <option value="1">BOLETA</option>
                    <option value="2">FACTURA</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Numero Documento</label>
                  <input type="number" class="form-control" placeholder="Ingresa el N°" id="numerodoc" required>
                </div>
                <div class="form-group">
                  <label>Detalle</label>
                  <input type="text" class="form-control" placeholder="Ingresa el detalle" id="detalledoc" required>
                </div>
                <div class="form-group">
                  <label>Monto</label>
                  <input type="number" onkeyup="format(this)" onchange="format(this)" class="form-control" placeholder="Ingresa el Monto" id="montodoc" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Subir Foto</label>
                  <input type="file" id="fileupload" class="fu" name="fileupload"  accept="image/*">
                  <button type="button" id="upload"><i class="fa fa-fw fa-upload"></i> Subir</button>
                </div>
                </div>
              </div>
              <div class="form-group">
              <table id="fotos_grid" class="table table-bordered table-striped">  
                                     <thead>
                                        <tr>
                                        <th>N°</th>
                                        <th>Foto</th> 
                                        <th>Acciones</th> 
                                       </tr>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                </div>
                <div class="form-group">
                <button type='button' class="btn btn-block btn-info" id="agregar" name="agregar"><i class="fa fa-fw fa-credit-card"></i> Agregar Gasto</button>
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
</body>
</html>
<script>
    $(document).ready(function() {
      
      var dataTable = $('#fotos_grid').DataTable( {
          "bPaginate": false,
          "bFilter": false,
          "bInfo": false,
          "ordering": false,
         "language":  {
          "sProcessing":     "Procesando...",
          "sLengthMenu":     "Mostrar   _MENU_   registros",
          "sZeroRecords":    "",
          "sEmptyTable":     "",
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
          
        }
        });
    });

</script>


<script>
  let count = 0;
  var foto_nombre= "";
  $('#upload').on('click', function() {
    var file_data = $('#fileupload').prop('files')[0];   
    var fileValue = $('#fileupload').prop('files')[0].name; 
    var form_data = new FormData();
    let file_change;                  
    form_data.append('file', file_data);                         
    $.ajax({
        url: '../controller/uploader.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success:function(data){
            file_change = data; 
            foto_nombre = file_change.toString();
            //alert(file_change);
            //alert(data);
            count = count +1;
                            let html = "<tr id='row"+count+"'>";
                            html += "<td id='data1' readonly='readonly' class='numero'>"+count+"</td>";
                            html += "<td id='data2' readonly='readonly' class='foto_link'>"+foto_nombre+"</a></td>";
                            html += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Eliminar</button> <a href='../imagenes_rindepro/"+foto_nombre+"' target='_blank' type='button' name='ver_imagen' class='btn btn-success btn-xs'>Ver Imagen</a></td>"; 
                            html += '</tr>';
                            $('#fotos_grid tbody').prepend(html);
        }
     });

  
  $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 }); 
});
</script>
<script>

function guarda_foto()
{
  var rutfoto = <?php echo $valida_id; ?>;
  $("#fotos_grid tbody tr").each(function (index) {
        var campo1, campo2, campo3;
        $(this).children("td").each(function (index2) {
            switch (index2) {
               case 1:
                   campo2 = $(this).text();
                   $.ajax({
                    url:'../controller/guardar_foto_rendicion.php',
                    method:'POST',
                    data:{
                        campo2:campo2,
                        rutfoto:rutfoto
                    },
                   success:function(data){
                   }                  
                   });
                 break;
           }
           $(this).css("background-color", "#ECF8E0");
     })
 });
}
$('#agregar').click(function(){
  var tablafotos = $('#fotos_grid').DataTable();
  
  var rut = <?php echo $valida_id; ?>;
        var fecha=$("#fecha").val();
        var cuenta_contable=$("#cuenta_contable").val();
        var tipodoc=$("#tipodoc").val();
        var numerodoc=$("#numerodoc").val();
        var detalledoc=$("#detalledoc").val();
        var montodoc=$("#montodoc").val();

  if ($('#numerodoc').val().length == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa Numero de Documento'
    })
    return false; 
  }
  else if ($('#detalledoc').val().length == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa Detalle de Documento'
    })
    return false; 
  
  }
  else if ($('#montodoc').val().length == 0) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa Monto'
    })
    return false; 
  }
  else if (count == 0){
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresar al menos una foto'
    })
    return false; 
  }
  else 
  {
    $.ajax({
     url:'../controller/guardar_rendicion.php',
      method:'POST',
        data:{
              rut:rut,
              fecha:fecha,
              cuenta_contable:cuenta_contable,
              tipodoc:tipodoc,
			        numerodoc:numerodoc,
              detalledoc:detalledoc,
              montodoc:montodoc
              },
      success:function(data){
              guarda_foto();
              Swal.fire({
              icon: 'success',
              title: 'Excelente',
              text: 'Se agrego su gasto!',
              confirmButtonText: 'Aceptar',
              preConfirm: () => {
                      window.location.reload();
 
                }
             })
            }
    });   
  }
  
     

});

</script>




