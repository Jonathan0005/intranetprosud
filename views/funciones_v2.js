function ver_XLS(countryId,stateId,k2Id,kId) 
{	
	var tipoId = window.sLevel=x;
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;
	
	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	var res = strf.split("|");
	
	if (res[1]==1){

		var strURL="baja_xls.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&SUC="+strsu+"&CLI="+strc;
		window.open(strURL, "_self", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
	}else{
		var strURL="baja_xls_cajas.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&SUC="+strsu+"&CLI="+strc;
	window.open(strURL, "_self", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
	}

	/*var strURL="baja_xls.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+strf+"&SUC="+strsu+"&CLI="+strc;
	window.open(strURL, "_self", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");*/
	
/*	
	var req = getXMLHTTP();

		
	if (req) {
		//alert(strURL);
		
		Shadowbox.open({
            content:    strURL,
            player:     "iframe",
            title:      "ProyecciÃ³n de Metas",
			loadingImage:"loading.gif",
			handleUnsupported:  'link',
			oversized: false,
			width: 1000,
			height: 600
})
	}
*/	
}

function verProyeccion(countryId,stateId,k2Id,kId) 
{	
	var tipoId = window.sLevel=x;
	var userId = window.sLevel=userid;
	
	var kam = document.forms["form1"].elements["country"].value;
	var vende = document.forms["form1"].elements["Svendedor"].value;
	var superv = document.forms["form1"].elements["Ssupervisor"].value;
	var repo = document.forms["form1"].elements["Sreponedor"].value;
	var cliId = document.forms["form1"].elements["state"].value;
	var sucId = document.forms["form1"].elements["city"].value;
	var kk2 = document.forms["form1"].elements["kamkam"].value;
	var fechaId = document.forms["form1"].elements["perifecha"].value;

	var res = fechaId.split("|");
	
	if (res[1]==1){
		var strURL="./grillaP.php?KAM="+res[0]+"&CLI="+cliId+"&SUC="+sucId+"&K2="+kk2+"&FECID="+res[0]+"&TIPO="+tipoId+"&VEND="+vende+"&SUP="+superv+"&REP="+repo+"&COD="+userId+"&K="+kam;
	}else{
		var strURL="./grilla_Cajas_proyeccion.php?KAM="+res[0]+"&CLI="+cliId+"&SUC="+sucId+"&K2="+kk2+"&FECID="+res[0]+"&TIPO="+tipoId+"&VEND="+vende+"&SUP="+superv+"&REP="+repo+"&COD="+userId+"&K="+kam;
	}


	
	var req = getXMLHTTP();

		
	if (req) {
		//alert(strURL);
		
		Shadowbox.open({
            content:    strURL,
            player:     "iframe",
            title:      "ProyecciÃ³n de Metas",
			loadingImage:"loading.gif",
			handleUnsupported:  'link',
			oversized: false,
			width: 1000,
			height: 600
})
	}
	
}


function getGrilla(countryId,stateId,k2Id,kId) {	
	
	var tipoId = window.sLevel=x;
	var userId = window.sLevel=userid;
	
	var kam = document.forms["form1"].elements["country"].value;
	var vende = document.forms["form1"].elements["Svendedor"].value;
	var superv = document.forms["form1"].elements["Ssupervisor"].value;
	var repo = document.forms["form1"].elements["Sreponedor"].value;
	var cliId = document.forms["form1"].elements["state"].value;
	var sucId = document.forms["form1"].elements["city"].value;
	var kk2 = document.forms["form1"].elements["kamkam"].value;
	var fechaId = document.forms["form1"].elements["perifecha"].value;

	var res = fechaId.split("|");
	
	if (res[1]==1){
		var strURL="grilla2.php?KAM="+res[0]+"&CLI="+cliId+"&SUC="+sucId+"&K2="+kk2+"&FECID="+res[0]+"&TIPO="+tipoId+"&VEND="+vende+"&SUP="+superv+"&REP="+repo+"&COD="+userId+"&K="+kam;
	}else{
		var strURL="grilla2_v2.php?KAM="+res[0]+"&CLI="+cliId+"&SUC="+sucId+"&K2="+kk2+"&FECID="+res[0]+"&TIPO="+tipoId+"&VEND="+vende+"&SUP="+superv+"&REP="+repo+"&COD="+userId+"&K="+kam;
	}




	//prompt("Fun_Reponedor \n",strURL);
	var req = getXMLHTTP();

		
	if (req) {

		req.onreadystatechange = function() {
			if (req.readyState == 4) {

				if (req.status == 200) {
				//alert(strURL);
				document.getElementById('grilladiv').innerHTML=req.responseText;			
				} else {
					alert("04 - There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
	}

}
function alertap(){
	if(alerta_per){
		alert("Debe Seleccionar un Periodo" + alerta_per);
		alerta_per=false;
	}
}
function getVendedor(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;
	
	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	if(strf=="Periodo")
		alertap();
	else
	{
		if(x<=2){
			var strURL="findVendedor.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&SUC="+strsu+"&CLI="+strc;
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
		
						if (req.status == 200) {						
							document.getElementById('vendedor').innerHTML=req.responseText;						
						} else {
							prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
						}
					}				
				}			
				//prompt("Prueba:\n" + req.statusText + "\n",strURL);
				req.open("GET", strURL, true);
				req.send(null);
			}
		}
	}

}
function getSupervisor(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;

	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	if(strf=="Periodo")
		alertap();
	else
	{
		if(x<=3){
			var strURL="findSupervisor.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP"+strr+"&SUC="+strsu+"&CLI="+strc;
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
		
						if (req.status == 200) {						
							document.getElementById('supervisor').innerHTML=req.responseText;						
						} else {
							prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
						}
					}				
				}			
				//prompt("Prueba:\n" + req.statusText + "\n",strURL);
				req.open("GET", strURL, true);
				req.send(null);
			}
		}
	}

}
function getReponedor(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;
	
	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;
	
	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	if(strf=="Periodo")
		alertap();
	else
	{

		var strURL="findReponedor.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP="+strr+"&SUC="+strsu+"&CLI="+strc;
		if (testQA) prompt("Fun_Reponedor \n",strURL);

		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
	
					if (req.status == 200) {						
						document.getElementById('reponedor').innerHTML=req.responseText;						
					} else {
						prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
					}
				}				
			}			
			//prompt("Prueba:\n" + req.statusText + "\n",strURL);
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

}

