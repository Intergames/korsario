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

    //mysql_select_db($database_conexion, $conexion);
    $query_Estados = "SELECT * FROM estados ORDER BY Nombre ASC";
    $Estados = mysqli_query($conexion, $query_Estados) or die(mysql_error());
    $row_Estados = mysqli_fetch_assoc($Estados);
    $totalRows_Estados = mysqli_num_rows($Estados);

    //mysql_select_db($database_conexion, $conexion);
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
    $sucursales = mysqli_query($conexion, $query_sucursales) or die(mysql_error());
    $row_sucursales = mysqli_fetch_assoc($sucursales);
    $conteo_row_sucursales = mysqli_num_rows($sucursales);
    ?>
<title>Nuevo Usuario - Korsario</title>
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
    <form name="form1" method="post" action="procesarNuevoUsuario.php" enctype="multipart/form-data">
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Nuevo Usuario</p></div>
          <div id="FondoFormularios">
            <center>
              <table width="894" border="0">
                <tr>
                  <td>Codigo Ruta</td>
                  <td><input type="text" name="IdRuta" id="IdRuta" title="Escriba el nombre de la ruta que puede curbir el usuario" /></td>
                  <td>Imagen:</td>
                  <td><input type="text" name="TxtRutaImagen" id="TxtRutaImagen" class="TxtRutaImagen" title="Escriba el nombre de la foto que aparecerá en la app al iniciar sesión" /></td>
                </tr>
                <tr>
                  <td width="170">Sucursal</td>
                  <td width="194"><select name="LstSucursal" id="LstSucursal" class="LstSucursal" title="Elija la sucursal a la que pertenece el usuario.">
                    <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_sucursales['IdSucursal']?>"><?php echo $row_sucursales['NombreSucursal']?></option>
                      <?php
                      } while ($row_sucursales = mysql_fetch_assoc($sucursales));
                        $rows = mysql_num_rows($sucursales);
                        if($rows > 0) {
                          mysql_data_seek($sucursales, 0);
                          $row_sucursales = mysql_fetch_assoc($sucursales);
                        }
                    ?>
                  </select></td>
                  <td width="201">Puesto</td>
                    <td width="190"><input name="TxtPuesto" type="text" id="TxtPuesto" maxlength="30" class="CajaTexto" tabindex="11" title="Escriba su nombre de usuario. Ejemplo: Vendedor, Almacenista, etc." /></td>
                </tr>
                <tr>
                  <td>Tipo de usuario</td>
                  <td><select name="LstTipoUsuario" id="LstTipoUsuario" title="Seleccione el nivel de privilegios del usuario cuando acceda al sistema.">
                    <option value="root">Super Usuario</option>
                    <option value="limitado">Limitado</option>
                    <option value="administrador">Administrador</option>
                    <option value="vendedor">Vendedor</option>
                  </select></td>
                  <td>Teléfono de la empresa</td>
                    <td><input name="TxtTelefonoEmpresa" type="text" id="TxtTelefonoEmpresa" maxlength="30" class="CajaTexto" tabindex="12" title="Escriba el número de teléfono otorgado por la empresa (bardahal) al usuario" /></td>
                </tr>
                <tr>
                  <td>Nombre de usuario</td>
                  <td><input name="TxtUsuario" type="text" class="CajaTexto" id="TxtUsuario" tabindex="3" title="Escriba su nombre de usuario." maxlength="30" /></td>
                  <td>Teléfono Particular 1</td>
                  <td><input name="TxtTelefonoParticular" type="text" id="TxtTelefonoParticular" maxlength="30" class="CajaTexto" tabindex="13" title="Escriba el nombre de usuario para acceder al sistema (Se recomienda sea una sola palabra): Ej. vendedor1" /></td>
                </tr>
                <tr>
                  <td>Contraseña</td>
                  <td><input name="TxtPasswrd" type="password" id="TxtPasswrd" maxlength="30" class="CajaTexto" tabindex="4" title="Escriba su contraseña de acceso al sistema" /></td>
                  <td>Teléfono Particular 2</td>
                  <td><input name="TxtTelefonoParticular2" type="text" id="TxtTelefonoParticular2" maxlength="30" class="CajaTexto" tabindex="14" title="Escriba un número de teléfono para contactar al usuario" /></td>
                </tr>
                <tr>
                  <td>Nombre completo del usuario</td>
                  <td><input name="TxtNombre" type="text" id="TxtNombre" maxlength="30" class="CajaTexto" tabindex="5" title="Escriba el nombre completo del usuario. Ej. Jesús Guillermo Vital García" /></td>
                  <td>email</td>
                  <td><input name="Txtemail" type="text" id="Txtemail" maxlength="30" class="CajaTexto" tabindex="15" title="Escriba el correo electronico del usuario Ej. Vendedor" /></td>
                </tr>
                <tr>
                  <td>Calle</td>
                  <td><input name="TxtCalle" type="text" id="TxtCalle" maxlength="30" class="CajaTexto" tabindex="6" title="Escria el nombre de la calle donde radica el usuario." /></td>
                  <td>NSS (Número de Seguridad Social)</td>
                  <td><input name="TxtNSS" type="text" id="TxtNSS" maxlength="30" class="CajaTexto" tabindex="16" title="Escriba el Número de seguro social del usuario" /></td>
                </tr>
                <tr>
                  <td>Número Exterior</td>
                  <td><input name="TxtNExterior" type="text" id="TxtNExterior" maxlength="30" class="CajaTexto" tabindex="7" title="Escriba el Número exterior del domicilio del usuario." /></td>
                  <td>RFC (Registro Federal de Contribuyentes)</td>
                  <td><input name="TxtRFC" type="text" id="TxtRFC" maxlength="30" class="CajaTexto" tabindex="17" title="Escriba el Registro Federal de contribuyentes del usuario Ej. VIGJ830223JQ4" /></td>
                </tr>
                <tr>
                  <td>Número Interior</td>
                  <td><input name="TxtNinterior" type="text" id="TxtNinterior" maxlength="30" class="CajaTexto" tabindex="8" title="Escriba el Número interior (opcional) del domicilio del usuario.." /></td>
                  <td>Fecha de Ingreso: </td>
                  <td><input name="TxtFechaIngreso" type="text" id="TxtFechaIngreso" maxlength="30" class="CajaTexto" tabindex="18" title="Fecha de Ingreso a Bardahl" /></td>
                </tr>
                <tr>
                  <td>Colonia: </td>
                  <td><input name="TxtColonia" type="text" id="TxtColonia" maxlength="30" class="CajaTexto" tabindex="9" title="Colonia donde vive el usuario." /></td>
                  <td></td>
                  <td></td>
                </tr>                
                <tr>
                  <td>Codigo Postal:</td>
                  <td><input name="TxtCP" type="text" id="TxtCP" maxlength="30" class="CajaTexto" tabindex="10" title="Escriba el código postal donde vive el usuario" /></td>
                  <td>Contacto de Emergencia</td>
                  <td><input name="TxtContactoEmergencia" type="text" id="TxtContactoEmergencia" maxlength="30" class="CajaTexto" tabindex="20" title="Nombre de la persona a contactar en caso de una emergencia al usuario" /></td>
                </tr>
                <tr>
                  <td>Grupo Sanguineo:</td>
                  <td><input type="text" name="TxtGrupoSanguineo" id="TxtGrupoSanguineo" /></td>
                  <td>Tel. Contacto Emergencia</td>
                  <td><input type="text" name="TxtTelContactoEmergencia" id="TxtTelContactoEmergencia" /></td>
                </tr>
                <tr>
                  <td colspan="4"><label>
                    <div align="center">
                      <input type="submit" name="Submit" value="Guardar" tabindex="21" id="Submit" />
                    </div>
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