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
  header ('Location: Cotizaciones.php');
  /*   echo "NO se ha encontrado la palabra deseada!!!!";*/
  } else {
   /*         echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;*/
  }
  
	 $expocoti=($_GET["id"]);
	 $prov=($_GET["proveedor"]);
// 	 echo $expocoti;
// 	 echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
	 
	 
  
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
            
            tr{cursor: pointer}
            
            .selected{background-color:#00c0ef33!important;}
            
            button{margin-top:10px;background-color: #eee;border: 2px solid #00F;
                 color: #17bb1c;font-weight: bold;font-size: 25px;cursor: pointer}
            
        </style>
    <title>Compras # <?php echo $_SESSION['sucursal']; ?></title>
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
<style type="text/css">



.contenedorimages{
    text-align: center;
}

.labelimage2{
    width: 250px;
    height: 250px;
    align-items: center;
   /* background-image:url(dist/img/clientes.jpg);*/
    border: 2px solid #07c6ff;
    display: inline-block;
    outline: none;
    line-height: 250px;
    /*padding: 0 30px;*/
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
  <!--<body onkeydown="agregaproducto();" onLoad="resumen();inicial_ventas();buscaordendetrabajo();">-->
  <body onkeydown="agregaproducto();" onLoad="resumen2();inicial_ventas2();">
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
            <small> Compras | Cajero: <?php echo $_SESSION['nombre_de_usuario']; ?> | Caja: <?php echo $_SESSION['numero_de_caja']; ?> | </small>
            <small>  <?php echo $fecha; ?></small>

          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Compras</li>
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
                  
                         <!--<div class='col-md-4'>-->
          <div class='box-body'>
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' class='btn btn-azul' onclick='busca_datos_pedidos();'><i class='fa fa-reorder'></i>  No. Factura y/o entrada&nbsp;</button>
          </div>
          <input type='text' id='factura'  value="<?php echo $expocoti ?>" class='form-control' placeholder=''  onkeypress='busx();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
          </div>
          </div>
          <!--</div>  -->
                 
                 
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
          
           
                 <div class="form-row">
    <div class="form-group col-sm-12 col-md-12">
      <label for="inputPassword4">Fecha</label>
      <input type="date" class="form-control" id='fechax' name='fechax'>
    </div>

    
  </div>
  
               
          <div class='col-md-12'>
                      <div id="clientesb" class="form-row">
                      
                                            <div class="form-group col-md-12">
                                                <label style="font-weight: bold;">Proveedor:</label>
                                             
                        <input  autocomplete = "off" onfocus="mostrarclientes();" type="text" id="buscaclientes" style="font-size:16px; text-align:center; color:blue; font-weight: bold;" onkeyup="buscacliente();" class="form-control" placeholder="Buscar proveedor">

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
                                        
              </div>
              
              <br><br>
              <div class='col-md-12' style="text-align: center;">
          <!--   
          <button class='btn  btn-azul btn-lg' data-toggle="tooltip" data-placement="top" title="Contado"onClick="abrir_datosorden();" id='btn_cre'><i class='fa fa-money'></i> Efectivo</button>
          <button disabled="true" class='btn  btn-naranja btn-lg' data-toggle="tooltip" data-placement="top" title="Crédito"onClick="busca_cliente();" id='btn_cre'><i class='fa fa-credit-card'></i> Crédito</button>
          -->
          
          <!--<button class='btn  btn-success btn-lg' data-toggle="tooltip" data-placement="top" title="Cobrar Envío" id='btn-procesa' onclick='prepara_venta();'><i class='fa fa-quora'></i> Cobrar</button>-->
          <button class='btn  btn-success btn-block' data-toggle="tooltip" data-placement="top" title="Guardar" id='btn-clientes' onclick='guardarx();'><i class='fas fa-save'></i> Guardar</button>
       <button class='btn  btn-primary btn-block' data-toggle="tooltip" data-placement="top" title="Nueva compra" id='btn-clientex' onclick='window.location.href = "Compras2.php";'><i class='fa fa-file'></i> Nueva Compra</button>
          <button class='btn  btn-warning btn-block' data-toggle="tooltip" data-placement="top" title="Nuevo Proveedor" id='btn-cliente' onclick='abrirproveedores();'><i class='fa fa-user-circle'></i> Nuevo Proveedor</button>
          
          <button class='btn  btn-danger btn-block' data-toggle="tooltip" data-placement="top" title="Inventario" id='btn-cliente' onclick='abririnventario();'><i class='fa fa-box'></i> Inventario</button>
          
           </div> 
           <br> 
           <br> 
          <br> 
          <br> 


          
          
          </div>
          </div>

      </div> <!--/.content-wrapper -->
                
                  
                  
      
      </div>


          
         
                  <small> <div class='col-md-8'>
             
            
                           
          <div class='col-md-12'>
    <!--      <div class='panel panel-danger'> -->
          <div class='input-group'>
          <div class='input-group-btn'>
          <button id="botonf9" type='button' class='btn btn-naranja' onclick='busqueda_art();'><i class='fa fa-search'></i> Buscar (F9)&nbsp;</button>
          </div>
          <input type='text' id='codigo' class='form-control' placeholder='Código' onkeypress='buscaproductoagregar();' style="font-size:16px; text-align:center; color:blue; font-weight: bold;">
          </div>
          <br>
          </div>
             <div class='table table-responsive'><div id='data'></div></div></div> </small> 
         
        </section><!-- /.content -->
         
</div><!-- /.content-wrapper -->



    <div class="modal fade" id ="Datos_orden" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog"  style="overflow: auto;height: 650px;" >
        <div class="modal-content">

   <!-- Main content -->
        <section class="content">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
          <h4 class="modal-title">Datos Cliente</h4>
          </div>
          
  
          
          

          <div class='panel panel-info'>  
          <br> 
          <small>
 <form id="formdatos"  enctype="multipart/form-data" method="post">
          
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Nit:</label>
          <div class="col-sm-4">
          <input type="text" class="form-control" onchange="buscacliente();" id='nitor' placeholder='Nit' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br> <br>     
          
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Cliente:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='clienteor' placeholder='Cliente' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br> 

          <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Telefono:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='telefonoor' placeholder='Telefono' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br> <br>      

    <div class='form-group'>
          <label for="beneficiario" class="col-sm-2 control-label">Dirección:</label>
          <div class="col-sm-10">
          <input type="text" class="form-control" id='direccionor' placeholder='Dirección' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
 
      
       
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
              <button class='btn btn-success btn-lg print_ticket' id='btn-termina' onclick='imprimir_pedido2();'><i class='fa fa-print'></i> Ticket</button>
              <button class='btn btn-success btn-lg' id='btn-termina' onclick='imprimir_pedido();'><i class='fa fa-shopping-cart'></i> Procesar</button>
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
          <input type='text' id='articulo_buscar' class='form-control' onKeyup="buscax();" placeholder='Descripcion del articulo...'>
          </div>
          </div>
          <div class="modal-body" style="width: 100%!important;height: 75%!important;">
         
          <br>
           <div class='col-md-12' style="width: 100%!important;height: 100%!important;"   ><div class='table table-responsive' style="width: 100%!important;height: 100%!important;overflow-x: hidden!important;"><div id='lista_articulos' style="width: 100%!important;height: 100%!important;overflow-x: auto;"></div></div></div>
          
          </div>
          <!--
          <div class="modal-footer" style="position: absolute;bottom: 0;right: 0;width: 100%;">
            <button type="button"  class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div> -->
          
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
busqueda_art();
}
}
/******************************************************************************************/  
    </script>
 
<script>
            
            var index;  // variable to set the selected row index
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
     //if (event.keyCode >= 48 && event.keyCode <= 90 ) {
         if ((event.keyCode >= 48 && event.keyCode <= 90) || (event.keyCode >= 96 && event.keyCode <= 105))  {
$("#articulo_buscar").val('');
$("#articulo_buscar").focus();
}
if (event.keyCode === 38) {
upNdown('up');

}
if (event.keyCode === 40) {
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
                    function agregap(){
                        var keycode = event.keyCode;


if (event.keyCode === 9) {
getSelectedRow2();
}

if (event.keyCode === 113) {
      var rows = document.getElementById("table").rows,
      parent = rows[index].parentNode;
  var dato = table.rows[index].children[0].innerHTML;
document.getElementsByName(dato)[0].click();

//$("#"+dato+"").trigger("click");
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



/*************************************************************************************/
 function agrega_a_listas(productos){
  var alimentos=productos;
  var idcl=alimentos.split("|");
  dcodigo=idcl[0];
  dproducto=idcl[1];
  dexistencia=idcl[2];
  dcosto=idcl[3];
  //dpresentacion=idcl[5];
  var cmbprecio = ($("#cmb"+dcodigo).val());
//   var idcl2=cmbprecio.split("|");
//   dprecio=idcl2[0];
//   dpresentacion=idcl2[1];
//   dunidades=idcl2[2];

  dcategoria='Repuestos';
  
  /*
   idpublica=idcl[4];
  pexistencias=idcl[4]; 
   pproducto=idcl[5];
   
            pcodigo=idcl[6];
            ppreciod=idcl[7];
            var cmbprecio = $("#cmb"+ppreciod).val();
            ppreciod=cmbprecio;
            ppresentacion=idcl[8];
            puni=idcl[9];
            psaldo=idcl[10];
            psaldolimite=idcl[11];*/
   agrega_a_lista();
  
 // $("#modal_busqueda_arts").modal('hide'); //ocultar modal
 
  //busqueda_presentacion();
     //busca_presentacion();
   //  var tipo=$("#tipo_venta").val();
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
  // busca_presentacion();
   });
}
/*************************************************************************************/
function busca_presentacion(){
  //pcodigo=$("#articulo_buscar").val();
  //alert(pcodigo);
  
  
        $.ajax({
        beforeSend: function(){
          $("#lista_presentacion").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_articulos_ayuda_presentacion.php',
        type: 'POST',
        //data: 'producto='+pcodigo+'&existencia='+pexistencias+'&nit='+$("#nitcliente").val(),
        data: 'producto='+pcodigo+'&existencia='+pexistencias,
        success: function(x){
   //      $("#lista_presentacion").html(x);
         },
        error: function(jqXHR,estado,error){
      //    $("#lista_presentacion").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*************************************************************************************/
var dmetros=0.00;
function agrega_a_lista(){
    
Swal
    .fire({
        title: "Ingrese una cantidad",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Agregar",
        cancelButtonText: "Cancelar",
        inputValue: 1,
    /*    inputValidator: nombre => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!nombre || nombre==0 || nombre.length>dexistencia) {
                return "Ingrese una cantidad";
            } else {
                return undefined;
            }
        }*/
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
            
            

            
        dprecio=dcosto;
        
        dmetros=1;
              dcantidad = resultado.value;
            dcantidadn=dmetros*dcantidad;
            
        
            dfactura=ofactura;
            dtotal=(dcantidad*dmetros)*dprecio;
            guardarorden();
        

            
                    
                   

       
            
            
      
    
    
    
    
    
        
        }
    });
    

  }
  /*************************************************************************************/
function agrega_a_lista2(){

Swal
    .fire({
        title: "Ingrese una cantidad",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Agregar",
        cancelButtonText: "Cancelar",
        inputValue: 1,
    /*    inputValidator: nombre => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!nombre || nombre==0 || nombre.length>dexistencia) {
                return "Ingrese una cantidad";
            } else {
                return undefined;
            }
        }*/
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
            
            
            
            
            Swal
    .fire({
        title: "Ingrese cantidad de metros",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Agregar",
        cancelButtonText: "Cancelar",
        inputValue: 1,
    /*    inputValidator: nombre => {
            // Si el valor es válido, debes regresar undefined. Si no, una cadena
            if (!nombre || nombre==0 || nombre.length>dexistencia) {
                return "Ingrese una cantidad";
            } else {
                return undefined;
            }
        }*/
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
    .then(resultado2 => {
        if (resultado2.value) {
            
            dmetros=resultado2.value;
              dcantidad = resultado.value;
            dcantidadn=dmetros*dcantidad;
            
               if (parseFloat(dcantidadn)<=parseFloat(dexistencia)) {
                  
            dfactura=ofactura;
            dtotal=(dcantidad*dmetros)*dprecio;
            guardarorden2();
            // guardar_detalleproducto2();   
                   
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
    });
    

// Swal
//     .fire({
//         title: "Ingrese una cantidad",
//         input: "text",
//         showCancelButton: true,
//         confirmButtonText: "Ok",
//         cancelButtonText: "Cancelar",
//         inputValue: 1,
//     /*    inputValidator: nombre => {
//             // Si el valor es válido, debes regresar undefined. Si no, una cadena
//             if (!nombre || nombre==0 || nombre.length>dexistencia) {
//                 return "Ingrese una cantidad";
//             } else {
//                 return undefined;
//             }
//         }*/
//              inputValidator: (value) => {
//             return new Promise((resolve) => {
//             if (!value || value==0) {
//               resolve('Ingrese una cantidad válida')
//             } else {
                
//                   resolve();
//             }
//             });
//         }
//     })
//     .then(resultado => {
//         if (resultado.value) {
            
//              dcantidad = resultado.value;
//             dcantidadn=dunidades*dcantidad;
            
//               if (parseFloat(dcantidadn)<=parseFloat(dexistencia)) {
                  
//             dfactura=ofactura;
//             dtotal=dcantidad*dprecio;
//             guardarorden2();
//             guardar_detalleproducto2();   
                   
//               }
             
//                     else
//                     {
//                         Swal.fire({
//   icon: 'error',
//   title: 'Pocas existencias'
//   })
//                     }
//         }
//     });
    

  }
/*************************************************************************************/
function busqueda_art(){
//var tipo=$("#tipo_venta").val();
//alert (tipo);
// if (ofactura!=0){
   $("#modal_busqueda_arts").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_arts').on('shown.bs.modal', function () {
   $("#lista_articulos").html("");
   $("#articulo_buscar").val("");
   $("#articulo_buscar").focus();
   buscaprod2();
   });
// }else{  
// Swal.fire({
//   icon: 'error',
//     title: 'No ha ingresado datos de orden de trabajo'
  
// })

// abrir_datosorden();
// }   

}
/*************************************************************************************/
  function guardar_producto(){
  //busca_datos_pedidos();  
  //if ($("#factura").val()!=''){  
  var tipodoc=document.title;  
  
  //$(document).ready(function(){
      var total=pcantidad*ppreciod;
      totalesmonto=parseFloat($("#total_venta").val())+parseFloat(total);
      $("#total_venta").val(totalesmonto);
      $("#totales").html('Q' + totalesmonto.toFixed(2));
      if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3' || tipodoc=='Bajas # 1' || tipodoc=='Bajas # 2' || tipodoc=='Bajas # 3' || tipodoc=='Altas # 1' || tipodoc=='Altas # 2' || tipodoc=='Altas # 3'){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Guardar_detalle_factura.php',
      type: 'POST',
      data: 'cantidad='+pcantidad+'&producto='+pproducto+'&precio='+ppreciod+'&total='+total+'&totales='+totalesmonto+'&codigo='+pcodigo+'&factura='+$("#factura").val()+'&cliente='+$            ("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+pdireccion+'&tipo='+ptipo+'&presentacion='+ppresentacion+'&uni='+puni+'&tipodoc='+tipodoc,
      success: function(x){
      $("#codigo").val('');  
      $("#codigo").focus();
      
      detalle_factura();                       
       },
      error: function(jqXHR,estado,error){
      }
      });  
    }else{
    $.ajax({
      beforeSend: function(){
      },
      url: 'Guardar_detalle_cotizacion.php',
      type: 'POST',
      data: 'cantidad='+pcantidad+'&producto='+pproducto+'&precio='+ppreciod+'&total='+total+'&totales='+totalesmonto+'&codigo='+pcodigo+'&factura='+$("#factura").val()+'&cliente='+$("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+pdireccion+'&tipo='+ptipo+'&presentacion='+ppresentacion+'&uni='+puni,
      success: function(x){
      $("#codigo").val('');  
      $("#codigo").focus();
      detalle_factura();   
      busca_datos_pedidos(); 
      //busca_datos_pedidos();  
       },
      error: function(jqXHR,estado,error){
      }
      });   
    }
  //  })  
//}else{
  //correlativo();
//}
}
/*************************************************************************************/
 function busca_datos_pedidos(){
  var tipodoc=document.title;  
 //$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({


          url: 'busca_data_compras.php',
          dataType: 'json',
          type: 'POST',
          data: 'factura='+$("#factura").val()+'&tipodoc='+otipo+'&proveedor='+ocliente,
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
  title: 'No. Factura no existe'
})
            }else{
            $(".widget-user-desc").html(data[0].factura);
            $("#totales").html("Q."+data[0].total);
            ofactura=data[0].Factura;
            
            
            onit=data[0].Nit;;
            ocliente=data[0].Proveedor;
            otelefono="";
            odireccion=data[0].Direccion;
            
            



            $("#nitor").val(onit);
            $("#clienteor").val(ocliente);
            $("#telefonoor").val("");
            $("#direccionor").val(odireccion);
            
            $("#fechax").val(data[0].Fecha);


            
            
            
            var vertipo=data[0].tipo;
            var vercliente=data[0].Proveedor;
            
            
         
            $("#tipo_de_venta").html
            ("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+" "+vertipo+" a "+vercliente);
            detalle_factura();
            if(data[0].total>0){
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

        url: 'Historial_detalle_comprasx_mostrar.php',
            type: 'POST',
            data: 'factura='+$('#factura').val()+'&proveedor='+ocliente,
            success: function(x){
            $("#data").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });     
  
}
/*************************************************************************************/
buscaprod2();
function buscaprod2(){
	var artbuscar=$("#articulo_buscar").val();
     $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_articulos_ayuda_compras.php',
        type: 'POST',
        data: 'producto='+artbuscar+'&proveedor='+ocliente,
        success: function(x){
         $("#lista_articulos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*************************************************************************************/
function abrir_datoscliente(){
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
function nuevocliente(){
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
   $("#nit").focus();
}
function nuevodatosorden(){
   $("#id").val("");
   $("#nit").focus();
}
/*************************************************************************************/
function abrir_datosorden(){
   $("#Datos_orden").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_orden').on('shown.bs.modal', function () {
   $("#nitor").focus();
   
   //$("#buscar_cliente2").focus();
   });
}
/*************************************************************************************/
function muestraxd(){
 //   var dato = document.getElementsByName("tiposervicio")[0].value;
   alert($('input:radio[name=tiposervicio]:checked').val());
}
/*************************************************************************************/
function buscaordendetrabajo(){

         $(document).ready(function(){
          $.ajax({
          url: 'buscapedido.php',
          dataType: 'json',
          type: 'POST', 
          data: null,
          success: function(data){
            if(data==0){
            valor=10001;
                    $("#factura").val(valor);
                  ofactura=valor;
   
            }else{
                var valor=0;
                
               
                    valor=parseFloat(data[0].Factura)+1;
                  $("#factura").val(valor);
                  ofactura=valor;  
              
                  
                
                  
          
                
                      }
           },
           error: function(jqXHR,estado,error){
            
           }
           });
          });
        
        
}

/*************************************************************************************/
function guardarorden(){
event.preventDefault();    
// $('#Datos_orden').modal('toggle');  

ofactura=$('#factura').val();
var fechax=$('#fechax').val();
dfactura=$('#factura').val();
var form = document.querySelector("#formdatos");
var formData = new FormData(form);
formData.append('factura', ofactura);
formData.append('tipo', otipo);
formData.append('nit', onit);
formData.append('cliente', ocliente);
formData.append('telefono', otelefono);
formData.append('direccion', odireccion);
formData.append('fecha', fechax);


if($("#factura").val()=="" || ocliente==""){
   
           Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'No se ha ingresado número de factura o no se ha seleccionado proveedor'
  
}) 
    
   

}else
{
       $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_compra.php',
   //type: 'POST',
                 method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  // data: 'factura='+ofactura+'&nit='+onit+'&cliente='+ocliente+'&telefono='+otelefono+'&tipo='+otipo+'&comentario='+ocomentario+'&tiposervicio='+otiposervicio+'&ano='+oano+'&placa='+oplaca+'&nomotor='+onomotor+'&cc='+occ+'&estilo='+oestilo+'&color='+ocolor+'&kilometraje='+okilometraje+'&nochasis='+onochasis+'&fechaprometida='+ofechaprometida+'&total='+ototal+'&direccion='+odireccion,
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
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



 }
/*************************************************************************************/
function guardar_detalleproducto(){
$('#modal_busqueda_arts').modal('toggle');  

dproducto=dproducto;

   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_detalle_comprasx.php',
   type: 'POST',
   data: 'factura='+ofactura+'&codigo='+dcodigo+'&producto='+dproducto+'&precio='+dprecio+'&cantidad='+dcantidad+'&categoria='+dcategoria+'&total='+dtotal+'&existencia='+dexistencia+'&costo='+dcosto+'&presentacion='+dpresentacion+'&cantidadn='+dcantidadn+'&metros='+dmetros+'&unidades='+dunidades+'&proveedor='+ocliente,
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
  //detalle_factura();
//   guardarorden2();
  busca_datos_pedidos();
  
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
 /*************************************************************************************/
function guardar_detalleproducto2(){


dproducto=dproducto;

   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_detalle_pedido.php',
   type: 'POST',
   data: 'factura='+dfactura+'&codigo='+dcodigo+'&producto='+dproducto+'&precio='+dprecio+'&cantidad='+dcantidad+'&categoria='+dcategoria+'&total='+dtotal+'&existencia='+dexistencia+'&costo='+dcosto+'&presentacion='+dpresentacion+'&cantidadn='+dcantidadn+'&metros='+dmetros+'&unidades='+dunidades,
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
  //detalle_factura();
//   guardarorden2();
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
            var costo=idcl[4];
            var factura=idcl[5];
            var total=0;
            
           
            
            
            
        Swal
    .fire({
        title: "Ingrese un precio",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: costo,
             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0 ) {
              resolve('Precio no válido')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
          if (parseFloat(resultado.value)<parseFloat(costo)){
              
              Swal.fire({
  icon: 'error',
  title: 'El precio es menor que precio costo',


})
          }
          else{
                      var nuevoprecio = resultado.value;
           total=nuevoprecio*cantidad;
          
                $.ajax({
      beforeSend: function(){
      },
      url: 'Modificar_precio2.php',
      type: 'POST',
      data: 'id='+id+'&precio='+precio+'&nuevoprecio='+nuevoprecio+'&cantidad='+cantidad+'&costo='+costo+'&total='+total+'&factura='+factura,
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
            var metros=idcl[6];
            cantidad=(parseFloat(cantidad))+1;
            var total=(cantidad*metros)*precio;
        
      
 
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
            var metros=idcl[6];
            
            cantidad=parseFloat(cantidad)-1;
            var total=(cantidad*metros)*precio;
        
      
 
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
            var metros=idcl[6];
            
            var total=(cantidad*metros)*precio;
        
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
      url: 'Eliminar_producto_compras.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+precio+'&total='+total+'&id='+id+'&codigo='+codigo+'&factura='+factura+'&metros='+metros,
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
/*************************************************************************************/

/*************************************************************************************/
/*************************************************************************************/

/*************************************************************************************/

/*************************************************************************************/

/*************************************************************************************/
function buscacliente(){
      $(document).ready(function(){
          
      var nit=$("#nitor").val();
          if(nit.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          url: 'buscaproveedor.php',
          dataType: 'json',
          type: 'POST', 
          data: 'nit='+nit,
          success: function(data){
            if(data==0){

/*
$("#codigop").val('');
$("#producto").val('');
$("#proveedor").val('');
$("#marca").val('');
$("#presentacionp").val('');
$("#aplicacion").val('');
$("#costo").val('');
$("#inversion").val('');
$("#minima").val('');
$("#maxima").val('');
$("#existencia").val('');
$("#producto").focus();
*/

       $("#clienteor").focus();        
              
            }else{
                $("#nitor").val(data[0].nit);
  $("#clienteor").val(data[0].proveedor);
  $("#telefonoor").val(data[0].telefono);
  $("#direccionor").val(data[0].direccion);
 $("#fechaproor").focus();

                
                
                
                      }
           },
           error: function(jqXHR,estado,error){
            

              
           }
           });
          });
          }else{ 
                $("#clienteor").val("");
                $("#fechaproor").focus();
          }
          })
}


function buscacliente2(){
      $(document).ready(function(){
          
      var nit=$("#nit").val();
          if(nit.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          url: 'buscaproveedor.php',
          dataType: 'json',
          type: 'POST', 
          data: 'nit='+nit,
          success: function(data){
            if(data==0){

/*
$("#codigop").val('');
$("#producto").val('');
$("#proveedor").val('');
$("#marca").val('');
$("#presentacionp").val('');
$("#aplicacion").val('');
$("#costo").val('');
$("#inversion").val('');
$("#minima").val('');
$("#maxima").val('');
$("#existencia").val('');
$("#producto").focus();
*/

              
              
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
/*************************************************************************************/
function imprimir_pedido(){
//window.location.href= "index.php";   

location.reload();
}
/*************************************************************************************/
function guardarorden2(){
 
/*ofactura=$("#factura").val();
otipo='Efectivo';
onit=$("#nitor").val();
ocliente=$("#clienteor").val();
otelefono=$("#telefonoor").val();
odireccion=$("#direccionor").val();*/

ofactura=$("#factura").val();
otipo='Efectivo';



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
   //type: 'POST',
                 method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  // data: 'factura='+ofactura+'&nit='+onit+'&cliente='+ocliente+'&telefono='+otelefono+'&tipo='+otipo+'&comentario='+ocomentario+'&tiposervicio='+otiposervicio+'&ano='+oano+'&placa='+oplaca+'&nomotor='+onomotor+'&cc='+occ+'&estilo='+oestilo+'&color='+ocolor+'&kilometraje='+okilometraje+'&nochasis='+onochasis+'&fechaprometida='+ofechaprometida+'&total='+ototal+'&direccion='+odireccion,
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
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

   //busca();
    //busca_datos_pedidos();
    $("#scriptsxd").html(x);
    guardar_detalleproducto2();   
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*************************************************************************************/
/*************************************************************************************/
/*************************************************************************************/
var tipodocumento="";


//factura//
var ofactura=0;
var onit='CF';
var ocliente='';
var odireccion='';
var otipo='';
var ototal=0.00;
var otelefono='';
var odireccion='';
var ototal=0.00;
  $("#nitor").val(onit);
  $("#clienteor").val(ocliente);

//detalle factura repuestos
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

var strabajo='';
var sprecio=0.00;
/*************************************************************************************/
/**************************************************************************************/  
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
                 
                 
                
                 
                 onit=idcl[1];
                 ocliente=idcl[0];
                 otelefono=idcl[3];
                 odireccion=idcl[2];
                 pdireccion=odireccion;
                 ptipo='Efectivo';
                 $("#tipo_venta").val("2");
                 
                  $("#idcliente_credito").val(ocliente);
                 $("#nitcliente").val(onit);
                 


                 
                $('#nitc').html(onit);
                $('#clientec2').html(ocliente);
                $('#direccionc').html(odireccion);
                $('#telefonoc').html(otelefono);
                
                $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+ocliente);
                $("#btn_cre").attr('disabled', false);
                $("#clientesb").hide();
                $("#datos_cliente").show();
                
                
                if(ofactura=="" || ofactura==0){
                    
                }else{
                guardarorden3();    
                }
                busca_datos_pedidos();
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
/***************************************************************/
function buscaproductoagregar(){
    
   var keycode = event.keyCode;    
if (event.keyCode == 13) { //112 f1


      $(document).ready(function(){
      var codigoalterno=$("#codigo").val();
          if(codigoalterno.trim()!=""){
         $(document).ready(function(){
          $.ajax({
     //     beforeSend: function(){
           // $("#data_articulo").html("Buscando información del cliente...");
       //    },
          url: 'buscaagregarpedido.php',
          dataType: 'json',
          type: 'POST', 
          data: 'codigoalterno='+codigoalterno,
          success: function(data){
            if(data==0){


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
  icon: 'info',
  title: 'El producto no existe...!'
})
              
              
              
              
              
            }else{
 dcodigo=data[0].codigo_alterno;
dproducto=data[0].producto;
dcosto=data[0].preciocosto;
dexistencia=data[0].existencia;

busca_precios_modal();

Swal.fire({
  title: 'Seleccione Precio',
  html:
    '<br><div style="font-size: 22px;font-weight: bold;    color: blue;">'+dproducto+'</div> <br>'+
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
      
      var cmbprecio = ($("#cmb"+dcodigo+"2").val());
  var idcl2=cmbprecio.split("|");
  dprecio=idcl2[0];
  dpresentacion=idcl2[1];
  dunidades=idcl2[2];

  dcategoria='Repuestos';
  
   agrega_a_lista2();
    
  } 
})










                      }
           },
           error: function(jqXHR,estado,error){
            
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
  icon: 'error',
  title: 'Parece ser que hay un error, por favor, reportalo a Soporte inmediatamente...!'
})
              
           }
           });
          });
          }else{ 
          }
          })
}
}
/*************************************************************************************/
function guardarorden3(){
 
/*ofactura=$("#factura").val();
otipo='Efectivo';
onit=$("#nitor").val();
ocliente=$("#clienteor").val();
otelefono=$("#telefonoor").val();
odireccion=$("#direccionor").val();*/

ofactura=$("#factura").val();
otipo='Efectivo';



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
   //type: 'POST',
                 method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  // data: 'factura='+ofactura+'&nit='+onit+'&cliente='+ocliente+'&telefono='+otelefono+'&tipo='+otipo+'&comentario='+ocomentario+'&tiposervicio='+otiposervicio+'&ano='+oano+'&placa='+oplaca+'&nomotor='+onomotor+'&cc='+occ+'&estilo='+oestilo+'&color='+ocolor+'&kilometraje='+okilometraje+'&nochasis='+onochasis+'&fechaprometida='+ofechaprometida+'&total='+ototal+'&direccion='+odireccion,
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
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

   //busca();
    //busca_datos_pedidos();
    $("#scriptsxd").html(x);
    // guardar_detalleproducto2();  
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*********************************************************/
function busca_precios_modal(){
	
     $.ajax({
 
        url: 'precios_pedidos.php',
        type: 'POST',
        data: "codigo="+dcodigo,
        success: function(x){
         $("#precios").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#precios").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
mostrar_expo();
function mostrar_expo(){
    
    ocliente = "<?php echo $prov; ?>";
    
    var cc=$("#factura").val();
    if(cc==0 || cc==""){
        
    }else
    {
    busca_datos_pedidos();    
    }
    
    
}
 
 var expocoti=0;
 
 function buscax(){
  if (event.keyCode === 27) {
$("#modal_busqueda_arts").modal('hide'); //ocultar modal
}
	var artbuscar=$("#articulo_buscar").val();
     $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_articulos_ayuda_compras.php',
        type: 'POST',
        data: 'producto='+artbuscar+'&proveedor='+ocliente,
        success: function(x){
         $("#lista_articulos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}

function abrirproveedores(){
    window.open('https://seyscom.net/Bruder-Bernal/Proveedores.php', '_blank');
}

function abririnventario(){
    window.open('https://seyscom.net/Bruder-Bernal/Inventario.php', '_blank');
}


function inicial_ventas2(){
                 //var client=elid;
                 //var idcl=client.split("|");
                 $("#idcliente_credito").val("");
                 $("#nitcliente").val("C/F");
                 pdireccion="Ciudad";
                 ptipo='Efectivo';
                 $("#tipo_venta").val("Contado");
                 $("#modal_tabla_clientes").modal('hide');
                 $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+$("#idcliente_credito").val());
                 $("#btn_cre").attr('disabled', false);
                 //window.alert(client);
               }
               function resumen2(){
  $(document).ready(function(){
            var articulos=0.00;
            var monto=0.00;
            $('#tabla_articulos > tbody > tr').each(function(){
            articulos +=parseFloat($(this).find("td").eq(2).html());
            monto+=parseFloat($(this).find('td').eq(4).html());
            });
           // $("#total_articulos").html("Total de Articulos: "+articulos.toFixed(2));
            $("#total_venta").val(monto.toFixed(2));
            $("#totales").html('Q ' + monto.toFixed(2));
            
            if($("#totales").val()>0){
              $("#btn-procesa").prop('disabled', false);
              $("#btn-cancela").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
              $("#btn-cancela").prop('disabled', true);
            }
            })
          }
          
          
          function busx(){

var keycode = event.keyCode;    
if (event.keyCode == 13) { //112 f1
busca_datos_pedidos();
}

}

function guardarx(){
    
    Swal.fire({
  title: 'Guardar',
  text: "¿Desea guardar los cambios?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, guardar',
  cancelButtonText: 'Cancelar'
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = "Compras2.php";    
  }
})


}

        </script>


       
  </body>
</html>