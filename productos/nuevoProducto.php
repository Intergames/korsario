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

    // mysql_select_db($database_conexion, $conexion);
    $query_sucursales = "SELECT * FROM sucursales WHERE IdSucursal != 6 ORDER BY NombreSucursal ASC";
    $sucursales = mysqli_query($conexion,$query_sucursales) or die(mysql_error());
    $row_sucursales = mysqli_fetch_assoc($sucursales);
    $total_rows_sucursales = mysqli_num_rows($sucursales);
    ?>
<title>Nuevo producto en inventario - El Korsario</title>
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
    <form name="form1" method="post" action="procesarNuevoProducto.php" enctype="multipart/form-data">
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Nuevo Producto</p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">
                <tr>
                  <td>Sucursal</td>
                  <td><select name="LstSucursal" id="LstSucursal" class="LstSucursal">
                    <?php
                    do {  
                    ?>
                    <option value="<?php 
                      echo $row_sucursales['IdSucursal']?>">
                      <?php 
                      echo $row_sucursales['NombreSucursal']; 
                      ?>
                    </option>
                    <?php
                      } while ($row_sucursales = mysqli_fetch_assoc($sucursales));
                        $rows = mysqli_num_rows($sucursales);
                        if($rows > 0) {
                          mysqli_data_seek($sucursales, 0);
                          $row_sucursales = mysqli_fetch_assoc($sucursales);
                        }
                    ?>
                  </select></td>
                  <td>Medida</td>
                  <td><input name="TxtMedida" type="text" id="TxtMedida" maxlength="30" class="CajaTexto" title="Escriba el alto y ancho del producto." /></td>
                </tr>
                <tr>
                  
                  <td>Unidad de Medida</td>
                  <td><input name="TxtUnidadMedida" type="text" id="TxtUnidadMedida" maxlength="30" class="CajaTexto" title="Escriba si el producto se mide en centimetros, litros, galones, etc." /></td>
                  <td>C&oacute;digo de Barras</td>
                  <td><input name="TxtCodigoBarras" type="text" id="TxtCodigoBarras" maxlength="50" class="CajaTexto" title="Escriba el código de barras asociado al producto." /></td>
                </tr>
                <tr>
                  <td>Cantidad</td>
                  <td><input name="TxtCantidad" type="text" id="TxtCantidad" maxlength="30" class="CajaTexto" title="Escriba la cantidad de dicho producto que entará por primera vez a inventario." /></td>
                  <td>Producto</td>
                  <td><input name="TºtDescripcion" type="text" id="TxtDescripcion" maxlength="30" class="CajaTexto" title="Escriba de que producto se trata. (Pantalos camisa, blusa, corbata, etc)." /></td>
                </tr>
                <tr>
                  <td>Marca</td>
                  <td><input name="TxtMarca" type="text" id="TxtMarca" maxlength="30" class="CajaTexto" title="Escriba la marca del producto que se va a ingrear a inventario." /></td>
                </tr>
                <tr>
                  <td>Comentario</td>
                  <td colspan="3"><textarea name="TxtComentario" cols="30" rows="3" id="TxtComentario" title="Escriba cualquier anotacion que desee para este producto."></textarea></td>
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