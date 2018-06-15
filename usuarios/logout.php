<?php 
	session_start();
	require_once('../Connections/conexion.php');
	require_once("../assets/logs.php");
	//GeneraLog("ha salido del sistema.","usuarios","00");
	unset($_SESSION['CadenaPrivilegios']);
	unset($_SESSION['NombreGlobal']);
	unset($_SESSION['UsuarioGlobal']);
	unset($_SESSION['SucursalGlobal']);
	unset($_SESSION['TipoUsuarioGlobal']);
	unset($_SESSION['IdUsuarioGlobal']);
	session_unset();	
?> 
<html>
<head>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css"; rel="stylesheet" type="text/css" />
    <title>Salida del sistema de publicidad  - Diario abc de Michoac&aacute;n</title>
<style type="text/css">
<!--
.Estilo1 {font-weight: bold}
-->
</style>
</head>
 <body>
     <div id="Cabecera">
     <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" /> 
     </div> <!-- Fin ContenedorCabeceraSuperior -->
     </div>
     <div dir="mainbody">
         <center>
            <p><strong>Cierre de sesión</strong></p>
            <p>La sesion se ha terminado correctamente.</p>
            <p><a href="login.php">Iniciar Sesi&oacute;n</a></p>
         </center>
     </div>
</body>
</html>