function getKam(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;

	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	if(strf=="Periodo")
		alertap();
	else
	{
		if(x<=1){
			var strURL="findKam.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP"+strr+"&SUC="+strsu+"&CLI="+strc;
			if (req) {
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
		
						if (req.status == 200) {						
							document.getElementById('kam').innerHTML=req.responseText;						
						} else {
							prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
						}
					}				
				}			
				//prompt("Prueba:\n" + req.statusText + "\n",strURL);
				req.open("GET", strURL, true);
				req.send(null);
			}
		}
	}

}
function getKam2(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;

	var k2 = document.getElementById("sel_kam2");
	var strk2 = k2.options[k2.selectedIndex].value;
	
	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;


	if(strf=="Periodo")
		alertap();
	else
	{

		var strURL="findKAM2_v2.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP="+strr+"&KAM2="+strk2+"&CLI="+strc+"&SUC="+strsu;
		if (testQA) prompt("Fun_Kam2 \n",strURL);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					if (req.status == 200) {						
						document.getElementById('kam2div').innerHTML=req.responseText;						
					} else {
						prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
					}
				}				
			}			
			//prompt("Prueba:\n" + req.statusText + "\n",strURL);
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

}
function getSucursal(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;

	var k2 = document.getElementById("sel_kam2");
	var strk2 = k2.options[k2.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;


	if(strf=="Periodo")
		alertap();
	else
	{

		var strURL="findSucursal_v2.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP="+strr+"&KAM2="+strk2+"&CLI="+strc+"&SUC="+strsu;
		if (testQA) prompt("Fun_Sucursal \n",strURL);
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
	
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;						
					} else {
						prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
					}
				}				
			}			
			//prompt("Prueba:\n" + req.statusText + "\n",strURL);
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

}

