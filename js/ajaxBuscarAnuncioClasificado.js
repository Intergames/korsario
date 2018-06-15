// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var reqClasificado;
var cadena_AnuncioClasificado;
var query_string_AnuncioClasificado;

function crea_query_string_AnuncioClasificado(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");
    var LstTipoAnuncio = document.getElementById("LstTipoAnuncio");
    var LstMedida = document.getElementById("LstMedida");
    var LstAprobado = document.getElementById("LstAprobadoClasificado");
    var Corresponsalia = document.getElementById("LstCorresponsalia");
    var Cantidad = document.getElementById("Cantidad");	
    var FechaInicial = document.getElementById("TxtFechaInicialHidden");
    var FechaFinal = document.getElementById("TxtFechaFinalHidden");
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");
    cadena_AnuncioClasificado="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +
    "&LstTipoAnuncio=" + encodeURIComponent(LstTipoAnuncio.value) +
    "&LstMedida=" + encodeURIComponent(LstMedida.value) +
    "&LstAprobado=" + encodeURIComponent(LstAprobado.value) +
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&Corresponsalia=" + encodeURIComponent(Corresponsalia.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&FechaInicial=" + encodeURIComponent(FechaInicial.value) +
    "&FechaFinal=" + encodeURIComponent(FechaFinal.value) +
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +
    "&nocache=" + Math.random();
    return cadena_AnuncioClasificado;
}

function processReqChangeAnuncioClasificado(){
    var ListadoAnuncioClasificado = document.getElementById("ListadoAnuncioClasificado");
    if(reqClasificado.readyState == 4 && reqClasificado.status == 200){
        ListadoAnuncioClasificado.innerHTML = reqClasificado.responseText;
    } else {
        ListadoAnuncioClasificado.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLAnuncioClasificado(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        reqClasificado = new XMLHttpRequest();
        reqClasificado.onreadystatechange = processReqChangeAnuncioClasificado;
        reqClasificado.open("POST", url, true);
        reqClasificado.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_AnuncioClasificado = crea_query_string_AnuncioClasificado(pg);
        reqClasificado.send(query_string_AnuncioClasificado);
    } else if (window.ActiveXObject) {
        isIE = true;
        reqClasificado = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqClasificado) {
            reqClasificado.onreadystatechange = processReqChange;
            reqClasificado.open("POST", url, true);
            reqClasificado.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_AnuncioClasificado = crea_query_string_AnuncioClasificado(pg);
            reqClasificado.send(query_string_AnuncioClasificado);
        }
    }
}