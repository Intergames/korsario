<?php 
session_start(); 
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
<title>Inicio de sesion de Usuario - Bardahl</title>
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
    <?php 
        $Verificar = $_POST['Verificar'];
        $nombre = $_POST['nombre'];
        $contra = $_POST['contra'];
        if ($Verificar):
            $sql="SELECT * FROM usuarios where Usuario = '$nombre' and Psswrd = '$contra'";
            if (mysqli_query($conexion, $sql)) //Comando de SQL valido?
            {
              $result = mysqli_query($conexion, $sql);
              $row = mysqli_fetch_assoc($result);
              $Resultado = mysqli_num_rows($result);              
              if ($Resultado == 0) //No Existe el nombre y contraseña intruducido
              {
                  echo ("<p align='center'>El nombre de usuario y contraseña no es valido</p><p align='center'><a href='login.php'>Regresar</a></p>");
                  exit;
              }
              else // Los datos coinciden
              {                
                  // Obtenemos los datos de codigo de sucursal y almacen del usuario que recien se firma
                  $sqlUsuario="SELECT IdSucursal, NombreSucursal FROM sucursales where IdSucursal  = ".$row['IdSucursal'];
                  // echo "Este es el sql del usuario: ".$sqlUsuario;
                  $resultado = mysqli_query($conexion, $sqlUsuario);
                  $detalle_sucursal = mysqli_fetch_assoc($resultado);
                  $_SESSION["NombreGlobal"] = $row['Nombre'];
                  $_SESSION["UsuarioGlobal"] = $row['Usuario'];                  
                  $_SESSION["TipoUsuarioGlobal"] = $row['TipoUsuario'];
                  $_SESSION["IdUsuarioGlobal"] = $row['IdUsuario'];
                  $_SESSION['SucursalGlobal'] = $row['Sucursal'];
                  $_SESSION['codigoSucursalGlobal'] = $detalle_sucursal['IdSucursal'];
                  $_SESSION['almacenGlobal'] = $detalle_sucursal['NombreSucursal'];
                  echo ("<p align='center'>Autenticaci&oacute;n valida</p>");
                  echo "<p align='center'>Bienvenido:".$_SESSION['NombreGlobal']."</p>";
                  echo "<p align='center'>Usuario:".$_SESSION['UsuarioGlobal']."</p>";                                  
                  echo "<br />";
                  echo "<center><a href='./principal.php'>Ver menú</a></center>";
                  GeneraLog("ha ingreado al sistema.","usuarios","login","0");                                                 
                  echo "<div id='footer'>";
                  include('../assets/Footer.php'); 
                  echo "</div>";
                  exit;
              }
              mysql_free_result($result);
            }
        endif;
    ?>
    <form name="form1" method="post" action="login.php">
        
    <input type="hidden" name="Verificar" value="Verificar" id="Verificar"/>
    <div id="MainBody">
    <div id="TituloFormulario"><p align="center">Inicio de sesion</p></div>
      <div id="FondoFormularios">
        <center>
          <table border="0">
            <tr>
              <td>Usuario</td>
              <td><input name="nombre" type="text" id="nombre" maxlength="15" class="CajaTexto" title="Escriba su nombre de usuario."></td>
            </tr>
            <tr>
              <td>Contrase&ntilde;a</td>
              <td><input name="contra" type="password" id="contra" maxlength="30" class="CajaTexto" title="Escriba su contraseña secreta."></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><label>
                <input type="submit" name="Submit" value="Acceder" id="Submit">
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