var isIE = false;
var READY_STATE_COMPLETE = 4;
var req_placas_vehiculo;
var cadena_placas_vehiculo;
var query_string_placas_vehiculo;

function crea_query_string_placas_vehiculo() {
	var NumeroNuevoVehiculo = document.getElementById("NumeroNuevoVehiculo");
	cadena_placas_vehiculo ="NumeroNuevoVehiculo=" + encodeURIComponent(NumeroNuevoVehiculo.value) +
	"&nocache=" + Math.random();
	return cadena_placas_vehiculo;
}

function processReqChangePlacas_Vehiculo(){
    var ListadoPlacasVehiculo = document.getElementById("ajxPlacas_Vehiculo");
    if(req_placas_vehiculo.readyState == READY_STATE_COMPLETE && req_placas_vehiculo.status == 200){
        ListadoPlacasVehiculo.innerHTML = req_placas_vehiculo.responseText;
    } else {
        ListadoPlacasVehiculo.innerHTML = '<img src="../assets/loading.gif" align="absmiddle" />';
    }
}

function cargaXMLPlacasVehiculo(url) {
    if(url==''){
        return;
    }
    if (window.XMLHttpRequest) {
        req_placas_vehiculo = new XMLHttpRequest();
        req_placas_vehiculo.onreadystatechange = processReqChangePlacas_Vehiculo;
        req_placas_vehiculo.open("POST", url, true);
        req_placas_vehiculo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
        query_string_placas_vehiculo = crea_query_string_placas_vehiculo();
        req_placas_vehiculo.send(query_string_placas_vehiculo);
    } else if (window.ActiveXObject) {
        isIE = true;
        req_placas_vehiculo = new ActiveXObject("Microsoft.XMLHTTP");
        if (req_placas_vehiculo) {
            req_placas_vehiculo.onreadystatechange = processReqChangePlacas_Vehiculo;
            req_placas_vehiculo.open("POST", url, true);
            req_placas_vehiculo.setRequestHeader("Content-Type", "application/x-www-form-urlencoded", "charset=UTF-8");
            query_string_placas_vehiculo = crea_query_string_placas_vehiculo();
            req_placas_vehiculo.send(query_string_placas_vehiculo);
        }
    }
}