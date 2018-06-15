// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_clientes;
var query_string_clientes;

function crea_query_string_clientes(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");	   
    var Cantidad = document.getElementById("Cantidad");	
    var Sucursal = document.getElementById("LstSucursales");    
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");    
    cadena_clientes="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) + 
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&Sucursal=" + encodeURIComponent(Sucursal.value) +    
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +  
    "&nocache=" + Math.random();
    return cadena_clientes;
}

function processReqChangeclientes(){
    var Listadoclientes = document.getElementById("ListadoClientes");
    if(req.readyState == 4 && req.status == 200){
        Listadoclientes.innerHTML = req.responseText;
    } else {
        Listadoclientes.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLClientes(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeclientes;
        req.open("POST", url, true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_clientes = crea_query_string_clientes(pg);
        req.send(query_string_clientes);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChangeclientes;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_clientes = crea_query_string_clientes(pg);
            req.send(query_string_clientes);
        }
    }
}