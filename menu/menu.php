
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($_SESSION['TipoUsuarioGlobal'] == "root" || $_SESSION['TipoUsuarioGlobal'] == "admin  " ): ?>
<div class="menu">
    <ul>
    <li><a href="" target="_self" >Nuevo</a>
        <ul>
            
            <li><a href="../productos/nuevoProducto.php" target="_self">Producto</a></li>
            <li><a href="../clientes/nuevoCliente.php" target="_self">Cliente</a></li> 
            <li><a href="../sucursales/nuevaSucursal.php" target="_self">Sucursal</a></li> 
            <li><a href="../usuarios/nuevoUsuario.php" target="_self">Usuario</a></li> 
        </ul>
    </li>    
    <li><a href="" target="_self" >Buscar</a>
        <ul>
            <li><a href="../productos/buscarProducto.php" target="_self">Producto</a></li>
            <li><a href="../pedidos/buscarPedido.php" target="_self">Pedido</a></li>
            <li><a href="../clientes/buscarCliente.php" target="_self">Cliente</a></li>
            <li><a href="../sucursales/buscarSucursal.php" target="_self">Sucursal</a></li>            
            <li><a href="../usuarios/buscarUsuarios.php" target="_self">Usuario</a></li> 
        </ul>
    </li>
  </ul>
</div>
<?php elseif ($_SESSION['TipoUsuarioGlobal'] == "limitado" || $_SESSION['TipoUsuarioGlobal'] != "root") : ?>
<div class="menulimitado" id="menulimitado">
    <ul>
    <li><a href="" target="_self" >Nuevo</a>
        <ul>
            <li><a href="../productos/nuevoProducto.php" target="_self">Producto</a></li>
            <li><a href="../clientes/nuevoCliente.php" target="_self">Cliente</a></li> 
        </ul>
    </li>        
    <li><a href="" target="_self" >Buscar</a>
        <ul> 
            <li><a href="../clientes/buscarCliente.php" target="_self">Cliente</a></li>            
            <li><a href="../productos/buscarProducto.php" target="_self">Producto</a></li>           
            <li><a href="../pedidos/buscarPedido.php" target="_self">Pedido</a></li>
        </ul>
    </li>    
  </ul>
</div>
<?php else: ?>
<div class="menu">
</div>  
<?php endif;?>