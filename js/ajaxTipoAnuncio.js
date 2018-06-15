// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_TipoAnuncio;
var query_string_TipoAnuncio;

function crea_query_string_TipoAnuncio(pg) {
	var TxtBusqueda = document.getElementById("TxtBusqueda");	
	var Cantidad = document.getElementById("Cantidad");	
	cadena_TipoAnuncio="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +	
	"&Cantidad=" + encodeURIComponent(Cantidad.value) +
	"&pg=" + encodeURIComponent(pg) +
	"&nocache=" + Math.random();
	return cadena_TipoAnuncio;
}

function processReqChangeTipoAnuncio(){
    var ListadoTipoAnuncio = document.getElementById("ListadoTipoAnuncio");
    if(req.readyState == 4 && req.status == 200){
        ListadoTipoAnuncio.innerHTML = req.responseText;
    } else {
        ListadoTipoAnuncio.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLTipoAnuncio(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeTipoAnuncio;
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
		query_string_TipoAnuncio = crea_query_string_TipoAnuncio(pg);
		req.send(query_string_TipoAnuncio);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
			query_string_TipoAnuncio = crea_query_string_TipoAnuncio(pg);
			req.send(query_string_TipoAnuncio);
        }
    }
}