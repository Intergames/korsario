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
    $query_estados = "SELECT * FROM estados ORDER BY Nombre ASC";
    $estados = mysqli_query($conexion, $query_estados) or die(mysql_error());
    $row_estados = mysqli_fetch_assoc($estados);
    $total_rows_estados = mysqli_num_rows($estados);
    ?>
<title>Nuevo sucursal - Korsario</title>
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
    <form name="form1" method="post" action="procesarNuevaSucursal.php" enctype="multipart/form-data">
        <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
        <div id="MainBody">
        <div id="TituloFormulario"><p align="center">Nueva Sucursal</p></div>
          <div id="FondoFormularios">
            <center>
              <table border="0">                
                <tr>
                  <td>Nombre de la sucursal: </td>
                  <td><input name="TxtNombreSucursal" type="text" id="TxtNombreSucursal" maxlength="30" class="CajaTexto" title="Escriba el nombre de la nueva sucursal. Ej. Nombre de la ciudad" /></td>
                </tr>
                <tr>
                  <td>Direcci&oacute;n</td>
                  <td><input name="TxtDireccion" type="text" id="TxtDireccion" maxlength="50" class="CajaTexto" title="Escriba la direccion completa donde se encuentra la nueva sucursal Ej. Cuba # 34." /></td>
                </tr>
                <tr>
                  <td>Colonia: </td>
                  <td><input name="TxtColonia" type="text" id="TxtColonia" maxlength="30" class="CajaTexto" title="Escriba el nombre de la colonia donde esta la nueva sucursal. Ej. Centro" /></td>
                </tr>
                <tr>
                  <td>Codigo Postal</td>
                  <td><input name="TxtCodigoPostal" type="text" id="TxtCodigoPostal" maxlength="30" class="CajaTexto" title="Escriba el c&oacute:digo postal de la nueva sucursal Ej 60000." /></td>
                </tr>
                <tr>
                  <td>Ciudad: </td>
                  <td><input name="TxtCiudad" type="text" id="TxtCiudad" maxlength="30" class="CajaTexto" title="Escriba la marca del producto que se va a ingrear a inventario." /></td>
                </tr>
                <tr>
                  <td>Estado</td>
                    <td>
                        <select name="LstEstado" id="LstEstado" class="LstEstado">
                            <?php
                              do {  
                              ?>
                              <option value="<?php echo $row_estados['Nombre']?>"><?php echo $row_estados['Nombre']; ?></option>
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
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><label>
                    <input type="submit" name="Submit" value="Guardar Sucursal" id="Submit" />
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