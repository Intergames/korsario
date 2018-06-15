// JavaScript Document
var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena_Usuarios;
var query_string_Usuarios;

function crea_query_string_Usuarios(pg) {
    var TxtBusqueda = document.getElementById("TxtBusqueda");	   
    var Cantidad = document.getElementById("Cantidad");	
    var Sucursal = document.getElementById("LstSucursales");    
    var Ordenar = document.getElementById("LstOrdenar");
    var Tipo = document.getElementById("LstTipo");    
    cadena_Usuarios="TxtBusqueda=" + encodeURIComponent(TxtBusqueda.value) +    
    "&Cantidad=" + encodeURIComponent(Cantidad.value) +
    "&pg=" + encodeURIComponent(pg) +
    "&Sucursal=" + encodeURIComponent(Sucursal.value) +    
    "&Ordenar=" + encodeURIComponent(Ordenar.value) +
    "&Tipo=" + encodeURIComponent(Tipo.value) +  
    "&nocache=" + Math.random();
    return cadena_Usuarios;
}

function processReqChangeUsuarios(){
    var ListadoUsuarios = document.getElementById("ListadoUsuarios");
    if(req.readyState == 4 && req.status == 200){
        ListadoUsuarios.innerHTML = req.responseText;
    } else {
        ListadoUsuarios.innerHTML = '<img src="../loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLUsuarios(url,pg) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChangeUsuarios;
        req.open("POST", url, true);
        req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_Usuarios = crea_query_string_Usuarios(pg);
        req.send(query_string_Usuarios);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_Usuarios = crea_query_string_Usuarios(pg);
            req.send(query_string_Usuarios);
        }
    }
}