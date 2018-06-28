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
    <script type="text/javascript" src="../js/validarEditarCliente.js"></script>
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

    // mysql_select_db($database_conexion, $conexion);
    $query_Estados = "SELECT * FROM estados ORDER BY Nombre ASC";
    $Estados = mysqli_query($conexion, $query_Estados) or die(mysql_error());
    $row_Estados = mysqli_fetch_assoc($Estados);
    $totalRows_Estados = mysqli_num_rows($Estados);
    ?>

    <?php
    $IdCliente = $_GET['recordID'];
    // mysql_select_db($database_conexion, $conexion);
    $query_clientes = "SELECT * FROM clientes WHERE IdCliente = '$IdCliente' ";
    $clientes = mysqli_query($conexion, $query_clientes) or die(mysql_error());
    $detalle_cliente = mysqli_fetch_assoc($clientes);    
    
    ?>
    <title>Edici&oacute;n de datos de un cliente - El Korsario</title>
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
    <form name="form1" method="post" action="procesarEditarCliente.php">
        <input type="hidden" name="IdCliente" value="<?php echo $IdCliente; ?>" id="IdCliente"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Edición del cliente: <?php echo $detalle_cliente['Nombre']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td width="157">RFC</td>
                  <td width="209"><input name="TxtRFC" type="text" id="TxtRFC" maxlength="30" class="CajaTexto" title="Escriba el Registro Federal de Contribuyentes Ej. VIGJ8302223JQ4" value="<?php echo $detalle_cliente['RFC']; ?>"/></td>
                  <td>Nombre de cliente</td>
                  <td><input name="TxtNombre" type="text" id="TxtNombre" maxlength="30" class="CajaTexto" tabindex="3" title="Escriba el nombre completo del cliente" value="<?php echo $detalle_cliente['Nombre']; ?>" /></td>  
                </tr>                
                <tr>
                  <td>Representante</td>
                  <td><input name="TxtRepresentante" type="text" id="TxtRepresentante" maxlength="30" class="CajaTexto" tabindex="2" title="Escriba el nombre del representante del cliente (Quien pudiera responder en nombre de el)." value="<?php echo $detalle_cliente['Representante']; ?>"/></td>
                  <td>Ciudad</td>
                  <td><input name="TxtCiudad" type="text" id="TxtCiudad" maxlength="30" class="CajaTexto" title="Escriba la ciudad de residenia/local del cliente Ej. Uruapan" value="<?php echo $detalle_cliente['Ciudad']; ?>"/></td>
                </tr>
                <tr>
                  <td>Estado</td>
                  <td><select name="LstEstado" id="LstEstado" class="LstEstado" title="Elija el estado de la república del cliente.">
                    <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_Estados['Nombre']?>" <?php if ($row_Estados['Nombre'] == $detalle_cliente['Estado']) echo "selected=selected"; ?>><?php echo $row_Estados['Nombre']?></option>
                      <?php
                      } while ($row_Estados = mysqli_fetch_assoc($Estados));
                        $rows = mysqli_num_rows($Estados);
                        if($rows > 0) {
                          mysqli_data_seek($Estados, 0);
                          $row_Estados = mysqli_fetch_assoc($Estados);
                      }
                      ?>
                  </select></td>
                  <td>Municipio</td>
                  <td><input name="TxtMunicipio" type="text" id="TxtMunicipio" maxlength="30" class="CajaTexto" title=" Ej. Uruapan" value="<?php echo $detalle_cliente['Municipio']; ?>" /></td>
                </tr>
                <tr>
                  <td>Calle</td>
                  <td><input name="TxtCalle" type="text" id="TxtCalle" maxlength="30" class="CajaTexto" title="Nombre de la calle donde radica el cliente o la se encuentra la empresa Ej Prol Druango." value="<?php echo $detalle_cliente['Calle']; ?>"/></td>
                  <td>Colonia</td>
                  <td><input name="TxtColonia" type="text" id="TxtColonia" maxlength="30" class="CajaTexto" title="Escriba la colonia de resiencia o local del cliente Ej. Cuahutemoc" value="<?php echo $detalle_cliente['Colonia']; ?>" /></td>
                </tr>
                <tr>
                  <td>Código Postal: </td>
                  <td><input name="TxtCP" type="text" id="TxtCP" maxlength="30" class="CajaTexto" title="Escriba el nombre de la colonia donde vive el cliente Ej. Cuahutemoc" value="<?php echo $detalle_cliente['CP']; ?>" /></td>
                  <td>Tel&eacute;fono</td>
                  <td><input name="TxtTelefono" type="text" id="TxtTelefono" maxlength="30" class="CajaTexto" title="Teléfono de contacto fijo del cliente" value="<?php echo $detalle_cliente['Telefono']; ?>"/></td>
                </tr>
                <tr>
                  <td>Celular:</td>
                  <td><input name="TxtCelular" type="text" id="TxtCelular" maxlength="30" class="CajaTexto" title="Teléfono Celular de Cliente" value="<?php echo $detalle_cliente['Celular']; ?>" /></td>
                  <td>FAX:</td>
                  <td><input name="TxtFax" type="text" id="TxtFax" maxlength="30" class="CajaTexto" title="Numero donde se puden enviar fax a un cliente." value="<?php echo $detalle_cliente['Fax']; ?>" /></td>
                </tr>
                <tr>
                  <td>e-mail: </td>
                  <td><input name="Txtemail" type="text" id="Txtemail" maxlength="30" class="CajaTexto" title="Correo electrónico del cliente E. gvital83@gmail.com" value="<?php echo $detalle_cliente['email']; ?>"/></td>
                  <td>Descuento:</td>
                  <td><input name="TxtDescuento" type="text" id="TxtDescuento" maxlength="30" class="CajaTexto" title="Descuento permitido al cliente" value="<?php echo $detalle_cliente['Descuento']; ?>"/></td>
                </tr>
                <tr>
                  <td>Observaciones:</td>
                  <td colspan="3">
                    <textarea name="TxtObservaciones" id="TxtObservaciones" cols="30"><?php echo $detalle_cliente['Observaciones']; ?></textarea>
                  </td>
                </tr>                
                <tr>
                  <td colspan="4"><label>
                    <div align="center">
                      <input type="submit" name="Submit" value="Guardar" id="Submit" />
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
<?php
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif; ?>