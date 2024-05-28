 <?php include "./class_lib/sesionSecurity.php"; ?>
 
 <?php
	require('class_lib/funciones.php');

	

  if ($_SESSION['usuarios']==1) {
    
     }else{
    //   header ('Location: index.php');
    }

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <title>Usuarios</title>
    <?php include "./class_lib/links.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style type="text/css">
    
        .croppedx {
width: 75px; 
height: 75px; 
object-fit: cover;

/*border: 5px solid black;*/
}

    .cropped1 {
width: 200px; 
height: 200px; 
object-fit: cover;

/*border: 5px solid black;*/
}
.cropped2 {
width: 200px; 
height: 200px; 
object-fit: cover;
object-position: 20% 10%; 
/*border: 5px solid black;*/
}


input[type=checkbox], input[type=radio] {

    transform: scale(1.3);
}

.form-check {
    user-select: none;
}

.form-check label{
    font-size: 19px!important;
}
.contenedorimages{
    text-align: center;
}

.labelimage2{
    /*width: 250px;*/
    /*height: 250px;*/
    align-items: center;
   /* background-image:url(dist/img/clientes.jpg);*/
    /*border: 2px solid #ffc107;*/
    display: inline-block;
    outline: none;
    /*line-height: 250px;*/
    /*padding: 0 30px;*/
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    font-size: 4em;
    cursor: pointer;
    transition: all 0.3s ease 0s;
    /*margin-top: 10px;*/
    /*    margin-right: 10px;*/
        position: relative;

}
.labelimage2:hover{
    color: #ffc107;
    /*border: 2px solid #ffc107;*/
    /*background: #fff;*/
    transform:scale(1.2);

    
}

.deleteimg{
    width: 100%;
    height: 30px;
    align-items: center;
    color: white;
   /* background-image:url(dist/img/clientes.jpg);*/
        background: #f44a40;
     color: #ffc107;
    display: inline-block;
    outline: none;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    font-size: 22px;
    cursor: pointer;
    transition: all 0.3s ease 0s;

position: absolute;
top: 216px;
    right: 0px;
}
.imgp{
    /*width: 100%;*/
    /*height: 100%;*/
     cursor: pointer;
     /*border-radius: 50%;*/
   }


</style>
  </head>
  <body onLoad="busca();">
   
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
 

        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
   
		  <div class='row'>

        
          <div class='col-md-12'>
    <!--      <div class='panel panel-danger'> -->
          <div class='box-body'>
              
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-naranja' onclick='abrir_modal_datos_clientes();'><i class='fa fa-search'></i> Buscar&nbsp;</button>
          </div>
          <input type='text' id='codigo' class='form-control' placeholder='Buscar...' onkeypress='busca();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
          </div>
          </div>
  <!--        </div>  -->
          </div>

         <small> <div class='col-md-12'><div id='data'></div></div> </small>
            </div>                
        </section><!-- /.content -->
        
</div><!-- /.content-wrapper -->

          <div class="modal fade" id ="Datos_cliente" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">

   <!-- Main content -->
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title"><center>Datos de usuario</center></h4>
          </div>

          
          
          <br>
          <form id="formdatos"  enctype="multipart/form-data" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">ID</label>
    <input type="text" class="form-control" id="id" placeholder="ID" disabled>
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Usuario</label>
    <input type="text" class="form-control" id="user" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" class="form-control" id="pass" placeholder="Contraseña">
  </div>
  <!--<div class="form-group">-->
  <!--  <label for="exampleInputFile">File input</label>-->
  <!--  <input type="file" id="exampleInputFile">-->
  <!--  <p class="help-block">Example block-level help text here.</p>-->
  <!--</div>-->

  

                 <!--<div class="icheck-primary d-inline">-->
                 <!--       <input class="form-control form-control-sm" type="checkbox" >-->
                 <!--       <label for="todos">-->
                 <!--         Seleccionar todo-->
                 <!--       </label>-->
                 <!--     </div>-->
                      

<!--<label class="checkbox-inline">-->
<!--  <input type="checkbox" id="inlineCheckbox1" value="option1"> 1-->
<!--</label>-->
<!--<label class="checkbox-inline">-->
<!--  <input type="checkbox" id="inlineCheckbox2" value="option2"> 2-->
<!--</label>-->
<!--<label class="checkbox-inline">-->
<!--  <input type="checkbox" id="inlineCheckbox3" value="option3"> 3-->
<!--</label>-->


