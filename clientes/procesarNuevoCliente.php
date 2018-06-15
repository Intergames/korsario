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
    <title>Procesado de Nuevas Clientes - Bardahal</title>
</head>
<body>
    <div id="Cabecera">
        <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" /> 
        </div><!-- Fin ContenedorCabeceraSuperior -->
        <div id="FondoMenu">
            <div id="ContenedorMenu">	
                <?php include("../menu/menu.php");
?> 
            </div> <!-- Fin ContenedorMenu -->
        </div> <!-- Fin FondoMenu -->
    </div><!-- Fin Cabecera -->
    <div id="MainBody">
        <div id="FondoFormularios">
        <?php 
            $RFC = $_POST['TxtRFC'];
            $Nombre = $_POST['TxtNombreCliente'];
            $Representante = $_POST['TxtRepresentante'];
            $Calle = $_POST['TxtCalle'];
            $Colonia = $_POST['TxtColonia'];
            $Ciudad = $_POST['TxtCiudad'];
            $Estado = $_POST['LstEstado'];
            $CP = $_POST['TxtCP'];
            if ($CP=="") $CP=0;
            $Telefono = $_POST['TxtTelefono'];
            $Celular = $_POST['TxtCelular'];
            $Fax = $_POST['TxtFax'];
            $email = $_POST['Txtemail'];
            $Descuento = $_POST['TxtDescuento'];
            if ($Descuento=="") $Descuento=0;
            $Observaciones = $_POST['TxtObservaciones'];
            $sql="INSERT INTO `clientes`
            (`RFC` , `Representante` ,  `Nombre` , `Calle` , `Colonia`, `Ciudad`, `Estado`, `CP`, `Telefono`, `Celular`, `Fax`, `email`,  `Descuento` , `Observaciones`)
            VALUES 
            ('$RFC' , '$Representante' , '$Nombre' , '$Calle'  ,'$Colonia' ,'$Ciudad' ,'$Estado' ,'$CP', '$Telefono' ,'$Celular','$Fax','$email','$Descuento','$Observaciones')";
            echo "Estas son las observaciones: ".$Observaciones;
            if (!mysqli_query($conexion,$sql))
            {
            	echo "Se ha generado el siguiente error: ".mysqli_error($conexion).$sql;
            }
            else
            {
            	echo "<p><center><h2>El registro del nuevo cliente se ha dado de alta satisfactoriamente</h2></center></p>";
            	//G	eneraLog("ha dado de alta el precio: $Nombre","Precios","nuevoPrecio");
            }
            ?>
        </div>
    </div><!-- Fin mainbody-->
    <div id="footer">
    	<?php include("../assets/Footer.php");
?>
    </div> <!-- Fin footer-->
</body>
</html>
<?php 
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a 
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif;
?>