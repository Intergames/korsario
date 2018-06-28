<?php session_start(); 
    /* Script para escribir en la bitacora (log) el movimiento realizado por el usuario */
    function GeneraLog($Mensaje,$TablaAfectada,$Modulo,$IdAfectado)
    {
        $hostname_conexion = "localhost";
        $database_conexion = "korsario";
        $username_conexion = "root";
        $password_conexion = "panelas19";
        $conexion = new mysqli($hostname_conexion, $username_conexion, $password_conexion, $database_conexion);
        date_default_timezone_set('America/Mexico_City'); 
        $diaActual= date("d"); $mesActual= date("m"); $yearActual= date("Y");
        $Fecha = $yearActual."-".$mesActual."-".$diaActual;
        $IdUsuarioGlobal = $_SESSION['IdUsuarioGlobal'];
        $NombreUsuarioGlobal=$_SESSION['NombreGlobal'];
        $SucursalGlobal = $_SESSION['SucursalGlobal'];
        // La variable accion debe ajustarse en funcion de donde se implemente 
        $Accion = "El usuario ".$NombreUsuarioGlobal." de la sucursal ".$SucursalGlobal." ".$Mensaje; 
        // mysql_select_db($database_conexion, $conexion)or die ("ERROR AL ESCOJER LA BD :".mysql_error());
        $sql="INSERT INTO `logs`
        (`Fecha` , `Hora` , `IdUsuario`, `Accion`, `Modulo`, `TablaAfectada`,`IdAfectado`)
        VALUES ('$Fecha' , now() , '$IdUsuarioGlobal', '$Accion' , '$Modulo', '$TablaAfectada', '$IdAfectado')";
        if (!mysqli_query($conexion, $sql))
            {
                echo "Se ha generado el siguiente error: ".mysqli_error($conexion);
            }
        mysqli_close($conexion);
        if ($Modulo=="00") //En el caso de que se desee cerrar la sesion.
        {
            unset($_SESSION['CadenaPrivilegios']);
            unset($_SESSION['Usuario']);
            unset($_SESSION['Sucursal']);
            unset($_SESSION['Nombre']);
            unset($_SESSION['TipoUsuario']);
            session_destroy();	
        }

    }
?>