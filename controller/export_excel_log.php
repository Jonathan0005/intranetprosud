<?php


require '../database/database_1.php';


/*******EDIT LINES 3-8*******/
$filename = "Reporte_Log_Metas";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection  

    $sql = "SELECT a.usuario, concat(b.nombre,' ',b.apellido_p,' ',b.apellido_m) as nombre_usuario, a.acceso_modulo, a.fecha_hora FROM tbl_oficina_logs a inner join  users b on a.usuario = b.RUT
    where a.acceso_modulo = 'Metas - Reporte Metas'";

$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "usuario" . "\t" . "nombre_usuario" . "\t" . "acceso_modulo" . "\t". "fecha_hora" . "\t";  
$setData = '';  
 while ($rec = mysqli_fetch_row($setRec)) {  
    $rowData = '';  
    foreach ($rec as $value) {  
        $value = '"' . $value . '"' . "\t";  
        $rowData .= $value;  
    }  
    $setData .= trim($rowData) . "\n";  
}  
 
header("Content-type: application/octet-stream");  
header("Content-Disposition: attachment; filename=Reporte_Log_Metas.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  

?>