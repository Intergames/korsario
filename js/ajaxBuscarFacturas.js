// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var reqFactura;
var cadena_Factura;
var query_string_Factura;

function crea_query_string_Factura(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");
    var LstTipoAnuncio = document.getElementById("LstTipoAnuncio");  
    var Corresponsalia = document.getElementById("LstCorresponsalia");
    var Cantidad = document.getElementById("Cantidad"); 
    var FechaInicial = document.getElementById("TxtFechaInicialHidden");
    var FechaFinal = document.getElementById("TxtFechaFinalHidden");
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");
    cadena_Factura="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +
    "&LstTipoAnuncio=" + encodeURIComponent(LstTipoAnuncio.value) +    
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&Corresponsalia=" + encodeURIComponent(Corresponsalia.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&FechaInicial=" + encodeURIComponent(FechaInicial.value) +
    "&FechaFinal=" + encodeURIComponent(FechaFinal.value) +
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +
    "&nocache=" + Math.random();
    return cadena_Factura;
}

function processReqChangeFactura(){
    var ListadoFactura = document.getElementById("ListadoFactura");
    if(reqFactura.readyState == 4 && reqFactura.status == 200){
        ListadoFactura.innerHTML = reqFactura.responseText;
    } else {
        ListadoFactura.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLFacturas(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        reqFactura = new XMLHttpRequest();
        reqFactura.onreadystatechange = processReqChangeFactura;
        reqFactura.open("POST", url, true);
        reqFactura.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_Factura = crea_query_string_Factura(pg);
        reqFactura.send(query_string_Factura);
    } else if (window.ActiveXObject) {
        isIE = true;
        reqFactura = new ActiveXObject("Microsoft.XMLHTTP");
        if (reqFactura) {
            reqFactura.onreadystatechange = processReqChange;
            reqFactura.open("POST", url, true);
            reqFactura.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_Factura = crea_query_string_Factura(pg);
            reqFactura.send(query_string_Factura);
        }
    }
}