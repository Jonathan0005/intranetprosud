<script type="text/javascript">
<!--
function FP_swapImg() {//v1.0
 var doc=document,args=arguments,elm,n; doc.$imgSwaps=new Array(); for(n=2; n<args.length;
 n+=2) { elm=FP_getObjectByID(args[n]); if(elm) { doc.$imgSwaps[doc.$imgSwaps.length]=elm;
 elm.$src=elm.src; elm.src=args[n+1]; } }
}

function FP_preloadImgs() {//v1.0
 var d=document,a=arguments; if(!d.FP_imgs) d.FP_imgs=new Array();
 for(var i=0; i<a.length; i++) { d.FP_imgs[i]=new Image; d.FP_imgs[i].src=a[i]; }
}

function FP_getObjectByID(id,o) {//v1.0
 var c,el,els,f,m,n; if(!o)o=document; if(o.getElementById) el=o.getElementById(id);
 else if(o.layers) c=o.layers; else if(o.all) el=o.all[id]; if(el) return el;
 if(o.id==id || o.name==id) return o; if(o.childNodes) c=o.childNodes; if(c)
 for(n=0; n<c.length; n++) { el=FP_getObjectByID(id,c[n]); if(el) return el; }
 f=o.forms; if(f) for(n=0; n<f.length; n++) { els=f[n].elements;
 for(m=0; m<els.length; m++){ el=FP_getObjectByID(id,els[n]); if(el) return el; } }
 return null;
}
// -->
</script>
<? 



$tipo = $_GET['TIPO'];



if ($tipo == 0)

{

	$codKAM=" and CodigoKAM = '" . $_GET['KAM'] . "' ";

	$campo="CodigoKAM";

};



$countryId=$_GET['KAM'];

$stateId=$_GET['CLI'];



$link = mysql_connect('localhost', 'root', '');



if (!$link) {

    die('Could not connect: ' . mysql_error());

}

mysqli_select_db('oficinaprosud_appsprosud');

$query="SELECT CONCAT(MesPalabra, '_', DoctAno) as Periodo, CONCAT(MesPalabra, ' ', DoctAno) as VPeriodo,tipo FROM Meses order by doctano desc, DoctMes desc;";

$result=mysql_query($query);





?>

<body onload="FP_preloadImgs(/*url*/'../../images/button4.jpg',/*url*/'../../images/button5.jpg')">

<span class="css3-metro-dropdown css3-metro-dropdown-color-353526">

<select id="perifecha" name="perifecha" onchange="carga(this.value,7);" >

<option>Periodo</option>

<? while($row=mysql_fetch_array($result)) { ?>

<option value=<?=$row['Periodo'].'|'.$row['tipo'] ?>><?=$row['VPeriodo']?></option>

<? } ?>

</select>

</span>

<br><a href="javascript:self.location.reload();">
<img id="reinicio" alt="Reiniciar Filtros" fp-style="fp-btn: Border Bottom 1" fp-title="Reiniciar Filtros" height="20" onmousedown="FP_swapImg(1,0,/*id*/'img1',/*url*/'../../images/button5.jpg')" onmouseout="FP_swapImg(0,0,/*id*/'img1',/*url*/'../../images/button3.jpg')" onmouseover="FP_swapImg(1,0,/*id*/'img1',/*url*/'../../images/button4.jpg')" onmouseup="FP_swapImg(0,0,/*id*/'img1',/*url*/'../../images/button4.jpg')" src="../../images/button3.jpg" style="border: 0; visibility: hidden;" width="100"></a>