<!--<div>-->
<!--<h3> Original image: </h3>-->
<!--<img src="https://tinyurl.com/k764en3w">-->
<!--<h3> Cropped image using object-fit: </h3>-->
<!--<img-->
<!--class="cropped1" src="https://tinyurl.com/k764en3w">-->
<!--<h3> Cropped image adjusted with object-position: </h3>-->
<!--<img-->
<!--class="cropped2" src="https://tinyurl.com/k764en3w"> -->
<!--</div>-->


<center>
<div class="form-check">
  <input class="form-check-input" type="checkbox" id="todos" onclick="selectall();">
  <label id="selall" class="form-check-label" for="todos">
    Marcar todo
  </label>
</div>
</center>


<br>
<div class="row" style="  display: flex;
  justify-content: center;">
    <div class="col-md-5">
    



       <div class="form-check" hidden>
  <input class="form-check-input" type="checkbox" id="cotizaciones">
  <label class="form-check-label" for="cotizaciones">
    Cotizaciones
  </label>
</div>



 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="ventas">
  <label class="form-check-label" for="ventas">
    Ventas
  </label>
</div>




 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="compras">
  <label class="form-check-label" for="compras">
    Compras
  </label>
</div>


 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="inventario">
  <label class="form-check-label" for="inventario">
    Inventario
  </label>
</div>



 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="clientes">
  <label class="form-check-label" for="clientes">
    Clientes
  </label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="proveedores">
  <label class="form-check-label" for="proveedores">
    Proveedores
  </label>
</div>

 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="usuarios">
  <label class="form-check-label" for="usuarios">
    Usuarios
  </label>
</div>
    
</div>
<div class="col-md-5">
    



       

      <div class="form-check" hidden>
  <input class="form-check-input" type="checkbox" id="histocotizaciones">
  <label class="form-check-label" for="histocotizaciones">
    Historial Cotizaciones
  </label>
</div>



 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="histoventas">
  <label class="form-check-label" for="histoventas">
    Historial Ventas
  </label>
</div>



 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="histocompras">
  <label class="form-check-label" for="histocompras">
    Historial Compras
  </label>
</div>

 

 <div class="form-check">
  <input class="form-check-input" type="checkbox" id="reporte">
  <label class="form-check-label" for="reporte">
    Reportes inventario
  </label>
</div>

 
</div>
</div>


             
         <div class="mt-10">
       <input onchange="cambioimg(this.id);"type="file" id="image1" name="image1" style='display: none;'>
      </div>  


  <!--<button type="submit" class="btn btn-default">Submit</button>-->
</form>

 <div id="contenedorimages" style="width:100%;text-align:center;" class=''>
      <div class="labelimage2">
<!--<label  for="image1"><img width="150" OnError="Error_Cargar()" class="imgp" name="image1a" id="image1a"src="imagenes/addx.png"></label>-->


<label  for="image1"><img width="200" OnError="Error_Cargar()" class="imgp cropped1" name="image1a" id="image1a"src="imagenes/userlg1.png"></label>

</div>
        
        </div>

<br>
<!--               <form id="formdatos"  enctype="multipart/form-data" method="post">-->
<!--          <div class='form-group'>-->
<!--          <label for="beneficiario" class="col-sm-2 control-label">Id:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input type="text" class="form-control" id='id' placeholder='' disabled='true'-->
<!--          data-inputmask="'placeholder': '0'" >-->
<!--          </div>-->
<!--          </div>-->
<!--<br> <br>      -->
          
<!--          <div class='form-group'>-->
<!--          <label for="beneficiario" class="col-sm-2 control-label">Usuario:</label>-->
<!--          <div class="col-sm-8">-->
<!--          <input type="text" class="form-control" id='user' placeholder='' -->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
<!--          </div>-->
<!--<br> <br> -->

<!--          <div class='form-group'>-->
<!--          <label for="beneficiario" class="col-sm-2 control-label">Contraseña:</label>-->
<!--          <div class="col-sm-8">-->
<!--          <input type="text" class="form-control" id='pass' placeholder='' -->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
<!--          </div>-->
<!--<br> <br>      -->



          
<!--         <div class="mt-10">-->
<!--       <input onchange="cambioimg(this.id);"type="file" id="image1" name="image1" style='display: none;'>-->
<!--      </div>  -->


