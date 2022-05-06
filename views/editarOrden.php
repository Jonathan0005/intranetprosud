<?php
error_reporting(-1);

  session_start();

  require '../database/database_1.php';
  require '../controller/diashabiles.php';

  $valida_id = $_SESSION['user_id'];
  $id_orden = $_GET['id'];


  if(isset($valida_id)) {
 
    $query = "SELECT concat(nombre,' ',apellido_p) as user_nom, DiasDespacho  FROM users WHERE RUT = '$valida_id' LIMIT 1";
    $results = mysqli_query($conn, $query);

     $user = "";


      $row=mysqli_fetch_row($results);
      $user = $row[0]; 
      
      $query_ordenEncabezado = "select OVOPFechaIngreso, OVOPFechaDespacho, OVOPDireccionDespacho, descripcion, sucursal, CodigoPago2, OVOPDescripcion, OVOPIVA, OVOPOtrosImpuestos, OVOPTotal, OVOPTotalNeto, UnidadMedida   from editar_orden where OVOP_ID = ".$id_orden."";
        $res_encabezado = mysqli_query($conn, $query_ordenEncabezado);
        $row_enca = mysqli_fetch_row($res_encabezado);
        $fecha_ingreso =  date("d/m/Y", strtotime($row_enca[0]));
        $fecha_despacho = date("d/m/Y", strtotime($row_enca[1]));
        $direccion = $row_enca[2];
        $cliente = $row_enca[3];
        $sucursal = $row_enca[4];
        $formapago = $row_enca[5];
        $observacion = $row_enca[6];
        $iva = $row_enca[7];
        $impto = $row_enca[8];
        $total = $row_enca[9];
        $total_neto = $row_enca[10];
        $unidadmedida= $row_enca[11];

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
  <title>AppsProsud | Editar Orden</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
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
        <i class="fa fa-edit"></i> Editar orden
        <small>editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">OP Web</a></li>
        <li class="active">Editar Orden</li>
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
              <h3 class="box-title"> <i class="fa fa-file"></i> Editar Orden de Pedido</h3>
              <form role="form">
              <div class="box-body">
                <div class="col-md-4">
                  <label>Cliente</label>
                  <input type="text" class="form-control" id="cliente" value="<?php echo $cliente ?>" disabled> 
                </div>
                  <div class="col-md-4">
                  <label>Sucursal</label>
                  <input type="text" class="form-control" id="sucursal" value="<?php echo $sucursal ?>" disabled>
                   
                </div>
                <div class="col-md-4">
                  <label>Fecha de O.P.</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="fecha_op" value="<?php echo $fecha_ingreso ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask  disabled>
                </div>
                </div>
              <div class="col-md-4">
                  <label>Forma de pago</label>
                  <input type="text" class="form-control" id="formapago" value="<?php echo $formapago ?>" disabled>
                </div>
                <div class="col-md-4">
                  <label>N° Orden</label>
                  <input type="text" class="form-control" id="numero_orden" value="<?php echo $id_orden ?>" disabled>
                </div>
                <div class="col-md-4">
                  <label>Unidad de Medida </label>
                  <input type="text" class="form-control" id="unidad_medida" value="<?php echo $unidadmedida ?>" disabled>
                </div>
                </div>
              <!-- /.box-body -->
               <br></br>
               <div class="form group">
                 <table id="op_detalle" class="table table-bordered table-striped" style="width:100%">  
                                     <thead>
                                        <tr>
                                        <th>Descripcion del Producto</th>
                                        <th>U.M</th>
                                        <th>Cantidad</th>
                                        <th>Precio Neto</th>
                                        <th>Impuesto Adicional</th>
                                        <th>Sub Total</th>
                                        <th>% Descuento </th>
                                        <th>Tipo Dscto.</th>
                                        <th>Total General</th>
                                       </tr>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                  </div>
        <div class="col-md-3">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h4 class="box-title"><i class="fa fa-money"></i> Totales</h4>

              <div class="box-tools pull-right">
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-hover">
                <tr>
                  <td>Total Neto</td>
                  <td><input type='text' class='form-control' value='<?php echo $total_neto ?>' id='neto' ></td>
                </tr>
                <tr>
                  <td>IVA</td>
                  <td><input type='text' class='form-control' value='<?php echo $iva ?>' id='iva' ></td>
                </tr>
                <tr>
                 <td>Impto. Adicional</td>
                 <td><input type='text' class='form-control' value='<?php echo $impto ?>' id='impto' ></td>
                </tr>
                <tr>
                 <td><label>Total General</label></td>
                 <td><input type='text' class='form-control' value='<?php echo $total ?>' id='general' ></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

          <div class="col-md-9">
          <div class="box box-success">
            <div class="box-header with-border">
              <h4 class="box-title"><i class="fa fa-edit"></i> Informacion Adicional</h4>

              <div class="box-tools pull-right">
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
                  <label>Direccion</label>
                  <input type="text" class="form-control" id="direccion_op" placeholder="" value="<?php echo $direccion ?>" >
                  
                </div>
                <div class="col-md-6">
                  <label>Observacion</label>
                  <input type="text" class="form-control" id="observacion_op" placeholder="" value="<?php echo $observacion ?>" >
                </div>
                <br></br>
                <div class="col-md-6">
                <label>Fecha de Despacho</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="fecha_despacho_op" value="<?php echo $fecha_despacho ?>"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask disabled>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-primary" id="grabar_op"><i class="fa fa-save"></i> Actualizar Pedido</button>
              </div>
            </form>                              
            </div>
            </div>
          </div>

    </section>
  </div>
    <!-- Modal -->
    <!-- /.content -->
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

        var dataTable = $('#op_detalle').DataTable( {
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
    $(document).ready(function(){

    var id_orden=$("#numero_orden").val();
    $.post("../controller/grid_productos.php", { id_orden: id_orden}, function(data){
              $("#op_detalle tbody").html(data);
            });


      function encabezado()
      {

        var cliente_insert=$("#cliente").val();
        var sucursal_insert=$("#sucursal").val();
        var fecha_insert=$("#fecha_op").val();
        var formapago_insert=$("#formapago").val();
        var direccion_insert=$("#direccion_op").val();
        var fecha_despacho_insert=$("#fecha_despacho_op").val();
        var observacion_insert=$("#observacion_op").val();
        var neto_insert=$("#neto").val();
        var iva_insert=$("#iva").val();
        var impto_insert=$("#impto").val();
        var unidad_insert=$("#unidad_medida").val();
        var general_insert=$("#general").val();

          $.ajax({
                    url:'../controller/updateEncabezadoOP.php',
                    method:'POST',
                    data:{
                        id_orden: id_orden,
                        cliente_insert:cliente_insert,
                        sucursal_insert:sucursal_insert,
                        fecha_insert:fecha_insert,
                        formapago_insert:formapago_insert,
                        direccion_insert:direccion_insert,
                        fecha_despacho_insert:fecha_despacho_insert,
                        observacion_insert:observacion_insert,
                        neto_insert:neto_insert,
                        iva_insert:iva_insert,
                        impto_insert:impto_insert,
                        unidad_insert:unidad_insert,
                        general_insert:general_insert
                    },
                   success:function(data){
                    
                   }    
                });
  
      }

      function detalle()
      {
             var producto_insert = [];
                var um_insert = [];
                var cantidad_insert = [];
                var precio_insert = [];
                var impuesto_insert = [];
                var subtotal_insert = [];
                var descuento_insert = [];
                var tipo_insert = [];
                var total_insert = [];

                $('.producto_pri').each(function(){
                producto_insert.push($(this).text());
                });

                $('.cantidad_pri').each(function(){
                cantidad_insert.push($(this).text());
                });

                $('.precio_pri').each(function(){
                precio_insert.push($(this).text());
                });

                $('.subtotal_pri').each(function(){
                subtotal_insert.push($(this).text());
                });

                $('.descuento_pri').each(function(){
                descuento_insert.push($(this).text());
                });
                $('.tipodscto_pri').each(function(){
                tipo_insert.push($(this).text());
                });

                $('.total_pri').each(function(){
                total_insert.push($(this).text());
                });
                if (producto_insert != ''){
                $.ajax({
                url:"../controller/updateDetalleOP.php",
                method:"POST",
                data:{
                  id_orden: id_orden,
                  producto_insert:producto_insert,
                  cantidad_insert:cantidad_insert,
                  precio_insert:precio_insert,
                  subtotal_insert:subtotal_insert,
                  descuento_insert:descuento_insert,
                  tipo_insert:tipo_insert,
                  total_insert:total_insert
                },
                success:function(data){
                    alert(data);
                }
                });
                
              }
              else
              {
                alert("Tienes que ingresar al menos 1 producto en la orden.");
              }
      }

    $('#grabar_op').click(function(){

        encabezado();
        detalle();
        location.href = "../views/ordenes.php";   
  });
  });

    </script>
