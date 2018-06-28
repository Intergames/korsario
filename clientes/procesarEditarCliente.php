<?php 
session_start();
require_once('../Connections/conexion.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" /> <!-- Hace que los acentos se vean apropiadamente -->
    <link href="../css/MainStyle.css" rel="stylesheet" type="text/css" />
    <link href="../menu/menu_style.css" rel="stylesheet" type="text/css" />
    <!-- Inicializacion JQuery -->
    <link type="text/css" href="../jquery/css/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../jquery/js/jquery-ui-1.8.20.custom.min.js"></script>
    <!-- Finalizacion JQuery -->
    <link href="../assets/tiptip/tipTip.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../assets/tiptip/jquery.tipTip.js"></script>
    <title></title>
</head>
<body >
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
      <p align="center">Edici&oacute;n de Cliente.</p>
    </div><!-- Fin TituloFormulario -->
    <div id="FondoFormularios">
      <?php 
         $IdCliente = $_POST['IdCliente']; 
         if ($_SESSION["TipoUsuarioGlobal"] == 'root' && $IdCliente != '0')
         {    
            $RFC = $_POST['TxtRFC'];
            $Nombre = $_POST['TxtNombre'];
            $Representante = $_POST['TxtRepresentante'];
            $Calle = $_POST['TxtCalle'];
            $Colonia = $_POST['TxtColonia'];
            $Ciudad = $_POST['TxtCiudad'];
            $Estado = $_POST['LstEstado'];
            $Municipio = $_POST['TxtMunicipio'];
            $CP = $_POST['TxtCP'];
            if ($CP=="") $CP=0;
            $Telefono = $_POST['TxtTelefono'];
            $Celular = $_POST['TxtCelular'];
            $Fax = $_POST['TxtFax'];
            $email = $_POST['Txtemail'];
            $Descuento = $_POST['TxtDescuento'];
            $Municipio = $_POST['TxtMunicipio'];
            if ($Descuento=="") $Descuento=0;
            $Observaciones = $_POST['TxtObservaciones'];
            $sql="UPDATE clientes SET RFC='$RFC', Representante='$Representante', Nombre='$Nombre', Calle='$Calle', Colonia='$Colonia', Ciudad='$Ciudad' , Estado='$Estado', Municipio='$Municipio' , CP='$CP' , Telefono='$Telefono' , Celular='$Celular' , Fax='$Fax' , email='$email' , Descuento='$Descuento' , Observaciones= '$Observaciones' WHERE IdCliente = $IdCliente";             
            if (mysqli_query($conexion,$sql))
                echo "<p><center>La modificaci&oacute;n del Cliente: ".$Nombre." se ha realizado con &eacute;xito</center></p>";
            else
                echo "<p><center>La modificaci&oacute;n no se ha podido realizar</center></p><p>$sql</p>";	 
         }
         else
         {
             echo "<p align=center><font color=#FF0000 size=4 face=Verdana, Arial, Helvetica, sans-serif>&iexcl;No se tienen los privilegios necesarios para entrar a este m&oacute;dulo! </font></p>
                    <p align=center><font color=#000000 size=4>Establezca un nombre de usuario y contrase&ntilde;a
                    para visualizar los datos.<p align=center>Si ha iniciado sesion pida al administrador del sitio que le otorge los privilegios necesarios</p></font></p>";
         }    
        ?>
    </div><!-- Fin FondoFormularios-->
</div><!-- Fin MainBody -->
<div id="footer">
  <?php include("../assets/footer.php"); ?>
</div> <!-- Fin footer-->
</body>