var isIE = false;
var READY_STATE_COMPLETE = 4;
var req_rfc;
var cadena_rfc;
var query_string_rfc;

function crea_query_string_rfc() {
    var RFC = document.getElementById("TxtRFCFacturaInformacionGeneral");
    cadena_rfc="RFC=" + encodeURIComponent(RFC.value);
    return cadena_rfc;
}

function processReqChangeRFC(){
    var detalles = document.getElementById("MensajeRFC");
    if(req_rfc.readyState == READY_STATE_COMPLETE && req_rfc.status == 200){
        detalles.innerHTML = req_rfc.responseText;
    } else {
        detalles.innerHTML = '<img src="../assets/loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLVerificarRFC(url) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req_rfc = new XMLHttpRequest();
        req_rfc.onreadystatechange = processReqChangeRFC;
        req_rfc.open("POST", url, true);
        req_rfc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_rfc = crea_query_string_rfc();
        req_rfc.send(query_string_rfc);
    } else if (window.ActiveXObject) {
        isIE = true;
        req_rfc = new ActiveXObject("Microsoft.XMLHTTP");
        if (req_rfc) {
            req_rfc.onreadystatechange = processReqChangeRFC;
            req_rfc.open("POST", url, true);
            req_rfc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
			query_string_rfc = crea_query_string_rfc();
			req_rfc.send(query_string_rfc);
        }
    }
}