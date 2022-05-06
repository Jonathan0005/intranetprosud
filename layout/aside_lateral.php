<?php
error_reporting(-1);

  

  require '../database/database_1.php';


  
   $valida_id = $_SESSION['user_id'];
  $tipo    = $_SESSION['tipo'];
  $nombre  = $_SESSION['nombre'];
  $nomperfil  = $_SESSION['nomperfil'];
  $usuario  = $_SESSION['usuario'];
  $valida_pass   = $_SESSION['valida_pass'];
  
  


  if(isset($valida_id) ) {
 
    $query = "select concat(u.nombre,' ',u.apellido_p) as user_nom, p.IdPerfil as ID ,p.NombrePerfil as perfil , ap.NombreAplicacion as nombre , f.NombreFuncion , f.Ruta_Aplicacion , ap.LogoAplicacion  from users as u INNER JOIN tbl_perfil_usuario as r on u.rut = r.idrut INNER JOIN tbl_perfil as p on r.IdPerfil = p.IdPerfil    
INNER JOIN tbl_aplicacion_perfil as a on r.IdPerfil =  a.IdPerfil INNER JOIN tbl_aplicacion as ap on a.IdAplicacion = ap.IdAplicacion  INNER JOIN tbl_funcion f on ap.IdAplicacion = f.IdAplicacion
 WHERE RUT = '$valida_id' 
 order by ap.NombreAplicacion asc  ";
	
    $results = mysqli_query($conn, $query);

		  
}
else 
{
session_destroy();
header("Location: ../index.php");
}
?>  
  
  
  
 
  
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nombre ?></p>
		   <p><?php echo $nomperfil   ?></p>
       
        </div>
      </div>
      <!-- search form -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Prosud TI</li>
		 <li > 
          <a href="../views/inicio.php" >
            <i class="fa fa-home"></i>
            <span>Inicio </span>
           
          </a>
         
        </li>
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Menu Aplicaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
 
		 	<?php 
		
		 $cMenu = "*";
		
		
		
		while ($row = mysqli_fetch_array($results)) {
	      	   
			   
			   
	    if($cMenu != $row['nombre']){

		?>

		 <li class="treeview">
          <a href="#">
            <i class="<?php echo $row['LogoAplicacion']?>"></i>
            <span><?php echo $row['nombre'] ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
		  
		  <?php 
		  
		  $cMenu = $row['nombre'];
		

		}
		
		
		 
		?>
		 <ul class="treeview">
								
		 
            <li><a href="<?php echo $row['Ruta_Aplicacion']?>"><i class="fa fa-circle-o"></i> <?php echo $row['NombreFuncion']?></a></li>



         </ul>
		

		

		<?php
		 
		 
		 
		 
		 
		
		}

		?>
   
        </li>
 
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
 
  
  
  
    
 
	

		
		
  

  