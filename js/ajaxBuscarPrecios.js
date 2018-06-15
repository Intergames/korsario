// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_Precio;
var query_string_Precio;

function crea_query_string_Precio(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");	
    var Cantidad = document.getElementById("Cantidad");	
    cadena_Precio="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +	
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&nocache=" + Math.random();
    return cadena_Precio;
}

function processReqChangePrecio(){
    var ListadoPrecio = document.getElementById("ListadoPrecios");
    if(req.readyState == 4 && req.status == 200){
        ListadoPrecio.innerHTML = req.responseText;
    } else {
        ListadoPrecio.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLPrecio(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangePrecio;
        req.open("POST", url, true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_Precio = crea_query_string_Precio(pg);
        req.send(query_string_Precio);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_Precio = crea_query_string_Precio(pg);
            req.send(query_string_Precio);
        }
    }
}