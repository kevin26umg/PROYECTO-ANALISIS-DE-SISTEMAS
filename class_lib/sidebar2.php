<style>
.sidebar-menu .treeview-menu > li > a {
    
    color: #000000!important;
}
.sidebar-menu > li > a {
     color: #000!important;
}
.sidebar {
    padding-bottom: 10px;
    background-color: #ffffff!important;
    color: #000!important;
    height: 100%;
}
.main-sidebar, .left-side {
    background-color: #ffffff!important;
}
.user-panel a {
    color: #000!important;
}
.main-header .logo {

    background-color: #4c92e8!important;

}
.main-footer {
    padding: 15px;
    background-color: #ffffff !important;
    color: #000 !important;
}


.main-sidebar, .left-side {
    min-height: 100%!important;
}   
.navbar {
    background-color: #4c92e8!important;
}
.main-header > .navbar a {
    color: white!important;
}
.main-header > .navbar a {
    font-weight: bold;
}
.wrapper {
  
    background: white!important;
}

</style>
<section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="imagenes/<?php 
            
              
                  $file = 'imagenes/'.$_SESSION['foto'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $_SESSION['foto']!='') {
   echo $_SESSION['foto'];
} else {
    
     echo "userlg1.png";
}
              
              ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nombre_de_usuario'] ?></p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Conectado</a>
            </div>
          </div>

          <!-- search form (Optional)
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" >
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="treeview">
              <a href="#punto_venta_admin.php"><i class="fa fa-check-square-o"></i> <span>Pedidos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="Pedidos.php"><i class="fa fa-check-square-o"></i> Pedidos de Clientes</a></li>
                <li><a href="servicios.php"><i class="fa fa-check-square-o"></i> Servicios</a></li>
				<li><a href="Clientes.php"><i class="fa fa-usd"></i> Abonos de Clientes</a></li>
                <li><a href="Cotizacion.php"><i class="fa fa-calendar"></i> Cotización</a></li>
                <li><a href="Corte_Caja.php"><i class="fa fa-calendar-o"></i> Corte de Caja</a></li>
				<li><a href="Lista_pedidos.php"><i class="fa fa-calendar-o"></i> Historial de Pedidos</a></li>
				<li><a href="Historial_cotizacion.php"><i class="fa fa-calendar-o"></i> Historial de Cotizaciones</a></li>
				<li><a href="Traslados.php"><i class="fa fa-calendar-o"></i> Historial de Traslados</a></li>
				<li><a href=""><i class="fa fa-calendar-o"></i> Historial de Garantías</a></li>
               </ul>
            </li>
			
			 <li class="treeview">
              <a href="#"><i class=" fa fa-shopping-cart"></i> <span>Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
              	<li><a href="Compras.php"><i class=" fa fa-shopping-cart"></i> Compras</a></li>
				<li><a href="Lista_compras.php"><i class=" fa fa-shopping-cart"></i> Historial de Compras</a></li>
        <li><a href="Compras_por_fecha.php"><i class="fa fa-male"></i> Compras por fecha</a></li> 
				<li><a href="Facturas_por_pagar.php"><i class=" fa  fa-calendar-o"></i> Facturas x pagar</a></li>
				<li><a href="Solicitud_compras.php"><i class=" fa  fa-check-square-o"></i> Solicitud Compras</a></li>
				
				</ul>
            </li>
			 
			 <li class="treeview">
              <a href="#"><i class=" fa fa-barcode"></i> <span>Bodega</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="Altas.php"><i class="fa fa-upload"></i> Altas</a></li>
                <li><a href="Bajas.php"><i class="fa fa-download"></i> Bajas</a></li>  
                <li><a href="Inventario.php"><i class=" fa fa-qrcode"></i> Inventario General</a></li>
				<li><a href="Inventario_general.php"><i class=" fa  fa-calendar-o"></i> Inventario General</a></li>
        <li><a href="Inventario_minima.php"><i class=" fa fa-ban"></i> Productos por Agotar</a></li>
        <li><a href="Inventario_agotados.php"><i class=" fa fa-ban"></i> Productos Agotados</a></li>
				</ul>
            </li>
			
			
			<li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Clientes y Prov.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                 <!--<li><a href="abc_lineas.php"><i class="fa fa-bars"></i> Lineas</a></li>-->
			    <li><a href="Clientes.php"><i class="fa fa-male"></i> Clientes</a></li> 
          <li><a href="Reporte_clientes.php"><i class="fa fa-male"></i> Listado Clientes</a></li> 
          <li><a href="Reporte_clientes_saldos.php"><i class="fa fa-male"></i> Saldos de Clientes</a></li> 
          <li><a href="Abonos_por_fecha.php"><i class="fa fa-male"></i> Abonos por fecha: Clientes</a></li> 
          <li><a href="Proveedores.php"><i class="fa fa-truck"></i> Proveedores</a></li>
              </ul>
            </li>
			
			<li class="treeview">
              <a href="#"><i class="fa fa-wrench"></i> <span>Administración</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <li><a href="Datos_empleado.php"><i class="fa fa-male"></i> Utilidades</a></li>
				<li><a href="Usuarios.php"><i class="fa fa-user"></i> Usuarios</a></li>
				<li><a href="Permisos.php"><i class="fa fa-user"></i> Permisos</a></li>
                <li><a href="parametros.php"><i class="fa fa-map-o"></i> Parametros de Aplicacion</a></li>
                <li><a href="valida_cambio.php?opt=582963741"><i class="fa fa-folder-open"></i> Respaldo de BD</a></li>
              </ul>
            </li>
          </ul>
          <!-- /.sidebar-menu -->
        </section>
