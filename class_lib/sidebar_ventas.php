<section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/icono2.png" class="img-circle" alt="User Image">
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
         
            <!-- Optionally, you can add icons to the links -->
            
                <li><a href="punto_venta.php"><i class="fa fa-shopping-cart"></i> Punto de Venta</a></li>
                <li><a href="cancel_venta.php"><i class="fa fa-usd"></i> Abono Clientes</a></li>
                <li><a href="cotizaciones.php"><i class="fa fa-check-square-o"></i> Cotizaci&oacute;n </a></li>
	            <li><a href="rep_ventas.php"><i class="fa fa-calendar"></i> Corte de Caja</a></li>
               	<li><a href="Historial_Ventas.php"><i class=" fa fa-th-list"></i> Historial Ventas</a></li>
                <li><a href="rep_ventas_s.php"><i class="fa fa-th-list"></i> Historial Cotizaciones</a></li>
				<li><a href="Traslados.php"><i class="fa fa-th-list"></i> Historial Traslados</a></li>
				<li><a href="rep_ventas_s.php"><i class="fa fa-th-list"></i> Historial Garancias</a></li>
            
			
			
			
		<!--	<li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Abonos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="Abonos_cliente.php"><i class="fa fa-user"></i> Clientes </a></li>
				<li><a href="Abonos_clientes_fechas.php"><i class="fa fa-file-text"></i> Abonos por fecha </a></li>
				<li><a href="Abonos_por_cliente.php"><i class="fa fa-file-text"></i> Abonos por Cliente </a></li>				
                <li><a href="Abonos_proveedor.php"><i class="fa fa-user"></i> Proveedores </a></li>
				<li><a href="Abonos_prov_fechas.php"><i class="fa fa-file-text"></i> Abonos por fecha </a></li>
				<li><a href="Abonos_por_proveedor.php"><i class="fa fa-file-text"></i> Abonos por Proveedor </a></li>		
              </ul>
            </li>

			  <li class="treeview">
              <a href="#"><i class="fa fa-server"></i> <span>Clientes y Prov.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
			    <li><a href="abc_clients.php"><i class="fa fa-male"></i> Clientes</a></li> 
              </ul>
            </li>
			
	
            <li class="treeview">
              <a href="#"><i class="fa fa-terminal"></i> <span>Herramientas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="parametros.php"><i class="fa fa-map-o"></i> Parametros de Aplicacion</a></li>
            </ul>
            </li>-->
          </ul>
          <!-- /.sidebar-menu -->
        </section>
