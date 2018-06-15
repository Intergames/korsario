<?php session_start(); 
require_once('../Connections/conexion.php');
require_once('../assets/logs.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    <?php
    if (!function_exists("GetSQLValueString")) {
        function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
        {
          if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
          }
          $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
          switch ($theType) {
            case "text":
              $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL"; 
              break;    
            case "long":
            case "int":
              $theValue = ($theValue != "") ? intval($theValue) : "NULL";
              break;
            case "double":
              $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
              break;
            case "date":
              $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
              break;
            case "defined":
              $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
              break;
          }
          return $theValue;
        }
    }


    mysql_select_db($database_conexion, $conexion);
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
    $sucursales = mysql_query($query_sucursales, $conexion) or die(mysql_error());
    $row_sucursales = mysql_fetch_assoc($sucursales);
    ?>
    <?php
    $IdUsuario = $_GET['recordID'];
    mysql_select_db($database_conexion, $conexion);
    $query_usuarios = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario' ";
    $usuarios = mysql_query($query_usuarios, $conexion) or die(mysql_error());
    $detalle_usuario = mysql_fetch_assoc($usuarios);    
    
    ?>
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
    <form name="form1" method="post" action="procesarNuevoUsuario.php">
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Detalle del usuario: <?php echo $detalle_usuario['Nombre']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Ruta:</td>
                    <td><?php echo $detalle_usuario['IdRuta']; ?></td>
                </tr>
                <tr>
                  <td>Codigo Agente:</td>
                    <td><?php echo $detalle_usuario['Codigo']; ?></td>
                </tr>
                <tr>
                  <td>Sucursal:</td>
                    <td><?php echo $row_sucursales['NombreSucursal']; ?></td>
                </tr>
                <tr>
                  <td>Tipo de usuario:</td>
                    <td><?php echo $detalle_usuario['TipoUsuario']; ?></td>
                </tr>
                <tr>
                  <td>Nombre de usuario:</td>
                  <td><?php echo $detalle_usuario['Usuario'] ?></td>
                </tr>                
                <tr>
                  <td>Nombre completo del usuario:</td>
                  <td><?php echo $detalle_usuario['Nombre'] ?></td>
                </tr>
                <tr>
                  <td>Domicilio:</td>
                  <td><?php echo $detalle_usuario['Calle'] ?></td>
                </tr>
                <tr>
                  <td>Colonia:</td>
                  <td><?php echo $detalle_usuario['Colonia'] ?></td>
                </tr>
                <tr>
                  <td>Codigo Postal:</td>
                  <td><?php echo $detalle_usuario['CP'] ?></td>
                </tr>
                <tr>
                  <td>Puesto:</td>
                  <td><?php echo $detalle_usuario['Puesto'] ?></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><a href="./buscarUsuarios.php">Regresar</a></td>
                </tr>
              </table>
            </center>
          </div><!-- Fin FondoFormularios -->
        </div><!-- Fin MainBody -->
    </form>
    <div id="footer">
	<?php include("../assets/Footer.php"); ?>
    </div><!-- Fin footer -->
</body>
</html>