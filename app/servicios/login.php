<?php header('Access-Control-Allow-Origin: *'); ?>
<?php 
header('content-type: text/html; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

$Usuario = addslashes(strip_tags($_POST['usuario']));
$Psswrd = addslashes(strip_tags($_POST['psswrd']));

function conexion() {
    mysql_connect("localhost:3306", "uruapan2_rtventa", "xffi3DCe;osw");
    mysql_select_db("uruapan2_ventas");
}

function query($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}
conexion();
// Determinamos si el nombre de usuario y contraseña es valido.
$sqlLogin = "SELECT * FROM usuarios WHERE Usuario = '$Usuario' AND Psswrd = '$Psswrd'";
$resultado = mysql_query($sqlLogin);
$detalle = mysql_fetch_assoc($resultado);
$datos = json_encode($detalle);
if ($resultado)
{
	$respuesta=$datos;
}
else
{
	$respuesta="Error";
}

echo $respuesta;
?>	