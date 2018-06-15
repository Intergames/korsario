<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
function conexion() {
    mysql_connect("localhost:3306", "uruapan2_rtventa", "xffi3DCe;osw");
    mysql_select_db("uruapan2_ventas");
}

function query($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

conexion();
$sql = "SELECT *  FROM `productos` WHERE Marca = 'Bardahl'";
$result = query($sql);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $array[] = $row;
}
$productos = json_encode($array);
$longitud = strlen($productos);
//echo "La longitud de la cadena es: ".$longitud;
$mensaje = substr($productos, 2 ,$longitud - 4);
//echo $mensaje;
echo $productos;
?>