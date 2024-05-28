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
  
  $expocoti=($_GET["id"]);
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
      <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <style>
.ul-menus{
                  
      list-style: none;
      list-style-type: none;
      list-style-position: outside;
          margin-bottom: 5px;
          margin-top: 5px;
      
}
 
.li-menus{
  line-height: 30px;
    font-size: 16px;
    cursor: pointer;
    padding: 4px 17px;
    border-radius: 5px;
    margin: 10px;
}
.li-menus:hover{

      background:#936a00;
}
 
.div-menus{
        user-select: none;
    transition: transform .2s ease-out;
    transform: scale(0);
    z-index: 1051;
    background:black;
    color:white;
    
        padding: 9px 0;
    
    border-radius: 12px;
 
    
    box-shadow: 0px 2px 5px rgba(0,0,0,0.3); 
    
        min-width: 266px!important;
    position:absolute;      
 
}

               
              input#articulo_buscar::placeholder {
    color: #0000ff8c;
}


 
#lista_articulos{
    outline: auto;
    border-radius: 5px;
    border: 2px;
    border-style: solid;
    
}


     .listaclientesx{
         transition: all .2s ease-out;
         transform: scale(0);
         min-width: 100%;
         max-width: 100%;
            position: absolute;
    background-color: white;
        height: auto;
    z-index: 1050;

    max-height: 800px;
    overflow-x: auto;
    padding: 0;
    }
     
             tr{
              
    outline-color: #c5ad00;
    outline-width: 0.1px;
            }
            
            tr{cursor: pointer}
            
             .selected{background-color:#efd2002b!important}
            
            button{margin-top:10px;background-color: #eee;border: 2px solid #00F;
                 color: #17bb1c;font-weight: bold;font-size: 25px;cursor: pointer}
            
            
            
            table { 
                border-collapse: collapse;
                width: 100%; 
                            }
                            
                        

.colores thead th {
    background: #ffbc0e!important;
    padding: 8px 16px!important;
}

.tableFixHead thead th {
    position: sticky;
    top: -1px;
    text-align: center;
}

        </style>
    <title>Envios de Bodega # <?php echo $_SESSION['sucursal']; ?></title>
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
<style type="text/css">



.contenedorimages{
    text-align: center;
}

.labelimage2{
    width: 250px;
    height: 250px;
    align-items: center;
   
    border: 2px solid #07c6ff;
    display: inline-block;
    outline: none;
    line-height: 250px;
   
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    font-size: 4em;
    cursor: pointer;
    transition: all 0.3s ease 0s;
    margin-top: 10px;
        margin-right: 10px;
        position: relative;

}
.labelimage2:hover{
    color: #ffc107;
    border: 2px solid #07c6ff;
    background: #fff;
    transform:scale(0.9);

    
}

.deleteimg{
    width: 100%;
    height: 30px;
    align-items: center;
    color: white;
   
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
    width: 200px;
    height: 200px;
     cursor: pointer;
   }

@media screen and (max-width: 280px) {


  div#dialog-inventario {
    width: 200px!important;
        margin: 30px auto;
  }
}

@media screen and (min-width: 281px) and (max-width: 359px) {
      div#dialog-inventario {
    width: 250px!important;
        margin: 30px auto;
  }
} 
 
@media screen and (min-width: 360px) and (max-width: 479px) {
      div#dialog-inventario {
    width: 300px!important;
        margin: 30px auto;
  }
}

@media screen and (min-width: 480px) and (max-width: 767px) {
      div#dialog-inventario {
    width: 450px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 768px) and (max-width: 999px) {
      div#dialog-inventario {
    width: 750px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1000px) and (max-width: 1279px) {
    div#dialog-inventario {
    width: 800px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1280px) and (max-width: 1649px) {
    
     div#dialog-inventario {
    width: 1000px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1650px) {
     div#dialog-inventario {
    width: 1200px!important;
        margin: 30px auto;
  }
}

</style>     
      
<style type="text/css">




@media screen and (max-width: 280px) {


  div#dialog-inventario {
    width: 200px!important;
        margin: 30px auto;
  }
}

@media screen and (min-width: 281px) and (max-width: 359px) {
      div#dialog-inventario {
    width: 250px!important;
        margin: 30px auto;
  }
} 
 
@media screen and (min-width: 360px) and (max-width: 479px) {
      div#dialog-inventario {
    width: 300px!important;
        margin: 30px auto;
  }
}

@media screen and (min-width: 480px) and (max-width: 767px) {
      div#dialog-inventario {
    width: 450px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 768px) and (max-width: 999px) {
      div#dialog-inventario {
    width: 750px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1000px) and (max-width: 1279px) {
    div#dialog-inventario {
    width: 800px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1280px) and (max-width: 1649px) {
    
     div#dialog-inventario {
    width: 1000px!important;
        margin: 30px auto;
  }
}
 
@media screen and (min-width: 1650px) {
     div#dialog-inventario {
    width: 1200px!important;
        margin: 30px auto;
  }
}

</style>     
      
    
    
    <?php include "./class_lib/links.php"; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  </head>
  
      <body onkeydown="agregaproducto();" onLoad="resumen();inicial_ventas();busca();">
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

        ?>
		
        
      </aside>

      
      <div class="content-wrapper">
     
        <!-- Main content -->
        <section class="content">

          <!-- Your Page Content Here -->
   
		  <div class='row'>
	      <div class="div-menus"  id="menu">
      <ul class="ul-menus">
 
            <li class="li-menus " id="li-add"><i id="li-add" class='fas fa-plus'></i>&nbsp; Agregar artículo</li>
            <li class="li-menus " id="li-quitar"><i id="li-quitar" class='fas fa-minus'></i>&nbsp; Quitar artículo</li>
            <li class="li-menus " id="li-eliminar"><i id="li-eliminar" class='fas fa-trash'></i>&nbsp; Eliminar</li>
            
        </ul>
        
