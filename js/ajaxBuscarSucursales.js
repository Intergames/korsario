// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_sucursales;
var query_string_sucursales;

function crea_query_string_sucursales(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");      
    var Cantidad = document.getElementById("Cantidad"); 
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");    
    cadena_sucursales="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) + 
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&pg=" + encodeURIComponent(pg) +   
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +  
    "&nocache=" + Math.random();
    return cadena_sucursales;
}

function processReqChangeSucursales(){
    var ListadoSucursales = document.getElementById("ListadoSucursales");
    if(req.readyState == 4 && req.status == 200){
        ListadoSucursales.innerHTML = req.responseText;
    } else {
        ListadoSucursales.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLSucursales(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeSucursales;
        req.open("POST", url, true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_sucursales = crea_query_string_sucursales(pg);
        req.send(query_string_sucursales);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_sucursales = crea_query_string_sucursales(pg);
            req.send(query_string_sucursales);
        }
    }
}