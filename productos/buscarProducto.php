<?php session_start();
    require_once('../Connections/conexion.php'); 
    if ($_SESSION["TipoUsuarioGlobal"] =='root'):
?>        
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
// Excluimos a Apatzingan a petición de Maribel, ya que pertenece a Uruapan.
$query_sucursales = "SELECT IdSucursal, NombreSucursal FROM sucursales ORDER BY IdSucursal ASC";
$sucursales = mysqli_query($conexion, $query_sucursales) or die(mysql_error());
$row_sucursales = mysqli_fetch_assoc($sucursales);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <!-- Hace que los acentos se vean apropiadamente -->
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>    
    <!-- Finalizacion JQuery -->
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <link href="../css/Paginacion.css" rel="stylesheet" type="text/css" />
    <script tyoe="text/javascript" src="../js/ajaxBuscarProductos.js"></script> 
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <script type="text/javascript">
    function confirmar()
    {
      if(confirm('Esta seguro(a) de eliminar este prodcto\n Esta acci\u00f3n no se puede deshacer'))
        return true;
      else
        return false;
    }
    </script>
    <title>B&uacute;squeda de productos - El Korsario</title>
</head>
<body onload="cargaXMLProductos('rutinaBuscarProductos.php','1')">
<div id="Cabecera">
    <div id="ContenedorCabeceraSuperior">
        <img src="../assets/logo.png" />
    </div> 		 
    <div id="FondoMenu">
        <div id="ContenedorMenu">	
            <?php include("../menu/menu.php"); ?> 
        </div> <!-- Fin ContenedorMenu -->
    </div> <!-- Fin FondoMenu -->
</div><!-- Fin Cabecera -->
<div id="MainBody">
    <div id="TituloFormulario">
      <p align="center">B&uacute;squeda de productos.</p>
    </div><!-- Fin TituloFormulario -->
    <div id="FondoFormularios">
    <p align="center"> </p>
    
    <table width="880" border="0"> 
      <tr>
        <td width="786">B&uacute;squeda por: Nombre:
        <input type="text" name="TxtBusqueda" id="TxtBusqueda" class="TxtBusqueda" value='<?php echo $busqueda; ?>' />
        Sucursal: 
        <select name="LstSucursales" id="LstSucursales" class="LstSucursales" onchange="cargaXMLProductos('rutinaBuscarProductos.php','1')">
          <option value="">[Todos]</option>
          <?php
            do {  
            ?>
          <option value="<?php echo $row_sucursales['IdSucursal']?>"><?php echo $row_sucursales['NombreSucursal']?></option>
          <?php
            } while ($row_sucursales = mysqli_fetch_assoc($sucursales));
              $rows = mysqli_num_rows($sucursales);
              if($rows > 0) {
                mysqli_data_seek($sucursales, 0);
                $row_sucursales = mysqli_fetch_assoc($sucursales);
              }
            ?>
        </select></td>
        <td width="84"><input type="button" name="BtnBuscar" id="BtnBuscar" value="Buscar" onclick="cargaXMLProductos('rutinaBuscarProductos.php','1')" /></td>
      </tr>
    </table>                 
    <table width="881">
      <tr>
          <td width="224">Mostrar
            <select name="LstCantidad" id="LstCantidad" class="LstCantidad" onchange="cargaXMLProductos('rutinaBuscarProductos.php','1')">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
          	</select> 
            resultados por p&aacute;gina
          </td>
          <td width="90">:</td>
          <td width="106">Ordenar Por:</td>
          <td width="77"><select name="LstOrdenar" id="LstOrdenar" class="LstOrdenar" onchange="cargaXMLProductos('rutinaBuscarProductos.php','1')">
            <option value="Codigo">Codigo</option>
            <option value="Cantidad">Cantidad</option>
            <option value="Descripcion">Descripcion</option>
            <option value="PrecioCompra">P. Compra</option>
            <option value="PrecioVenta">P. Venta</option>
            <option value="PrecioVentaEspecial">P. Venta Especial</option>
          </select></td>
          <td width="134">&nbsp;</td>
          <td width="100">Tipo:</td>
          <td width="118"><select name="LstTipo" id="LstTipo" class="LstTipo" onchange="cargaXMLProductos('rutinaBuscarProductos.php','1')"> ajax<option value="ASC">Ascendente</option>
            <option value="DESC">Descendente</option>
          </select></td>
      </tr>	
    </table>
    <input type="hidden" name="TxtFechaInicialHidden" class="TxtFechaInicialHidden" id="TxtFechaInicialHidden" />
    <input type="hidden" name="TxtFechaFinalHidden" class="TxtFechaFinalHidden" id="TxtFechaFinalHidden" />
     <div id="FondoFormulariosDashboard">
	<div id="ListadoProductos" >
       	
       </div><!-- Fin ListadoDashboard -->
     </div> <!-- Fin FondoFormulariosDashboard -->    
    </div>
</div><!-- Fin MainBody -->
<div id="footer">
  <?php include("../assets/footer.php"); ?>
</div> <!-- Fin footer-->
</body>
<?php
mysqli_free_result($sucursales);
?>
<?php
else:
echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;duelo! </font></p>
<p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
  para visualizar los datos.<p align=center>Si ha iniciado sesión pida al administrador del sitio que le otorga los privilegios necesarios</p></font></p>";
endif; ?>