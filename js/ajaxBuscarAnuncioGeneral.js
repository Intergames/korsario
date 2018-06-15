// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_AnuncioGeneral;
var query_string_AnuncioGeneral;

function crea_query_string_AnuncioGeneral(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");	
    var LstTipoAnuncio = document.getElementById("LstTipoAnuncio");
    var LstMedida = document.getElementById("LstMedida");
    var LstAprobado = document.getElementById("LstAprobadoInformacionGeneral");
    var Cantidad = document.getElementById("Cantidad");	
    var Corresponsalia = document.getElementById("LstCorresponsalia");
    var FechaInicial = document.getElementById("TxtFechaInicialHidden");
    var FechaFinal = document.getElementById("TxtFechaFinalHidden");
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");    
    cadena_AnuncioGeneral="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +
    "&LstTipoAnuncio=" + encodeURIComponent(LstTipoAnuncio.value) +
    "&LstMedida=" + encodeURIComponent(LstMedida.value) +
    "&LstAprobado=" + encodeURIComponent(LstAprobado.value) +	
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&Corresponsalia=" + encodeURIComponent(Corresponsalia.value) +
    "&FechaInicial=" + encodeURIComponent(FechaInicial.value) +
    "&FechaFinal=" + encodeURIComponent(FechaFinal.value) + 
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +  
    "&nocache=" + Math.random();
    return cadena_AnuncioGeneral;
}

function processReqChangeAnuncioGeneral(){
    var ListadoAnuncioGeneral = document.getElementById("ListadoAnuncioGeneral");
    if(req.readyState == 4 && req.status == 200){
        ListadoAnuncioGeneral.innerHTML = req.responseText;
    } else {
        ListadoAnuncioGeneral.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLAnuncioGeneral(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeAnuncioGeneral;
        req.open("POST", url, true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_AnuncioGeneral = crea_query_string_AnuncioGeneral(pg);
        req.send(query_string_AnuncioGeneral);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_AnuncioGeneral = crea_query_string_AnuncioGeneral(pg);
            req.send(query_string_AnuncioGeneral);
        }
    }
}