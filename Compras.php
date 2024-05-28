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
	$cadena_buscada   = 'compras';
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
    <title>Detalle de Compras # <?php echo $_SESSION['sucursal']; ?></title>
    <?php include "./class_lib/links.php"; ?>
     <style type="text/css">
    
    li {
    list-style: none;
}
.media-body {
    flex: 1;
}
.mb-2, .my-2 {
    margin-bottom: 0.5rem !important;
}
.justify-content-between {
    justify-content: space-between !important;
}
.mb-sm-0, .my-sm-0 {
    margin-bottom: 0 !important;
}
.mb-1, .my-1 {
    margin-bottom: 0.25rem !important;
}
ol, ul {
    margin-top: 0;
    padding: 0;
    margin-bottom: 10px;
}
h5, .h5 {
    font-size: 1rem;
        font-weight: bold;
}
        .listaclientes{
            position: absolute;
    background-color: white;
    width: 100%;
    height: auto;
    z-index: 1050;

    max-height: 300px;
    overflow-x: auto;
    padding: 0;
    }
        .listas{
display: flex;
    flex-wrap: wrap;
    border: solid 1px;
    border-color: #d0d0d054;
    padding: 8px;
    list-style: none;
    }
    
    .listas:hover{
        background-color:#d0d0d054;
        cursor:pointer;
    }
        #listas {
       /*datalist has "id=answer"*/
       border: .5em solid #137da0;
       font-size: 2em;
       font-weight: bolder;
       font-size: 2em;
       color: red;
       padding: 1px 1px;
       cursor: pointer}
       
      /*****************************************/
      .form-row {
    display: flex;
    flex-wrap: wrap;
    margin-right: -5px;
    margin-left: -5px;
}
.form-row > .col, .form-row > [class*="col-"] {
    padding-right: 5px;
    padding-left: 5px;
}
       .card {
    margin-bottom: 30px;
 border: 0px!important;
    border-radius: 0.625rem!important;
    box-shadow: 6px 11px 41px -28px #a99de7;
}
.d-sm-flex {
    display: flex !important;
}
.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}
       .card .card-body {
    padding: 1.88rem 1.81rem;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.25rem;
}
.mb-sm-0, .my-sm-0 {
    margin-bottom: 0 !important;
}
.mb-2, .my-2 {
    margin-bottom: 0.5rem !important;
}
.justify-content-between {
    justify-content: space-between !important;
}
.btn:not(:disabled):not(.disabled) {
    cursor: pointer;
}
.media-reply__link button {
    background: none;
}
.p-0 {
    padding: 0 !important;
}
.ml-3, .mx-3 {
    margin-left: 1rem !important;
}
btn {
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
.mb-1, .my-1 {
    margin-bottom: 0.25rem !important;
}
.card-profile__info li strong {
    max-width: 100px;
}
.text-dark {
    color: #464a53 !important;
}
.mr-5, .mx-5 {
    margin-right: 3rem !important;
}
.mr-4, .mx-4 {
    margin-right: 1.5rem !important;
}
    </style>
  </head>
  <body onLoad="pone_num_venta();resumen();busca_presenta();">
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
            <small> Detalle de Compras | Cajero: <?php echo $_SESSION['nombre_de_usuario']; ?> | Caja: <?php echo $_SESSION['numero_de_caja']; ?> | </small>
            <small>  <?php echo $fecha; ?></small>

          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Detalle de Compras</li>
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
          
          <div id="clientesb" class="form-row">
                      
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: bold;">Proveedor:</label>
                                             
                        <input  autocomplete = "off" onfocus="mostrarclientes();" type="text" id="buscaclientes" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="buscacliente();" class="form-control" placeholder="Buscar cliente">

<ul class="listaclientes" id="listaclientes">

</ul>
 </div>
        </div>  
        
         <div id="datos_cliente" class="form-row">
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: bold;">Datos proveedor</label>
                                               
                                            
                                                
                                                <div class="card">
                            <div class="card-body">
                                                <div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 id="clientec2" class="mb-sm-0"></h5>
                                        <div class="media-reply__link">
                                            <button onclick="editar_cliente();" class="btn btn-transparent p-0 ml-3 font-weight-bold">Editar</button>
                                            
                                      
                                        </div>
                                    </div>
                                    <br>
                                    
                                <ul class="card-profile__info">
                                    <li class="mb-1"><strong class="text-dark mr-5">Nit     </strong> <span id="nitc"></span></li>
                                    <li><strong class="text-dark mr-4">Dirección</strong> <span id="direccionc"></span></li>
                                    <li><strong class="text-dark mr-4">Telefono</strong> <span id="telefonoc"></span></li>
                                </ul>
                                </div>
                                </div>
                                </div>
                                
                                            </div>
                                        
                                         
                                        </div>
          <div class='btn-group'>
<!--          <button class='btn  btn-success btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Cobrar Envío" id='btn-procesa' onclick='prepara_venta();'><i >Cobrar</i> </button>

          <button class='btn  btn-azul btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Contado"onClick="busca_cliente_contado();" id='btn_cre'><i class=>Efectivo</i> </button>

          <button class='btn  btn-naranja btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Crédito"onClick="busca_cliente();" id='btn_cre'><i >Crédito</i> </button>-->
          
          <button class='btn  btn-warning btn-mini pull-left' data-toggle="tooltip" data-placement="top" title="Nuevo Código" onclick="abririnventarioa();" id='btn_cre'><i >Inventario</i> </button>
          </div>  

          <div class='form-group'>
          <div class='box-body'>
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-azul' onclick='busca_datos_pedidos();'><i class='fa fa-spinner'></i> Actualizar&nbsp;</button>
          </div>
          <input type='text' id='factura' class='form-control' placeholder='' onchange='busca_datos_pedidos();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;" value=<?php echo $_GET["id"]?>>
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
          <input type='text' id='codigo' class='form-control' placeholder='Codigo...' onchange='agrega();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
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

    <div class="modal fade" id ="modal_tabla_presentación2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Elige la presentación del producto:</h4>
          </div>
          <div class="modal-body">
            <div id='lista_presentacion2'></div>
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
            <h4 class="modal-title">Selecciona el Proveedor:</h4>
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
            <div class="modal-dialog modal-lg">
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


     <div class="modal fade" id ="Datos_cliente" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" style="width: 90%!important;height: 88%!important;overflow-x:auto!important;">
        <div class="modal-content" style="width: 100%!important;height: 100%!important;overflow-x:auto!important;position:fixed!important;margin:auto!important;">

   <!-- Main content -->
        <section class="content" style="width: 100%!important;height: 100%!important;overflow-x:auto!important;position:fixed!important;margin:auto!important;">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Datos de Inventario...</h4>
          </div>
          <div class='panel panel-info'>  
          <br> 
          <small>
          
<div class='form-group' style="padding:4px;">
          <label for="beneficiario" class="col-sm-1 control-label">Código:</label>
          <div class="col-sm-1">
          <input type="text" class="form-control" id='codigoo' placeholder='Código' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-1 control-label">C. Barra:</label>
          <div class="col-sm-2">
          <input  onKeyUp="busca_inventario_compras();" type="text" class="form-control" id='codigooalterno' placeholder='Código de Barra'
          data-inputmask="'placeholder': '0'">
          </div>
            <label for="beneficiario" class="col-sm-1 control-label">Producto:</label>
          <div class="col-sm-5">
          <input type="text" class="form-control" id='producto' placeholder='Producto' 
          data-inputmask="'placeholder': '0'">
          </div>
        <!--  <button type='button' class='btn btn-azul btn-xs' data-toggle="tooltip" data-placement="top" title="Buscar" onclick='busqueda_inventario_compras();' id='btn-altas'><i class='fa fa-search'></i></button>
        -->
          </div>
          <br>

 <div class="form-row" style="padding:4px;">
         <div class='form-group' >
          <label for="beneficiario" class="col-sm-1 control-label">Proveedor:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='proveedor' placeholder='Proveedor' 
          data-inputmask="'placeholder': '0'">
          </div>
          
          
           <label for="beneficiario" class="col-sm-1 control-label">Marca:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id='presentacion2' placeholder='Marca' 
          data-inputmask="'placeholder': '0'">
          </div>
          
          <label for="beneficiario" class="col-sm-1 control-label">Presentación:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id='presentacion2' placeholder='Presentación' 
          data-inputmask="'placeholder': '0'">
          </div>
          
          </div>
<br>       
     </div>
      


          
          <div class='form-group'style="padding:4px;">
          <label for="beneficiario" class="col-sm-1 control-label">Aplicación:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='existencia' placeholder='Aplicación' 
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-1 control-label">Miníma:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id='minima' placeholder='Mínima' 
          data-inputmask="'placeholder': '0'">
          </div>
               <label for="beneficiario" class="col-sm-1 control-label">Máxima:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control" id='maxima' placeholder='Máxima' 
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> 

          <div class='form-group'style="padding:4px;">
     
          <label for="beneficiario" class="col-sm-1 control-label">Costo:</label>
          <div class="col-sm-2">
          <input type="text" class="form-control cantidades" id='costo' placeholder='Costo' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Costo'">
          </div>
          </div>
          
          
         

<br>


         <div class="modal-footer">
         <button class='btn btn-azul btn-mini pull-left' id='btn-add1' onclick='guardar_inventarios();'><i class='fa fa-save'></i> Guardar producto</button>
         <button class='btn btn-success btn-mini pull-left' id='btn-add' onclick='nuevo_producto();'><i class='fa fa-file-o'></i> Nuevo producto</button>
         <button class='btn btn-naranja btn-mini pull-left' id='btn-add' onclick='abrir_modal_datos_presentacion();'><i class='fa fa-list'></i> Nueva presentación</button>
        </div>
        
         <small> <div class=class='col-md-12'><div id='lista_productos'></div></div> </small>                    
        </small>
          </section><!-- /.content -->
      </div>
      </div>
      </div>

      <div class="modal fade" id ="Datos_presentacion" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">

   <!-- Main content -->
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Datos de Presentación...</h4>
          </div>
          <div class='panel panel-info'>  
          <br> 
          <small>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Código:</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id='id' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'" >
          </div>
          </div>
<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Tipo Precio:</label>
          <div class="col-sm-4">
          <select class='form-control select2' name="empresa" id="tipoprecio"  style='width: 100%;' onChange="">
          <option value='P. Público'>P. Público</option>
          <option value='P. Distribuidor'>P. Distribuidor</option>
          <option value='P. Mayorista'>P. Mayorista</option>
          <option value='P. Mayorista 2'>P. Mayorista 2</option>
          </select>
          </div>  
          </div>  
          

<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Presentación:</label>
          <div class="col-sm-8">
          <input type="text" class="form-control" id='presentacion' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Unidades:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidade" id='unidades' placeholder='' 
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 0, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Precio:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='precio' placeholder='' 
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> 
</small>
         <div class="modal-footer">
         <button class='btn btn-primary btn-mini pull-left' id='btn-add' onclick='guardar_presentaciones();'><i class='fa fa-save'></i> Guardar</button>
     </div>
     </div>
          </section><!-- /.content -->
      </div>
      </div>
      </div>


      <div class="modal fade" id ="modal_busqueda_inventario_compras" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Busqueda de Productos:</h4>
          </div>
          <div class="modal-body">
          <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>Producto:</b></span>
          <input type='text' id='producto_buscar' class='form-control' onKeyUp="busca_inventario_compras();" placeholder='Descripcion del articulo...'>
          </div>
          <br>
          <small>  <div id='lista_productos2'></div> </small>
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
    <script src="dist/js/source_point_compras.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/printPage/jquery.printPage.js"></script>
    <script>
      $(document).ready(function(){
        $(".cantidades").inputmask();
      });
    </script>
<script type="text/javascript">
    buscacliente();
function buscacliente(){
    
        $.ajax({

        url: 'listaproveedores.php',
            type: 'POST',
            data: 'cliente='+$('#buscaclientes').val(),
            success: function(x){
            $("#listaclientes").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#listaclientes").html(estado+"   "+error);
              }
          });     
  
}
/***************************************/
function mostrarclientes(){
    $("#listaclientes").show();
}
function ocultarclientes(){
    $("#listaclientes").hide();
}
ocultarclientes();
/***************************************/
window.addEventListener('click', function(e){ 
    if (document.getElementById('clientesb').contains(e.target)){ 
    // Clicked in box 
    } else{ 
    // Clicked outside the box 
    ocultarclientes();
    
    } 
    }); 
/***************************************/
function agregacliente(elid){

    var client=elid;
                 var idcl=client.split("|");
                 $("#idcliente_credito").val(idcl[0]);
                 $("#nitcliente").val(idcl[1]);
                 pdireccion=idcl[2];
                 ptipo='Efectivo';
                 $("#tipo_venta").val("2");
                 
                $('#nitc').html(idcl[1]);
                $('#clientec2').html(idcl[0]);
                $('#direccionc').html(idcl[2]);
                $('#telefonoc').html(idcl[3]);
                
                $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+idcl[0]);
                $("#btn_cre").attr('disabled', false);
                $("#clientesb").hide();
                $("#datos_cliente").show();
                ocultarclientes();
}
/***************************************/
$("#datos_cliente").hide();

/***************************************/
function editar_cliente(){
       $("#datos_cliente").hide();
      $("#clientesb").show();
         $('#buscaclientes').val("");
}

function abririnventarioa(){
    window.location.href = "Inventario.php";
}

       
    
    </script>
  </body>
</html>