function getCliente(x) {
	var req = getXMLHTTP();
	var tipoId = window.sLevel=x;
	
	
	var f = document.getElementById("perifecha");
	var strf = f.options[f.selectedIndex].value;
	var res=strf.split("|");
	
	var k = document.getElementById("sel_kam");
	var strk = k.options[k.selectedIndex].value;
	
	var v = document.getElementById("sel_ven");
	var strv = v.options[v.selectedIndex].value;
	
	var s = document.getElementById("sel_sup");
	var strs = s.options[s.selectedIndex].value;

	var r = document.getElementById("sel_rep");
	var strr = r.options[r.selectedIndex].value;

	var k2 = document.getElementById("sel_kam2");
	var strk2 = k2.options[k2.selectedIndex].value;

	var c = document.getElementById("sel_cli");
	var strc = c.options[c.selectedIndex].value;

	var su = document.getElementById("sel_suc");
	var strsu = su.options[su.selectedIndex].value;


	if(strf=="Periodo")
		alertap();
	else
	{

		var strURL="findCliente_v2.php?KAM=" + strk +"&VEN="+ strv +"&SUP="+ strs + "&TIPO="+tipoId+"&PER="+res[0]+"&REP="+strr+"&SUC="+strsu+"&KAM2="+strk2+"&CLI="+strc;
		if (testQA) prompt("Fun_Cliente \n",strURL);

		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
	
					if (req.status == 200) {						
						document.getElementById('statediv').innerHTML=req.responseText;						
					} else {
						prompt("03 - There was a problem while using XMLHTTP:\n" + req.statusText + "\n",strURL);
					}
				}				
			}			
			//prompt("Prueba:\n" + req.statusText + "\n",strURL);
			req.open("GET", strURL, true);
			req.send(null);
		}
	}

}

function carga(t,tipo){
	 $("#carga_reloj").css('visibility','visible'); 
    //window.setTimeout(document.getElementById("carga_reloj").style.display='block', 1000000);
   //document.getElementById("carga_reloj").style.visibility='visible';
   if(x<=1){
   		$("#kam").css('visibility','visible'); 
   		$("#vendedor").css('visibility','visible'); 
   		$("#supervisor").css('visibility','visible'); 
   }
   if(x==2){
   		$("#vendedor").css('visibility','visible'); 
   		$("#supervisor").css('visibility','visible'); 
   }
   if(x==3){
   		$("#supervisor").css('visibility','visible'); 
   }
	$("#reponedor").css('visibility','visible');
	$("#reinicio").css('visibility','visible'); 
	$("#xls").css('visibility','visible'); 

   if (tipo==1){ //chg cliente
   		getSucursal(x); 
   		//------
   		//getKam2(x);
   		//getReponedor(x);
   		//getSupervisor(x);
   		//getVendedor(x);
   		//getKam(x);
   }
   if (tipo==2){// chg kam2
   		getCliente(x);
   		getSucursal(x); 
   		//-------------
   		//getReponedor(x);
   		//getSupervisor(x);
   		//getVendedor(x);
   		//getKam(x);
   }
   if (tipo==3){ // chg reponedor
   		getKam2(x);
   		getCliente(x);
   		getSucursal(x); 
   		//------------------
   		//getSupervisor(x);
   		//getVendedor(x);
   		//getKam(x);
   }
   if (tipo==4){ // chg supervisor
   		getReponedor(x);
   		getKam2(x);
   		getCliente(x);
   		getSucursal(x); 
   		//---------------
   		//getVendedor(x);
   		//getKam(x);   		
   		
   }
   if (tipo==5){ // chg vendedor
   		getSupervisor(x);   		 
   		getReponedor(x);
   		getKam2(x);
   		getCliente(x);
   		getSucursal(x); 
   		//-------------
		//getKam(x); 
   		
   }
   if (tipo==6){
   		getVendedor(x);
   		getSupervisor(x);   		 
   		getReponedor(x);
   		getKam2(x);
   		getCliente(x);
   		getSucursal(x);
   }
   
   if (tipo==7){
   		getKam(x);
   		getVendedor(x);
   		getSupervisor(x);   		 
   		getReponedor(x);
   		getKam2(x);
   		getCliente(x);
   		getSucursal(x);
  }

   if (tipo==0){
   		getKam(x);
   		getVendedor(x);
   		getSupervisor(x);   		 
   		getReponedor(x);
   		//getKam2(x);
   		//getCliente(x);
  }
   
   
   
   
  
 
   getGrilla(t);
   //getGrilla(country);
   //getState(t);
   alerta_per=true;
  //document.getElementById("carga_reloj").style.display='none';
  //$("#carga_reloj").css('visibility','hidden');
   	//document.getElementById("carga_reloj").style.display='none';
    //document.getElementById("carga_reloj").style.visibility='hidden';
 }
function getState(countryId) {		
	var tipoId = window.sLevel=x;
	var strURL="findCliente.php?country="+countryId+"&TIPO="+tipoId;
	var req = getXMLHTTP();
	
	if (req) {

		req.onreadystatechange = function() {
			if (req.readyState == 4) {

				if (req.status == 200) {		
					document.getElementById('statediv').innerHTML=req.responseText;						
				} else {
					alert("01 - There was a problem while using XMLHTTP:\n" + req.statusText);
				}
			}				
		}			
		req.open("GET", strURL, true);
		req.send(null);
	}		
}

