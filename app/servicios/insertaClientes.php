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
$sql = "LOAD DATA INFILE 'public_html/ventas/csv/clientes.csv' INTO TABLE clientes FIELDS TERMINATED BY ','  (IdCliente,IdSucursal,Folio,Nombre,RFC,Calle,Ninterior,Nexterior,Colonia,CP,Ciudad,Estado,Telefono1,Telefono2,Telefono3,Telefono4,email,SitioWeb)";
$result = query($sql);
//echo $mensaje;
echo $result;
?>