<!--</form>-->





     

         <div class="modal-footer">
         <button class='btn btn-info btn-mini pull-left' id='btn-add' onclick='guardar();'><i class='fa fa-save'></i> Guardar</button>
     </div>
     
          </section><!-- /.content -->
      </div>
      </div>
      </div>



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


<div class="modal fade" id ="modal_abonos" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">

   <!-- Main content -->
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Abonos de Clientes...</h4>
          </div>
          <div class='panel panel-info'>  
          <br> 
          <small>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Boleta:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id='boleta' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Id:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='idcliente' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          <button type='button' class='btn btn-azul btn-xs' data-toggle="tooltip" data-placement="top" title="Buscar" onclick='busqueda_inventario_compras();' id='btn-altas'><i class='fa fa-search'></i></button>
          </div>
 <br> 
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Cliente:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='nombrecliente' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br>  
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Saldo:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='saldoabono' placeholder='' disabled='true'
           data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Abono:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='abono' placeholder='' onKeyUp="calcula();"
           data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> <br> 
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Saldo F:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='saldofinalabonos' placeholder='' disabled='true'
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> <br> 
         <div class="form-group">
         <button class='btn btn-azul btn-mini pull-right' id='btn-add' onclick='guardar_abonos();'><i class='fa fa-save'></i> Guardar abono</button>
         </div>
        <br>
         <small> <div class=class='col-md-12'><div id='data2'></div></div> </small>                    
        </small>
          </section><!-- /.content -->
      </div>
      </div>
      </div>



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
  <!-- jQuery 3.1.1 -->
<script src="./js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./js/bootstrap.min.js"></script>
<!-- Script AjaxForms-->
<script src="./js/AjaxForms.js"></script>
<!-- Sweet Alert 2-->

<!-- AdminLTE App -->
<script src="dist/js/app.js"></script>
<!-- Script main-->

<script src="./js/main.js"></script>
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/printPage/jquery.printPage.js"></script>
      <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->
    <script>
      $(document).ready(function(){
        $(".cantidades").inputmask();
      });
    </script>
    
    <script type="text/javascript">
    /*****************************************************************************/
function busca(){
	var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_lista_usuarios.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#data").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function abrir_modal_datos_clientes(){
   $("#id").val("");
   $("#nit").val("");
   $("#nombre").val("");
   $("#contacto").val("");
   $("#direccion").val("");
   $("#telefono").val("");
   $("#correo").val("");
   $("#listado").val("");
   $("#saldolimite").val("");
   $("#plazo").val("");
   $("#saldo").val("");
   $("#Datos_cliente").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_cliente').on('shown.bs.modal', function () {
   $("#nit").focus();
   //$("#buscar_cliente2").focus();
   });
}
/*****************************************************************************/   
function busca(){
	var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_lista_usuarios.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#data").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#codigo").val(art.trim());
  busca_articulo();
}
/*********************************************************************************/
function guardar(){
       event.preventDefault();
// $('#Datos_cliente').modal('toggle');  
var user=$("#user").val();
var pass=$("#pass").val();
var tipouser=$("#tipouser").val();
var comision=$("#comision").val();
var id=$("#id").val();
var comision=$("#comision").val();

var cotizaciones=0;
var histocotizaciones=0;
var ventas=0;
var histoventas=0;
var compras=0;
var histocompras=0;
var inventario=0;
var reporte=0;
var clientes=0;
var proveedores=0;
var usuarios=0;

const $cotizaciones = document.querySelector("#cotizaciones");
const $histocotizaciones = document.querySelector("#histocotizaciones");
const $ventas = document.querySelector("#ventas");
const $histoventas = document.querySelector("#histoventas");
const $compras = document.querySelector("#compras");
const $histocompras = document.querySelector("#histocompras");
const $inventario = document.querySelector("#inventario");
const $reporte = document.querySelector("#reporte");
const $clientes = document.querySelector("#clientes");
const $proveedores = document.querySelector("#proveedores");
const $usuarios = document.querySelector("#usuarios");


if ($cotizaciones.checked) {
  cotizaciones=1;
} 
if ($histocotizaciones.checked) {
  histocotizaciones=1;
} 
if ($ventas.checked) {
  ventas=1;
} 
if ($histoventas.checked) {
  histoventas=1;
} 
if ($compras.checked) {
  compras=1;
} 
if ($histocompras.checked) {
  histocompras=1;
} 
if ($inventario.checked) {
  inventario=1;
} 
if ($reporte.checked) {
  reporte=1;
} 
if ($clientes.checked) {
  clientes=1;
} 
if ($proveedores.checked) {
  proveedores=1;
} 
if ($usuarios.checked) {
  usuarios=1;
} 

var form = document.querySelector("#formdatos");
var formData = new FormData(form);
var files = $('#image1')[0].files[0];
formData.append('archivo', files);
formData.append('user', user);
formData.append('pass', pass);
formData.append('tipouser', tipouser);
formData.append('id', id);
formData.append('comision', comision);

formData.append('usuarios', usuarios);
formData.append('proveedores', proveedores);
formData.append('clientes', clientes);
formData.append('reporte', reporte);
formData.append('inventario', inventario);
formData.append('histocompras', histocompras);
formData.append('compras', compras);
formData.append('histoventas', histoventas);
formData.append('ventas', ventas);
formData.append('histocotizaciones', histocotizaciones);
formData.append('cotizaciones', cotizaciones);



if(user==""||pass==""){
   var n = noty({
   text: "Completa la informacion del Cliente...!",
   theme: 'relax',
   layout: 'center',
   type: 'information',
   timeout: 2000,
});
   return false;
}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_usuario.php',
 
          method: "POST",
             data: formData,
            contentType:false,
   processData:false,
   //data: 'id='+$("#id").val()+'&user='+$("#user").val()+'&pass='+$("#pass").val()+'&tipouser='+$("#tipouser").val(),
   success: function(x){
   
    const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Guardado correctamente'
})

   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*****************************************************************************/  
