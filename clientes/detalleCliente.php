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
    
    ?>

    <?php
    
    $IdCliente = $_GET['recordID'];
    mysql_select_db($database_conexion, $conexion);
    $query_clientes = "SELECT * FROM clientes WHERE IdCliente = '$IdCliente' ";
    $clientes = mysql_query($query_clientes, $conexion) or die(mysql_error());
    $detalle_cliente = mysql_fetch_assoc($clientes);

    $IdSucursal = $detalle_cliente['IdSucursal'];
    // echo "Este es el ID de la sucursal: ".$IdSucursal;
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales WHERE IdSucursal = $IdSucursal";
    $sucursales = mysql_query($query_sucursales, $conexion) or die(mysql_error());
    $detalle_sucursal= mysql_fetch_assoc($sucursales);
    
    ?>
<title>Detalle de cliente - Bardahl</title>
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
        <div id="TituloFormulario"><p align="center">Detalle del cliente: <?php echo $detalle_cliente['Descripcion']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Sucursal:</td>
                    <td><?php echo $detalle_sucursal['NombreSucursal']; ?></td>
                </tr>
                <tr>
                  <td>Folio:</td>
                    <td><?php echo $detalle_cliente['Folio']; ?></td>
                </tr>
                <tr>
                  <td>Nombre:</td>
                  <td><?php echo $detalle_cliente['Nombre']; ?></td>
                </tr>                
                <tr>
                  <td>RFC:</td>
                  <td><?php echo $detalle_cliente['RFC']; ?></td>
                </tr>
                <tr>
                  <td>Curp:</td>
                  <td><?php echo $detalle_cliente['CURP']; ?></td>
                </tr>
                <tr>
                  <td>Calle:</td>
                  <td><?php echo $detalle_cliente['Calle']; ?></td>
                </tr>
                <tr>
                  <td>Número Interior:</td>
                  <td><?php echo $detalle_cliente['Ninterior']; ?></td>
                </tr>
                <tr>
                  <td>Número Exterior:</td>
                  <td><?php echo $detalle_cliente['Nexterior']; ?></td>
                </tr>
                <tr>
                  <td>Colonia:</td>
                  <td><?php echo $detalle_cliente['Colonia']; ?></td>
                </tr>
                <tr>
                  <td>Código Postal:</td>
                  <td><?php echo $detalle_cliente['CP']; ?></td>
                </tr>
                <tr>
                  <td>Estado:</td>
                  <td><?php echo $detalle_cliente['Estado']; ?></td>
                </tr>
                <tr>
                  <td>Municipio:</td>
                  <td><?php echo $detalle_cliente['Municipio']; ?></td>
                </tr>
                <tr>
                  <td>Telefono1:</td>
                  <td><?php echo $detalle_cliente['Telefono1']; ?></td>
                </tr>
                <tr>
                  <td>Telefono2:</td>
                  <td><?php echo $detalle_cliente['Telefono2']; ?></td>
                </tr>
                <tr>
                  <td>Telefono3:</td>
                  <td><?php echo $detalle_cliente['Telefono3']; ?></td>
                </tr>
                <tr>
                  <td>Telefono4:</td>
                  <td><?php echo $detalle_cliente['Telefono4']; ?></td>
                </tr>
                <tr>
                  <td>email:</td>
                  <td><?php echo $detalle_cliente['email']; ?></td>
                </tr>
                <tr>
                  <td>SitioWeb:</td>
                  <td><?php echo $detalle_cliente['SitioWeb']; ?></td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><a href="./buscarCliente.php">Regresar</a></td>
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