<?php header('Access-Control-Allow-Origin: *'); ?>
<?php 
header('content-type: text/html; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

$folio = addslashes(strip_tags($_POST['folioCliente']));
$ids = addslashes(strip_tags($_POST['ids']));
$cantidades = addslashes(strip_tags($_POST['cantidadesProductos']));
$precios = addslashes(strip_tags($_POST['preciosProductos']));
$NombreUsuario = addslashes(strip_tags($_POST['NombreUsuario']));
$Comentario = addslashes(strip_tags($_POST['Comentario']));

$descuentos = addslashes(strip_tags($_POST['descuentosProductos']));
$descuentos2 = addslashes(strip_tags($_POST['descuentosProductos2']));
$tiposDescuentos = addslashes(strip_tags($_POST['tiposDescuentosProductos']));

$FechaEstampada = date("Y-m-d H:i:s");
$Fecha = date("Y-m-d");

function conexion() {
    mysql_connect("localhost:3306", "uruapan2_rtventa", "xffi3DCe;osw");
    mysql_select_db("uruapan2_ventas");
}

function query($query) {
    $result = mysql_query($query) or die(mysql_error());
    return $result;
}

conexion();
$ahora = getdate(); $diaActual= $ahora["mday"]; $mesActual= $ahora["mon"]; 	$yearActual= $ahora["year"];
$fecha = $yearActual."-".$mesActual."-".$diaActual;
// Determinamos el folio del pedido en base al ultimo pedido registrado por el mismo cliente.
$sqlSeleccionarFolio = "SELECT Folio FROM pedidos WHERE IdCliente LIKE '%$folio%' ORDER BY IdPedido DESC LIMIT 1";
$resultadoSeleccionarFolio = mysql_query($sqlSeleccionarFolio);
$DetalleSeleccionarFolio = mysql_fetch_assoc($resultadoSeleccionarFolio);
$FolioSeparado = explode("-",$DetalleSeleccionarFolio['Folio']);
$UltimoID = $FolioSeparado[1];
if ($UltimoID=="") //Es la primera reservaciccon de esa sucursal.
	$UltimoID=1;
else
	$UltimoID=$UltimoID+1;
$FolioPedido = $folio."-".$UltimoID;
// Contamos cuantas veces se tiene que hacer el ciclo para insertar los diferentes id's
$arregloIds = explode(",",$ids);
$arregloCantidades = explode(",",$cantidades);
$arregloPrecios = explode(",",$precios);

$arregloDescuentos = explode(",",$descuentos);
$arregloDescuentos2 = explode(",",$descuentos2);
$arregloTiposDescuentos = explode(",",$tiposDescuentos);

$cuantos = count($arregloIds);

$SumatoriaSubtotal = 0;
$SumatoriaDescuento = 0;
$SumatoriaIVA = 0;
$SumatoriaTotal = 0;
$Status = "Capturado";
// Insertamos el registro de pedido.
for ($c=0; $c<$cuantos; $c++)
{
	if ($arregloIds[$c] != "")
	{	
		$Neto = $arregloPrecios[$c] * $arregloCantidades[$c];
		$descuentoAplicado = $Neto * $arregloDescuentos[$c] / 100;
		if ($arregloDescuentos[$c]!=0 && $arregloDescuentos2[$c]!=0 )
		{
			$nuevoSubTotal = round($Neto - $descuentoAplicado,2,PHP_ROUND_HALF_UP);
			$descuentoAplicado2 = round(($nuevoSubTotal * $arregloDescuentos2[$c] / 100), 2, PHP_ROUND_HALF_UP);
			$totalDescuento =  round($descuentoAplicado + $descuentoAplicado2,2,PHP_ROUND_HALF_UP);
			$SubTotal = round($Neto - $totalDescuento,2,PHP_ROUND_HALF_UP);
			$IVA = round($SubTotal * .16,2,PHP_ROUND_HALF_UP);
			$Total = $SubTotal + $IVA;		
			$SumatoriaSubtotal = $SumatoriaSubtotal + $SubTotal;
			$SumatoriaDescuento = $SumatoriaDescuento + $totalDescuento;
			$SumatoriaIVA = $SumatoriaIVA + $IVA;
			$SumatoriaTotal = $SumatoriaTotal + $Total;
		}
		else
		{ 	
			if ( $arregloDescuentos[$c]==100 )
			{
				$SubTotal = 0;
				$IVA = 0;
				$Total = 0;
				$Neto = 0;
				$descuentoAplicado = 0;
				$arregloPrecios[$c] = 0;
			}
			else
			{
           	 	$SubTotal = round($Neto - $descuentoAplicado,2,PHP_ROUND_HALF_UP);
				$IVA = round($SubTotal * .16,2,PHP_ROUND_HALF_UP);
				$Total = round($SubTotal + $IVA,2,PHP_ROUND_HALF_UP);
 			}		
			$SumatoriaSubtotal = $SumatoriaSubtotal + $Neto;
			$SumatoriaDescuento = $SumatoriaDescuento + $descuentoAplicado;
			$SumatoriaIVA = $SumatoriaIVA + $IVA;
			$SumatoriaTotal = $SumatoriaTotal + $Total;
			$descuentoAplicado2  = 0;
		}
		// Redondeamos las cantidades para efectos de cohesión con Adminpaq.
		$SumatoriaSubtotal = round($SumatoriaSubtotal,2,PHP_ROUND_HALF_UP);
		$SumatoriaDescuento = round($SumatoriaDescuento,2,PHP_ROUND_HALF_UP);
		$SumatoriaIVA = round($SumatoriaIVA,2,PHP_ROUND_HALF_UP);
		$SumatoriaTotal = round($SumatoriaTotal,2,PHP_ROUND_HALF_UP);
		$sqlInsert = "INSERT INTO `detalle_pedido` (Folio,IdProducto,Cantidad,Precio,Descuento1,Descuento2,Neto,IVA,Total) values ('$FolioPedido','$arregloIds[$c]','$arregloCantidades[$c]','$arregloPrecios[$c]','$descuentoAplicado','$descuentoAplicado2','$Neto','$IVA','$Total')";
		$resultInsert = mysql_query($sqlInsert);
		$sqlDescontar = "UPDATE productos SET Cantidad = Cantidad - {$arregloCantidades[$c]} WHERE IdProducto = {$arregloIds[$c]}";
		$resultDescontar = mysql_query($sqlDescontar);
	}
}
$sqlInsertarPedido = "INSERT INTO pedidos (IdCliente,NombreUsuario,TimeStamp,Folio,Fecha,Comentario,Status,SubTotal,Descuento,IVA,Total) values ('$folio','$NombreUsuario','$FechaEstampada','$FolioPedido','$fecha','$Comentario','$Status','$SumatoriaSubtotal','$SumatoriaDescuento','$SumatoriaIVA','$SumatoriaTotal')";
$resultadoInsertarPedido = mysql_query($sqlInsertarPedido);
if ($resultInsert && $resultDescontar && $resultadoInsertarPedido)
	echo "Se ha dado de alta su pedido satisfactoriamente con el Folio: $FolioPedido";
else
	echo "No se pudo completar el pedido como lo pidio.".$sqlInsertarPedido;

?>	