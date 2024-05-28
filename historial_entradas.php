<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
  require('class_lib/funciones.php');

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Historial entradas de inventario</title>
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
            Historial entradas de inventario
            <small>>> </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Historial entradas de inventario</li>
          </ol>
        </section>

       <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
          <div class='row'>
          <div class='col-md-3'>
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

         <button class='btn btn-primary pull-left' onclick='historial();'><i class='fa fa-search'></i> Consultar</button>
         <!--<button class='btn btn-naranja pull-right' onclick='sucursales();'><i class='fa fa-search'></i> Sucursales</button>-->
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
   var sucursal='';
/*********************************************************/
function sucursales(){
var userx="<?php echo $_SESSION['puesto'] ?>";
if (userx=='Administrador'){
busca_precios_modal();

Swal.fire({
  title: 'Seleccione Sucursal',
  html:
    '<br><div style="font-size: 22px;font-weight: bold;    color: blue;">'+""+'</div> <br>'+
    '<div id="precios"></div> ',
    
  showCloseButton: true,
  showCancelButton: true,
    focusConfirm: true,
  confirmButtonText:
    'Ok',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    'Cancelar',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {

  if (result.isConfirmed) {
      //$('#cuotasatrasadas').val('500.00');
      
      var cmbprecio = ($("#fechasx").val());
   var idcl2=cmbprecio.split("|");  
   sucursal=idcl2[1];
   //var fechaf=idcl2[1];
   corte_sucursales();
   } 
})
}else{
   alert("Acceso denegado, este usuario no tiene permisos para esta operación...!");           
}
}
/*********************************************************/
function busca_precios_modal(){

     $.ajax({
 
        //url: 'fechas_planilla.php',
        url: 'sucursales.php',
        type: 'POST',
        //data: 'gestor='+$("#gestor").val()+'&fechai='+$("#fi").val()+'&fechaf='+$("#ff").val(),
        data: null,
        success: function(x){
         $("#precios").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#precios").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*********************************************************/
function corte_sucursales(){
var id=$("#ff").val();
var idfi=$("#fi").val();
if (sucursal=='TECÚN UMÁN'){
    sucursal='TECÚN-UMÁN';
}
if (sucursal=='CABALLO BLANCO'){
    sucursal='CABALLO-BLANCO';
}
window.open("corte_de_caja.php?sucursal="+encodeURIComponent(sucursal)+'&varf=' + encodeURIComponent(id)+'&vari=' + encodeURIComponent(idfi));
}
/*******************************************************************************************/
function historial(){
var id=$("#ff").val();
var idfi=$("#fi").val();
window.open("historial_entradas_rep.php?varf="+encodeURIComponent(id)+' &vari=' + encodeURIComponent(idfi));
}
/*******************************************************************************************/
</script>
  </body>
</html>