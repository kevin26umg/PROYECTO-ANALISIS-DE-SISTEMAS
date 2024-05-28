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
  /*   echo "NO se ha encontrado la palabra deseada!!!!";*/
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
    <title>Ventas por periodo</title>
    <?php include "./class_lib/links.php"; ?>
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <link rel="stylesheet" href="plugins/printarea/jquery.printarea.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
  </head>
  <body onLoad="">

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
            Ventas por periodo
            <small>>> </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Ventas por periodo</li>
          </ol>
        </section>

       <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-4'>
          <div class='box box-primary'>
          <div class='box-header with-border'>
          <h3 class='box-title'>Ingresa las fechas...</h3>
          </div>
          <div class='box-body'>
            <div class="form-group">
                    <label>Fechas:</label>
                    <div class="input-group">
                      <button class="btn btn-default pull-left" id="daterange-btn">
                        <i class="fa fa-calendar"></i> Click para seleccionar.
                        <i class="fa fa-caret-down"></i>
                      </button>
                    </div>
                    <span class='fe'></span>
                    <input type='hidden'  class='form-control' id='fi' value=''>
                    <input type="hidden"  class='form-control' id='ff' value=''>
<br>

           <button class='btn btn-primary pull-left' onclick='cortex();'><i class='fa fa-search'></i> Consultar</button>
           <!--<button class='btn btn-naranja pull-right' onclick='corte_credito();'><i class='fa fa-search'></i> Consultar Crédito</button>-->
            </div><!-- /.form group -->
          </div>
      
    

          </div>
          </div>

   <!--       <div class='col-md-4'>
          <div id='opcion'></div>
          </div>
          </div>-->

   <small>     		<div class='col-md-12'>
        <div id='data'>
        </div>
        </div>  </small>
        </section><!-- /.content -->
		
        <div class="modal fade" id ="modal_detalle_venta" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title nuticket"></h4>
          </div>
          <div class="modal-body">
            <div id='detalle_de_venta'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

         </div><!-- /.content-wrapper -->


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
    <script src="plugins/select2/select2.full.min.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/printarea/jquery.printarea.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
	<script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
	<script src="plugins/uploadify/jquery.uploadify.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="dist/js/source_lista_pedidos.js"></script>
   <script>
   /*****************************************************************************/
   $(function(){
      $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Esta semana': [moment().startOf('week'), moment().endOf('week')],
        'Este dia': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Los ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Los ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Este mes': [moment().startOf('month'), moment().endOf('month')],
                'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('.fe').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          var xstart=start.format('YYYY-MM-DD');
          var xend=end.format('YYYY-MM-DD');
          $("#fi").val(xstart);
          $("#ff").val(xend);
          //alert(start.format('YYYY-MM-DD')+'    '+end.format('YYYY-MM-DD'));
         }
        );
       });
   /*****************************************************************************/
function corte_credito(){
var id=$("#ff").val();
var idfi=$("#fi").val();
window.open("corte_de_caja_credito.php?varf="+encodeURIComponent(id)+' &vari=' + encodeURIComponent(idfi));
}
/*****************************************************************************/
function cortex(){
var id=$("#ff").val();
var idfi=$("#fi").val();
window.open("ventas_periodo.php?varf="+encodeURIComponent(id)+' &vari=' + encodeURIComponent(idfi));
}
/*******************************************************************************************/
 </script>   
  </body>
</html>