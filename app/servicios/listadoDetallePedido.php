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
$sql = "SELECT detalle_pedido.Cantidad, detalle_pedido.Precio, detalle_pedido.Descuento1, detalle_pedido.Neto, detalle_pedido.IVA, detalle_pedido.Total, productos.RutaImagen , productos.Descripcion FROM `detalle_pedido` JOIN productos ON detalle_pedido.IdProducto = productos.IdProducto WHERE Folio = '$Folio'";
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