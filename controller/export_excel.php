<?php


require '../database/database_1.php';


/*******EDIT LINES 3-8*******/
$rut = $_GET['rut'];
$tipo = $_GET['tipo'];
$periodo = $_GET['periodo'];
$filename = "ExportMetas";         //File Name
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    
//create MySQL connection  
if($tipo == 'reponedor')
{
    $sql = "Select Ano, Mes, Kam1, NombreVendedor, NomSup, NomReponedor, Cliente, RutCliente, Sucursal, Kam2, Linea, round(Meta, 2) as Meta, round(Avance,2) as Avance  from tbl_metasbi_oficina where RutRepo = '$rut' and  Proceso = '$periodo'";
}else if ($tipo == 'supervisor')
{
    $sql = "Select Ano, Mes, Kam1, NombreVendedor, NomSup, NomReponedor, Cliente, RutCliente, Sucursal, Kam2, Linea, round(Meta, 2) as Meta, round(Avance,2) as Avance  from tbl_metasbi_oficina where RutSup = '$rut' and  Proceso = '$periodo'";
}else if ($tipo == 'vendedor')
{
    $sql = "Select Ano, Mes, Kam1, NombreVendedor, NomSup, NomReponedor, Cliente, RutCliente, Sucursal, Kam2, Linea, round(Meta, 2) as Meta, round(Avance,2) as Avance  from tbl_metasbi_oficina where RutVendedor = '$rut' and  Proceso = '$periodo'";
}else if ($tipo == 'administrador')
{
    $sql = "Select Ano, Mes, Kam1, NombreVendedor, NomSup, NomReponedor, Cliente, RutCliente, Sucursal, Kam2, Linea, round(Meta, 2) as Meta, round(Avance,2) as Avance  from tbl_metasbi_oficina where Proceso = '$periodo'";
}


$setRec = mysqli_query($conn, $sql);  
$columnHeader = '';  
$columnHeader = "Ano" . "\t" . "Mes" . "\t" . "Kam1" . "\t". "NombreVendedor" . "\t". "NomSup" . "\t". "NomReponedor" . "\t". "Cliente" . "\t". "RutCliente" . "\t". "Sucursal" . "\t". "Kam2" ."\t". "Linea" . "\t". "Meta" . "\t". "Avance" . "\t";  
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
header("Content-Disposition: attachment; filename=ReporteMetas.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  
echo ucwords($columnHeader) . "\n" . $setData . "\n";  

?>