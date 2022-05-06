<?php

require ('../database/database_1.php');



$query = "SELECT distinct RutRepo from tbl_bonos_reponedor";


$resultado = mysqli_query($conn, $query);

	while($row = mysqli_fetch_row($resultado)){

		 echo "<script>window.open('../views/pdf/reporte_bonosr.php?id=".$row[0]."', '_blank'); window.open('../views/impresion_masiva.php'); </script>";
			
	}

echo "<script>window.close();</script>";


?>