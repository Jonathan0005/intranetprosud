<?
$countryId=$_GET['country'];
$tipo = $_GET['TIPO'];

$link = mysqli_connect('localhost', 'root', '');
if (!$link) {
    die('Could not connect: ' . mysqli_error());
}
mysqli_select_db('oficinaprosud_appsprosud');

if ($tipo == 0)
{
	$campo="CodigoKAM";
};

if ($tipo == 1)
{
	$campo="CodigoKAM";
};

if ($tipo == 2)
{
	$campo="CodigoVendedor";
};

if ($tipo == 3)
{
	$campo="CodigoSupervisor";
};
if ($tipo == 4)
{
	$campo="CodigoReponedor";
};


$query="SELECT distinct  rut,relcnombre FROM metas_resumidas WHERE " . $campo . " ='$countryId' and  relcnombre <> '' order by relcnombre ASC";
//echo $query;
$result=mysql_query($query);



?>
<span class="css3-metro-dropdown css3-metro-dropdown-color-ff1d77">
<select name="state" onchange="getK2(<?=$countryId?>);getCity(<?=$countryId?>,this.value);getGrilla(<?=$countryId?>)" id="sel_cli">
<option>Cliente</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['rut']?>><?=$row['relcnombre']?></option>
<? } ?>
</select>
</span>