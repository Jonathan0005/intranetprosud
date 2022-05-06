


<?php

require './database/database_1.php';

$email = $_POST['campo_email'];

if(!empty($email)) {
  $query = "SELECT RUT, password , concat(nombre,' ',apellido_p) as user_nom , usuario ,email FROM users where email = '$email'  LIMIT 1 ";
  $results = mysqli_query($conn, $query);
  $message = '';

  while ($row = mysqli_fetch_row($results)){

	$valida_id = $row[0];
	$valida_user = $row[1];
	$nombre = $row[2];
	$usuario = $row[3];
	$correo = $row[4];


  }
    if (!empty($email) && $email = $correo ) {
		
		
  $enviado = "soporte@oficina.prosud.cl";		
  $asunto = "Recuperacion de Contraseña";
  $bcc = "";


  $mensaje='<b>Recuperación de Contraseña</b>';	
  
  $mensaje=$mensaje . '<br> <br> <b> Estimad@ ' . $nombre.'</b>'  ;
  $mensaje=$mensaje . '<br> <br> <b> Le hacemos envio del detalle de sus credenciales : </b> <br>';
  $mensaje=$mensaje . '<br>Correo: ' . $email ;
  $mensaje=$mensaje . '<br>Usuario: ' . $usuario;
	$mensaje=$mensaje . '<br>Contraseña: ' . $valida_user ;
	$mensaje=$mensaje . '<br>Atte. Soporte Prosud. ';	

  $cabeceras .= 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
  $cabeceras .= 'From:' . $enviado . "\r\n" ;
  $cabeceras .= 'Reply-To:' . $email . "\r\n";
  $cabeceras .= 'Bcc: ' . $bcc . "\r\n";
  $cabeceras .= 'X-Mailer:PHP/' . phpversion();
  mail($correo, $asunto, $mensaje, $cabeceras);
  
		
	echo"<script>
    alert('Se realiza el envio de su contraseña');
    window.location.href='http://oficina.prosud.cl/';
    </script>";
		


    header("Location: ./views/inicio.php");
    } else {
            echo"<script>alert('El correo no encuentra registrado en nuestros sistemas, favor de comunicarse con el area de soporte...');
              window.location.href='http://oficina.prosud.cl/';</script>";
           
        
            
		
}
}


?>