</div>
        


          
    
         
           <div class='col-md-9'>
                <div class='col-md-12'>
                      <div id="artb" class="form-row">
                      
                                            <div class="form-group col-md-12">
                                               
                       <input  autocomplete = "off" onfocus="mostrararticulos();" onkeydown="agregap2();" type="text" id="articulo_buscar"  onclick="busca();" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="" class="form-control input-lg" placeholder="BUSCAR ARTÍCULOS">

<ul class="listaclientesx tableFixHead"  onkeypress="return runScript(event)" id="lista_articulos" onkeydown="agregap();" style="transform: scale(1);font-family: monospace;">

</ul>
</div>
</div>  
</div>

         <div class='col-md-12'><div class='table table-responsive'><div id='data'></div></div></div></div>
         
         
         
         
         
          <div class='col-md-3'>
          <div class='panel panel-success'>
          <div class='box-body'>
          <div class='form-group'>
         
             
          <div class="small-box bg-primary">
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
          
           
               
           
           <div class='col-md-12'>
          <div class='box-body'>
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-azul' onclick='busca_datos_pedidos();'><i class='fa fa-reorder'></i>  No. Envio&nbsp;</button>
          </div>
          <input type='text' id='factura' value="<?php echo $expocoti ?>"  class='form-control' placeholder='' onchange='busca_datos_pedidos();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;" readonly>
          </div>
          </div>
          </div>
          
          <div class='col-md-12'>
          <div class='box-body'>
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-warning' onclick=''><i class='fa fa-percent'></i> Descuento</button>
          </div>
          <input type='text' id='descuento' class='form-control' placeholder='' onchange='' style="font-size:16px; text-align:center; color:blue; font-weight: bold;"disabled>
          </div>
          </div>
          </div>
		
		      
               
          <div class='col-md-12'>
                        <div id="clientesb" class="form-row">
                      
                                            <div class="form-group col-md-12">
                                               
                                             
                        <input  autocomplete = "off"  onfocus="mostrarclientes();" type="text" id="nitor" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="buscacliente();" class="form-control" placeholder="Nit">

<ul class="listaclientes" id="listaclientes">

</ul>
 </div>
 
                                  <div class="form-group col-md-12">
                                               
                                             
                        <input  onfocusout="guardacliente();" autocomplete = "off" onfocus="" type="text" id="clienteor" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="" class="form-control" placeholder="Cliente">
 </div>
 
                                  <div class="form-group col-md-12">
                                             
                                             
                        <input onfocusout="guardacliente();"  autocomplete = "off" onfocus="" type="text" id="direccionor" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="" class="form-control" placeholder="Dirección">


 </div>
 
             <div class="form-group col-md-12">
                                              
                                             
                        <input  onfocusout="guardacliente();" autocomplete = "off" onfocus="" type="text" id="telefonoor" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="" class="form-control" placeholder="Teléfono">


 </div>
        </div>  
        
         <div id="datos_cliente" class="form-row">
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: bold;">Datos cliente</label>
                                               
                                            
                                                
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
                                    <li><strong class="text-dark mr-4">Descuento</strong> <span id="descuentoc"></span></li>
                                </ul>
                                </div>
                                </div>
                                </div>
                                
                                            </div>
                                        
                                         
                                        </div>
                                        
              </div>
              
              <br><br>
              <div class='col-md-12'>
 
          
          <button class='btn  btn-success btn-lg' data-toggle="tooltip" data-placement="top" title="Cobrar Envío" id='btn-procesa' onclick='prepara_ventax();'><i class='fa fa-quora'></i> Cobrar</button>
       
          
            <button class='btn  btn-warning btn-lg' data-toggle="tooltip" data-placement="top" title="Descuento %" id='btn-descuento' onclick='descuento();'><i class=''></i>% Descuento</button>
           </div> 
           <br> 
           <br> 
          <br> 
          <br> 
          

          
          
          </div>
          </div>

      </div>
                
                  
                  
      
      </div>
         
        </section>
         
</div>



    <div class="modal fade" id ="Datos_orden" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog"  style="overflow: auto;height: 650px;" >
        <div class="modal-content">

   
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Datos Cliente</h4>
          </div>
          
  
          
          

          <div class='panel panel-info'>  
          <br> 
          <small>
 <form id="formdatos"  enctype="multipart/form-data" method="post">
        
      
       
<br> <br>      
<br> <br> 
 
      </form>
 
