var isIE = false;
var READY_STATE_COMPLETE = 4;
var req;
var cadena;
var query_string;

function crea_query_string() {
	var Usuario = document.getElementById("TxtClaveClasificado");
	cadena="Usuario=" + encodeURIComponent(Usuario.value);
	return cadena;
}

function processReqChange(){
    var detalles = document.getElementById("MensajeClaveClasificado");
    if(req.readyState == READY_STATE_COMPLETE && req.status == 200){
        detalles.innerHTML = req.responseText;
    } else {
        detalles.innerHTML = '<img src="../assets/loading.gif" align="absmiddle" /> Cargando...';
    }
}

function cargaXMLVerficiarClave(url) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("POST", url, true);
		req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
		query_string = crea_query_string();
		req.send(query_string);
    } else if (window.ActiveXObject) {
        isIE = true;
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req) {
            req.onreadystatechange = processReqChange;
            req.open("POST", url, true);
            req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
			query_string = crea_query_string();
			req.send(query_string);
        }
    }
}