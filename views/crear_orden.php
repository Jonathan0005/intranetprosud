<?php
error_reporting(-1);

  session_start();

  require '../database/database_1.php';
  require '../controller/diashabiles.php';

  $valida_id = $_SESSION['user_id'];
  



  if(isset($valida_id)) {
 
    $query = "SELECT concat(nombre,' ',apellido_p) as user_nom, DiasDespacho  FROM users WHERE RUT = '$valida_id' LIMIT 1";
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
$cliente = "SELECT distinct cliente from vw_clientes_sap ";
$cliente_result = mysqli_query($conn, $cliente);

$estado_act = "SELECT flag FROM tbl_actualizacion_oficina";
$estado_act_result = mysqli_query($conn, $estado_act);

$rows_estado = mysqli_fetch_row($estado_act_result);

$estado_actua = $rows_estado[0];


$lineas = "SELECT distinct codigolinea_text from tbl_material_sap";
$lineas_result = mysqli_query($conn, $lineas);
$fecha_desp_2 = sumasdiasemana(date("Y-m-d"), $row[1]);
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intranet Prosud | Crear Orden</title>
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
        <i class="fa fa-edit"></i> Crear orden
        <small>editar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">OP Web</a></li>
        <li class="active">Crear Orden</li>
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
              <h3 class="box-title"> <i class="fa fa-file"></i> Detalle Orden de Pedido</h3>
              <form role="form">
              <div class="box-body">
                <div class="col-md-4">
                  <label>Seleccionar Cliente  (*)</label>
                   <select class="form-control select2" style="width: 100%;" id="cliente">
                    <option value='0'>Seleccionar Cliente</option>
                    <?php 
                            while ($rows = mysqli_fetch_row($cliente_result))
                            {
                              ?><option value="<?php echo utf8_encode($rows[0])?>"><?php echo utf8_encode($rows[0])?></option>
                          <?php }
                          
                          ?>
                  </select>
                </div>
                  <div class="col-md-4">
                  <label>Seleccionar Sucursal (*)</label>
                   <select class="form-control select2" style="width: 100%;" id="sucursal">
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Fecha de O.P.</label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="fecha_op" value="<?php echo date("d/m/Y") ?>" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask  disabled>
                </div>
                </div>
              <div class="col-md-4">
                  <label>Seleccionar forma de pago (*)</label>
                   <select class="form-control select2" style="width: 100%;" name="formapago" id="formapago">
                    <!--Logica Seleccion forma de pago-->
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Seleccionar Tipo de Medida (*)</label>
                   <select class="form-control select2" style="width: 100%;" name="tipomedida" id="tipomedida">
                    <!--Logica Seleccion Unidad de Medida-->
                  </select>
                </div>
                <div class="col-md-4">
                  <label>Seleccionar Area de Venta (*)</label>
                   <select class="form-control select2" style="width: 100%;" name="areaventa" id="areaventa">
                    <!--Logica Seleccion Unidad de Medida-->
                  </select>
                </div>

                </div>
              <!-- /.box-body -->
              <div class="pull-right">
                <div clas="col-md-2">
                  <button type="button" class="btn btn-block btn-success btn-flat" id="modal_show"><i class="fa fa-cart-plus"></i> Agregar Producto</button>
                </div>
              </div>
               <br></br>
               <div class="form group">
                 <table id="op_detalle" class="table table-bordered table-striped" style="width:100%">  
                                     <thead>
                                        <tr>
                                        <th>Descripcion del Producto</th>
                                        <th>U.M</th>
                                        <th>Cantidad</th>
                                        <th>Precio Neto Caja</th>
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
                  <td><div id="total_neto"></div></td>
                </tr>
                <tr>
                  <td>IVA</td>
                  <td><div id="total_iva"></div></td>
                </tr>
                <tr>
                 <td>Impto. Adicional</td>
                 <td><div class='col-md-12>'><div id="total_adicional"></div></div></td>
                </tr>
                <tr>
                 <td><label>Total General</label></td>
                 <td><div id="total_general"></div></td>
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
                  <div id="div_direccion"></div>
                </div>
                <div class="col-md-6">
                  <label>Observacion</label>
                  <input type="text" class="form-control" id="observacion_op" placeholder="">
                </div>
                <br></br>
                <div class="col-md-6">
                <label>Fecha de Despacho</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="fecha_despacho_op" value="<?php echo $fecha_desp_2 ?>"  data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
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
                <button type="button" class="btn btn-primary" id="grabar_op"><i class="fa fa-save"></i> Grabar Pedido</button>
                <button type="button" class="btn btn-info" id="limpiar_op"><i class="fa fa-refresh"></i> Limpiar</button>
              </div>
            </form>                              
            </div>
            </div>
          </div>

    </section>
    <!-- Modal -->
<div class="modal fade" id="modal_agregar_producto" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><i class="fa fa-cart-plus"></i> Agregar Productos</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="box-body">
           <div class="col-md-4">
                  <label>Seleccionar Linea (*)</label>
                   <select class="form-control select2" style="width: 100%;" id="linea_select" name="linea_select">
                    <option value='0'>Seleccionar Linea</option>
                                        <?php 
                            while ($rows_lineas = mysqli_fetch_row($lineas_result))
                            {
                              ?><option value="<?php echo $rows_lineas[0]?>"><?php echo $rows_lineas[0]?></option>
                          <?php }
                          
                          ?>
                  </select>
                </div>
            <div class="col-md-4">
                  <label>Seleccionar Producto (*)</label>
                   <select class="form-control select2" style="width: 100%;" id="producto_select" name="producto_select">
                    
                  </select>
                </div>
            <div class="col-md-4">
                  <label>Cantidad (*)</label>
                  <input type="number" class="form-control" id="cantidad_pro" name="cantidad_pro" >
                </div>
            <div class="col-md-4">
                  <label>Tipo Descuento</label>
                  <select class="form-control select2" style="width: 100%;" id="descuento_select" name="descuento_select">
                  <option value="0">Seleccione Descuento</option>
                  <option value="1">PRUEBA</option>
		  <option value="2">PROMOCIONES</option>
                  <option value="3">PRONTO VENCIMIENTO</option>
                  <option value="4">SOBRESTOCK</option>
                  <option value="5">VOLUMEN</option>
                  <option value="6">MERMA</option>
		  <option value="7">DESCUENTO FIJO</option>
                  </select>
                </div>
            <div class="col-md-4">
                  <label>Porcentaje Dscto.</label>
                  <input type="number" class="form-control" id="descuento_pro" name="descuento_pro" placeholder="">
                </div>
                <br></br>
                       <br></br>
                              <br></br>
                               <br></br>

                <buton type="button" name="agregar" id="agregar" class="btn btn-block btn-primary"><i class="fa fa-plus"></i> Agregar Producto</buton>
              </div>
              </form>
              <br>
                                    <table id="Productos" class="table table-bordered table-striped">  
                                     <thead>
                                        <tr>
                                        <th>Linea</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Tipo Dscto.</th>
                                        <th>% Dscto.</th>
                                        <th>Acciones</th>
                                       </tr>
                                      </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                            
                                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="guardar" name="guardar"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
</div>
  <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Actualizacion en Curso</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p><b>Actualizacion de Datos Maestros</b> Si estas viendo este mensaje, es por que se encuentra la actualizacion de datos en curso, intente crear su OP mas tarde.
</p>

<p>Saludos.</p>
                    </div>
                    <div class="modal-footer">Tienes alguna consulta? Envianos un correo <a href="mailto:sos@prosud.cl">Mail IT Prosud</a></div>
                </div>
            </div>
        </div>

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
         <?php if($estado_actua == 1){ ?>
                  $('#myModal').modal('toggle')
         <?php }?>
        $("#div_direccion").html('<input type="text" class="form-control" id="direccion_op" placeholder="" value="" disabled>');
        $("#total_adicional").html("<input type='text' class='form-control' value='' id='impto' disabled>");
        $("#total_neto").html("<input type='text' class='form-control' value='' id='neto' disabled>");
        $("#total_iva").html("<input type='text' class='form-control' value='' id='iva' disabled>");
        $("#total_general").html("<input type='text' class='form-control' value='' id='general' disabled>");


           var cliente_val = "";
           $("#cliente").change(function(){
            cliente_val = $(this).children("option:selected").val();
            });

            var formapago_valida = "";
           $("#formapago").change(function(){
            formapago_valida = $(this).children("option:selected").val();
            });

            var tipomedida_valida = "";
           $("#tipomedida").change(function(){
            tipomedida_valida = $(this).children("option:selected").val();
            });


         $('#modal_show').click(function(){
                  if(cliente_val != "" && formapago_valida != "" && tipomedida_valida != ""){
                  $("#modal_agregar_producto").modal("show");
                  }
                  else 
                  {
                    Swal.fire({
                    icon: 'error',
                    title: 'Atencion por Favor',
                    text: 'Favor ingresar todos los datos del Cliente.',
                    footer: '<a href="mailto:sos@prosud.cl">Tienes Problemas, Envianos un Correo</a>'
                  })
                  }

         });

        var dataTable = $('#Productos').DataTable( {
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

  var linea_grilla;
  var prod_grilla;
  var tipo_grilla = '';
  var cant_grilla = '0';
  var dscto_grilla = '0';

  var count = 1;
  $('#agregar').click(function(){
  if(linea_grilla != 'Seleccionar Linea' && cant_grilla != '0'){
  $('#le').prop('selectedIndex',0);
   count = count +1;
   var html = "<tr id='row"+count+"'>";
   html += "<td id='data1' readonly='readonly' class='linea_detalle'>"+linea_grilla+"</td>";
   html += "<td id='data2' readonly='readonly' class='producto_detalle'>"+prod_grilla+"</td>";
   html += "<td id='data3' readonly='readonly' class='cantidad_detalle'>"+cant_grilla+"</td>";
   html += "<td id='data4' readonly='readonly' class='tipo_detalle'>"+tipo_grilla+"</td>";
   html += "<td id='data5' readonly='readonly' class='dscto_detalle'>"+dscto_grilla+"</td>";
   html += "<td><button type='button' name='remove' data-row='row"+count+"' class='btn btn-danger btn-xs remove'>Eliminar</button></td>"; 
   html += '</tr>';
   $('#Productos tbody').prepend(html);
   $('input[name="cantidad_pro"]').val('0');
   $('input[name="descuento_pro"]').val('0');
   $("#linea_select").select2("val", "0");
   $("#descuento_select").select2("val", "0");
   linea_grilla = '';
   prod_grilla = '';
   tipo_grilla = '';
   cant_grilla = '0';
   dscto_grilla = '0';
 }
 else 
 {

  Swal.fire({
                    icon: 'error',
                    title: 'Atencion por Favor',
                    text: 'Favor ingresar producto y su respectiva cantidad para agregar',
                    footer: '<a href="mailto:sos@prosud.cl">Tienes Problemas, Envianos un Correo</a>'
                  })

 }
  }); 


  $(document).on('click', '.remove', function(){
  var delete_row = $(this).data("row");
  $('#' + delete_row).remove();
 });

  $("#linea_select").change(function(){
        linea_grilla = $(this).children("option:selected").val();
  });
  $("#producto_select").change(function(){
        prod_grilla = $(this).children("option:selected").val();
  });
  $("#descuento_select").change(function(){
        tipo_grilla = $(this).children("option:selected").val();
  });
   $("#cantidad_pro").change(function(){
        cant_grilla = $(this).val();
  });
   $("#descuento_pro").change(function(){
        dscto_grilla = $(this).val();
  });


});

</script>
 <script>
      $(document).ready(function(){
        var cli; 
        $("#cliente").change(function () {
          $("#cliente option:selected").each(function () {
            cliente_select = $(this).val();
            cli = cliente_select;
            $.post("../controller/getSucursal.php", { cliente_select: cliente_select }, function(data){
              $("#sucursal").html(data);
            }); 
            $.post("../controller/getAreaVenta.php", { cliente_select: cliente_select }, function(data){
              $("#areaventa").html(data);
            });           
          });
        })
        
        $("#cliente").change(function () {
          $("#cliente option:selected").each(function () {
            cliente_select = $(this).val();
            cli = cliente_select;
            $.post("../controller/getUnidadMedida.php", { cliente_select: cliente_select }, function(data){
              $("#tipomedida").html(data);
            });            
          });
        })
        
        $("#sucursal").change(function () {
          $("#sucursal option:selected").each(function () {
            sucursal_select = $(this).val();
            $.post("../controller/getFormaPago.php", { cli: cli, sucursal_select: sucursal_select }, function(data){
              $("#formapago").html(data);
            });
              $.post("../controller/getDireccion.php", { cli: cli, sucursal_select: sucursal_select }, function(data){
              $("#div_direccion").html(data);
            });          
          });
        })
      $("#linea_select").change(function () {
          $("#linea_select option:selected").each(function () {
            linea_select = $(this).val();
            $.post("../controller/getProducto.php", { cli: cli, linea_select: linea_select }, function(data){
              $("#producto_select").html(data);
            });            
          });
        })
      });


    </script>
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

    $(document).ready(function() {
        $("#cliente_select").change(function(){
        cliente_select = $(this).children("option:selected").val();
        });
        $("#tipomedida").change(function(){
        medida_select = $(this).children("option:selected").val();
        });
        $("#areaventa").change(function(){
        area_select = $(this).children("option:selected").val();
        });


      $('#guardar').click(function(){
          Swal.fire({
          title: 'Estas Seguro?',
          text: "De agregar estos productos!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Estoy Seguro!'
            }).then((result) => {
              if (result.value) {
                var table = $('#op_detalle').DataTable();
                table.clear().draw();

                var linea_arr = [];
                var producto_arr = [];
                var cantidad_arr = [];
                var tipo_arr = [];
                var dscto_arr = [];
                $('.linea_detalle').each(function(){
                linea_arr.push($(this).text());
                });
                $('.producto_detalle').each(function(){
                producto_arr.push($(this).text());
                });
                $('.cantidad_detalle').each(function(){
                cantidad_arr.push($(this).text());
                });
                $('.tipo_detalle').each(function(){
                tipo_arr.push($(this).text());
                });
                $('.dscto_detalle').each(function(){
                dscto_arr.push($(this).text());
                });

                if(linea_arr != '' && producto_arr != '' && cantidad_arr != '') {
                $.ajax({
                url:"../controller/getProductosSetDetalle.php",
                method:"POST",
                data:{linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select},
                success:function(data){
                $.post("../controller/getProductosSetDetalle.php", {linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select, area_select: area_select}, function(html){
                $('#op_detalle tbody').prepend(html);
                  });
                $.post("../controller/getTotalNeto.php",{linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select}, function(total_neto){
                $("#total_neto").html(total_neto);
                  }); 
                $.post("../controller/getTotalIva.php",{linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select}, function(total_iva){
                $("#total_iva").html(total_iva);
                  });                  
                $.post("../controller/getTotalAdic.php",{linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select }, function(total_impto){
                $("#total_adicional").html(total_impto);
                  });                  
                $.post("../controller/getTotalGeneral.php",{linea_arr:linea_arr, producto_arr:producto_arr, cantidad_arr:cantidad_arr, tipo_arr:tipo_arr, dscto_arr:dscto_arr, cliente_select:cliente_select, medida_select: medida_select}, function(total_total){
                $("#total_general").html(total_total);
                  });                                   
                  }
                });
                Swal.fire(
                  'Productos Agregados',
                  'Cerrar Ventana Emergente',
                  'success'
                )
                }
                else{
                  Swal.fire({
                    icon: 'error',
                    title: 'Atencion por Favor',
                    text: 'Favor ingresar al menos 1 producto antes de Guardar',
                    footer: '<a href="mailto:sos@prosud.cl">Tienes Problemas, Envianos un Correo</a>'
                  })
                }
              }
            })
        });
      });
    </script>
    <script>
    $(document).ready(function(){

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
        var general_insert=$("#general").val();
        var um_insert=$("#tipomedida").val();	
	var solicitante = '<?php echo $valida_id ?>';



          $.ajax({
                    url:'../controller/setEncabezadoOP.php',
                    method:'POST',
                    data:{
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
                        general_insert:general_insert,
                        um_insert:um_insert,
			solicitante: solicitante
                    },
                   success:function(data){

                  Swal.fire({
                  icon: 'success',
                  title: 'OP Ingresada correctamente',
                  showConfirmButton: false,
                    })

              
                            detalle();
                    
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

                $('.tipo_pri').each(function(){
                tipo_insert.push($(this).text());
                });

                $('.total_pri').each(function(){
                total_insert.push($(this).text());
                });
                if (producto_insert != ''){
                $.ajax({
                url:"../controller/setDetalleOP.php",
                method:"POST",
                data:{
                  producto_insert:producto_insert,
                  cantidad_insert:cantidad_insert,
                  precio_insert:precio_insert,
                  subtotal_insert:subtotal_insert,
                  descuento_insert:descuento_insert,
                  tipo_insert: tipo_insert,
                  total_insert:total_insert
                },
                success:function(data){
                   // alert(data);
                }
                });
                location.reload();
              }
              else
              {
                Swal.fire({
                    icon: 'error',
                    title: 'Atencion por Favor',
                    text: 'Tienes que ingresar al menos 1 producto en la orden.',
                    footer: '<a href="mailto:sos@prosud.cl">Tienes Problemas, Envianos un Correo</a>'
                  })
              }
      }

    $('#grabar_op').click(function(){

        encabezado();  
  });

  
  $('#limpiar_op').click(function(){
    location.reload();

  });
  });

    </script>