<?php session_start(); 
require_once('../Connections/conexion.php');
require_once('../assets/logs.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Hace que los acentos se vean apropiadamente -->
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <!-- Finalizacion JQuery -->
    <script type="text/javascript">
    $(function(){
        $(".CajaTexto").tipTip({maxWidth: "auto", defaultPosition:"right"});
    });
    </script>
<title>Inicio de sesion de Usuario - Diario abc de Michoac&aacute;n</title>
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
        </div><!-- Fin FondoMenu -->
    </div><!-- Fin Cabecera -->
    <div id="MainBody">
        <div id="FondoFormularios">	
          <br />
          <center><h3>Utilice el men&uacute; superior para acceder a las opciones del sistema.</h3></center>
          <p align="center">Dicho men&uacute; permanecer&aacute; a lo largo de todo el sistema, por lo que siempre podr&aacute; cambiar a un m&oacute;dulo en particular en cualquier momento</p>
        </div><!-- Fin FondoFormularios -->
    </div><!-- Fin Mainbody -->
    <div id="footer">
	<?php include("../assets/footer.php"); ?>
    </div><!-- Fin footer -->
</body>
</html>