</small>
         <div class="modal-footer">
         <button class='btn btn-info btn-mini pull-left' id='btn-add' onclick='guardarorden();'><i class='fa fa-save'></i> Guardar</button>
     </div>
     </div>
    

          </section><!-- /.content -->
      </div>
      </div>
      </div>



    <div class="modal fade" id ="Datos_cliente" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog" >
        <div class="modal-content">

   <!-- Main content -->
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Datos de Cliente...</h4>
          </div>
          <div class='panel panel-info'>  
          <br> 
          <small>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Id:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='id' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'" >
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Nit:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" onchange="buscacliente2();" id='nit' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br>      
          
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Nombre:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='nombre' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br> 

          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Contacto:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='contacto' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br>      

          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Dirección:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='direccion' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br> 
          
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Telefóno:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='telefono' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Correo E:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='correo' placeholder='' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br> 

          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Listado Precio:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='listado' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Limite Crédito:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='saldolimite' placeholder='' disabled='true'
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> <br> 

          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Plazo:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" id='plazo' placeholder='' disabled='true'
          data-inputmask="'placeholder': '0'">
          </div>
          <label for="beneficiario" class="col-sm-2 control-label">Saldo:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control cantidades" id='saldo' placeholder='' disabled='true'
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          </div>
<br> 
</small>
         <div class="modal-footer">
         <button class='btn btn-info btn-mini pull-left' id='btn-add' onclick='guardar();'><i class='fa fa-save'></i> Guardar</button>
     </div>
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
          <span class='input-group-addon bg-blue'><b>Descuento:
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%</b></span>
          <input type='text' id='descuentox' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onKeyUp="calcula_descuento();"
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Su Pago:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='paga_con' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onKeyUp="calcula_cambiox();"
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>
          
          
          
          
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Cambio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='el_cambio' class='form-control' style="font-size:30px; text-align:center; color:red; font-weight: bold;" disabled>
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Efectivo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='efectivo' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onKeyUp=""
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>
          <div class='input-group input-group-lg'>
          <span class='input-group-addon bg-blue'><b>Al crédito:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>
          <input type='text' id='credito' class='form-control cantidades' style="font-size:30px; text-align:center; color:red; font-weight: bold;" onKeyUp="calcular_tipo_corte();"
          data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">
          </div>
          <br>

          </div>
          <div class="modal-footer">

              <button class='btn btn-success btn-lg' id='btn-termina' onclick='guardar_corte();'><i class='fa fa-shopping-cart'></i> Procesar</button>
              <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal"><i class='fa fa-times'></i> Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div  class="modal fade" id ="modal_busqueda_arts" onkeydown="agregap();" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 100%!important;height: 100%!important;overflow-x:auto!important;position:fixed!important;margin:auto!important;">
        <div class="modal-content" style="width: 100%!important;height: 100%!important;overflow-x: auto!important;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Busqueda de Articulos:</h4>
            <br>
             <div class='input-group'>
          <span class='input-group-addon bg-blue'><b>Articulo:</b></span>
          <input type='text' id='articulo_buscar' class='form-control' onKeyup="busca();" onkeydown="agregap2();" autocomplete="off" placeholder='Producto/Proveedor/Marca/Código'>
          </div>
          </div>
          <div class="modal-body" style="width: 100%!important;height: 75%!important;">
         
          <br>
           <div class='col-md-12' style="width: 100%!important;height: 100%!important;"   ><div class='table table-responsive' style="width: 100%!important;height: 100%!important;overflow-x: hidden!important;"><div id='lista_articulos' class="tableFixHead" style="width: 100%!important;height: 100%!important;overflow-x: auto;"></div></div></div>
          
          </div>
      
          
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id ="existencias_sucursales" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title">Existencias Sucursales:</h4>
          </div>
          <div class="modal-body">
            <div id='lista_existencias'></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
     

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


    <input type='hidden' id='idcliente_credito' value="">
	  <input type='hidden' id='idcliente_contado' value="">
	  <input type='hidden' id='registros' value="">
	  <input type='hidden' id='nitcliente' value="">
	  <input type='hidden' id='tipo_venta' value="">
    <input type='hidden' id='total_venta' value="">
    <div id="scriptsxd" style="display:none;"></div>

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
      });
    /******************************************************************************************/
function agregaproducto(){
var keycode = event.keyCode;    
if (event.keyCode == 120) { //112 f1
// busqueda_art();
$("#articulo_buscar").focus();
}
}
/******************************************************************************************/  
            var index;
            var indexd;// variable to set the selected row index
