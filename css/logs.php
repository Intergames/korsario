<?php session_start();
 
    /* Script para escribir en la bitacora (log) el movimiento realizado por el usuario */
	function GeneraLog($Mensaje,$TablaAfectada,$Modulo)
	{
		$hostname_EHLRentaCar = "localhost";
		$database_EHLRentaCar = "ehlrentacar"; //Del lado del servidor es:  intergam_ehlrentacar
		$username_EHLRentaCar = "root"; // Lado del servidor: intergam_root
		$password_EHLRentaCar = "panelas";
		$EHLRentaCar = mysql_pconnect($hostname_EHLRentaCar, $username_EHLRentaCar, $password_EHLRentaCar) or trigger_error(mysql_error(),E_USER_ERROR); 
		$ahora = getdate(); $diaActual= $ahora["mday"]; $mesActual= $ahora["mon"]; 	$yearActual= $ahora["year"];
		$Fecha = $yearActual."-".$mesActual."-".$diaActual;
		$IdUsuarioGlobal = $_SESSION['IdUsuarioGlobal'];
		$NombreUsuarioGlobal=$_SESSION['UsuarioGlobal'];
		$SucursalGlobal = $_SESSION['SucursalGlobal'];
		// La variable accion debe ajustarse en funcion de donde se implemente 
		$Accion = "El usuario ".$NombreUsuarioGlobal." de la sucursal ".$SucursalGlobal." ".$Mensaje; 
		mysql_select_db($database_EHLRentaCar, $EHLRentaCar)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
		$sql="INSERT INTO `logs`
		(`Fecha` , `Hora` , `IdUsuario`, `Accion`, `Modulo`, `TablaAfectada`)
		VALUES ('$Fecha' , now() , '$IdUsuarioGlobal', '$Accion' , '$Modulo', '$TablaAfectada')";
		if (!mysql_query($sql))
			{echo "Se ha generado el siguiente error: ".mysql_error();}
		mysql_close($EHLRentaCar);
		if ($Modulo=="00") //En el caso de que se desee cerrar la sesion.
		{
			session_unregister("Accesar");
			unset($_SESSION['CadenaPrivilegios']);
			unset($_SESSION['Usuario']);
			unset($_SESSION['Sucursal']);
			unset($_SESSION['Nombre']);
			unset($_SESSION['TipoUsuario']);
			session_destroy();	
		}
		
	}
?>