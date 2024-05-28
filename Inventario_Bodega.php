<?php include "./class_lib/sesionSecurity.php"; ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Inventario Bodega</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link href="plugins/jtable/themes/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jtable/jquery-ui.structure.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/jtable/themes/metro/blue/jtable.min.css" rel="stylesheet" type="text/css" />
  </head>
  <body onLoad="lista_articulos(); mostrar_inventario();">

    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <?php
        include('class_lib/nav_header.php');
        ?>

      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <?php
        include('class_lib/sidebar.php');
       
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Inventario Bodega
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Inventario Bodega</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-9'>
		  <div class='panel panel-primary'>
		  <div class="panel-heading">Datos de Producto</div>
    	   <div class='box-body'>
          <form class="form-horizontal">

		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">C&oacute;digo:</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id='codigo' placeholder=''
		  data-inputmask="'placeholder': '0'">
		  </div>
		  <button type='button' class='btn btn-info btn-mini' onclick='mostrar_inventario();' id='btn-altas'><i class='fa fa-search'></i></button>
		  </div>
		 
		  
		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Producto:</label>
          <div class="col-sm-9">
          <input type="text" class="form-control" id='producto' placeholder='' 
		  data-inputmask="'placeholder': '0'">
          </div>
          </div>
		  
		
		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Presentaci&oacute;n:</label>
          <div class="col-sm-6">
          <input type="text" class="form-control" id='presentacion' placeholder='' 
		  data-inputmask="'placeholder': '0'">
          </div>
          </div>
    	 
		  
		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Existencia:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='existencia' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
          </div>
          </div>
    	  
		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Minima:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='minima' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
          </div>
          </div>
    	 
		  
		  <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Estanteria:</label>
          <div class="col-sm-6">
          <input type="text" class="form-control" id='estanteria' placeholder='' 
		  data-inputmask="'placeholder': '0'">
          </div>
          </div>
    	 
		  
		   <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Precio Costo:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='costo' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
		   </div>
          </div>
		 
		   <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Precio P&uacute;b.:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='preciod' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
		   </div>
          </div>
		 
		  
		   <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Precio C:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='precioc' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
		   </div>
          </div>
		  
		  
		   <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Precio B:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='preciob' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
		   </div>
          </div>
		 
		  
		   <div class="form-group">
          <label for="cuentac" class="col-sm-3 control-label">Precio A:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='precioa' placeholder='' 
		  data-inputmask="'placeholder': '0.00'">
		   </div>
          </div>
		
         
 
		  </form>
		  
		  <div class="modal-footer">
         <button class='btn btn-info btn-mini' id='btn-add' data-dismiss="modal"><i class='fa fa-times'></i> Cerrar</button>
		 <button class='btn btn-info btn-mini' id='btn-add' onclick='alta_articulo();'><i class='fa fa-save'></i> Guardar</button>
		 </div>
          </div>
		 </div>   
		</div>
		</div>

 </div>
        </section><!-- /.content -->
         </div><!-- /.content-wrapper -->
	
		<div class="modal fade" id ="modal_inventario" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title">Busqueda Productos:</h4>
          </div>
          <div class="modal-body">
          <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>Buscar:</b></span>
		  <input type='text' id='articulo_para_buscar' class='form-control' onKeyUp="busca_articulos();" placeholder=''>
          </div>
		  <br>
            <div id='lista_articulos'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class='fa fa-times'></i> Cerrar</button>
		    
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

      <!-- Main Footer -->
      <?php
      include('class_lib/main_fotter.php');
      ?>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->
    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/source_lines.js"></script>
    <script src="plugins/jtable/jquery-ui.js" type="text/javascript"></script>
    <script src="plugins/jtable/jquery.jtable.js" type="text/javascript"></script>
    <script src="dist/js/source_inventario.js"></script>

  </body>
</html>