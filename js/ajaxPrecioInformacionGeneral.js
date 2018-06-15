var isIE = false;
var READY_STATE_COMPLETE = 4;
var req_precio_informacion_general;
var cadena_precio_informacion_general;
var query_string_precio_informacion_general;

function crea_query_string_precio_informacion_general() {
    var Medida = document.getElementById("ListaMedidaInformacionGeneral");	
    cadena_precio_informacion_general ="Medida=" + encodeURIComponent(Medida.value) +
    "&nocache=" + Math.random();
    return cadena_precio_informacion_general;
}

function processReqChangePrecio_Informacion_General(){
    var ListadoPrecioInformacionGeneral = document.getElementById("TxtTotalInformacionGeneral");
    if(req_precio_informacion_general.readyState == READY_STATE_COMPLETE && req_precio_informacion_general.status == 200){
        ListadoPrecioInformacionGeneral.val = req_precio_informacion_general.responseText;
    } else {
        ListadoPrecioInformacionGeneral.innerHTML = '<img src="../publicidad/assets/loading.gif" align="absmiddle" />';
    }
}

function cargaXMLPrecioInformacionGeneral(url) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req_precio_informacion_general = new XMLHttpRequest();
        req_precio_informacion_general.onreadystatechange = processReqChangePrecio_Informacion_General;
        req_precio_informacion_general.open("POST", url, true);
        req_precio_informacion_general.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_precio_informacion_general = crea_query_string_precio_informacion_general();
        req_precio_informacion_general.send(query_string_precio_informacion_general);
    } else if (window.ActiveXObject) {
        isIE = true;
        req_precio_informacion_general = new ActiveXObject("Microsoft.XMLHTTP");
        if (req_precio_informacion_general) {
            req_precio_informacion_general.onreadystatechange = processReqChangePrecio_Informacion_General;
            req_precio_informacion_general.open("POST", url, true);
            req_precio_informacion_general.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_precio_informacion_general = crea_query_string_precio_informacion_general();
            req_precio_informacion_general.send(query_string_precio_informacion_general);
        }
    }
}