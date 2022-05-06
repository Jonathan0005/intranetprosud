<?php
$con = mysqli_connect("localhost","prodea1","desarrollo","prodea1_cpfr")  or die ("Sin Conexion");

$sql = "select Año as Ano, Mes, Numero, FechaEntrega, OdocOC, FECHA_AGENDAMIENTO, CLASIFICACION_DEVOLUCION, CONVERT(CAST(CONVERT(COMENTARIO_DEVOLUCION USING latin1) AS BINARY) USING utf8) as COMENTARIO_DEVOLUCION, Cod_Producto, cajas, CajasPendientes, PrecioNetoTotFinal, PrecioUnitarioNeto, Sucursal, CONVERT(CAST(CONVERT(Nom_Producto USING latin1) AS BINARY) USING utf8) as Nom_Producto, LineaProducto, Nombre_CliProv from OPCPFR where RUT in (' 966185406', ' 81201000K' ,' 786272106' ,' 815376005',' 76042014K')";

$resul = mysqli_query($con, $sql);

while($row = mysqli_fetch_object($resul)){
   $datos[] = $row; 


}
echo json_encode($datos);
mysqli_close($con);
?>