function modificar_cliente(id){
   abrir_modal_datos_clientes();
   pid=id;
   busca_cliente();
}
/*****************************************************************************/  
function busca_cliente(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del usuario...");
           },
          url: 'busca_data_usuarios.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].id);
            $("#id").val(data[0].id);
            $("#user").val(data[0].Usuario);
            $("#pass").val(data[0].Password);
            
            document.getElementById("image1a").src="imagenes/"+data[0].imagen+"";


var cotizaciones=data[0].cotizaciones;
var histocotizaciones=data[0].historialcotizaciones;
var ventas=data[0].ventas;
var histoventas=data[0].historialventas;
var compras=data[0].compras;
var histocompras=data[0].historialcompras;
var inventario=data[0].inventario;
var reporte=data[0].reporteinventario;
var clientes=data[0].clientes;
var proveedores=data[0].proveedores;
var usuarios=data[0].usuarios;

const $cotizaciones = document.querySelector("#cotizaciones");
const $histocotizaciones = document.querySelector("#histocotizaciones");
const $ventas = document.querySelector("#ventas");
const $histoventas = document.querySelector("#histoventas");
const $compras = document.querySelector("#compras");
const $histocompras = document.querySelector("#histocompras");
const $inventario = document.querySelector("#inventario");
const $reporte = document.querySelector("#reporte");
const $clientes = document.querySelector("#clientes");
const $proveedores = document.querySelector("#proveedores");
const $usuarios = document.querySelector("#usuarios");

if (cotizaciones==0) {
  $cotizaciones.checked=false;
} else{
  $cotizaciones.checked=true;
}

if (histocotizaciones==0) {
  $histocotizaciones.checked=false;
} else{
  $histocotizaciones.checked=true;
}

if (ventas==0) {
  $ventas.checked=false;
} else{
  $ventas.checked=true;
}


if (histoventas==0) {
  $histoventas.checked=false;
} else{
  $histoventas.checked=true;
}



if (compras==0) {
  $compras.checked=false;
} else{
  $compras.checked=true;
}


if (histocompras==0) {
  $histocompras.checked=false;
} else{
  $histocompras.checked=true;
}


if (inventario==0) {
  $inventario.checked=false;
} else{
  $inventario.checked=true;
}


if (reporte==0) {
  $reporte.checked=false;
} else{
  $reporte.checked=true;
}


if (clientes==0) {
  $clientes.checked=false;
} else{
  $clientes.checked=true;
}


if (proveedores==0) {
  $proveedores.checked=false;
} else{
  $proveedores.checked=true;
}


if (usuarios==0) {
  $usuarios.checked=false;
} else{
  $usuarios.checked=true;
}







            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          
          })
         }
