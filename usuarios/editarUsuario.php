<?php session_start(); 
require_once('../Connections/conexion.php');
require_once('../assets/logs.php');
if ( $_SESSION["TipoUsuarioGlobal"] =='root' ):
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
    <script type="text/javascript" src="../js/validarEditarUsuario.js"></script>
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

    //mysql_select_db($database_conexion, $conexion);
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
    $sucursales = mysqli_query($conexion, $query_sucursales) or die(mysql_error());
    $row_sucursales = mysqli_fetch_assoc($sucursales);
    ?>
    <?php
    $IdUsuario = $_GET['recordID'];
    //mysql_select_db($database_conexion, $conexion);
    $query_usuarios = "SELECT * FROM usuarios WHERE IdUsuario = '$IdUsuario' ";
    $usuarios = mysqli_query($conexion, $query_usuarios) or die(mysql_error());
    $detalle_usuario = mysqli_fetch_assoc($usuarios);    
    
    ?>
    <title>Edici&oacute;n de datos de  usuario - Bardahl </title>
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
    <form name="form1" method="post" action="procesarEditarUsuario.php">
        <input type="hidden" name="IdUsuario" value="<?php echo $IdUsuario; ?>" id="IdUsuario"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Edición del usuario: <?php echo $detalle_usuario['Nombre']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Sucursal:</td>
                    <td>
                        <select name="LstSucursal" id="LstSucursal" class="LstSucursal" title="Elija la sucursal en la cual va a tarbajar el usuario.">
                            <?php
                              do {  
                              ?>
                              <option value="<?php echo $row_sucursales['IdSucursal']?>" <?php if ($detalle_usuario['IdSucursal'] == $row_sucursales['IdSucursal'] ) echo "selected=selected"; ?> ><?php echo $row_sucursales['NombreSucursal']?></option>
                              <?php
                              } while ($row_sucursales = mysqli_fetch_assoc($sucursales));
                                $rows = mysqli_num_rows($sucursales);
                                if($rows > 0) {
                                  mysqli_data_seek($sucursales, 0);
                                  $row_sucursales = mysqli_fetch_assoc($sucursales);
                                }
                            ?>
                        </select>  
                    </td>
                </tr>
                <tr>
                  <td>Tipo de usuario</td>
                    <td>
                        <select name="LstTipoUsuario" id="LstTipoUsuario" title="Elija el tipo de usuario para permitir todos los accesos al sistema (Super Usuario) o solo efectuar ventas (limitado)">
                            <option value="root" <?php if ($detalle_usuario['TipoUsuario'] == 'root' ) echo "selected=selected"; ?> >Super Usuario</option>
                            <option value="limitado" <?php if ($detalle_usuario['TipoUsuario'] == 'limitado' ) echo "selected=selected"; ?> >Limitado</option>
                        </select>
                    </td>
                </tr>
                <!-- 
                <tr>
                  <td>Imagen</td>
                  <td><input name="TxtRutaImagen" type="text" id="TxtRutaImagen" maxlength="30" class="CajaTexto" title="Escriba el nombre de la imagen a cargar en la app al iniciar sesion" value="<?php echo $detalle_usuario['RutaImagen'] ?>" /></td>
                </tr> -->
                <tr> 
                  <td>Nombre de usuario</td>
                  <td><input name="TxtNombreUsuario" type="text" id="TxtNombreUsuario" maxlength="30" class="CajaTexto" title="Escriba su nombre de usuario." value="<?php echo $detalle_usuario['Usuario'] ?>" /></td>
                </tr>
                <tr>
                  <td>Contraseña</td>
                  <td><input name="TxtPasswrd" type="password" id="TxtPasswrd" maxlength="30" class="CajaTexto" title="Escriba la contraseña de acceso al sistema asigando al usuario." value="<?php echo $detalle_usuario['Psswrd'] ?>" /></td>
                </tr>
                <tr>
                  <td>Nombre completo del usuario</td>
                  <td><input name="TxtNombre" type="text" id="TxtNombre" maxlength="30" class="CajaTexto" title="Escriba el nombre completo del usuario." value="<?php echo $detalle_usuario['Nombre'] ?>"/></td>
                </tr>
                <tr>
                  <td>Domicilio:</td>
                  <td><input name="TxtDomicilio" type="text" id="TxtDomicilio" maxlength="30" class="CajaTexto" title="Domicilio particular del usuario." value="<?php echo $detalle_usuario['Calle'] ?>" /></td>
                </tr>
                <tr>
                  <td>Colonia: </td>
                  <td><input name="TxtColonia" type="text" id="TxtColonia" maxlength="30" class="CajaTexto" title="Escriba el nombre de la colonia donde vive el usuario." value="<?php echo $detalle_usuario['Colonia'] ?>" /></td>
                </tr>
                <tr>
                  <td>Codigo Postal:</td>
                  <td><input name="TxtCodigoPostal" type="text" id="TxtCodigoPostal" maxlength="30" class="CajaTexto" title="Escriba el código postal donde vive el usuario." value="<?php echo $detalle_usuario['CP'] ?>" /></td>
                </tr>
                <tr>
                  <td>Puesto</td>
                  <td><input name="TxtPuesto" type="text" id="TxtPuesto" maxlength="30" class="CajaTexto" title="Escriba el puesto que desempeña el usuario en la empresa Ej. Vendedor, Limpieza, etc." value="<?php echo $detalle_usuario['Puesto'] ?>" /></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input type="submit" name="guardarEditarUsuario" value="Guardar" class="guardarEditarUsuario" id="guardarEditarUsuario" />
                  </label></td>
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
<?php
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif; ?>