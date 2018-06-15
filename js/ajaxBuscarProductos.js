// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req_productos;
var cadena_productos;
var query_string_productos;

function crea_query_string_productos(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");	   
    var Cantidad = document.getElementById("LstCantidad");	
    var Sucursal = document.getElementById("LstSucursales");    
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");    
    cadena_productos="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) + 
    "&pg=" + encodeURIComponent(pg) +
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&Sucursal=" + encodeURIComponent(Sucursal.value) +    
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +  
    "&nocache=" + Math.random();
    return cadena_productos;
}

function processReqChangeProductos(){
    var ListadoProductos = document.getElementById("ListadoProductos");
    if(req_productos.readyState == 4 && req_productos.status == 200){
        ListadoProductos.innerHTML = req_productos.responseText;
    } else {
        ListadoProductos.innerHTML = '<img src="../assets/loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLProductos(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req_productos = new XMLHttpRequest();
        req_productos.onreadystatechange = processReqChangeProductos;
        req_productos.open("POST", url, true);
        req_productos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_productos = crea_query_string_productos(pg);
        req_productos.send(query_string_productos);
    } else if (window.ActiveXObject) {
        isIE = true;
        req_productos = new ActiveXObject("Microsoft.XMLHTTP");
        if (req_productos) {
            req_productos.onreadystatechange = processReqChange;
            req_productos.open("POST", url, true);
            req_productos.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_productos = crea_query_string_productos(pg);
            req_productos.send(query_string_productos);
        }
    }
}