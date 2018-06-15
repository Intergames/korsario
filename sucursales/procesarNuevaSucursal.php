<?php 
    session_start();
    include("../Connections/conexion.php"); 
    require_once('../assets/logs.php');
    if ($_SESSION["TipoUsuarioGlobal"] =='root' ):
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <title>Procesado de Nuevas Sucursales - Refaccionaria Terry's</title>
</head>
<body>
    <div id="Cabecera">
        <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" /> 
        </div><!-- Fin ContenedorCabeceraSuperior -->
        <div id="FondoMenu">
            <div id="ContenedorMenu">	
                <?php include("../menu/menu.php"); ?> 
            </div> <!-- Fin ContenedorMenu -->
        </div> <!-- Fin FondoMenu -->
    </div><!-- Fin Cabecera -->
    <div id="MainBody">
        <div id="FondoFormularios">
        <?php 
            $NombreSucursal = $_POST['TxtNombreSucursal'];
            $Direccion = $_POST['TxtDireccion'];
            $Colonia = $_POST['TxtColonia'];
            $CodigoPostal = $_POST['TxtCodigoPostal'];           
            $Ciudad = $_POST['TxtCiudad'];
            $Estado = $_POST['LstEstado'];            
            mysql_select_db($database_conexion, $conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
            $sql="INSERT INTO `sucursales`
            (`NombreSucursal` , `Direccion` ,`Colonia` , `CodigoPostal` , `Ciudad` ,  `Estado`)
            VALUES ( '$NombreSucursal' , '$Direccion' , '$Colonia' , '$CodigoPostal' , '$Ciudad' ,  '$Estado')";
            if (!mysql_query($sql))
            {
                echo "Se ha generado el siguiente error: ".mysql_error().$sql;
            }
            else
            {   
                echo "<p><center><h2>El registro de la nueva sucursal se ha dado de alta satisfactoriamente</h2></center></p>";
                //GeneraLog("ha dado de alta el precio: $Nombre","Precios","nuevoPrecio");
            }
        ?>
        </div>
    </div><!-- Fin mainbody-->
    <div id="footer">
    	<?php include("../assets/Footer.php"); ?>
    </div> <!-- Fin footer-->
</body>
</html>
<?php 
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a 
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif; ?>