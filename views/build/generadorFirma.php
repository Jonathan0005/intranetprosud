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
$cliente = "SELECT distinct descripcion from clientes2 where trim(emplrutf) = trim('$valida_id')";
$cliente_result = mysqli_query($conn, $cliente);

$lineas = "SELECT lpronombre from lineas";
$lineas_result = mysqli_query($conn, $lineas);
?>

<!DOCTYPE html>

<html ng-app="kitdigital" >

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  <title>AppsProsud | Generador Firma</title>
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

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <!-- <link rel="stylesheet" href="../assets/css/main.css"> -->
  <script src="../ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script> 

  <script>

    var myapp;
    myApp = angular.module('kitdigital', []);

    myApp.config(function ($interpolateProvider) {    
       return  $interpolateProvider.startSymbol('[[').endSymbol(']]');
      });

document.addEventListener('DOMContentLoaded', () => {
    for (const el of document.querySelectorAll("[placeholder][data-slots]")) {
        const pattern = el.getAttribute("placeholder"),
            slots = new Set(el.dataset.slots || "_"),
            prev = (j => Array.from(pattern, (c,i) => slots.has(c)? j=i+1: j))(0),
            first = [...pattern].findIndex(c => slots.has(c)),
            accept = new RegExp(el.dataset.accept || "\\d", "g"),
            clean = input => {
                input = input.match(accept) || [];
                return Array.from(pattern, c =>
                    input[0] === c || slots.has(c) ? input.shift() || c : c
                );
            },
            format = () => {
                const [i, j] = [el.selectionStart, el.selectionEnd].map(i => {
                    i = clean(el.value.slice(0, i)).findIndex(c => slots.has(c));
                    return i<0? prev[prev.length-1]: back? prev[i-1] || first: i;
                });
                el.value = clean(el.value).join``;
                el.setSelectionRange(i, j);
                back = false;
            };
        let back = false;
        el.addEventListener("keydown", (e) => back = e.key === "Backspace");
        el.addEventListener("input", format);
        el.addEventListener("focus", format);
        el.addEventListener("blur", () => el.value === pattern && (el.value=""));
    }
});


  </script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php 
    require_once('../layout/header.php');
?>  

<?php 
    require_once('../layout/aside_lateral.php');
?>  

<style>
input:invalid {
    background-color: rgb(223, 189, 196);
}                    

input:invalid+span:after {
    content: '✖ - Formato incorrecto, Ej: +560 0000 00 00';
    padding-left: 5px;
    color:red;
}
[data-slots] { font-family: monospace }
</style>

 <div class="content-wrapper">

       <div align="center" class="container" style="padding-bottom:10px;"  >       
     
        <h3 class="h2 text-center white" style="font-weight: bolder;">Generador de <strong>firma</strong></h3>
        <br>
        <div style="width: 450px; " >
      <form  id="FormularioCorreo" name="DatosCorreo" >

        <div class="form-group row" >
          <label for="inputPassword1" class="col-sm-2 col-form-label" style="font-weight: bolder;">Nombre:</label>
          <div class="col-sm-10" align="left">
            <input type="text"   class="form-control" ng-model="nombre" name= "nombre" id="nombre" placeholder="Ingresa tu nombre completo">
          </div>
        </div>

          <div class="form-group row">
            <label for="inputPassword2" class="col-sm-2 col-form-label"  style="font-weight: bolder;">Cargo:</label>
            <div class="col-sm-10"  >
              <input  type="text"  class="form-control" ng-model="cargo" name="cargoname" placeholder="Ingresa tu cargo" >
            </div>
          </div>

          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label" style="font-weight: bolder;">Telefono:</label>
            <div class="col-sm-10">
              <input type="text" name="tel" data-slots="_"  class="form-control"  ng-model="tel"  id="tel" placeholder="+56_ ____ __ __">
              <span class="validity"></span>
            </div>
            
          </div>

          <div class="form-group row " >
            <label for="inputPassword4" class="col-sm-2 col-form-label" style="font-weight: bolder;">Celular:</label>
            <div class="col-sm-10">
              <input type="text" name="cel"  class="form-control" maxlenght="12" ng-model="tel2" id="cel" data-slots="_" placeholder="+56_ ____ __ __">
              <span class="validity"></span>
              
            </div>
          </div>
          
        </form>
       
        </div>
<div>
<hr class="mt-5 mb-5">
        
        <ul class="ul" style="font-family: Arial, Helvetica, sans-serif; font-size: medium; " >
          <p > 1. Seleccione la firma generada.</p>
          <p >2. Haz click derecho sobre la selección y seleccione “copiar”</p>
          <p >3. Diríjase a la configuración de su mail (Archivo > Opciones > Correo > Firma).</p>
          <p >4. Haga click derecho sobre el cuadrado para Editar firma y selecione pegar".​</p>
          <p >5. En caso de presentar un problema comunicarse con soporte informática: <strong>soporte@prosud.cl</strong>.​</p>
        </ul>
        <!-- <img src="img/imgGeneradorCorreo/instr.png" width="250" height="150" style="border-width:5px; border-style:double;"> -->
        <!-- <p></p> -->
  
</div>

<hr class="mt-5 mb-5">
<div  style=" margin:auto; background-color: white; border-radius: 20px; height: 230px;  width: 469px;padding: 20px; border-style: dotted; color: #062244;">
        <table  >
          <tr > 
            <td><img src="img/imgGeneradorCorreo/logo6.png" >
            </td>
  
            <td align="left"style="width:20px; " >
            <img src="img/imgGeneradorCorreo/line2.png"  ></td>
      
<td align="left" style="width:235px;" >

      <strong id="nombrefirma" style="font-family: calibri;">[[nombre  || "Nombre Completo"]]</strong><br>
        <strong  id="cargo" style="font-family: calibri;">[[cargo || "Cargo"]]</strong><br>
        <img src="img/imgGeneradorCorreo/tel2.png" width="15" height="15"><span id="telnum" style="font-family: calibri;"> Tel. [[tel]]</span><br>
        <img src="img/imgGeneradorCorreo/cell2.png" width="15" height="15"><span id="celnum" style="font-family: calibri;">Cel. [[tel2]]</span> <br> 
        <img src="img/imgGeneradorCorreo/web2.png"  width="15" height="15"><a href="https://www.prosud.cl" style="font-family: calibri;">  www.<strong >prosud</strong>.cl</a><br>
        Lautaro 2102-D, Quilicura
       
      </td>
          </tr>    
      
            <tr >
            <td colspan="3" style="height:70px; ">         
            <img src="img/imgGeneradorCorreo/firma2.png" width=419 height=50></td>
          </tr>
        </table>

      </div>

      </div>    

</div>   
 
  <?php 
    require_once('../layout/footer.php');
?>  

<?php 
    require_once('../layout/aside_final.php');
?>

  <div class="control-sidebar-bg"></div>


<!-- ./wrapper -->
<script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

</body>

</html>

