 <?php include "./class_lib/sesionSecurity.php"; ?>
 
 <?php
	require('class_lib/funciones.php');
	if ($_SESSION['sucursal']=="1"){
	include('./class_lib/class_conecta_mysql.php');
	}
	if ($_SESSION['sucursal']=="2"){
	include('./class_lib/class_conecta_mysql2.php');
	}
	if ($_SESSION['sucursal']=="3"){
	include('./class_lib/class_conecta_mysql3.php');
	}
    $db=conectar();
    $usuario=$_SESSION['nombre_de_usuario'];
    $query = "SELECT * from usuarios where Usuario= :nom";
    $resultado=$db->prepare($query);
    $resultado->bindParam(":nom",$usuario);	
    $resultado->execute();	
    foreach ($resultado as $key =>$data){
    $clave=$data['TipoUsuario'];
	}
	$cadena_buscada   = 'ventas';
	$posicion_coincidencia = strpos($clave, $cadena_buscada);
 
	if ($posicion_coincidencia === false) {
	header ('Location: inicio.php');
	/*	 echo "NO se ha encontrado la palabra deseada!!!!";*/
	} else {
	 /*         echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;*/
	}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Punto de Venta</title>
    <?php include "./class_lib/links.php"; ?>
  </head>
  <body onLoad="pone_num_venta();resumen();pone_foco_ini();busca_datos_pedidos();">
      
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
		$tipousuario=$_SESSION['clave'];
        include('class_lib/sidebar.php');
        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') ;

        /*verifica si esta establecido un numero de caja
        if($_SESSION['numero_de_caja']=='0'){
           echo '<script language="javascript">alert("No se ha establecido un numero de caja, por favor vaya a Utilerias -> Parametros de Aplicacion y establezca un numero de caja...");
           window.location="inicio.php";
           </script>';
        }else{
          echo "<input type='hidden' id='ncaja' value='$_SESSION[numero_de_caja]'>";
        }*/
        ?>
		
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <small> Envios de Bodega | Cajero: <?php echo $_SESSION['nombre_de_usuario']; ?> | Caja: <?php echo $_SESSION['numero_de_caja']; ?> | </small>
            <small>  <?php echo $fecha; ?></small>

          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Punto de Venta</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
   
		  <div class='row'>

        
		
          <div class='col-md-4'>
          <div class='panel panel-success'>
    <!--  <div class="panel-heading"> </div> -->
          <div class='box-body'>
          <div class='form-group'>
          
<!--<div class="contenido col">
                  <center>
                  <img src="dist/img/Fondo PosSoft 800x400.png"  width="180" height="90">
                  </center>
                  </div><!--cierra contenido col-->                
          <div class="small-box bg-aqua">
                <div class="inner">
                <h3><div id='totales'></div></h3>
                <p>Total</p>
                </div>
                <div class="icon">
                <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="#" class="xsmall-box-footer">
                <div id=''></div>
                </a>
                <a href="#" class="small-box-footer">
                <div id='total_articulos'></div>
                </a>
                <a href="#" class="small-box-footer">
                <div id='tipo_de_venta'></div>
                </a>
          </div>
          <div class='btn-group'>
          <button class='btn  btn-success btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Cobrar Envío" id='btn-procesa' onclick='prepara_venta();'><i >Cobrar</i> </button>
          <button class='btn  btn-azul btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Contado"onClick="busca_cliente_contado();" id='btn_cre'><i class=>Efectivo</i> </button>

          <button class='btn  btn-naranja btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Crédito"onClick="busca_cliente();" id='btn_cre'><i >Crédito</i> </button>
          <button class='btn  btn-warning btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Traslado" onClick="traslado();" id='btn_cre'><i >Traslado</i> </button>
          </div>  

          <div class='form-group'>
          <div class='box-body'>
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-azul' onclick='abrir_modal_solicitud_compras();'><i class='fa fa-search'></i> Pedido&nbsp;</button>
          </div>
          <input type='text' id='factura' class='form-control' placeholder='' value=<?php echo $_GET["id"]?> onchange='busca_datos_pedidos();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
          </div>
          </div>
          </div>
          
          </div>
          </div>

      </div> <!--/.content-wrapper -->
                
                  
                  
      
      </div>


          <div class='col-md-8'>
    <!--      <div class='panel panel-danger'> -->
          <div class='box-body'>
              
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-naranja' onclick='busqueda_art();'><i class='fa fa-search'></i> Buscar&nbsp;</button>
          </div>
          <input type='text' id='codigo' class='form-control' placeholder='Codigo...' onchange='busca_articulo();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
          </div>
          </div>
  <!--        </div>  -->
          </div>

         <small> <div class='col-md-8'><div id='data'></div></div> </small>
                     
        </section><!-- /.content -->
         
</div><!-- /.content-wrapper -->

   <div class="modal fade" id ="modal_tabla_presentación" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Elige la presentación del producto:</h4>
          </div>
          <div class="modal-body">
            <div id='lista_presentacion'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


           <div class="modal fade" id ="modal_tabla_clientes" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Selecciona el Cliente:</h4>
          </div>
          <div class="modal-body">
            <div id='lista_clientes'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="modal fade" id ="modal_prepara_venta" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">RESUMEN</h4>
          </div>
          <div class="modal-body">

          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Total de la Venta:</b></span>
          <input type='text' id='total_de_venta' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Su Pago:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='paga_con' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onKeyUp="calcula_cambio();"
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Cambio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='el_cambio' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>

          </div>
          <div class="modal-footer">
              <button class='btn btn-success btn-lg print_ticket' id='btn-termina' onclick='' disabled><i class='fa fa-print'></i> Ticket</button>
              <button class='btn btn-success btn-lg' id='btn-termina' onclick='procesa_venta();'><i class='fa fa-shopping-cart'></i> Procesar</button>
              <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class='fa fa-times'></i> Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id ="modal_busqueda_arts" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Busqueda de Articulos:</h4>
          </div>
          <div class="modal-body">
          <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>Articulo:</b></span>
          <input type='text' id='articulo_buscar' class='form-control' onKeyUp="busca();" placeholder='Descripcion del articulo...'>
          </div>
          <br>
          <small>  <div id='lista_articulos'></div> </small>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <input type='hidden' id='idcliente_credito' value="">
	  <input type='hidden' id='idcliente_contado' value="">
	  <input type='hidden' id='registros' value="">
	  <input type='hidden' id='nitcliente' value="">
	  <input type='hidden' id='tipo_venta' value="">
    <input type='hidden' id='total_venta' value="">

      <div id='impresion_de_ticket' class='print'></div>
      <!-- Main Footer -->
      <?php
      include('./class_lib/main_fotter.php');
      ?>
      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <div class="MsjAjaxForm"></div>
    <?php include "./class_lib/scripts.php"; ?>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="dist/js/source_point_sales.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/printPage/jquery.printPage.js"></script>
    <script>
      $(document).ready(function(){
        $(".cantidades").inputmask();
        $("#factura").focus();
      });
    </script>
    <script type="text/javascript">

    


       

       
    </script>
  </body>
</html>