function getSelectedRow()
            {
                
                var table = document.getElementById("table");
                  var indexf=  table.rows.length-1;  
                            if (typeof index !== "undefined" && index > indexf){
                                   for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                  
                       
                        index = this.rowIndex;
                  
                        this.classList.toggle("selected");
                            var dato = table.rows[index].children[0].innerHTML;
                document.getElementById('cmb'+dato).focus();

                    };
                }  
                            }
                            else
                            {
                                     for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].onclick = function()
                    {
                
                        if(typeof index !== "undefined"){
                          
                            table.rows[index].classList.toggle("selected",false);
                               
                        }
                       
                        index = this.rowIndex;
                
                        this.classList.toggle("selected");
                            var dato = table.rows[index].children[0].innerHTML;
                document.getElementById('cmb'+dato).focus();
   ccc=document.getElementsByName(dato)[0].id;

agrega_a_listas(ccc);
                    };
                }
                            }
                
                
           
                    
            }


            function getSelectedRow2()
            {
                var table = document.getElementById("table");
                              var indexf=  table.rows.length-1;  
                            if (typeof index !== "undefined" && index > indexf){
                                
                      
                      
                        index =  table.rows[1].rowIndex;
                       
                                                 table.rows[index].classList.toggle("selected"); 
                                                     var dato = table.rows[index].children[0].innerHTML;
                document.getElementById('cmb'+dato).focus();
                                }  else
                                {
                              
                      if(typeof index !== "undefined"){
                               table.rows[index].classList.toggle("selected",false);
                                
                      }
                      
                      
                        index =  table.rows[1].rowIndex;
             
                                                 table.rows[index].classList.toggle("selected"); 
                                                     var dato = table.rows[index].children[0].innerHTML;
                document.getElementById('cmb'+dato).focus();
                
                                }
                 }
               function getSelectedRow3()
            {
                var table = document.getElementById("table");
                var indexf=  table.rows.length;           
                                          
                      if(typeof index !== "undefined"){
                          
                           table.rows[index].classList.toggle("selected",false);
                      }
                         
                        index =  table.rows[indexf-1].rowIndex;
                        table.rows[index].classList.toggle("selected"); 
                        var dato = table.rows[index].children[0].innerHTML;
                        document.getElementById('cmb'+dato).focus();
            
                                               
                                                 
                                                 
                                                     
                
              
                 }
            
            
            
            function upNdown(direction)
            {
                var rows = document.getElementById("table").rows,
                    parent = rows[index].parentNode;
                 if(direction === "up")
                 {
                     if(index > 1){
                    
                       table.rows[index-1].classList.toggle("selected");
                   var dato = table.rows[index-1].children[0].innerHTML;
                document.getElementById('cmb'+dato).focus();
                 table.rows[index].classList.toggle("selected", false);
    
                 
                        // when the row go up the index will be equal to index - 1
                        index--;
                    }
                 }
                 
                 
                 if(direction === "down")
                 {
                     if(index < rows.length -1){
                    
                      table.rows[index+1].classList.toggle("selected");
                       var dato = table.rows[index+1].children[0].innerHTML;
                 document.getElementById('cmb'+dato).focus();
                      table.rows[index].classList.toggle("selected",false);
                     
                        // when the row go down the index will be equal to index + 1
                        index++;
                    }
                 }
               
                 
             
            }
 function focustable(){
     
if (event.keyCode === 9) {
getSelectedRow2();
}


     //if (event.keyCode >= 48 && event.keyCode <= 90 ) {
         if ((event.keyCode >= 48 && event.keyCode <= 90) || (event.keyCode >= 96 && event.keyCode <= 105))  {
$("#articulo_buscar").val('');
$("#articulo_buscar").focus();
}
if (event.keyCode === 38) {


if(index==1){
    $("#articulo_buscar").focus();
    
}
else
{
    event.preventDefault(); 
    upNdown('up');
    
}

}
if (event.keyCode === 40) {
    event.preventDefault(); 
upNdown('down');
}
if (event.keyCode === 36) {
getSelectedRow2();
}
if (event.keyCode === 35) {
getSelectedRow3();
//upNdown('end');
}
 }
 
   
   function runScript(e) {
    
    
    //See notes about 'which' and 'key'
    if (e.keyCode == 13) {
        
        var rows = document.getElementById("table").rows,
      parent = rows[index].parentNode;
  var dato = table.rows[index].children[0].innerHTML;
  
        var tb = document.getElementById("lista_articulos");
        eval(tb.value);
var ccc="";
        ccc=document.getElementsByName(dato)[0].id;

agrega_a_listas(ccc);

        return false;
    }
}
              function agregap2(){
                  
                  mostrararticulos();
                //    var keycode = event.keyCode;
if (event.keyCode === 27) {
ocultararticulos();
                
}

if (event.keyCode === 40) {
    
    event.preventDefault();    
getSelectedRow2();
  
                
}

}

                          function agregap(){
                        var keycode = event.keyCode;

if (event.keyCode === 27) {
ocultararticulos();
$("#articulo_buscar").focus();                
}

if (event.keyCode === 9) {
getSelectedRow2();
}





}
/*FUNCIONES PARA EL PUNTO DE VENTA*/
var totalesmonto=0.00;
var pdireccion='';
var ptipo='';
var pcodigo='';
var pcodigo2='';
var pproducto='';
var ppreciod=0.00;
var punidades=0;
var pexistencias=0.00;
var pcantidad=0.00;
var puni=0.00;
var psaldo=0.00;
var psaldolimite=0.00;
var pcosto=0.00;

var precioxa=0.00;
var precioxb=0.00;
var precioxc=0.00;
var precioxd=0.00;
var precioxe=0.00;


var upe=0.00;
var ublister=0.00;
var ucaja=0.00;


var xunidades=0.00;
var cantx=0.00;

/*************************************************************************************/
 function agrega_a_listas(productos){
  var alimentos=productos;
  var idcl=alimentos.split("|");
  dcodigo=idcl[0];
  dproducto=idcl[1];
  dexistencia=idcl[2];
  dcosto=idcl[3];
  dpresentacion=idcl[5];
  ddescuento=idcl[7];
  dprecio=idcl[4];
  
  precioxa=idcl[8];
  precioxb=idcl[9];
  precioxc=idcl[10];
  precioxd=idcl[11];
  precioxe=idcl[16];
  
  uunidad=idcl[12];
  ublister=idcl[13];
  ucaja=idcl[14];
  upe=idcl[15];
  
  var cmbprecio = ($("#cmb"+dcodigo).val());
  var idcl2=cmbprecio.split("|");
  var textdescuento=$("#descuento").val();
  if (parseFloat(odescuento)>0.00){
  var valordescuento=odescuento;      
  }else{
  var valordescuento=textdescuento;   
  }
  //alert (valordescuento);
  //alert (odescuento);
  if (parseFloat(valordescuento) > parseFloat(ddescuento)){
  ddescuento2=ddescuento;
  ddescuento2=(dprecio*ddescuento2)/100;
  campodescuento=ddescuento2;
  dprecio=dprecio-ddescuento2;
  }else{
  ddescuento2=valordescuento;
  ddescuento2=(dprecio*ddescuento2)/100;
  campodescuento=ddescuento2;
  dprecio=dprecio-ddescuento2;
  }

dunidades=1;

  dcategoria='';
  
   agrega_a_lista();
  

}
 /*************************************************************************************/
 function busqueda_presentacion(){
var tipo=$("#tipo_venta").val();
   $("#modal_tabla_presentación").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_tabla_presentación').on('shown.bs.modal', function () {
   });
}

