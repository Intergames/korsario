<?php 
session_start();
require_once('../Connections/conexion.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> <!-- Hace que los acentos se vean apropiadamente -->
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>
    <!-- Finalizacion JQuery -->
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <title></title>
</head>
<body >
<div id="Cabecera">
    <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" />
    </div> 		 
    <div id="FondoMenu">
        <div id="ContenedorMenu">	
            <?php include("../menu/menu.php"); ?> 
        </div> <!-- Fin ContenedorMenu -->
    </div> <!-- Fin FondoMenu -->
</div><!-- Fin Cabecera -->
<div id="MainBody">
    <div id="TituloFormulario">
      <p align="center">Edici&oacute;n de Datos de Usuario.</p>
    </div><!-- Fin TituloFormulario -->
    <div id="FondoFormularios">
      <?php 
         $IdUsuario = $_POST['IdUsuario']; 
         if ($_SESSION["TipoUsuarioGlobal"] == 'root' && $IdUsuario != '0')
         {    
            $Sucursal = $_POST['LstSucursal'];
            // $RutaImagen = $_POST['TxtRutaImagen'];
            $Usuario = $_POST['TxtNombreUsuario'];
            $TipoUsuario = $_POST['LstTipoUsuario'];
            $Password = $_POST['TxtPasswrd'];
            $IdRuta = $_POST['TxtIdRuta'];
            $Nombre = $_POST['TxtNombre'];
            $Domicilio = $_POST['TxtDomicilio'];         
            $Colonia = $_POST['TxtColonia'];                   
            $Codigo = $_POST['TxtCodigoAgente'];                   
            $CodigoPostal = $_POST['TxtCodigoPostal'];                   
            $Puesto = $_POST['TxtPuesto'];                   
            //mysql_select_db($database_conexion, $conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
            $sql="UPDATE usuarios SET IdSucursal='$Sucursal', IdRuta='$IdRuta', Usuario='$Usuario', RutaImagen='$RutaImagen', TipoUsuario='$TipoUsuario', Psswrd='$Password', Nombre='$Nombre', Calle='$Domicilio', Colonia='$Colonia' , CP='$CodigoPostal', Puesto='$Puesto', Codigo = '$Codigo'  WHERE IdUsuario ='$IdUsuario'";             
            // echo "Este es el sql: ".$sql;
            if (mysqli_query($conexion, $sql))
                echo "<p><center>La modificaci&oacute;n del Usuario:".$Nombre." se ha realizado con &eacute;xito</center></p>";
            else
                echo "<p><center>La modificaci&oacute;n no se ha podido realizar:".mysql_error()."</center></p>";	 
         }
         else
         {
             echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;dulo! </font></p>
                    <p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
                    para visualizar los datos.<p align=center>Si ha iniciado sesion pida al administrador del sitio que le otorge los privilegios necesarios</p></font></p>";
         }    
        ?>
    </div><!-- Fin FondoFormularios-->
</div><!-- Fin MainBody -->
<div id="footer">
  <?php include("../assets/footer.php"); ?>
</div> <!-- Fin footer-->
</body>