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
$sql = "SELECT  pedidos.IdCliente, pedidos.Folio, pedidos.Fecha, pedidos.Comentario, pedidos.Comentario, pedidos.SubTotal, pedidos.Descuento, pedidos.IVA, pedidos.Total, clientes.Nombre FROM `pedidos` JOIN clientes ON pedidos.IdCliente = clientes.Folio WHERE pedidos.Folio LIKE '$Folio%'";
$result = query($sql);
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
    $array[] = $row;
}
$pedidos = json_encode($array);
$longitud = strlen($pedidos);
//echo "La longitud de la cadena es: ".$longitud;
$mensaje = substr($pedidos, 2 ,$longitud - 4);
//echo $mensaje;
echo $pedidos;
?>