/*************************************************************************************/
function agrega_a_lista(){

        var inputOptions = {};  
        
        
        
	 inputOptions["Precio 1"] = "Q"+precioxa+" Precio 1";
	 inputOptions["Precio 2"] = "Q"+precioxb+" Precio 2";
	 inputOptions["Precio 3"] = "Q"+precioxc+" Precio 3";
	 inputOptions["Docena"] = "Q"+precioxd+" Docena";
	 inputOptions["Fardo"] = "Q"+precioxe+" Fardo";

     
     
(async () => {

const { value: fruit } = await Swal.fire({
  title: 'Seleccione un precio',
  input: 'select',
  inputOptions: inputOptions,
  showCancelButton: true,
  inputValidator: (value) => {
    return new Promise((resolve) => {
    
        resolve()
    
    })
  }
})

if (fruit) {
  if(fruit=="Precio 1"){
      
      xunidades=1;
      dprecio=precioxa*xunidades;
      dpresentacion="Unidad 1";
  }else if(fruit=="Precio 2"){
     
      xunidades=1;
       dprecio=precioxb*xunidades;
      dpresentacion="Unidad 2";
  }else if(fruit=="Precio 3"){
      
      xunidades=1;
      dprecio=precioxc*xunidades;
      dpresentacion="Unidad 3";
  }else if(fruit=="Docena"){
     
      xunidades=12;
       dprecio=precioxd*xunidades;
      dpresentacion="Docena";
  }else if(fruit=="Fardo"){
      
      xunidades=upe;
      dprecio=precioxe*xunidades;
      dpresentacion="Fardo";
  }
  
  
  
  Swal
    .fire({
        title: "Ingrese una cantidad",
        input: "number",
            inputAttributes: {
       min: 1
      
    },
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: 1,
             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve('Ingrese una cantidad válida')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            
             dcantidad = resultado.value;
             campodescuento=campodescuento*dcantidad;
            dcantidadn=dcantidad*xunidades;
            xunidades=dcantidadn;
            
               if (parseFloat(dcantidadn)<=parseFloat(dexistencia)) {
                  
            dfactura=ofactura;
            dtotal=dcantidad*dprecio;
            guardarorden();
            
                   
               }
             
                    else
                    {
                        Swal.fire({
  icon: 'error',
  title: 'Pocas existencias'
  })
                    }
        }
    });
  
}

})()


    

  }

/*************************************************************************************/
 function busca_datos_pedidos(){
  var tipodoc=document.title;  
  ofactura=$("#factura").val();

         $(document).ready(function(){
          $.ajax({


          url: 'busca_data_pedidos.php',
          dataType: 'json',
          type: 'POST',
          data: 'factura='+$("#factura").val()+'&tipodoc='+otipo,
          success: function(data){
            if(data==0){
            const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'error',
  title: 'No. Envio no existe'
})
            }else{
            $(".widget-user-desc").html(data[0].factura);
            $("#totales").html("Q."+data[0].Total);
            ofactura=data[0].Factura;
            $("#nitor").val(data[0].Nit);
            $("#clienteor").val(data[0].Cliente);
            $("#telefonoor").val(data[0].Telefono);
            $("#direccionor").val(data[0].Direccion);
            $("#efectivo").val(data[0].efectivo);
            $("#credito").val(data[0].credito);


            
            
            
            var vertipo=data[0].Tipo;
            var vercliente=data[0].Cliente;
            
            
         
            $("#tipo_de_venta").html
            ("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+" "+vertipo+" a "+vercliente);
            detalle_factura();
            if(data[0].Total>0){
              $("#btn-procesa").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
            }
            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...");
           }
           });
          });
          
          //})
         }
/*************************************************************************************/
function detalle_factura(){
  //var tipodoc=document.title;  
        $.ajax({

        url: 'Historial_detalle_pedido_mostrar.php',
            type: 'POST',
            data: 'factura='+$('#factura').val(),
            success: function(x){
            $("#data").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });     
  
}


/*************************************************************************************/
function guardarorden(){
event.preventDefault();    
// $('#Datos_orden').modal('toggle');  
ofactura=$("#factura").val();
otipo='Efectivo';

onit=$("#nitor").val();
odireccion=$("#direccionor").val();
ocliente=$("#clienteor").val();
otelefono=$("#telefonoor").val();


var form = document.querySelector("#formdatos");
var formData = new FormData(form);
formData.append('factura', ofactura);
formData.append('tipo', otipo);
formData.append('nit', onit);
formData.append('cliente', ocliente);
formData.append('telefono', otelefono);
formData.append('direccion', odireccion);





   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_pedido.php',

                 method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  
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
  title: 'Datos Actualizados'
})
$("#scriptsxd").html(x);
guardar_detalleproducto();   

   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*************************************************************************************/
