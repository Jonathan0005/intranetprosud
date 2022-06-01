<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

require './database/database_1.php';

$usuario_ = $_POST['campo_usuario'];
$pass = $_POST['campo_pass'];

$query_alerta = "select alerta_flag, alerta_texto from tbl_alertas_prosud"; 
$r_alertas = mysqli_query($conn, $query_alerta);
$row_alertas=mysqli_fetch_row($r_alertas);
$flag = $row_alertas[0];   
$texto = $row_alertas[1]; 

if(!empty($usuario_) && !empty($pass)) {
  $query = "SELECT u.RUT, u.email , u.CodEmpleado , a.IdPerfil , u.password , concat(u.nombre,' ',u.apellido_p) as user_nom ,p.NombrePerfil , u.usuario FROM users as u INNER JOIN tbl_perfil_usuario as a on u.RUT  = a.IdRut  INNER JOIN tbl_perfil p on a.IdPerfil = p.IdPerfil WHERE u.usuario = '$usuario_' and u.password = '$pass' LIMIT 1 ";
  $results = mysqli_query($conn, $query);
  $message = '';

  while ($row = mysqli_fetch_row($results)){

	$valida_id = $row[0];
  $valida_user = $row[1];
	$codigo= $row[2];
	$tipo= $row[3];
  $valida_pass = $row[4];
	$nombre = $row[5];
	$nomperfil = $row[6];
  $usuario = $row[7];


  }


    if (!empty($valida_id) && $usuario_ = $usuario && $pass = $valida_pass  ) {
  $_SESSION['user_id'] = $valida_id;
	$_SESSION['codigo'] = $codigo;
	$_SESSION['tipo'] = $tipo;
	$_SESSION['nombre'] = $nombre;
	$_SESSION['nomperfil'] = $nomperfil;
	$_SESSION['usuario'] = $usuario ;
	$_SESSION['valida_pass'] = $valida_pass ;

    header("Location: ./views/inicio.php");
    } else {
            echo"<script>alert('Credenciales no coicinden, favor intentelo nuevamente')</script>";
}
} ?>

<!DOCTYPE html>
<html>
<head><meta charset="gb18030">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="views/img/logo.png">
  <title>Intranet Prosud | Log in </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->

   
   
     <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
  
  
    <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

 
  <!-- iCheck -->


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green sidebar-collapse sidebar-mini login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index.php"><img src="logo.png" alt="logo" width="80%"></a>
  </div>
  <!-- /.login-logo -->
  <div id="back"></div>
  
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar Sesión - Intranet Prosud</p>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" >
      <div class="form-group has-feedback">
        <input type="textdomain" class="form-control" placeholder="Ingrese Usuario" name="campo_usuario">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Ingrese Contraseña" name="campo_pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          </div>
        </div>
        <!-- /.col -->
        <div class="box-footer">
		<button type="submit" class="btn btn-info pull-right">Acceder</button>
         <a  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Recuperar Contraseña</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
	
	
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario de Recuperación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="formularioContacto" method="post" action="correo.php" class="form-style-1 placeholder-1">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Ingrese su correo:</label>
            <input type="mail" class="form-control" id="recipient-name" placeholder="correo@prosud.cl"  name="campo_email" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
        <button  class="btn btn-primary">Enviar Correo</button>
      </div>
	  
	  </form>
    </div>
  </div>
</div>
	 
	

  </div>
  <!-- /.login-box-body -->
</div>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-login">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Alertas Prosud</h4>
                    </div>
                    <div class="modal-body">

    <p><b>Alertas</b></p>
    <p><?php echo $texto; ?></p>

                    </div>
                    <div class="modal-footer">Tienes alguna consulta? Envianos un correo <a href="mailto:sos@prosud.cl">Mail IT Prosud</a></div>
                </div>
            </div>
        </div>


</body>

</html>
<script>
$( document ).ready(function() {
  var flag = "<?php echo $flag; ?>";
  if(flag == "1")
  {
  $('#myModal').modal('toggle')
  }
});
</script>