/*****************************************************************************/  
function eliminar_item(id){
   pid=id;  
   var n = noty({
                  text: "Seguro que desea eliminar el usuario...?",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  buttons     : [
                    {addClass: 'btn btn-primary',
                     text    : 'Si',
                     onClick : function ($noty){
                          $noty.close();
                        $.ajax({
          beforeSend: function(){
          },
          url: 'Eliminar_data_usuario.php',
          type: 'POST',
          data: 'id='+pid,
          success: function(x){
             var n = noty({
              text: "Se elimino el usuario del listado...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000,
            });
      //recuperar_alimentos();
            busca();
           },
           error: function(jqXHR,estado,error){
           }
           });
                      }
                   },
                   {addClass: 'btn btn-danger',
                    text    : 'No',
                    onClick : function ($noty){
                       $noty.close();

                    }
                    }
                  ]
                  });
}
/*****************************************************************************/  
function Error_Cargar() {
document.getElementById("image1a").src="imagenes/userlg1.png";
}
/*****************************************************************************/  
function cambioimg(art){
            event.preventDefault();
var form = document.querySelector("#formdatos");
var formData = new FormData(form);
var files = $('#'+art.trim()+'')[0].files[0];
formData.append('archivo', files);
                $.ajax({
               url: 'cambioimg.php',
               method: "POST",
               data: formData,
            contentType:false,
     processData:false,
        
              success: function(xx){
                if (files==null) {
document.getElementById(art.trim()+"a").src="imagenes/userlg1.png";  


                }
 else
 {
document.getElementById(art.trim()+"a").src="imagenes/"+xx+"";  

 }
  //$("#imagen2").attr("src","../imgproductos/"+xx);
 //src="data:image/jpeg;base64,"+xx;
//var element = $(art.trim());
//element.src = src;

              },
           error: function(jqXHR,estado,error){
             $("#btn-reg-usr").html('Hubo un error: '+estado+' '+error);
             swal("Hubo un error al registrar el producto, contacte a soporte inmediatamente...!");
           }
           });


         }
         /*****************************************************************************/  
function muestraimg(id){
       var img=id;
    Swal.fire({
  width: 800,
  height: 800,
  imageUrl: img,
  imageAlt: 'Custom image',
})
}
/*****************************************************************************/  

// $(document).ready(function(){
// 	$(".btn-exit-system").on("click", function(e){
// 		e.preventDefault();
// 		var urlDir=$(this).attr("href");

// 		Swal.fire({
//    title: '¿Estás seguro?',
//   text: "Quieres salir del sistema y finalizar la sesión actual",
//   icon: 'warning',
//   showCancelButton: true,
//   confirmButtonColor: '#3085d6',
//   cancelButtonColor: '#d33',
//   confirmButtonText: 'Si, salir'
// }).then((result) => {
//   if (result.isConfirmed) {
// 	  window.location.href=urlDir;
//   }
// })
// 	});
// });

/*****************************************************************************/  
function selectall(){
const $selectall = document.querySelector("#todos");
const $cotizaciones = document.querySelector("#cotizaciones");
const $histocotizaciones = document.querySelector("#histocotizaciones");
const $ventas = document.querySelector("#ventas");
const $histoventas = document.querySelector("#histoventas");
const $compras = document.querySelector("#compras");
const $histocompras = document.querySelector("#histocompras");
const $inventario = document.querySelector("#inventario");
const $reporte = document.querySelector("#reporte");
const $clientes = document.querySelector("#clientes");
const $proveedores = document.querySelector("#proveedores");
const $usuarios = document.querySelector("#usuarios");

if ($selectall.checked==false) {
  $cotizaciones.checked=false;
  $histocotizaciones.checked=false;
  $ventas.checked=false;
  $histoventas.checked=false;
  $compras.checked=false;
  $histocompras.checked=false;
  $inventario.checked=false;
  $reporte.checked=false;
  $clientes.checked=false;
  $proveedores.checked=false;
  $usuarios.checked=false;
  $("#selall").html("Marcar todo");

  
} else{
    $cotizaciones.checked=true;
  $histocotizaciones.checked=true;
  $ventas.checked=true;
  $histoventas.checked=true;
  $compras.checked=true;
  $histocompras.checked=true;
  $inventario.checked=true;
  $reporte.checked=true;
  $clientes.checked=true;
  $proveedores.checked=true;
  $usuarios.checked=true;
  $("#selall").html("Desmarcar todo");
}
}
var pid='';
    </script>
  </body>
</html>