function guardar_detalleproducto(){




   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_detalle_pedido.php',
   type: 'POST',
   data: 'factura='+dfactura+'&codigo='+dcodigo+'&producto='+dproducto+'&precio='+dprecio+'&cantidad='+dcantidad+'&categoria='+dcategoria+'&total='+dtotal+'&existencia='+dexistencia+'&costo='+dcosto+'&presentacion='+dpresentacion+'&cantidadn='+dcantidadn+'&descuento='+campodescuento+'&unidades='+xunidades,
  success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
   const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

Toast.fire({
  icon: 'success',
  title: 'Agregado'
})  
  busca_datos_pedidos();
  
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
 
/*************************************************************************************/
function cambiar_precio(agrega){
    $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            
            var id=idcl[0];
            var codigo=idcl[1];
            var cantidad=idcl[2];
            var precio=idcl[3];
            var preciob=idcl[8];
            var costo=idcl[4];
            var factura=idcl[5];
            var total=0;
            var pprecioa=idcl[6];
            //var ddesc=idcl[7];
            //var difdescuento=ddescuento-ddesc;
           
        Swal
    .fire({
        title: "Ingresar descuento",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: costo,
             inputValidator: (value) => {
            return new Promise((resolve) => {
            //if (!value || value==0 || value>difdescuento) {
            if (!value || value==0) {
              resolve('Precio no válido')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
          if (parseFloat(resultado.value)<parseFloat(0)){
              
              Swal.fire({
  icon: 'error',
  title: 'El precio es menor que precio costo',


})
          }
          else{
           //var nuevoprecio = resultado.value;
           var nuevoprecio= $("#descuento").val();
           nuevoprecio=pprecioa*(nuevoprecio/100);
           
           //precio=precio-nuevodesc;
           precio=pprecioa-nuevoprecio;
           var nuevodesc=(preciob-precio)*cantidad;
           total=precio*cantidad;
          
                $.ajax({
      beforeSend: function(){
      },
      url: 'Modificar_precio2.php',
      type: 'POST',
      data: 'id='+id+'&precio='+precio+'&descuento='+nuevodesc+'&cantidad='+cantidad+'&costo='+costo+'&total='+total+'&factura='+factura,
      success: function(x){
       detalle_factura();    
       busca_datos_pedidos();
      },
      error: function(jqXHR,estado,error){
      }
      });  
          }
                            }
    });    
     })

         }

/*************************************************************************************/
function descuento(){
var valor=0;   
var valor2=25;   
Swal
    .fire({
        title: "Ingrese un descuento",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        //inputValue: costo,
        inputValue: valor,
             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve('Descuento no válido')
            } else {
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
          if (parseFloat(resultado.value)>parseFloat(valor2)){
              Swal.fire({
  icon: 'error',
  title: 'El descuento no es válido',
})
          }
          else{
           $("#descuento").val(resultado.value);
           if ($("#total_venta").val()>0){
    //alert ('Aplicando descuento...');    
    factura=$("#factura").val();
    $(document).ready(function(){    
    $.ajax({
      beforeSend: function(){
      },
      url: 'Historial_detalle_pedido_descuento_mostrar.php',
      type: 'POST',
      data: 'descuento='+resultado.value+'&factura='+factura,
      success: function(x){
       detalle_factura();    
       busca_datos_pedidos();
      },
      error: function(jqXHR,estado,error){
      }
      });    
    })
    }else{
    }    
          }
                            }
    });     
}
/*************************************************************************************/
function agrega_articulo(agrega){
  
   $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            
            var id=idcl[0];
            var codigo=idcl[1];
            var cantidad=idcl[2];
            var precio=idcl[3];
            var costo=idcl[4];
            var factura=idcl[5];
            cantidad=parseFloat(cantidad)+1;
            var total=cantidad*precio;
        
      
 
      $.ajax({
      beforeSend: function(){
      },
      url: 'Modificar_detalle_pedido.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+precio+'&total='+total+'&id='+id+'&codigo='+codigo+'&factura='+factura,
      success: function(x){
      $("#codigo").focus();
      detalle_factura();        
      busca_datos_pedidos();
      },
      error: function(jqXHR,estado,error){
      }
      });  
    
   
     })

         }
/*************************************************************************************/
function elimina_articulo(agrega){
  
   $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            
            var id=idcl[0];
            var codigo=idcl[1];
            var cantidad=idcl[2];
            var precio=idcl[3];
            var costo=idcl[4];
            var factura=idcl[5];
            
            cantidad=parseFloat(cantidad)-1;
            var total=cantidad*precio;
        
      
 
      $.ajax({
      beforeSend: function(){
      },
      url: 'Eliminar_detalle_pedido.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+precio+'&total='+total+'&id='+id+'&codigo='+codigo+'&factura='+factura,
      success: function(x){
      $("#codigo").focus();
      detalle_factura();    
      busca_datos_pedidos();
      },
      error: function(jqXHR,estado,error){
      }
      });  
    
   
     })

         }
/*************************************************************************************/
function elimina_producto(agrega){
     $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            
            var id=idcl[0];
            var codigo=idcl[1];
            var cantidad=idcl[2];
            var precio=idcl[3];
            var costo=idcl[4];
            var factura=idcl[5];
            
            var total=cantidad*precio;
        
      Swal.fire({
  title: 'Está seguro de eliminar?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    
    
    
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
  title: 'Eliminado'
})




  $.ajax({
      beforeSend: function(){
      },
      url: 'Eliminar_producto_pedido.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+precio+'&total='+total+'&id='+id+'&codigo='+codigo+'&factura='+factura,
      success: function(x){
      $("#codigo").focus();
      detalle_factura();   
      busca_datos_pedidos();
      },
      error: function(jqXHR,estado,error){
      }
      });  
    
  }
})
 
    
    
   
     })

         }



function buscacliente2(){
      $(document).ready(function(){
          
      var nit=$("#nit").val();
          if(nit.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          url: 'buscacliente.php',
          dataType: 'json',
          type: 'POST', 
          data: 'nit='+nit,
          success: function(data){
            if(data==0){

              
              
            }else{
                $("#nit").val(data[0].nit);
  $("#nombre").val(data[0].cliente);
  $("#contacto").val(data[0].contacto);
  $("#direccion").val(data[0].direccion);
  $("#telefono").val(data[0].telefono);
  $("#correo").val(data[0].correo);
  $("#saldolimite").val(data[0].saldo_limite);
  $("#plazo").val(data[0].plazo);
  $("#saldo").val(data[0].saldo);
 $("#nombre").focus();

                
                
                
                      }
           },
           error: function(jqXHR,estado,error){
            

              
           }
           });
          });
          }else{ 
             
          }
          })
}

var ofactura=0;
var onit='CF';
var ocliente='Consumidor Final';
var odireccion='';
var otipo='';
var ototal=0.00;
var otelefono='';
var odireccion='';
var ototal=0.00;
var odescuento=0.00;
var ddescuento=0.00;
var ddescuento2=0.00;
//   $("#nitor").val(onit);
//   $("#clienteor").val(ocliente);

//detalle factura 
var dfactura=0;
var dcodigo='';
var dproducto='';
var dcantidad=0;
var dcantidadn=0;
var dexistencia=0;
var dprecio=0.00;
var dtotal=0.00;
var dcategoria='';
var dpresentacion='';
var dcosto=0.00;
var dunidades=0.00;
var campodescuento=0.00;

