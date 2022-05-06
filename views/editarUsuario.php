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
<head><meta charset="euc-jp">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Intranet Prosud | Editar Usuario</title>
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
        Editar Usuario
        <small>Mantenedores</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Intranet Prosud</li>
      </ol>
    </section>
    <section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> <i class="fa fa-file"></i> Editar Usuario</h3>
              <?php
			// escaping, additionally removing everything that could be (html/javascript-) code
			$nik = mysqli_real_escape_string($conn,(strip_tags($_GET["nik"],ENT_QUOTES)));
			$sql = mysqli_query($conn, "SELECT a.nombre, a.apellido_p, a.apellido_m, a.email, a.RUT, a.usuario, a.password, b.IdPerfil  FROM users a left join  tbl_perfil_usuario b on a.RUT = b.IdRut  WHERE RUT='$nik'");
			if(mysqli_num_rows($sql) == 0){
				header("Location: MantenedorUsuarios.php");
			}else{
				$row = mysqli_fetch_assoc($sql);
			}
			if(isset($_POST['save'])){
				$RUT		     = mysqli_real_escape_string($conn,(strip_tags($_POST["RUT"],ENT_QUOTES)));//Escanpando caracteres 
				$nombre		     = mysqli_real_escape_string($conn,(strip_tags($_POST["nombre"],ENT_QUOTES)));//Escanpando caracteres 
				$apellido_p	 	 = mysqli_real_escape_string($conn,(strip_tags($_POST["apellido_p"],ENT_QUOTES)));//Escanpando caracteres 
				$apellido_m	     = mysqli_real_escape_string($conn,(strip_tags($_POST["apellido_m"],ENT_QUOTES)));//Escanpando caracteres 
				$email	         = mysqli_real_escape_string($conn,(strip_tags($_POST["email"],ENT_QUOTES)));//Escanpando caracteres 
				$usuario		 = mysqli_real_escape_string($conn,(strip_tags($_POST["usuario"],ENT_QUOTES)));//Escanpando caracteres 
				$password		 = mysqli_real_escape_string($conn,(strip_tags($_POST["password"],ENT_QUOTES)));//Escanpando caracteres 
				$IdPerfil		 = mysqli_real_escape_string($conn,(strip_tags($_POST["IdPerfil"],ENT_QUOTES)));//Escanpando caracteres 
				
				
				$update = mysqli_query($conn, "UPDATE users SET nombre='$nombre', apellido_p='$apellido_p', apellido_m='$apellido_m', email='$email', usuario='$usuario', password='$password' WHERE RUT='$nik'") or die(mysqli_error());
				$update2 = mysqli_query($conn, "UPDATE tbl_perfil_usuario SET IdPerfil='$IdPerfil' WHERE IdRut='$nik'") or die(mysqli_error());
				if($update && $update2){

					echo "<script>window.location.href='editarUsuario.php?nik=".$nik."&pesan=sukses'</script>";


				}else{
					echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Error, no se pudo guardar los datos.</div>';
				}
			}
			
			if(isset($_GET['pesan']) == 'sukses'){
				echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Los datos han sido guardados con éxito.</div>';
			}
			?>
			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<label class="col-sm-3 control-label">Rut</label>
					<div class="col-sm-2">
						<input type="text" name="RUT" value="<?php echo $row ['RUT']; ?>" class="form-control" placeholder="NIK" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-4">
						<input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellido Paterno</label>
					<div class="col-sm-4">
						<input type="text" name="apellido_p" value="<?php echo $row ['apellido_p']; ?>" class="form-control" placeholder="Apellido Paterno" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Apellido Materno</label>
					<div class="col-sm-4">
						<input type="text" name="apellido_m" value="<?php echo $row ['apellido_m']; ?>" class="form-control" placeholder="Apellido Materno" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Email</label>
					<div class="col-sm-4">
						<input type="text" name="email" value="<?php echo $row ['email']; ?>" class="form-control" placeholder="Email" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-4">
						<input type="text" name="usuario" value="<?php echo $row ['usuario']; ?>" class="form-control" placeholder="Usuario" required>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Contraseña</label>
					<div class="col-sm-3">
						
						<input type="text" name="password" value="<?php echo $row ['password']; ?>" class="form-control" placeholder="Contraseña" required>
					</div>
                    
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">Perfil</label>
					<div class="col-sm-3">
						<select name="IdPerfil" class="form-control">
							<option value="">- Selecciona estado -</option>
                            <option value="1" <?php if ($row ['IdPerfil']==1){echo "selected";} ?>>Administrador</option>
							<option value="2" <?php if ($row ['IdPerfil']==2){echo "selected";} ?>>Ventas</option>
							<option value="3" <?php if ($row ['IdPerfil']==3){echo "selected";} ?>>Base</option>
							<option value="4" <?php if ($row ['IdPerfil']==4){echo "selected";} ?>>Finanzas</option>
								<option value="5" <?php if ($row ['IdPerfil']==5){echo "selected";} ?>>Drivin</option>
						</select> 
					</div>
                   
                </div>
			
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="mantenedorUsuarios.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
			
		</div> 
        </div>
        </div>
        </div>

 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>


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
<script>
	$('.date').datepicker({
		format: 'dd-mm-yyyy',
	})
	</script>
</body>
</html>