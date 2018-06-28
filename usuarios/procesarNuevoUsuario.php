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
    <title>Procesado de Nuevas Corresponsalias - Diario abc de Michoac&aacute;n</title>
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
            $IdRuta = $_POST['IdRuta'];
            $IdSucursal = $_POST['LstSucursal'];
            $RutaImagen = $_POST['TxtRutaImagen'];
            $Usuario = $_POST['TxtUsuario'];
            $TipoUsuario = $_POST['LstTipoUsuario'];
            $Psswrd = $_POST['TxtPasswrd'];
            $Nombre = $_POST['TxtNombre'];
            $Calle = $_POST['TxtCalle'];
            $Nexterior = $_POST['TxtNExterior'];
            $Ninterior = $_POST['TxtNInterior'];
            $Colonia = $_POST['TxtColonia'];
            $CP = $_POST['TxtCP'];
            $Puesto = $_POST['TxtPuesto'];
            $TelefonoEmpresa = $_POST['TxtTelefonoEmpresa'];
            $TelefonoParticular = $_POST['TxtTelefonoParticular'];
            $TelefonoParticular2 = $_POST['TxtTelefonoParticular2'];
            $email = $_POST['Txtemail'];
            $NSS = $_POST['TxtNSS'];
            $RFC = $_POST['TxtRFC'];
            $FechaIngreso = $_POST['TxtFechaIngreso'];
            $TelContacto = $_POST['TxtTelContactoEmergencia'];
            $GrupoSanguineo = $_POST['TxtGrupoSanguineo'];
            $DonadorOrganos = $_POST['LstDonadorOrganos'];
            $ContactoEmergencia = $_POST['TxtContactoEmergencia'];
            //mysql_select_db($database_conexion, $conexion) or die ("ERROR AL ESCOJER LA BD :".mysql_error());
            $sql="INSERT INTO `usuarios`
            (`IdRuta` ,`IdSucursal` , `Usuario` ,  `TipoUsuario` ,  `Psswrd` , `Nombre` , `Calle` , `Nexterior`, `Ninterior`, `Colonia`, `CP`, `Puesto`, `TelefonoEmpresa`, `TelefonoParticular`, `TelefonoParticular2`, `email`, `NSS`, `RFC`, `FechaIngreso`, `TelContacto`, `GrupoSanguineo`, `DonadorOrganos`, `ContactoEmergencia`)
            VALUES 
            ('$IdRuta' , '$IdSucursal' , '$Usuario' , '$TipoUsuario' , '$Psswrd' , '$Nombre'  ,'$Calle' ,'$Nexterior', '$Ninterior' ,'$Colonia' ,'$CP','$Puesto','$TelefonoEmpresa','$TelefonoParticular','$TelefonoParticular2','$email','$NSS','$RFC','$FechaIngreso','$TelContacto','$GrupoSanguineo','$DonadorOrganos','$ContactoEmergencia')";
            if (!mysqli_query($conexion,$sql))
            {
                echo "Se ha generado el siguiente error: ".$sql;
            }
            else
            {
                echo "<p><center><h2>El registro del nuevo usuario se ha dado de alta satisfactoriamente</h2></center></p>";
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