var strabajo='';
var sprecio=0.00;
/*************************************************************************************/
/**************************************************************************************/  
buscacliente();
function buscacliente(){
    
        $.ajax({

        url: 'listaclientes.php',
            type: 'POST',
            data: 'cliente='+$('#nitor').val(),
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
function mostrararticulos(){
    
 
      $("#lista_articulos").css({'transform-origin': 'top', 'transform': 'scale(1)'});
    // $("#lista_articulos").show();
}
function ocultararticulos(){
    // $("#lista_articulos").hide();
    $("#lista_articulos").css({'transform-origin': 'top', 'transform': 'scale(0)'});
}
ocultararticulos();
/***************************************/
    window.addEventListener('click', function(e){ 
    if (document.getElementById('menu').contains(e.target)){ 
    // Clicked in box 
    } else{ 
    // Clicked outside the box 
    // ocultararticulos();
    $("#menu").css("transform", "scale(0)");
    
    
    } 
    });
    
window.addEventListener('click', function(e){ 
    if (document.getElementById('clientesb').contains(e.target)){ 
    // Clicked in box 
    } else{ 
    // Clicked outside the box 
    ocultarclientes();
    
    } 
    }); 
    window.addEventListener('click', function(e){ 
    if (document.getElementById('artb').contains(e.target)){ 
    // Clicked in box 
    } else{ 
    // Clicked outside the box 
ocultararticulos();
    
    
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
                 
                 

onit=idcl[1];
ocliente=idcl[0];
otelefono=idcl[3];
odireccion=idcl[2];
odescuento=idcl[4];
                
                $('#clienteor').val(ocliente);
                $('#nitor').val(onit);
                $('#telefonoor').val(otelefono);
                $('#direccionor').val(odireccion);
                
                $('#nitc').html(idcl[1]);
                $('#clientec2').html(idcl[0]);
                $('#direccionc').html(idcl[2]);
                $('#telefonoc').html(idcl[3]);
                $('#descuentoc').html(idcl[4]);
                
                $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+idcl[0]);
                $("#btn_cre").attr('disabled', false);
                // $("#clientesb").hide();
                // $("#datos_cliente").show();
                
                // guardarorden2();
                if(ofactura=="" || ofactura==0){
                    
                }else{
                guardarorden3();    
                }
                ocultarclientes();
}
/***************************************/
function editar_cliente(){
       $("#datos_cliente").hide();
      $("#clientesb").show();
         $('#buscaclientes').val("");
}
 
function calcula_descuento(){
    var descuentot=totales*($("#descuentox").val()/100);
    descuentot=totales-descuentot;
    $("#total_de_venta").val(descuentot);
    calcula_cambiox();
    
    
}
function calcula_cambiox(){
    
    if($("#paga_con").val()==0){
        $("#el_cambio").val(0);
    }else
    {
        var cambiox=$("#paga_con").val()-$("#total_de_venta").val();
    $("#el_cambio").val(cambiox);    
    }
    
    
    
    
    calcula_descuento();
    
}
/*************************************************************************************/
function guardar_venta_corte(){
//$(document).ready(function(){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Guardar_ventas_corte.php',
      type: 'POST',
      data: 'factura='+$("#factura").val()+'&efectivo='+$("#efectivo").val()+'&tarjeta='+$("#tarjeta").val()+'&credito='+$("#credito").val(),
      success: function(x){
                       
       },
      error: function(jqXHR,estado,error){
      }
      });  
//)}
}

/*************************************************************************************/
function guardar_corte(){
//window.location.href= "index.php";
var id=$("#factura").val();
guardar_venta_corte();
guardardescuento();
window.open("Impresion_pedido2.php?id="+id);   							
//location.reload();
window.location.href= "Pedidos.php";   
}
/*************************************************************************************/
function guardar_venta_corte(){
//$(document).ready(function(){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Guardar_ventas_corte.php',
      type: 'POST',
      data: 'factura='+$("#factura").val()+'&efectivo='+$("#efectivo").val()+'&credito='+$("#credito").val(),
      success: function(x){
                       
       },
      error: function(jqXHR,estado,error){
      }
      });  
//)}
}
/*************************************************************************************/
function guardardescuento(){
event.preventDefault();    
// $('#Datos_orden').modal('toggle');  
ofactura=$("#factura").val();
var descuentox=$("#descuentox").val();
var totalex2=$("#total_de_venta").val();
if ($("#credito").val()>0){
var tipox='Crédito';
}else{
var tipox='Efectivo';    
}
ocliente=$("#clienteor").val();
var form = document.querySelector("#formdatos");
var formData = new FormData(form);
formData.append('factura', ofactura);
formData.append('tipo', tipox);
formData.append('total', $("#credito").val());
formData.append('cliente', ocliente);


   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_descuento.php',
   
                 method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  
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
  title: 'Datos Actualizados'
})

   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/***************************************************************************************/
function prepara_ventax(){
  $(document).ready(function(){
   $("#modal_prepara_venta").modal({
        show:true,
        backdrop: 'static',
        keyboard: false
   });
   
   $('#modal_prepara_venta').on('shown.bs.modal', function () {
   guardar_cliente();
   $("#paga_con").select();
   $('#paga_con').focus();
   });
   $("#total_de_venta").val("Q "+ $("#total_venta").val());
   if ($("#credito").val()>0){
   }else{
   $("#efectivo").val("Q "+ $("#total_venta").val());
   }
   })
}
/***********************************************************************************/ 
function calcular_tipo_corte(){
   var m2=$("#total_venta").val();
   var m1=$("#credito").val();
   if (m1!=''){
   }else{
   m1=0.00;       
   }
   var change=parseFloat(m2)-parseFloat(m1);
   $("#efectivo").val("Q "+change.toFixed(2));
}
/**************************************************************************************/

