<?php session_start(); 
  require_once('../Connections/conexion.php');
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
    ?>
<title>Detalle de Sucursal - Bardahl</title>
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
  <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
  <div id="MainBody">
  <div id="TituloFormulario"><p align="center">Cambio de estados de pedidos a facturación</p></div>
    <div id="FondoFormularios">
      <?php
        // Recibimos el valor inicial de los folios de los pedidos
        $FolioInicial = $_POST['ultimoFolio'];
        $Sucursal = $_POST['Sucursal'];
        $FolioPedido = $FolioInicial + 1;
        $NombreArchivo = "Pedido".$FolioPedido.".txt";
        $FechaActual = date("m/d/Y");
        $FechaDiaAnterior = date("m/d/Y", strtotime('-1 day'));
        mysql_select_db($database_conexion,$conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
        $file = fopen ($NombreArchivo,"w");
        fwrite($file, "DOCUMENTOS"."\r\n");
        fwrite($file, "MGW10008"."\r\n");
        fwrite($file, "cCodigoConcepto"."\r\n");
        fwrite($file, "CSERIEDOCUMENTO"."\r\n");
        fwrite($file, "CFOLIO"."\r\n");
        fwrite($file, "CFECHA"."\r\n");
        fwrite($file, "cCodigoCteProv"."\r\n");
        fwrite($file, "CRAZONSOCIAL"."\r\n");
        fwrite($file, "CRFC"."\r\n");
        fwrite($file, "cCodigoAgente"."\r\n");
        fwrite($file, "CFECHAVENCIMIENTO"."\r\n");
        fwrite($file, "CFECHAPRONTOPAGO"."\r\n");
        fwrite($file, "CFECHAENTREGARECEPCION"."\r\n");
        fwrite($file, "CFECHAULTIMOINTERES"."\r\n");
        fwrite($file, "CIDMONEDA"."\r\n");
        fwrite($file, "CTIPOCAMBIO"."\r\n");
        fwrite($file, "CREFERENCIA"."\r\n");
        fwrite($file, "cCodigoDocumentoOrigen"."\r\n");
        fwrite($file, "CAFECTADO"."\r\n");
        fwrite($file, "CIMPRESO"."\r\n");
        fwrite($file, "CCANCELADO"."\r\n");
        fwrite($file, "CDEVUELTO"."\r\n");
        fwrite($file, "CIDPREPOLIZA"."\r\n");
        fwrite($file, "CIDPREPOLIZACANCELACION"."\r\n");
        fwrite($file, "CESTADOCONTABLE"."\r\n");
        fwrite($file, "CGASTO1"."\r\n");
        fwrite($file, "CGASTO2"."\r\n");
        fwrite($file, "CGASTO3"."\r\n");
        fwrite($file, "CDESCUENTOPRONTOPAGO"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO1"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO2"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO3"."\r\n");
        fwrite($file, "CPORCENTAJERETENCION1"."\r\n");
        fwrite($file, "CPORCENTAJERETENCION2"."\r\n");
        fwrite($file, "CPORCENTAJEINTERES"."\r\n");
        fwrite($file, "CTEXTOEXTRA1"."\r\n");
        fwrite($file, "CTEXTOEXTRA2"."\r\n");
        fwrite($file, "CTEXTOEXTRA3"."\r\n");
        fwrite($file, "CFECHAEXTRA"."\r\n");
        fwrite($file, "CIMPORTEEXTRA1"."\r\n");
        fwrite($file, "CIMPORTEEXTRA2"."\r\n");
        fwrite($file, "CIMPORTEEXTRA3"."\r\n");
        fwrite($file, "CIMPORTEEXTRA4"."\r\n");
        fwrite($file, "CDESTINATARIO"."\r\n");
        fwrite($file, "CNUMEROGUIA"."\r\n");
        fwrite($file, "CMENSAJERIA"."\r\n");
        fwrite($file, "CCUENTAMENSAJERIA"."\r\n");
        fwrite($file, "CNUMEROCAJAS"."\r\n");
        fwrite($file, "CPESO"."\r\n");
        fwrite($file, "COBSERVACIONES"."\r\n");
        fwrite($file, "CBANOBSERVACIONES"."\r\n");
        fwrite($file, "CBANDATOSENVIO"."\r\n");
        fwrite($file, "CBANCONDICIONESCREDITO"."\r\n");
        fwrite($file, "CBANGASTOS"."\r\n");
        fwrite($file, "CIMPCHEQPAQ"."\r\n");
        fwrite($file, "CSISTORIG"."\r\n");
        fwrite($file, "CIDMONEDCA"."\r\n");
        fwrite($file, "CTIPOCAMCA"."\r\n");
        fwrite($file, "/MGW10008"."\r\n");
        fwrite($file, "MGW10011"."\r\n");
        fwrite($file, "CTIPOCATALOGO"."\r\n");
        fwrite($file, "CTIPODIRECCION"."\r\n");
        fwrite($file, "CNOMBRECALLE"."\r\n");
        fwrite($file, "CNUMEROEXTERIOR"."\r\n");
        fwrite($file, "CNUMEROINTERIOR"."\r\n");
        fwrite($file, "CCOLONIA"."\r\n");
        fwrite($file, "CCODIGOPOSTAL"."\r\n");
        fwrite($file, "CTELEFONO1"."\r\n");
        fwrite($file, "CTELEFONO2"."\r\n");
        fwrite($file, "CTELEFONO3"."\r\n");
        fwrite($file, "CTELEFONO4"."\r\n");
        fwrite($file, "CEMAIL"."\r\n");
        fwrite($file, "CDIRECCIONWEB"."\r\n");
        fwrite($file, "CPAIS"."\r\n");
        fwrite($file, "CESTADO"."\r\n");
        fwrite($file, "CCIUDAD"."\r\n");
        fwrite($file, "CTEXTOEXTRA"."\r\n");
        fwrite($file, "CMUNICIPIO"."\r\n");
        fwrite($file, "/MGW10011"."\r\n");
        fwrite($file, "MGW10010"."\r\n");
        fwrite($file, "CNUMEROMOVIMIENTO"."\r\n");
        fwrite($file, "cCodigoProducto"."\r\n");
        fwrite($file, "cCodigoAlmacen"."\r\n");
        fwrite($file, "CUNIDADES"."\r\n");
        fwrite($file, "CUNIDADESNC"."\r\n");
        fwrite($file, "CUNIDADESCAPTURADAS"."\r\n");
        fwrite($file, "cNombreUnidad"."\r\n");
        fwrite($file, "cNombreUnidadNC"."\r\n");
        fwrite($file, "CPRECIO"."\r\n");
        fwrite($file, "CPRECIOCAPTURADO"."\r\n");
        fwrite($file, "CCOSTOCAPTURADO"."\r\n");
        fwrite($file, "CCOSTOESPECIFICO"."\r\n");
        fwrite($file, "CNETO"."\r\n");
        fwrite($file, "CIMPUESTO1"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO1"."\r\n");
        fwrite($file, "CIMPUESTO2"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO2"."\r\n");
        fwrite($file, "CIMPUESTO3"."\r\n");
        fwrite($file, "CPORCENTAJEIMPUESTO3"."\r\n");
        fwrite($file, "CRETENCION1"."\r\n");
        fwrite($file, "CPORCENTAJERETENCION1"."\r\n");
        fwrite($file, "CRETENCION2"."\r\n");
        fwrite($file, "CPORCENTAJERETENCION2"."\r\n");
        fwrite($file, "CDESCUENTO1"."\r\n");
        fwrite($file, "CPORCENTAJEDESCUENTO1"."\r\n");
        fwrite($file, "CDESCUENTO2"."\r\n");
        fwrite($file, "CPORCENTAJEDESCUENTO2"."\r\n");
        fwrite($file, "CDESCUENTO3"."\r\n");
        fwrite($file, "CPORCENTAJEDESCUENTO3"."\r\n");
        fwrite($file, "CDESCUENTO4"."\r\n");
        fwrite($file, "CPORCENTAJEDESCUENTO4"."\r\n");
        fwrite($file, "CDESCUENTO5"."\r\n");
        fwrite($file, "CPORCENTAJEDESCUENTO5"."\r\n");
        fwrite($file, "CTOTAL"."\r\n");
        fwrite($file, "CPORCENTAJECOMISION"."\r\n");
        fwrite($file, "CREFERENCIA"."\r\n");
        fwrite($file, "CAFECTAEXISTENCIA"."\r\n");
        fwrite($file, "CAFECTADOSALDOS"."\r\n");
        fwrite($file, "CAFECTADOINVENTARIO"."\r\n");
        fwrite($file, "CFECHA"."\r\n");
        fwrite($file, "CMOVTOOCULTO"."\r\n");
        fwrite($file, "cCodigoMovtoOrigen"."\r\n");
        fwrite($file, "CUNIDADESPENDIENTES"."\r\n");
        fwrite($file, "CUNIDADESNCPENDIENTES"."\r\n");
        fwrite($file, "CUNIDADESORIGEN"."\r\n");
        fwrite($file, "CUNIDADESNCORIGEN"."\r\n");
        fwrite($file, "CTIPOTRASPASO"."\r\n");
        fwrite($file, "cCodigoValorClasificacion"."\r\n");
        fwrite($file, "CTEXTOEXTRA1"."\r\n");
        fwrite($file, "CTEXTOEXTRA2"."\r\n");
        fwrite($file, "CTEXTOEXTRA3"."\r\n");
        fwrite($file, "CFECHAEXTRA"."\r\n");
        fwrite($file, "CIMPORTEEXTRA1"."\r\n");
        fwrite($file, "CIMPORTEEXTRA2"."\r\n");
        fwrite($file, "CIMPORTEEXTRA3"."\r\n");
        fwrite($file, "CIMPORTEEXTRA4"."\r\n");
        fwrite($file, "CGTOMOVTO"."\r\n");
        fwrite($file, "COBSERVAMOV"."\r\n");
        fwrite($file, "CCOMVENTA"."\r\n");
        fwrite($file, "CSCMOVTO"."\r\n");
        fwrite($file, "/MGW10010"."\r\n");
        fwrite($file, "MGW10025"."\r\n");
        fwrite($file, "cCodigoAlmacen"."\r\n");
        fwrite($file, "cCodigoProducto"."\r\n");
        fwrite($file, "CFECHA"."\r\n");
        fwrite($file, "CTIPOCAPA"."\r\n");
        fwrite($file, "CNUMEROLOTE"."\r\n");
        fwrite($file, "CFECHACADUCIDAD"."\r\n");
        fwrite($file, "CFECHAFABRICACION"."\r\n");
        fwrite($file, "CPEDIMENTO"."\r\n");
        fwrite($file, "CADUANA"."\r\n");
        fwrite($file, "CFECHAPEDIMENTO"."\r\n");
        fwrite($file, "CTIPOCAMBIO"."\r\n");
        fwrite($file, "CEXISTENCIA"."\r\n");
        fwrite($file, "CCOSTO"."\r\n");
        fwrite($file, "CCODIGOCAPAORIGEN"."\r\n");
        fwrite($file, "CNUMADUANA"."\r\n");
        fwrite($file, "/MGW10025"."\r\n");
        fwrite($file, "MGW10028"."\r\n");
        fwrite($file, "cCodigoCapa"."\r\n");
        fwrite($file, "CFECHA"."\r\n");
        fwrite($file, "CUNIDADES"."\r\n");
        fwrite($file, "CTIPOCAPA"."\r\n");
        fwrite($file, "CNOMBREUNIDADCAPTURA"."\r\n");
        fwrite($file, "/MGW10028"."\r\n");
        fwrite($file, "MGW10032"."\r\n");
        fwrite($file, "cCodigoProducto"."\r\n");
        fwrite($file, "CNUMEROSERIE"."\r\n");
        fwrite($file, "cCodigoAlmacen"."\r\n");
        fwrite($file, "CNUMEROLOTE"."\r\n");
        fwrite($file, "CFECHACADUCIDAD"."\r\n");
        fwrite($file, "CFECHAFABRICACION"."\r\n");
        fwrite($file, "CPEDIMENTO"."\r\n");
        fwrite($file, "CADUANA"."\r\n");
        fwrite($file, "CFECHAPEDIMENTO"."\r\n");
        fwrite($file, "CTIPOCAMBIO"."\r\n");
        fwrite($file, "CCOSTO"."\r\n");
        fwrite($file, "CNUMADUANA"."\r\n");
        fwrite($file, "/MGW10032"."\r\n");
        fwrite($file, "MGW10009"."\r\n");
        fwrite($file, "CLLAVEABONO"."\r\n");
        fwrite($file, "cMonedaAbono"."\r\n");
        fwrite($file, "CLLAVECARGO"."\r\n");
        fwrite($file, "CIDMONEDA"."\r\n");
        fwrite($file, "CIMPORTEABONO"."\r\n");
        fwrite($file, "CIMPORTECARGO"."\r\n");
        fwrite($file, "CFECHAABONOCARGO"."\r\n");
        fwrite($file, "CLLAVEDESCUENTO"."\r\n");
        fwrite($file, "cCodigoCteProv"."\r\n");
        fwrite($file, "/MGW10009"."\r\n");
        fwrite($file, " "."\r\n");
        foreach($_POST['chkMarcados'] as $Folio) 
        { 
          $sql = "UPDATE pedidos SET Status = 'Facturado' WHERE Folio = '$Folio'";
          $resultado =  mysql_query($sql);
          if ($resultado)
          {  
           // Sucursal elegida por el administrador de Uruapan
            $sqlSucursal = "SELECT * FROM sucursales WHERE IdSucursal = '$Sucursal'";
            $resultadoSucursal = mysql_query($sqlSucursal);
            $datosSucursal = mysql_fetch_assoc($resultadoSucursal);
            // Consulta para obtener los datos generales del pedido.
            // Consulta para obtener los datos generales del pedido.
            $sqlPedido = "SELECT * FROM pedidos WHERE Folio = '$Folio'";
            $resultadoPedido = mysql_query($sqlPedido);
            $datosPedido = mysql_fetch_assoc($resultadoPedido);
            $NombreUsuario = $datosPedido['NombreUsuario'];
            // Obtenermos el IdRuta para ponerlo dentro de los .txt a exportar
            $sqlUsuario = "SELECT Codigo FROM usuarios WHERE Nombre = '$NombreUsuario'";
            $resultadoUsuario = mysql_query($sqlUsuario);
            $detalleUsuario = mysql_fetch_assoc($resultadoUsuario);
            // Obtenemos los datos del cliente que efectuó el pedido
            $sqlCliente = "SELECT * FROM clientes WHERE Folio = '".$datosPedido['IdCliente']."'";
            $resultadoCliente = mysql_query($sqlCliente);
            $detalleCliente = mysql_fetch_assoc($resultadoCliente);
            //Obtenemos los registros del pedido en la tabla detalle_pedido
            $sqlDetallePedido = "SELECT detalle_pedido.Cantidad, detalle_pedido.Precio, detalle_pedido.Descuento1, detalle_pedido.Descuento2, detalle_pedido.Neto, detalle_pedido.IVA, detalle_pedido.Total, productos.Codigo FROM detalle_pedido JOIN productos ON detalle_pedido.IdProducto = productos.IdProducto WHERE detalle_pedido.Folio = '$Folio'";
            $resultadoDetallePedido = mysql_query($sqlDetallePedido);
            //$detallePedido = mysql_fetch_assoc($resultadoDetallePedido);
            $cuantosProductos  = mysql_num_rows($resultadoDetallePedido);
            echo "Se han cambiado los pedidos del folio ".$Folio." a facturados de forma satisfactoria <br>";
            fwrite($file, "MGW10008"."\r\n");
            if ($_SESSION['almacenGlobal'] == 'UPN')
            {
              // De la lista seleccionada por el administrador de uruapan, consultamos cual es el codigo de sucursa y almacen
              fwrite($file, $datosSucursal['codigoSucursal']."\r\n"); //
              fwrite($file, $datosSucursal['almacen']."\r\n"); // 
            }
            else // Es otra sucursal, y los valores se tomaran en base a quien este firmado en ese momento
            {
              fwrite($file, $_SESSION['codigoSucursalGlobal']."\r\n"); //
              fwrite($file, $_SESSION['almacenGlobal']."\r\n"); //
            }
            fwrite($file, $FolioPedido."\r\n"); // Cambiamos el folio para que lo acepte Adminpaq
            $FolioPedido = $FolioPedido + 1;
            fwrite($file, $FechaActual."\r\n"); //Fecha actual 
            fwrite($file, $detalleCliente['Folio']."\r\n"); // Codigo del cliente.s
            fwrite($file, $detalleCliente['Nombre']."\r\n"); // Nombre del cliente
            fwrite($file, $detalleCliente['RFC']."\r\n"); // RFC del cliente.
            fwrite($file, $detalleUsuario['Codigo']."\r\n"); //Ruta del proveedor 
            // Las siguientes 4 fechas para efectos practicos las dejaremos como la fecha actual
            fwrite($file, $FechaActual."\r\n"); // Fecha de vencimiento 
            fwrite($file, $FechaDiaAnterior."\r\n"); // Fecha "pronto pago" (Anterior a la actual)
            fwrite($file, $FechaDiaAnterior."\r\n"); // fecha en la que se entrega (Anterior a la actual)
            fwrite($file, $FechaActual."\r\n"); // Fecha en la que pago los ultimos intereses
            fwrite($file, "1"."\r\n"); // Id de moneda (Siempre será 1)
            fwrite($file, "1.00000"."\r\n"); // Tipo de cambio
            // Inicio de valores constantes para efectos de simplicidad y compatibilidad con Bardahl
            fwrite($file, " "."\r\n"); // Referencia
            fwrite($file, " "."\r\n"); // Documento origen
            fwrite($file, "1"."\r\n"); // Afectado 
            fwrite($file, "0"."\r\n"); // Impreso
            fwrite($file, "0"."\r\n"); // Cancelado
            fwrite($file, "0"."\r\n"); // Devuelto
            fwrite($file, "0"."\r\n"); // ID de prepoliza
            fwrite($file, "0"."\r\n"); // Prepoliza (Cancelación)
            fwrite($file, "1"."\r\n"); // Estado Contable
            fwrite($file, "0.00000"."\r\n"); // Gasto1
            fwrite($file, "0.00000"."\r\n"); // Gasto2
            fwrite($file, "0.00000"."\r\n"); // Gasto3
            fwrite($file, "0.00000"."\r\n"); // Descuento Pronto Pago
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de impuesto 1
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de Impuesto 2
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de impuesto 3
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de retención 1
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de retención 2
            fwrite($file, "0.00000"."\r\n"); // Porcentaje de intereses
            fwrite($file, " "."\r\n"); // Texto extra 1
            fwrite($file, " "."\r\n"); // Texto extra 2
            fwrite($file, " "."\r\n"); // Texto extra 3
            fwrite($file, "12/30/1899"."\r\n"); // Fecha Extra
            fwrite($file, "0.00000"."\r\n"); // Importe extra 1
            fwrite($file, "0.00000"."\r\n"); // Importe extra 2
            fwrite($file, "0.00000"."\r\n"); // Importe extra 3
            fwrite($file, "0.00000"."\r\n"); // Importe extra 4
            fwrite($file, $detalleCliente['Nombre']."\r\n"); // Destinatario (Mismo siempre que el cliente)
            fwrite($file, "0"."\r\n"); // Número de guia
            fwrite($file, " "."\r\n"); // Mensajeria
            fwrite($file, " "."\r\n"); // Número de cuenta de mensajeria
            fwrite($file, "0.00000"."\r\n"); // Número de cajas
            fwrite($file, "0.00000"."\r\n"); // Peso de las cajas de mensajeria
            fwrite($file, "{"."\r\n"); // Bandera de Observaciones
            fwrite($file, $datosPedido['Comentario']."\r\n"); // Bandera de datos de envio
            fwrite($file, "}"."\r\n"); // Bandera de condiciones 
            fwrite($file, "1"."\r\n"); // Bandera datos de envío --------------------------------- Antes habia un 0
            fwrite($file, "0"."\r\n"); // Bandera Condiciones de Crédito
            fwrite($file, "0"."\r\n"); // Bandera Gastos
            fwrite($file, "0"."\r\n"); // Impresio en ChecPAqu
            fwrite($file, "0.00000"."\r\n"); // Sistem Origen
            fwrite($file, "0"."\r\n"); // IdMoneda
            fwrite($file, "0"."\r\n"); //Tipo Camca
            fwrite($file, "0.00000"."\r\n");
            fwrite($file, "MGW10011"."\r\n");
            fwrite($file, "3"."\r\n"); // Tipo de catalogo
            fwrite($file, "1"."\r\n"); // Tipo de dirección
            // Fin de constantes
            // Comienzan los datos de cliente
            fwrite($file, $detalleCliente['Calle']."\r\n"); // Calle (Cliente)
            fwrite($file, $detalleCliente['Nexterior']."\r\n"); // Número exterior
            fwrite($file, $detalleCliente['Ninterior']."\r\n"); // Número interior
            fwrite($file, $detalleCliente['Colonia']."\r\n"); // Colonia
            fwrite($file, $detalleCliente['CP']."\r\n"); // Código Postal
            fwrite($file, $detalleCliente['Telefono1']."\r\n"); // Telefono 1
            fwrite($file, $detalleCliente['Telefono2']."\r\n"); // Teléfono 2
            fwrite($file, $detalleCliente['Telefono3']."\r\n"); // Teléfono 3
            fwrite($file, $detalleCliente['Telefono4']."\r\n"); // Teléfono 4
            fwrite($file, $detalleCliente['email']."\r\n"); // email 
            fwrite($file, $detalleCliente['SitioWeb']."\r\n"); // Sitio web.
            fwrite($file, "MEXICO"."\r\n"); //Pais
            fwrite($file, $detalleCliente['Estado']."\r\n"); // Estado
            fwrite($file, $detalleCliente['Ciudad']."\r\n"); // Ciudad
            fwrite($file, " "."\r\n"); // Texto Extra
            fwrite($file, $detalleCliente['Municipio']."\r\n"); // Municipio
            fwrite($file, "MGW10011"."\r\n"); // Tabla requerida de contpaq
            fwrite($file, "3"."\r\n"); // Constante
            fwrite($file, "1"."\r\n"); // Constante
            fwrite($file, $detalleCliente['Calle']."\r\n"); // Direccion
            fwrite($file, $detalleCliente['Ninterior']."\r\n"); // Número Interior
            fwrite($file, $detalleCliente['Nexterior']."\r\n");   // Número Exterior
            fwrite($file, ""."\r\n");
            fwrite($file, $detalleCliente['Colonia']."\r\n"); // Colonia
            fwrite($file, $detalleCliente['CP']."\r\n");       // CP
            fwrite($file, " "."\r\n");
            fwrite($file, " "."\r\n");
            fwrite($file, " "."\r\n");
            fwrite($file, " "."\r\n");
            fwrite($file, " "."\r\n");
            fwrite($file, " "."\r\n");
            fwrite($file, "MEXICO"."\r\n");
            fwrite($file, $detalleCliente['Estado']."\r\n");   // Estado
            fwrite($file, $detalleCliente['Ciudad']."\r\n");     // Ciudad
            fwrite($file, " "."\r\n");
            fwrite($file, $detalleCliente['Ciudad']."\r\n");     //u Ciudad
            $posicion = 1;
            while($detallePedido = mysql_fetch_array($resultadoDetallePedido)) {
            fwrite($file, "MGW10010"."\r\n");  // Valor constante que indica la tabla de conpaq alterada 
            $longitud = strlen($posicion);
            if ($longitud == 1);
              $elemento = $posicion."00";
            if ($longitud == 2)
              $elemento = $posicion."0";
            if ($longitud == 3)  
              $elemento = $posicion;
            fwrite($file, $elemento."\r\n");       // Contador de que es el primer producto en la lista
            $posicion = $posicion + 1;
            fwrite($file, $detallePedido['Codigo']."\r\n");     // Código del producto
            fwrite($file, "1"."\r\n");         // Almacén
            fwrite($file, $detallePedido['Cantidad']."\r\n");  // Unidades (Cantidad)
            fwrite($file, "0.00000"."\r\n");   // NombreUnidad NC
            fwrite($file, $detallePedido['Cantidad']."\r\n");  // Unidades Capturadas (Siempre se repite al de la cantidad) 
            fwrite($file, " "."\r\n");         // Nombre de la unidad (Bardahl siempre lo deja vacio)
            fwrite($file, " "."\r\n");         // Nombre Unidad NC
            fwrite($file, $detallePedido['Precio']."\r\n");  // Precio Capturado
            fwrite($file, $detallePedido['Precio']."\r\n");  // Costo Capturado (Igual que el precio Capturado)
            fwrite($file, "0.00000"."\r\n");   // Costo Especifico
            fwrite($file, "0.00000"."\r\n");   // Costo Neto
            fwrite($file, $detallePedido['Neto']."\r\n"); // Neto
            fwrite($file, $detallePedido['IVA']."\r\n");  // Impuesto 1 (IVA calculado)
            fwrite($file, "16.00000"."\r\n");  // Porcentaje Impuestoa 1
            fwrite($file, "0.00000"."\r\n");   // Impuesto 2
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Impuesto 2
            fwrite($file, "0.00000"."\r\n");   // Impuesto 3
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Impuesto 3
            fwrite($file, "0.00000"."\r\n");   // Retencion 1
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Retencion 1
            fwrite($file, "0.00000"."\r\n");   // Retencion 2
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Retencion 2
            fwrite($file, $detallePedido['Descuento1']."\r\n");   // Descuento 1
            fwrite($file, round($detallePedido['Descuento1'] * 100 / $detallePedido['Neto'],4,PHP_ROUND_HALF_UP)."\r\n");   // Porcentaje Descuento 1
            fwrite($file, $detallePedido['Descuento2']."\r\n");   // Descuento 2
            fwrite($file, round($detallePedido['Descuento2'] * 100 / ($detallePedido['Neto'] - $detallePedido['Descuento1']),4,PHP_ROUND_HALF_UP)."\r\n");   // Porcentaje Descuento 2
            fwrite($file, "0.00000"."\r\n");   // Descuento 3
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Descuento 3
            fwrite($file, "0.00000"."\r\n");   // Descuento 4
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Descuento 4
            fwrite($file, "0.00000"."\r\n");   // Descuento 5
            fwrite($file, "0.00000"."\r\n");   // Porcenaje Descuento 5
            fwrite($file, $detallePedido['Total']."\r\n"); // Total
            fwrite($file, "0.00000"."\r\n");   // Porcentaje Comision 
            fwrite($file, " "."\r\n");         // Referencia
            fwrite($file, "3"."\r\n");         // Afecta Existencia (Valor Constante)
            fwrite($file, "0"."\r\n");         // Afecta Saldos 
            fwrite($file, "0"."\r\n");         // Afeca Inventario
            fwrite($file, $FechaDiaAnterior."\r\n");// Fecha del da anterior
            fwrite($file, "0"."\r\n");         // Movimiento Oculto
            fwrite($file, " "."\r\n");         // Código de Movimiento Origen
            fwrite($file, $detallePedido['Cantidad']."\r\n");   // Unidades Pendientes ------ Aqui esta el pinche pedo
            fwrite($file, "0.00000"."\r\n");   // Unidades NC Pendientes
            fwrite($file, "0.00000"."\r\n");   // Unidades Origen
            fwrite($file, "0.00000"."\r\n");   // Unidades NC Origen
            fwrite($file, "1"."\r\n");         // Tipo Traspaso
            fwrite($file, " "."\r\n");         // Codigo Valor Clasificacion
            fwrite($file, " "."\r\n");         // Texto extra 1
            fwrite($file, " "."\r\n");         // Texto extra 2
            fwrite($file, " "."\r\n");         // Texto extra 3 
            fwrite($file, "12/30/1899"."\r\n");// Fecha Extra
            fwrite($file, "0.00000"."\r\n");   // Importe extra 1
            fwrite($file, "0.00000"."\r\n");   // Importe extra 2
            fwrite($file, "0.00000"."\r\n");   // Importe extra 3
            fwrite($file, "0.00000"."\r\n");   // Importe extra 4
            fwrite($file, "0.00000"."\r\n");   // GTO Movimiento 
            fwrite($file, "{"."\r\n");         // Observacion de moviento 
            fwrite($file, $datosPedido['Comentario']."\r\n");         // Comentario de venta
            fwrite($file, "}"."\r\n");         // CASMOVTO
            fwrite($file, "0.00000"."\r\n");   // Valor Constante
            fwrite($file, " "."\r\n");         // Separacion Constante
            }
          }    
          else
          {
            echo "Error: ".$sql."<br>";
          }  
        };
        fwrite($file, "".PHP_EOL);         // Fin del archivo.
        fclose($file);
        echo "<a href='http://www.bardahluruapan.com/ventas/pedidos/".$NombreArchivo."'>Descargar archivo para pedido de Adminpaq</a>";
          // Generamos un archivo de texto fijo y dejamos el link
          
      ?>
    </div><!-- Fin FondoFormularios -->
  </div><!-- Fin MainBody -->
  <div id="footer">
	<?php include("../assets/Footer.php"); ?>
    </div><!-- Fin footer -->
</body>
</html>