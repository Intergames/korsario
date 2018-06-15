<?php 
session_start();
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php require_once('../Connections/conexion.php');
    function truncateFloat($number, $digitos)
    {
        $raiz = 10;
        $multiplicador = pow ($raiz,$digitos);
        $resultado = ((int)($number * $multiplicador)) / $multiplicador;
        return number_format($resultado, $digitos);
    }
     //Saber si la variable biene del formulario para hacer que prevalezca en las variables a pasar por medio de la url.
    $TxtBusqueda = $_POST['TxtBusqueda'];					
    echo "
    <table border='0' width = '960px' class='normal'>";
    echo "
    <tr>
        <th scope='col' width='150'>Nombre</td>
        <th scope='col' width='150'>Direccion</td>
        <th scope='col' width='100'>Colonia</td>             
        <th scope='col' width='100'>C. Postal</td>
        <th scope='col' width='100'>Ciudad</td>
        <th scope='col' width='100'>Estado</td>
        <th scope='col' width='100'></td>
        <th scope='col' width='100'></td>
    </tr>";
 // InicializaciÃ³n de variables para paginaciÃ³n.
 $pg=$_POST['pg']; //Obtenemos la pagina donde desea ir el usuario, obtenida por BuscarCliente.php  
 $Busqueda = $_POST['TxtBusqueda'];
 $Ordenar = $_POST['Ordenar'];
 $Tipo = $_POST['Tipo'];		
 if (!isset($pg)) //Si no está establecida es que es la primera página.
 {$pg = 1;}// $pg es la pagina actual
 $cantidad=$_POST['Cantidad']; // cantidad de resultados por página
 $inicial = ($pg-1) * $cantidad; //Calculamos donde se comienzan a mostrar los datos en la consulta.
 mysql_select_db($database_conexion,$conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
 $sele = "SELECT * FROM sucursales WHERE IdSucursal != 0 ";
 $contar = "SELECT * FROM sucursales WHERE IdSucursal !=0 ";    
 if ($Busqueda != '')
 {
    $sele = $sele."AND (Direccion LIKE '%$Busqueda%' OR Colonia LIKE '%$Busqueda%' OR CodigoPostal LIKE '%$Busqueda%' OR Ciudad LIKE '%$Busqueda%' OR Estado LIKE '%$Busqueda%') ";
    $contar = $contar."AND (Direccion LIKE '%$Busqueda%' OR Colonia LIKE '%$Busqueda%' OR CodigoPostal LIKE '%$Busqueda%' OR Ciudad LIKE '%$Busqueda%' OR Estado LIKE '%$Busqueda%') ";
 } 
 $ContadorSelector = 0;
 $sele = $sele." ORDER BY "."$Ordenar $Tipo LIMIT $inicial, $cantidad";
 $contar = $contar." ORDER BY "."$Ordenar $Tipo";
 // echo $sele;
 $result=mysql_query($sele) or die();
  while($row = mysql_fetch_array($result)) { ?>
     <tr>
      <td><?php echo $row['NombreSucursal']; ?></td>
      <td><?php echo $row['Direccion']; ?></td>
      <td><?php echo $row['Colonia']; ?></td>
      <td><?php echo $row['CodigoPostal']; ?></td>
      <td><?php echo $row['Ciudad']; ?></td>
      <td><?php echo $row['Estado']; ?></td>
      <td><a href="../sucursales/detalleSucursal.php?recordID=<?php echo $row['IdSucursal'];?>" title="Muestra el m&oacute;dulo para editar la informaciÃ³n de la fila resaltada">Detalle</a></td>
      <td><a href="../sucursales/editarSucursal.php?recordID=<?php echo $row['IdSucursal'];?>"><img src="../assets/editar.png" /></a></td>
   </tr>
<?php
}//Fin de while($row = mysql_fetch_array($result))
    
   if (mysql_num_rows($result) == 0)
      echo "<p><center>No se encontraron usurios con los parámetros de búsqueda especificados.</center></p>";
   @mysql_free_result($result);
echo "</table>";
?>
<?php //Inicia paginacion
mysql_select_db($database_conexion, $conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
$contarok= mysql_query($contar);
$total_records = mysql_num_rows($contarok);
$Paginas = intval($total_records / $cantidad);
$haymaspaginas = $total_records%$cantidad;
if ($haymaspaginas != 0)
{ $Paginas++;}
$primero=1;
$segundo=2;
$ultimo = $Paginas;
$penultimo = $Paginas - 1;
$antepenultimo = $Paginas -2;
$continua = 1;
if ($pg==1)
{
     $pivote = 1;
}
else
{
     $pivote = $pg;
}
echo "<table id=nav style=border-collapse:collapse;margin:auto;text-align:center;direction:ltr;margin-bottom:1.4em>";
echo "<tr>";
if ($Paginas >1)
{
     // Creando los enlaces de paginaciÃ³n
     if ($pg != 1) {
     $url = $pg - 1;
     echo "<td class=b><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$url')>&laquo; Anterior</a></td>";
     } else {
     echo "<td></td>";
     }
     //inicia paginacion flickr
     if ($pivote == 1)
     {
          echo "<td class=cur><b> ".$pivote."</b></td>"; //Pivote
          if ($ultimo >= 8)
               $final=8;
          else
               $final=$ultimo;
          for ($c=1;$c<$final;$c++)
          {
               $imprime = $c+1;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a></td>";
          }
          if ($ultimo >= 8)
          {
               echo "<td><b> ... </b></td>"; //Puntos suspensivos
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$penultimo')>";
               echo $penultimo."</a></td>";
               echo "<td><aonclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$ultimo')>";
               echo $ultimo."</a></td>";
          }
          $continua=0;
     }
     if ($ultimo <= 17 && $continua == 1)
     {
     if ($pivote ==1)
     {
    
          echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
          $imprime = $pivote;
          for ($c=1;$c<$ultimo;$c++)
          {
               $imprime ++;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a></td>";
          }    
     }
     else
     {
          for ($c=1;$c<=$pivote - 1;$c++)
          {
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$c')>";
               echo $c."</a>&nbsp;</td>";
          }    
          echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
          $imprime = $pivote ;
          for ($c=$pivote;$c<$ultimo;$c++)
          {
               $imprime ++;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a>&nbsp</td>";
          }    
     }
     $continua=0;
     }

     if (($pivote >=2 && $pivote <=8) && $continua == 1)
     {    
          for ($c=0;$c<$pivote - 1;$c++)
          {
               $imprime = $c+1;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a>&nbsp;</td>";
          }
          echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
          for ($c=$pivote;$c<8;$c++)
          {
               $imprime = $c+1;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a>&nbsp;</td>";
          }
          echo "<td><b> ... </b></td>"; //Puntos suspensivos
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$penultimo')>";
          echo $penultimo."</a>&nbsp;</td>";
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$ultimo')>";
          echo $ultimo."</a>&nbsp;</td>";
          $continua = 0;
     }
     if (($pivote >=9 )&& (($ultimo - $pivote) >=9) && $continua == 1)
     {    
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
          echo $primero."</a>&nbsp;</td>";
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
          echo $segundo."</a>&nbsp;<td>";
          echo "<td><b> ... </b></td>"; //Puntos suspensivos
          //imprimir 3 antes que que pivote
          $imprime = $pivote - 4;
          for ($c=1;$c<=3;$c++)
          {
               $imprime++;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a>&nbsp;</td>";
          }
          echo "<td class=cur><b> ".$pivote."</b></td>"; //Pivote
          $imprime = $pivote;
          for ($c=1;$c<=3;$c++)
          {
               $imprime++;
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
               echo $imprime."</a>&nbsp</td>";
          }
          echo "<td><b> ... </b></td>"; //Puntos suspensivos
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$penultimo')>";
          echo $penultimo."</a>&nbsp;</td>";
          echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$ultimo')>";
          echo $ultimo."</a>&nbsp;</td>";
     }
     if (($ultimo-$pivote)<=8 && $continua == 1)
     {
          if (($ultimo - $pivote >=3) && ($ultimo - $pivote <=8))
          {
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
               echo $primero."</a>&nbsp;</td>";
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
               echo $segundo."</a>&nbsp;</td>";
               echo "<td><b> ... </b></td>"; //Puntos suspensivos
               //imprimir 3 antes que que pivote
               $imprime = $pivote - 4;
               for ($c=1;$c<=3;$c++)
               {
                    $imprime++;
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                    echo $imprime."</a>&nbsp;</td>";
               }
               echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
               $i= $pivote;
               for ($c=$i;$c<$ultimo;$c++)
               {
                    $imprime = $c+1;
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                    echo $imprime."</a>&nbsp;</td>";
               }
          }
          else // Toca ver si es el Ãºltimo, penultimo o antepenultimo
          {
               if ($pivote != $ultimo && $pivote != $penultimo && $pivote != $antepenultimo && $continua == 1 )
               {
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
                    echo $primero."</a>&nbsp;</td>";
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
                    echo $segundo."</a>&nbsp;</td>";
                    echo "<td><b> ... </b></td>"; //Puntos suspensivos
                    //imprimir 3 antes que que pivote
                    $imprime = $pivote - 4;
                    for ($c=1;$c<=3;$c++)
                    {
                         $imprime++;
                         echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                         echo $imprime."</a>&nbsp;</td>";
                    }
                    echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
               }         
          }
          if ($pivote == $antepenultimo && $continua == 1)
          {
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
               echo $primero."</a>&nbsp;</td>";
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
               echo $segundo."</a>&nbsp;</td>";
               echo "<td><b> ... </b></td>"; //Puntos suspensivos
               $imprime=$pivote - 5;
               for ($c=1;$c<=4;$c++) //imprimimos 4 antes que el pivote
               {
                    $imprime++;
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                    echo $imprime."</a>&nbsp;</td>";
               }
               echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$penultimo')>";
               echo $penultimo."</a>&nbsp;</td>";
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$ultimo')>";
               echo $ultimo."</a>&nbsp;</td>";
          }
          if ($pivote == $penultimo && $continua == 1)
          {
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
               echo $primero."</a>&nbsp;</td>";
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
               echo $segundo."</a>&nbsp;</td>";
               echo "<td><b> ... </b></td>"; //Puntos suspensivos
               $imprime=$pivote - 6;
               for ($c=1;$c<=5;$c++) //imprimimos 4 antes que el pivote
               {
                    $imprime++;
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                    echo $imprime."</a>&nbsp;</td>";
               }
               echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$ultimo')>";
               echo $ultimo."</a>&nbsp;</td>";
          }
          if ($pivote == $ultimo && $continua == 1)
          {
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$primero')>";
               echo $primero."</a>&nbsp;</td>";
               echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$segundo')>";
               echo $segundo."</a>&nbsp;</td>";
               echo "<td><b> ... </b></td>"; //Puntos suspensivos
               $imprime=$pivote - 7;
               for ($c=1;$c<=6;$c++) //imprimimos 4 antes que el pivote
               {
                    $imprime++;
                    echo "<td><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$imprime')>";
                    echo $imprime."</a>&nbsp;</td>";
               }
               echo "<td class=cur><b> ".$pivote." </b></td>"; //Pivote
          }
     }
}
if ($pg < $Paginas) {
$url = $pg + 1;
echo "<td class=b><a onclick=cargaXMLSucursales('rutinaBuscarSucursales.php','$url')>Siguiente &raquo;</a></td>";
} else {
echo "<td></td>";
}
echo "</tr>";
echo "</table>";
echo "</div>";
//termina paginacion flickr
?>  