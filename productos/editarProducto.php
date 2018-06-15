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
    // Excluimos a Apatingan por que pertenece a Uruapan
    $query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales WHERE IdSucursal != 6 ORDER BY IdSucursal ASC";
    $sucursales = mysqli_query($conexion, $query_sucursales) or die(mysql_error());
    $row_sucursales = mysqli_fetch_assoc($sucursales);
    ?>

    <?php
    $IdProducto = $_GET['recordID'];
    // mysql_select_db($database_conexion, $conexion);
    $query_productos = "SELECT * FROM productos WHERE IdProducto = '$IdProducto' ";
    $productos = mysqli_query($conexion, $query_productos) or die(mysql_error());
    $detalle_producto = mysqli_fetch_assoc($productos);    
    
    ?>
    <title>Edici&oacute;n de datos de un producto - Bardahl</title>
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
    <form name="form1" method="post" action="procesarEditarProducto.php">
        <input type="hidden" name="IdProducto" value="<?php echo $IdProducto; ?>" id="IdProducto"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Edición del producto: <?php echo $detalle_producto['Descripcion']; ?></p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Sucursal</td>
                    <td>
                        <select name="LstSucursal" id="LstSucursal" class="LstSucursal">
                            <?php
                              do {  
                              ?>
                              <option value="<?php echo $row_sucursales['IdSucursal']?>" <?php if ($detalle_producto['IdSucursal'] == $row_sucursales['IdSucursal'] ) echo "selected=selected"; ?> ><?php echo $row_sucursales['NombreSucursal']?></option>
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
                    <td>
                       Revendedor 
                    </td>
                    <td>
                      <input name="TxtPrecioVenta" type="text" id="TxtPrecioVenta" maxlength="30" class="CajaTexto" title="Escriba el precio a otorgar a los revendedores." value="<?php echo $detalle_producto['PrecioVenta']; ?>" />
                    </td>
                    <td>
                </tr>
                <tr>
                  <!-- <td>Imagen</td>
                  <td><input name="TxtRutaFoto" type="file" class="CajaTexto" id="TxtRutaFoto" title="Elija una imagen que desee reemplazar por la foto actual." /></td> -->
                  <td>Gasolinero</td>
                  <td><input name="TxtPrecioVentaEspecial" type="text" id="TxtPrecioVentaEspecial" maxlength="30" class="CajaTexto" title="Escriba el precio al cual se va a vender el producto a una persona con un descuento preferente dentro de la refaccionaria." value="<?php echo $detalle_producto['PrecioVentaEspecial']; ?>"/></td>
                  <td>G500</td>
                  <td><input name="TxtG500" type="text" id="TxtG500" maxlength="30" class="CajaTexto" title="Escriba la cantidad minima de este producto antes de que sea necesario volver a surtir." value="<?php echo $detalle_producto['G500']; ?>" /></td>
                </tr>
                <tr>
                  <td>C&oacute;digo de Barras</td>
                  <td><input name="TxtCodigoBarras" type="text" id="TxtCodigoBarras" maxlength="50" class="CajaTexto" title="Escriba el código de barras asociado al producto." value="<?php echo $detalle_producto['Codigo']; ?>"/></td>
                  <td>Precio Especial</td>
                  <td><input type="text" name="TxtGEspecial" id="TxtGEspecial" title="Escriba el precio al que bardahl obtuvo el producto con el proveeedor" value="<?php echo $detalle_producto['GEspecial']; ?>" /></td>
                </tr>
                <tr>
                  <td>Cantidad</td>
                  <td><input name="TxtCantidad" type="text" id="TxtCantidad" maxlength="30" class="CajaTexto" title="Escriba la cantidad de dicho producto que entará por primera vez a inventario." value="<?php echo $detalle_producto['Cantidad']; ?>"/></td>
                  <td>Medida</td>
                  <td><input name="TxtMedida" type="text" id="TxtMedida" maxlength="30" class="CajaTexto" title="Escriba el alto y ancho del producto." value="<?php echo $detalle_producto['Medida']; ?>" /></td>
                </tr>
                <tr>
                  <td>Producto</td>
                  <td><input name="TxtDescripcion" type="text" id="TxtDescripcion" maxlength="30" class="CajaTexto" title="Escriba de que producto se trata. (Aceite, tornillos, etc." value="<?php echo $detalle_producto['Descripcion']; ?>" /></td>
                  <td>Unidad de Medida</td>
                  <td><input name="TxtUnidadMedida" type="text" id="TxtUnidadMedida" maxlength="30" class="CajaTexto" title="Escriba si el producto se mide en centimetros, litros, galones, etc." value="<?php echo $detalle_producto['UnidadMedida']; ?>" /></td>
                </tr>
                <tr>
                  <td>Marca</td>
                  <td><input name="TxtMarca" type="text" id="TxtMarca" maxlength="30" class="CajaTexto" title="Escriba la marca del producto que se va a ingrear a inventario." value="<?php echo $detalle_producto['Marca']; ?>" /></td>
                </tr>
                <tr>
                  <td>Comentario</td>
                  <td colspan="3"><textarea name="TxtComentario" cols="30" rows="3" id="TxtComentario" title="Escriba cualquier anotacion que desee para este producto."><?php echo $detalle_producto['Comentario']; ?></textarea></td>
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