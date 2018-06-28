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
    <script type="text/javascript" src="../js/validarNuevoCliente.js"></script>
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
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
    $sucursales = mysqli_query($conexion, $query_sucursales) or die(mysql_error());
    $row_sucursales = mysqli_fetch_assoc($sucursales);
    $conteo_row_sucursales = mysqli_num_rows($sucursales);

    $query_estados = "SELECT IdEstado, Nombre FROM estados ORDER BY IdEstado ASC";
    $estados = mysqli_query($conexion, $query_estados) or die(mysql_error());
    $row_estados = mysqli_fetch_assoc($estados);
    $conteo_estados = mysqli_num_rows($estados);
    ?>
<title>Nuevo Cliente - El Korsario</title>
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
    <form name="form1" method="post" action="procesarNuevoCliente.php" enctype="multipart/form-data">
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Nuevo Cliente</p></div>
          <div id="FondoFormularios">
            <center>
              <table width="729" border="0">
                <tr>
                  <td width="188">RFC</td>
                  <td width="157">
                    <input name="TxtRFC" type="text" id="TxtRFC" maxlength="30" class="CajaTexto" title="Registro Federal de Contribuyentes"/>
                  </td>
                  <td>Nombre de cliente</td>
                  <td>
                    <input name="TxtNombreCliente" type="text" id="TxtNombreCliente" maxlength="30" class="CajaTexto" tabindex="3" title="Escriba el nombre completo del cliente" />
                  </td>
                </tr>                
                <tr>
                  <td width="157">Representante: </td>
                  <td width="209">
                    <input name="TxtRepresentante" type="text" id="TxtRepresentante" maxlength="30" class="CajaTexto" title="Representante legal de cliente" />
                  </td>
                  <td>Ciudad</td>
                  <td>
                    <input name="TxtCiudad" type="text" id="TxtCiudad" maxlength="30" class="CajaTexto" title="Escriba la ciudad de residenia/local del cliente Ej. Uruapan" />
                  </td>
                </tr>
                <tr>
                  <td>Estado</td>
                  <td><select name="LstEstado" id="LstEstado" class="LstEstado" title="Elija el estado de la república del cliente.">
                    <?php
                      do {  
                      ?>
                      <option value="<?php echo $row_estados['Nombre']?>"><?php echo $row_estados['Nombre']?></option>
                      <?php
                      } while ($row_estados = mysqli_fetch_assoc($estados));
                        $rows = mysqli_num_rows($estados);
                        if($rows > 0) {
                          mysqli_data_seek($estados, 0);
                          $row_estados = mysqli_fetch_assoc($estados);
                      }
                      ?>
                  </select>
                  </td>
                  <td>Municipio</td>
                  <td><input name="TxtMunicipio" type="text" id="TxtMunicipio" maxlength="30" class="CajaTexto" title="Escriba el municipio donde pertenece el cliente Ej. Uruapan" /></td>
                  <td></td>

                </tr>
                <tr>
                  <td>Calle</td>
                  <td><input name="TxtCalle" type="text" id="TxtCalle" maxlength="30" class="CajaTexto" title="Nombre de la calle donde radica el cliente o la se encuentra la empresa Ej Prol Druango." /></td>
                  <td>Colonia</td>
                  <td><input name="TxtColonia" type="text" id="TxtColonia" maxlength="30" class="CajaTexto" title="Escriba la colonia de resiencia o local del cliente Ej. Cuahutemoc" /></td>
                </tr>                
                <tr>
                  <td>Codigo Postal</td>
                  <td><input name="TxtCP" type="text" id="TxtCP" maxlength="30" class="CajaTexto" title="Escriba el código postal del cliente. Ej. 60140" /></td><td>Telefono</td>
                  <td><input name="TxtTelefono" type="text" id="TxtTelefono" maxlength="30" class="CajaTexto" title="Escriba el número de teléfono fijo del cliente." /></td>
                </tr>
                <tr>
                  <td>Celular:</td>
                  <td><input name="TxtCelular" type="text" id="TxtCelular" maxlength="30" class="CajaTexto" title="Número de teléfono celular de cliente" /></td>
                  <td>FAX</td>
                  <td><input name="TxtFax" type="text" id="TxtFax" maxlength="30" class="CajaTexto" title="Escriba el número de fax del cliente" /></td>
                </tr>
                <tr>
                  <td>email</td>
                  <td><input name="Txtemail" type="text" id="Txttemail" maxlength="30" class="CajaTexto" title="Escriba el correo electronico del cliente, Ej. gvital83@gmail.com" /></td>
                  <td>Descuento</td>
                  <td><input name="TxtDescuento" type="text" id="TxtDescuento" maxlength="30" class="CajaTexto" title="Escriba un  número entreo 0 y 100 para definir el porcentaje de descuento para el cliente" /></td>
                </tr>
                <tr>
                  <td>Observaciones:</td>
                  <td colspan="3">
                    <textarea name="TxtObservaciones" id="TxtObservaciones" cols="30"></textarea>
                  </td>
                </tr>
                <tr>
                  <td colspan="4"><label>
                    <div align="center">
                      <input type="submit" name="GuardarNuevoCliente" value="Guardar" id="GuardarNuevoCliente" class="GuardarNuevoCliente" />
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