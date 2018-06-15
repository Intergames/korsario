<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
$Folio = addslashes(strip_tags($_GET['folio']));
function conexion() {
    mysql_connect("localhost:3306", "uruapan2_rtventa", "xffi3DCe;osw");
    mysql_select_db("uruapan2_ventas");
}

function query($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

conexion();
$sql = "SELECT *  FROM `clientes` WHERE Folio LIKE '$Folio%'";
$result = query($sql);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $array[] = $row;
}
$clientes = json_encode($array);
$longitud = strlen($clientes);
//echo "La longitud de la cadena es: ".$longitud;
$mensaje = substr($clientes, 2 ,$longitud - 4);
//echo $mensaje;
echo $clientes;
?>