mostrar_expo();
function mostrar_expo(){
    
    expocoti=ocliente = "<?php echo $expocoti; ?>";
    if(expocoti==0 || expocoti==""){
        
    }else
    {
    busca_datos_pedidos();    
    }
    
    
}
 
 var expocoti=0;
 
 function busca(){
  if (event.keyCode === 27) {
$("#modal_busqueda_arts").modal('hide'); //ocultar modal
}

if (event.keyCode === 38985) {

}else
{
    var artbuscar=$("#articulo_buscar").val();
     $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<center><br><img width='100px' src='dist/img/carga5.gif'></img><br>");
          },
        url: 'busca_articulos_ayuda.php',
        type: 'POST',
        data: 'producto='+encodeURIComponent(artbuscar),
        success: function(x){
         $("#lista_articulos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}

	
}

function contextmenu()
            {
                
                
             
                
             
               
                var table = document.getElementById("datax");
                  var indexf=  table.rows.length-1;  
                            if (typeof indexd !== "undefined" && indexd > indexf){
                                   for(var i = 1; i < table.rows.length; i++)
                {
                    table.rows[i].oncontextmenu = function(e)
                    {
                  
                   event.preventDefault();    
                       
                        indexd = this.rowIndex;
                  
                        this.classList.toggle("selected");
                            var dato = table.rows[indexd].children[0].innerHTML;
                // document.getElementById('cmb'+dato).focus();
                // this.agrega_a_listas(dato);
                    //  this.alert(i);
                    
                          
                  $("#menu").css({'transform-origin': 'left top', 'display':'block', 'left':e.pageX, 'top':e.pageY, 'transform': 'scale(0)'});
                  
                    setTimeout(function(){
                  $("#menu").css({'transform-origin': 'left top', 'display':'block', 'left':e.pageX, 'top':e.pageY, 'transform': 'scale(1)'});
                        }, 10);



                    };
                    
                                 table.rows[i].onclick = function(e)
                    {
                  
                   event.preventDefault();    
                       
                        indexd = this.rowIndex;
                  
                        this.classList.toggle("selected");
                            var dato = table.rows[indexd].children[0].innerHTML;
                // document.getElementById('cmb'+dato).focus();
                // this.agrega_a_listas(dato);
                    //  this.alert(i);
                    
                          
             



                    };
                    
                 
                }  
                            }
                            else
                            {
                                     for(var i = 1; i < table.rows.length; i++)
                {
                    
                    table.rows[i].oncontextmenu = function(e)
                    {
                         event.preventDefault();    
                        
                
                        if(typeof indexd !== "undefined"){
                          
                            table.rows[indexd].classList.toggle("selected",false);
                               
                        }
                       
                        indexd = this.rowIndex;
                
                        this.classList.toggle("selected");
                            var dato = table.rows[indexd].children[0].innerHTML;
                // document.getElementById('cmb'+dato).focus();
                //  ccc=document.getElementsByName(dato)[0].id;
                
                      
                  $("#menu").css({'transform-origin': 'left top', 'display':'block', 'left':e.pageX, 'top':e.pageY, 'transform': 'scale(0)'});
                  
                    setTimeout(function(){
                  $("#menu").css({'transform-origin': 'left top', 'display':'block', 'left':e.pageX, 'top':e.pageY, 'transform': 'scale(1)'});
                        }, 20);




                }
                
                
                    table.rows[i].onclick = function(e)
                    {
                         event.preventDefault();    
                        
                
                        if(typeof indexd !== "undefined"){
                          
                            table.rows[indexd].classList.toggle("selected",false);
                               
                        }
                       
                        indexd = this.rowIndex;
                
                        this.classList.toggle("selected");
                            var dato = table.rows[indexd].children[0].innerHTML;
                // document.getElementById('cmb'+dato).focus();
                //  ccc=document.getElementsByName(dato)[0].id;
                
                      
            



                }
                
                   
                            }
            }
            }
            
            
            
                $("#menu").click(function(e){
                    
                        var table = document.getElementById("datax");                            
    var rows = document.getElementById("datax").rows,
    parent = rows[indexd].parentNode;
    var dato ="";
    dato = table.rows[indexd].children[0].innerHTML;
                    
                  switch(e.target.id){

                      
                      
                        case "li-porpre":
      
 
   document.getElementsByName("desc"+dato)[0].click();
   break;      
                        case "li-pre":
      
 
   document.getElementsByName("pre"+dato)[0].click();
 
  
                        break;      
                        case "li-add":
                              document.getElementsByName("add"+dato)[0].click();
                              break;
                        case "li-quitar":
                             document.getElementsByName("quitar"+dato)[0].click();
                              break;
                                    case "li-eliminar":
                             document.getElementsByName("eliminar"+dato)[0].click();
                              break;
                  }
                   
            }); 
            
            

            $( "#articulo_buscar" ).keyup(function() {
     clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

            
                 $('#articulo_buscar').keydown(function(){
  clearTimeout(typingTimer);
            });
            

//user is "finished typing," do something
function doneTyping () {
//   busca();
 var artbuscar=$("#articulo_buscar").val();
     $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<center><br><img width='100px' src='dist/img/carga5.gif'></img><br>");
          },
        url: 'busca_articulos_ayuda.php',
        type: 'POST',
        data: 'producto='+encodeURIComponent(artbuscar),
        success: function(x){
         $("#lista_articulos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
        

var typingTimer;                
var doneTypingInterval = 500;  
var $input = $('#articulo_buscar');

       function guardacliente(){
             var nitt=$("#nitor").val();
             var facc=$("#factura").val();
             
             
             if((nitt!="") && (facc!="")){
                 guardarorden3();
             }
         }
         
        </script>


       
  </body>
</html>