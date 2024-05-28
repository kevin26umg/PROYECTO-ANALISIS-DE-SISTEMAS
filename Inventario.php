 
<!DOCTYPE html>

<html>
  <head>
      
<?php include "./class_lib/sesionSecurity.php"; ?>
 
 <?php
  require('class_lib/funciones.php');


    
?>
    <title>Inventario # <?php echo $_SESSION['sucursal']; ?></title>
<?php include "./class_lib/links.php"; ?>

 

<style type="text/css">

#data{
    background:white!important;
}
.tableFixHead thead th {
    position: sticky;
    top: -1px;
    text-align: center;
}

.modal-content {
    border-radius: 8px!important;

}
.contenedorimages{
    text-align: center;
}

.labelimage2{
    width: 250px;
    height: 250px;
    align-items: center;
   /* background-image:url(dist/img/clientes.jpg);*/
    border: 2px solid #ffc107;
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
    border: 2px solid #ffc107;
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

              <style>
            
            tr{cursor: pointer}
            
            /*.selected{background-color:#00c0ef33!important;}*/
            
           /* button{margin-top:10px;background-color: #eee;border: 2px solid #00F;
                 color: #17bb1c;font-weight: bold;font-size: 25px;cursor: pointer}*/
            
        </style>
  </head>
  <body   onLoad="busca();" >
  
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
        <!--<section class="content-header">-->

        <!--  <ol class="breadcrumb">-->
        <!--    <li><a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a></li>-->
        <!--    <li class="active">Inventario</li>-->
        <!--  </ol>-->
        <!--</section><!-- Main content -->
        <section class="content" onkeydown="agregap();newp();">

          <!-- Your Page Content Here -->
   
      <div class='row'>

        
          <div class='col-md-12'>
    <!--      <div class='panel panel-danger'> -->
          <div class='box-body'>
              
          <div class='input-group'>
          <div class='input-group-btn'>
          <button type='button' onclick="abrir_modal_datos_inventario();nuevoprod();" class='btn btn-azul'></i> Nuevo (1)&nbsp;</button>
          </div>
          <input type='text' id='codigo' class='form-control input-lg' placeholder='Buscar'  onkeydown='buscaxx();' style="font-size:25px; text-align:center; color:blue; font-weight: bold;">
          <div class='input-group-btn'>
          <button type='button' class='btn btn-naranja' onclick='busca_negativos();'><i class='fa fa-search'></i> Buscar Negativos&nbsp;</button>
          </div>
          </div>
          </div>
  <!--        </div>  -->
          </div>

         <div class='col-md-12' style="width: 100%!important;height: 700px!important;"   ><div id='data' class="tableFixHead" style="width: 100%!important;height: 100%!important;overflow-x: auto;"></div></div>
                     
        </section><!-- /.content -->
         
</div><!-- /.content-wrapper -->

         



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
          <input type='text' id='articulo_buscar' class='form-control' onKeyUp="busca_inventario_compras();" placeholder='Descripcion del articulo...'>
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
      <div id="dialog-inventario" class="modal-dialog" style="overflow-x:auto!important;">
        <div class="modal-content" style="width: 100%!important;height: 100%!important;overflow-x:auto!important;margin:auto!important;">





   <!-- Main content -->
        <section class="content" style="width: 100%!important;height: 100%!important;overflow-x:auto!important;margin:auto!important;">
          <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" $("#articulo_buscar").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Datos de Inventario...</h4>
          </div>
     


<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Datos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Imagenes</a>
  </li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" style="width: 100%;" id="home">
      
             
          <small>
                <br>
   
                   <form id="formdatos"  enctype="multipart/form-data" method="post">
                       
                       
                         <div class="form-row">
    <div class="form-group col-sm-4 col-md-3">
      <label for="inputEmail4">#</label>
      <input type="text" class="form-control" id='codigop' name='codigop' placeholder="#" disabled>
    </div>
    <div class="form-group col-sm-4 col-md-3">
      <label for="inputPassword4">Código</label>
      <input type="text" class="form-control" name='codigobarra' id='codigobarra' placeholder="Código">
    </div>
    
        <div class="form-group col-sm-4 col-md-3">
      <label for="inputPassword4">Nueva categoría</label>
      <input type="text" class="form-control" name='categoriaxd' id='categoriaxd' placeholder="Nueva categoría">
    </div>
    
    
    <div class="form-group col-sm-4 col-md-3">
      <label for="inputEmail4">Categoría</label>
             <select type="text" class="form-control" id='categoria' name="categoria" data-inputmask="'placeholder': '0'">
              <!--<option disabled selected value="">Seleccione una categoría</option>-->
              <!--<option value="1">Bodega 1</option>-->
              <!--<option value="2">Bodega 2</option>-->
           
              </select>
    </div>
  </div>
  
                           <div class="form-row">
    <div class="form-group col-sm-12 col-md-12">
      <label for="inputEmail4">Producto</label>
      <input type="text" class="form-control" name='producto'id='producto' placeholder='Producto'>
    </div>
    
        
   
    
    <!--<div class="form-group col-sm-12 col-md-4">-->
    <!--  <label for="inputPassword4">Proveedor</label>-->
    <!--  <input type="text" class="form-control" id='proveedor' name='proveedor' placeholder='Proveedor'>-->
    <!--</div>-->
  </div>
  
  
   <div class="form-group col-sm-12 col-md-6">
      <label for="inputEmail4">Proveedor</label>
             <select type="text" class="form-control" id='proveedor' name="proveedor" data-inputmask="'placeholder': '0'">
    
              </select>
    </div>
    
                            <div class="form-row">
    <div class="form-group col-sm-6 col-md-6">
      <label for="inputEmail4">Marca</label>
      <input type="text" class="form-control" id='marca'  name='marca' placeholder='Marca' >
    </div>
    <!--<div class="form-group col-sm-6 col-md-6">-->
    <!--  <label for="inputPassword4">Vencimiento</label>-->
    <!--  <input type="date" class="form-control" id='presentacionp' name='presentacionp' placeholder='Presentación'>-->
    <!--</div>-->
  </div>
  
                       <div class="form-row">
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputEmail4">Existencia</label>
      <input type="number" class="form-control" id='existencia' name='existencia'  placeholder='Existencia'>
    </div>
    
    
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Mínima</label>
      <input type="number" class="form-control" id='minima' name='minima' placeholder='Mínima' >
    </div>
    
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Máxima</label>
      <input type="number" class="form-control" id='maxima' name='maxima' placeholder='Máxima'>
    </div>
    
 
    
  </div>
  
 <br> <center><h3><b>Precios</b></h3></center>
  
  
    
    
    
        <div class="form-group col-sm-6 col-md-4" style="    opacity: 0;">
      <label for="inputPassword4">Precio costo</label>
      <input type="number" class="form-control" id='preciocostoxx' name='preciocostoxx' placeholder='Precio costo' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Precio costo'">
    </div>
    
    
       <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Precio costo</label>
      <input type="number" class="form-control" id='preciocosto' name='preciocosto' placeholder='Precio costo' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    
    
        <div class="form-group col-sm-6 col-md-4"  style="    opacity: 0;">
      <label for="inputPassword4">Precio costo</label>
      <input type="number" class="form-control" id='preciocostoxxxxxxx' name='preciocosxxxxxxto' placeholder='Precio costo' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    
    
                    <div class="form-row">
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Precio 1</label>
      <input type="number" class="form-control" id='precioa' name='precioa' placeholder='Q0.00'  onkeyup="" onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Precio 2</label>
      <input type="number" class="form-control" id='preciob' name='preciob' placeholder='Q0.00' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Precio 3</label>
      <input type="number" class="form-control" id='precioc' name='precioc' placeholder='Q0.00' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    
    
  </div>
  
                <div class="form-row">
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Docena</label>
      <input type="number" class="form-control" id='preciod' name='preciod' placeholder='Q0.00'  onkeyup="" onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Fardo</label>
      <input type="number" class="form-control" id='precioe' name='precioe' placeholder='Q0.00' onfocus="this.placeholder = 'Q0.00'" onblur="this.placeholder = 'Q0.00'">
    </div>
    <div class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Unidades x Fardo</label>
      <input type="number" class="form-control" id='upe' name='upe' placeholder='0.00' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = '0.00'">
    </div>
      </div>
  
  
  
  
  
  
  
                    <div class="form-row">

  
    
    <div hidden class="form-group col-sm-6 col-md-4">
      <label for="inputPassword4">Descuento</label>
      <input type="number" class="form-control" id='descuento' name='descuento' placeholder='Descuento' onfocus="this.placeholder = '0.00%'" onblur="this.placeholder = 'Descuento'" readonly>
    </div>
    

    
  </div>
  
  
  
<!--<div class='form-group' style="padding:4px;">-->
<!--          <label for="beneficiario" class="col-sm-2 control-label">Código:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input type="text" class="form-control" id='codigop' name='codigop' placeholder='Código' disabled='true'-->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
<!--          <label for="beneficiario" class="col-sm-2 control-label">C. Barra:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input  onchange="" type="text" class="form-control" name='codigobarra' id='codigobarra' placeholder='Código de Barra'-->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
      
<!--          </div>-->
<!--          <br>-->

<!-- <div class="form-row" style="padding:4px;">-->
     
<!--         <div class='form-group' >-->
<!--                      <label for="beneficiario" class="col-sm-2 control-label">Producto:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input type="text" class="form-control" name='producto'id='producto' placeholder='Producto' -->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>   -->
             
             
     
          

          
<!--          </div>-->
<!--<br>       -->
<!--     </div>-->
<!--          <div class='form-group'style="padding:4px;">-->
              
<!--                   <label for="beneficiario" class="col-sm-2 control-label">Proveedor:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input type="text" class="form-control" id='proveedor' name='proveedor' placeholder='Proveedor' -->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
                        
<!--           <label for="beneficiario" class="col-sm-2 control-label">Marca:</label>-->
<!--          <div class="col-sm-4">-->
<!--          <input type="text" class="form-control" id='marca'  name='marca' placeholder='Marca' -->
<!--          data-inputmask="'placeholder': '0'">-->
<!--          </div>-->
          
         
          

<!--          </div>-->
<!--<br> -->

          <!--<div class='form-group'style="padding:4px;">-->
              
          <!--     <label for="beneficiario" class="col-sm-2 control-label">Presentación:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" class="form-control" id='presentacionp' name='presentacionp' placeholder='Presentación' -->
          <!--data-inputmask="'placeholder': '0'">-->
          <!--</div>-->
          
              
          <!--              <label for="beneficiario" class="col-sm-2 control-label">Estantería:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" class="form-control" id='estanteria' name='estanteria' placeholder='Estantería' -->
          <!--data-inputmask="'placeholder': '0'">-->
          <!--</div>-->
         
          
          <!--</div>-->
          
          <!--   <br>-->
          <!--          <div class='form-group'style="padding:4px;">-->
              
          <!--     <label for="beneficiario" class="col-sm-2 control-label">Miníma:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" class="form-control" id='minima' name='minima' placeholder='Mínima' -->
          <!--data-inputmask="'placeholder': '0'">-->
          <!--</div>-->
          
                      
          <!--     <label for="beneficiario" class="col-sm-2 control-label">Máxima:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" class="form-control" id='maxima' name='maxima' placeholder='Máxima' -->
          <!--data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'">-->
          <!--</div>-->
          
     
        
          <!--          </div>-->
          
          <!--   <br>-->
          
          <!-- <div class='form-group'style="padding:4px;">-->
               
               
          <!--       <label for="beneficiario" class="col-sm-2 control-label">Existencia:</label>-->
          <!--<div class="col-sm-4">-->
            
          <!--<input type="text" class="form-control cantidades"  onkeyup="calcula();" id='existencia' name='existencia'  placeholder='Existencia' disabled>-->
          <!--</div>-->
          
               
          <!--  <label for="beneficiario" class="col-sm-2 control-label">Precio costo:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" onkeyup="" class="form-control cantidades" id='precioa' name='precioa' placeholder='Precio A' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Precio A'">-->
          <!--</div>-->
          
          
          <!--               </div>-->
          <!--       <br>-->
                 
                 
                 
                 
              <div class='form-group'style="padding:4px;display:none;">
          
          <!--    <label for="beneficiario" class="col-sm-2 control-label">Precio Público:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<input type="text" onkeyup="" class="form-control cantidades" id='preciob' name='preciob' placeholder='Precio B' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Precio B'">-->
          <!--</div>-->
          
                    
            <label for="beneficiario" class="col-sm-2 control-label">Porcentaje:</label>
          <div class="col-sm-4">
          <input type="text" onkeyup="calcula();" class="form-control cantidades" id='preciocx' name='precioxc' placeholder='Precio C' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Precio C'">
          </div>
          
          
               </div>
               <!--<br> -->
               
            <div class='form-group'style="padding:4px;display:none;">
          
         
                    
            <label for="beneficiario" class="col-sm-2 control-label">Descuento %:</label>
          <div class="col-sm-4">
          <input type="text" onkeyup="calcula();" class="form-control cantidades" id='descuentox' name='descuentox' placeholder='Descuento %' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Precio C'">
          </div>
                        
          <!--<label for="beneficiario" class="col-sm-2 control-label">Bodega:</label>-->
          <!--<div class="col-sm-4">-->
          <!--<select type="text" class="form-control" id='bodega' name="bodega" data-inputmask="'placeholder': '0'">-->
          <!--    <option disabled selected value="">Seleccione una bodega</option>-->
          <!--    <option value="1">Bodega 1</option>-->
          <!--    <option value="2">Bodega 2</option>-->
           
          <!--    </select>-->
          <!--</div>-->
        
          
               </div>     
           
    
          
                 
                 
              
                 
                 
                 
                 <br> 
          
           
        <div class="mt-10">
       <input onchange="cambioimg(this.id);"type="file" id="image1" name="image1" style='display: none;'>
       <input onchange="cambioimg(this.id);"type="file" id="image2" name="image2" style='display: none;'>
       <input onchange="cambioimg(this.id);"type="file" id="image3" name="image3" style='display: none;'>
       <input onchange="cambioimg(this.id);"type="file" id="image4" name="image4" style='display: none;'>
       <input onchange="cambioimg(this.id);"type="file" id="image5" name="image5" style='display: none;'>
       <input onchange="cambioimg(this.id);"type="file" id="image6" name="image6" style='display: none;'>
      </div>  
          
          </form>
       

<br><br>
        </small>
         
  </div>
  
  
  
  <div class="tab-pane container fade" style="width:100%;" id="menu1">
      <br>
      <br>
      

      <div id="contenedorimages" style="width:100%;text-align:center;" class='col-xs-12 col-sm-6 col-md-8'>
      <div class="labelimage2">
<label  for="image1"><img OnError="Error_Cargar()" class="imgp" name="image1a" id="image1a"src="imagenes/add.png"></label>
</div>
      <div class="labelimage2">
<label  for="image2"><img OnError="Error_Cargar2()" class="imgp" name="image2a" id="image2a"src="imagenes/add.png"></label>
</div>
      <div class="labelimage2">
<label  for="image3"><img OnError="Error_Cargar3()" class="imgp" name="image3a" id="image3a"src="imagenes/add.png"></label>
</div>
      <div class="labelimage2">
<label  for="image4"><img OnError="Error_Cargar4()" class="imgp" name="image4a" id="image4a"src="imagenes/add.png"></label>
</div>
      <div class="labelimage2">
<label  for="image5"><img OnError="Error_Cargar5()" class="imgp" name="image5a" id="image5a"src="imagenes/add.png"></label>
</div>
      <div class="labelimage2">
<label  for="image6"><img OnError="Error_Cargar6()" class="imgp" name="image6a" id="image6a"src="imagenes/add.png"></label>
</div>
    <br>
      <br>
      <br>
      
        </div>
      
  
  </div>

</div>






<div style="text-align:center;/* height: 200px; */width: 100%;position: relative;/* border: 3px solid green; */" class=" modal-footer">
             <div style="/* margin: 0 auto; *//* margin: 0px auto; *//* text-align: center; *//* justify-content: center; */margin: 0;position: relative;top: 50%;left: 50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
                
         <button class="btn btn-azul btn-mini pull-left" id="btn-add1" onclick="guardar_inventarios();"><i class="fa fa-save"></i> Guardar producto</button>
         <button class="btn btn-success btn-mini pull-left" id="btn-add" onclick="nuevo_producto();nuevoprod();"><i class="fa fa-file-o"></i> Nuevo producto</button>
         <!--<button class="btn btn-naranja btn-mini pull-left" id="btn-add" onclick="abrir_modal_datos_presentacion();"><i class="fa fa-list"></i> Nueva Presentación </button>-->
         <!--         <button class="btn btn-naranja btn-mini pull-left" id="btn-add" onclick="nuevaestanteria();"><i class="fa fa-list"></i> Agregar Estantería </button>-->
        </div>
        </div>
        
        
        
         <small> <div class='col-md-12'><div id='data2'></div></div> </small>                    

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
   <button type="button" class="close" data-dismiss="modal" $("#codigobarra").focus(); aria-hidden="true">x</button>
          <h4 class="modal-title">Presentaciones</h4>
          </div>
          <div class='panel panel-info'>  
          <br> 
          <small>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Código:</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id='codigoprecio' placeholder='Codigo' disabled='true'
          data-inputmask="'placeholder': '0'" >
          </div>
          </div>
<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Tipo Precio:</label>
          <div class="col-sm-6">
          <input type="text" class="form-control" id='presentacionpp' placeholder='Tipo Precio' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br>
          <div class='form-group'>
          <label for="beneficiario" class="col-sm-3 control-label">Unidades:</label>
          <div class="col-sm-6">
          <input type="text" class="form-control" value="1" id='unidades' placeholder='Unidades' 
          data-inputmask="'placeholder': '0'">
          </div>
          </div>
<br>
          <div class='form-group'>
           <label for="beneficiario" class="col-sm-3 control-label">Precio:</label>
          <div class="col-sm-3">
          <input type="text" class="form-control cantidades" id='preciop' placeholder='Precio' onfocus="this.placeholder = '0.00'" onblur="this.placeholder = 'Precio'">
          </div>
          </div>
<br> 
<br> 
<br> 
</small>
         <div class="modal-footer">
         <button class='btn btn-azul btn-mini pull-left' id='btn-add' onclick='guardar_presentaciones();'><i class='fa fa-save'></i> Guardar</button>
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
          <small>  <div id='lista_productos'></div> </small>
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
    <script src="dist/js/source_inventario.js"></script>
    <script src="plugins/noty/packaged/jquery.noty.packaged.min.js"></script>
    <script src="plugins/number/jquery.inputmask.bundle.js"></script>
    <script src="plugins/printPage/jquery.printPage.js"></script>
       <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
      $(document).ready(function(){
        $(".cantidades").inputmask();
      });
      
      
      
      
      
      function nuevoprod(){
          let formulario = document.getElementById('formdatos');
    
      formulario.reset();
      }
/*****************************************************************************/   
function abrir_modal_datos_inventario(){
 nuevo_producto();
 busca_cate();
 busca_prov();
   $("#Datos_cliente").modal({
             show:true,
             backdrop: 'static',
             keyboard: true
            });
   $('#Datos_cliente').on('shown.bs.modal', function () {
   $("#codigobarra").focus();
   
      
    
  
   //$("#buscar_cliente2").focus();
   });
}      
/*****************************************************************************/  
function buscaxx(){
    if (event.keyCode === 13) {
busca();

}
}
function busca(){
  var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_lista_inventario.php',
        type: 'POST',
        data: 'producto='+encodeURIComponent(artbuscar),
        success: function(x){
         $("#data").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}


busca_cate();

function busca_cate(){

    $.ajax({
        url: 'listacategorias.php',
        type: 'POST',
        data: null,
        success: function(x){
         $("#categoria").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#categoria").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}

busca_prov();
function busca_prov(){
  
    $.ajax({
        url: 'listaproveedoresinventario.php',
        type: 'POST',
        data: null,
        success: function(x){
         $("#proveedor").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#proveedor").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}

/*****************************************************************************/
buscaprov();
function buscaprov(){
 
    $.ajax({
    /*    beforeSend: function(){
          $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
          },*/
        url: 'provinventario.php',
        type: 'POST',
        data: '',
        success: function(x){
         $("#proveedor").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#proveedor").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
buscaestan();
function buscaestan(){
 
    $.ajax({
    /*    beforeSend: function(){
          $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
          },*/
        url: 'estanterias.php',
        type: 'POST',
        data: '',
        success: function(x){
         $("#estanteria").html(x);
          mostraes();
  
         },
        error: function(jqXHR,estado,error){
          $("#estanteria").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
/*****************************************************************************/

            var index;  // variable to set the selected row index
function getSelectedRow()
            {
                
                var table = document.getElementById("datax");
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
                var table = document.getElementById("datax");
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
                var table = document.getElementById("datax");
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
                var rows = document.getElementById("datax").rows,
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
         if ((event.keyCode >= 65 && event.keyCode <= 90) || (event.keyCode >= 96 && event.keyCode <= 105))  {
$("#codigo").val('');
$("#codigo").focus();
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

if (event.keyCode === 50) {
    /*
      var rows = document.getElementById("table").rows,
      parent = rows[index].parentNode;
  var dato = table.rows[index].children[0].innerHTML;
document.getElementsByName('edit'+dato)[0].click();
*/
//$("#"+dato+"").trigger("click");
}
if (event.keyCode === 51) {
    /*
      var rows = document.getElementById("table").rows,
      parent = rows[index].parentNode;
  var dato = table.rows[index].children[0].innerHTML;
document.getElementsByName('delete'+dato)[0].click();
*/
//$("#"+dato+"").trigger("click");
}
 }
                    function agregap(){
                        var keycode = event.keyCode;


if (event.keyCode === 9) {
getSelectedRow2();
}


}

function newp(){
    if (event.keyCode === 49) {
    //   abrir_modal_datos_inventario();
}
}
/*****************************************************************************/  
function guardar_inventarios(){
var tipodoc=document.title;
this.guardar_inventario();
if (tipodoc=='Inventario # 1'){    
// this.guardar_inventario_s2();

}
}

var vreli=0;
function eli_inv(codigo){
    vreli=codigo;
    
    eliminaproducto_s1();

}




function guardar_inventario_s2(){
     event.preventDefault();
//$('#Datos_cliente').modal('toggle');  
//var codigo=$("#codigop").val();
//var producto=$("#producto").val();
var estanteria= $("#estanteria").val();
var codigop= $("#codigop").val();
var form = document.querySelector("#formdatos");
var formData = new FormData(form);
var files = $('#image1')[0].files[0];
var files2 = $('#image2')[0].files[0];
var files3 = $('#image3')[0].files[0];
var files4 = $('#image4')[0].files[0];
var files5 = $('#image5')[0].files[0];
var files6 = $('#image6')[0].files[0];
formData.append('codigop', codigop);
formData.append('archivo', files);
formData.append('archivo2', files2);
formData.append('archivo3', files3);
formData.append('archivo4', files4);
formData.append('archivo5', files5);
formData.append('archivo6', files6);
formData.append('estanteria', estanteria);

if(producto==""){
//alert('Rellene');
abrir_modal_datos_inventario2();

   return false;
} else
{
       $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_inventario_s2.php',
  //type: 'POST',
              method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  // data: 'codigo='+$("#codigop").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&aplicacion='+$("#aplicacion").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigobarra").val()+'&marca='+$("#marca").val()+'&inversion='+$("#inversion").val()+'&presentacion='+$("#presentacionp").val()+'&existencia='+$("#existencia").val()+'&archivo='+files+'&archivo2='+files2+'&archivo3='+files3+'&archivo4='+files4+'&archivo5='+files5+'&archivo6='+files6,
   success: function(x){
   guardadocorrecto();
   $("#scriptsxd").html(x);
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
}

 }
/*****************************************************************************/  
function guardar_inventario(){
     event.preventDefault();
//$('#Datos_cliente').modal('toggle');  
//var codigo=$("#codigop").val();
//var producto=$("#producto").val();
var estanteria= $("#estanteria").val();
var codigop= $("#codigop").val();
var form = document.querySelector("#formdatos");
var formData = new FormData(form);
var files = $('#image1')[0].files[0];
var files2 = $('#image2')[0].files[0];
var files3 = $('#image3')[0].files[0];
var files4 = $('#image4')[0].files[0];
var files5 = $('#image5')[0].files[0];
var files6 = $('#image6')[0].files[0];
formData.append('codigop', codigop);
formData.append('archivo', files);
formData.append('archivo2', files2);
formData.append('archivo3', files3);
formData.append('archivo4', files4);
formData.append('archivo5', files5);
formData.append('archivo6', files6);
formData.append('estanteria', estanteria);

if(producto==""){
//alert('Rellene');
abrir_modal_datos_inventario2();

   return false;
} else
{
       $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_inventario.php',
  //type: 'POST',
              method: "POST",
             data: formData,
            contentType:false,
   processData:false,
  // data: 'codigo='+$("#codigop").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&aplicacion='+$("#aplicacion").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigobarra").val()+'&marca='+$("#marca").val()+'&inversion='+$("#inversion").val()+'&presentacion='+$("#presentacionp").val()+'&existencia='+$("#existencia").val()+'&archivo='+files+'&archivo2='+files2+'&archivo3='+files3+'&archivo4='+files4+'&archivo5='+files5+'&archivo6='+files6,
   success: function(x){
   guardadocorrecto();
   $("#scriptsxd").html(x);
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
}

 }
/*****************************************************************************/
function nuevo_producto(){
$("#codigop").val('');
$("#codigobarra").val('');
$("#producto").val('');
$("#proveedor").val('');
$("#marca").val('');
$("#presentacionp").val('');
$("#aplicacion").val('');
$("#costo").val('');
$("#descuento").val('');
$("#existencia").val('');
$("#inversion").val('');
$("#minima").val('');
$("#maxima").val('');
$("#image1").val('');
$("#image2").val('');
$("#image3").val('');
$("#image4").val('');
$("#image5").val('');
$("#image6").val('');
$("#vencimientop").val('');
document.getElementById("image1a").src="imagenes/add.png";
document.getElementById("image2a").src="imagenes/add.png";
document.getElementById("image3a").src="imagenes/add.png";
document.getElementById("image4a").src="imagenes/add.png";
document.getElementById("image5a").src="imagenes/add.png";
document.getElementById("image6a").src="imagenes/add.png";

//busca_precios();
$("#codigobarra").focus();
}
/*****************************************************************************/  
function abrir_modal_datos_inventario2(){
    
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
  title: 'Llene el campo producto'
})

}
/*****************************************************************************/  
function guardadocorrecto(){
    
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

}      
/*****************************************************************************/  
function editaproducto(art){
      $("#codigop").val(art.trim());
      editarabrir();
      buscaeditar();
    //   busca_precios();
}
/*****************************************************************************/  
var codigoprecio=0;
function editarprecio(art){
      //$("#codigo").val(art.trim());
      codigoprecio=art.trim();
      editarabrirprecio();
      buscaeditarprecio();
      //busca_precios();
}
/*****************************************************************************/ 
function editarabrir(){
     $("#Datos_cliente").modal({
             show:true,
             backdrop: 'static',
             keyboard: true
            });
   $('#Datos_cliente').on('shown.bs.modal', function () {
   $("#codigobarra").focus();
    });
} 
/*****************************************************************************/ 
function editarabrirprecio(){
   $("#codigoprecio").val($("#codigop").val());
   $("#Datos_presentacion").modal({
             show:true,
             backdrop: 'static',
             keyboard: true
            });
   $('#Datos_presentacion').on('shown.bs.modal', function () {
   $("#presentacionpp").focus();
   });
}
/*****************************************************************************/  
function buscaeditar(){
      $(document).ready(function(){
      var codigoalterno=$("#codigop").val();
          if(codigoalterno.trim()!=""){
         $(document).ready(function(){
          $.ajax({
     //     beforeSend: function(){
           // $("#data_articulo").html("Buscando información del cliente...");
       //    },
          url: 'buscaeditarinventario.php',
          dataType: 'json',
          type: 'POST', 
          data: 'codigoalterno='+codigoalterno,
          success: function(data){
            if(data==0){

$("#codigop").val('');
$("#producto").val('');
$("#equi").val('');
$("#proveedor").val('');
$("#marca").val('');
$("#presentacionp").val('');
$("#aplicacion").val('');
$("#costo").val('');
$("#inversion").val('');
$("#minima").val('');
$("#maxima").val('');
$("#precioa").val('');
$("#preciob").val('');
$("#precioc").val('');
$("#existencia").val('');
$("#producto").focus();

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
  title: 'Parece ser que ingresará un producto, ya que no existe...!'
})
              
              
              
              
              
            }else{
  $("#codigop").val(data[0].codigo);
  $("#codigobarra").val(data[0].codigo_alterno);
$("#producto").val(data[0].producto);
$("#equi").val(data[0].equivalencia);
$("#proveedor").val(data[0].proveedor);
$("#marca").val(data[0].marca);
$("#presentacionp").val(data[0].presentacion);
$("#aplicacion").val(data[0].aplicacion);
$("#costo").val(data[0].preciocosto);
$("#existencia").val(data[0].existencia);
$("#inversion").val(data[0].inversion);
$("#minima").val(data[0].minima);
$("#precioa").val(data[0].precioa);
$("#preciob").val(data[0].preciob);
$("#precioc").val(data[0].precioc);
$("#preciod").val(data[0].preciod);
$("#precioe").val(data[0].precioe);
$("#upe").val(data[0].upe);
$("#preciocosto").val(data[0].preciocosto);
$("#descuento").val(data[0].descuento);
$("#categoria").val(data[0].categoria);



$("#upreciodx").val(data[0].uunidad);
$("#upreciocx").val(data[0].ublister);
$("#upreciobx").val(data[0].ucaja);


$("#maxima").val(data[0].maxima);   
/*
var imagend1 =data[0].imagen;
var imagend2 =data[0].imagen2;
var imagend3 =data[0].imagen3;
var imagend4 =data[0].imagen4;
var imagend5 =data[0].imagen5;
var imagend6 =data[0].imagen6;
*/
/*
if (file_exists('imagenes/'+imagend1+'')) {
    
} else { 
document.getElementById("image1a").src="imagenes/add.png";   
    }
*/

document.getElementById("image1a").src="imagenes/"+data[0].imagen+"";
document.getElementById("image2a").src="imagenes/"+data[0].imagen2+"";
document.getElementById("image3a").src="imagenes/"+data[0].imagen3+"";
document.getElementById("image4a").src="imagenes/"+data[0].imagen4+"";
document.getElementById("image5a").src="imagenes/"+data[0].imagen5+"";
document.getElementById("image6a").src="imagenes/"+data[0].imagen6+"";

                
                
                
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
/*****************************************************************************/  


function buscaeditarprecio(){
      $(document).ready(function(){
      var codigoalterno=$("#codigoprecio").val();
          if(codigoprecio!=""){
         $(document).ready(function(){
          $.ajax({
     //     beforeSend: function(){
           // $("#data_articulo").html("Buscando información del cliente...");
       //    },
          url: 'buscaeditarprecio.php',
          dataType: 'json',
          type: 'POST', 
          data: 'codigoalterno='+codigoprecio,
          success: function(data){
            if(data==0){

$("#presentacionpp").val('');
$("#preciop").val('');
// $("#unidades").val('');
$("#presentacionpp").focus();

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
  title: 'Parece ser que ingresará un precio, ya que no existe...!'
})
              
              
              
              
              
            }else{
  $("#presentacionpp").val(data[0].presentacion);
  $("#preciop").val(data[0].precio);
  $("#unidades").val(data[0].unidades);
          
                
                
                
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
/*****************************************************************************/  
function busca_precios(){
  var artbuscar=$("#codigop").val();
    //alert($("#codigoo").val());
    //var artbuscar=150;
    $.ajax({
        beforeSend: function(){
        //   $("#data2").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_precio_inventario.php',
        type: 'POST',
        data: 'codigoalterno='+artbuscar,
        success: function(x){
         $("#data2").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data2").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}     
/*****************************************************************************/  
function abrir_modal_datos_presentacion(){
   $("#codigoprecio").val($("#codigop").val());
   $("#presentacionpp").val("");
   $("#preciop").val("");
//   $("#unidades").val("");
   $("#Datos_presentacion").modal({
             show:true,
             backdrop: 'static',
             keyboard: true
            });
   $('#Datos_presentacion').on('shown.bs.modal', function () {
   $("#presentacionpp").focus();
   });
}
/*****************************************************************************/  
function guardar_presentaciones(){
this.guardar_presentacion();
var tipodoc=document.title;
//if (tipodoc=='Inventario # 1'){    
//this.guardar_presentacion2();
//this.guardar_presentacion3();
//}
}
/*****************************************************************************/
function guardar_presentacion(){
var codigoprecio = $("#codigoprecio").val();
var presentacion = $("#presentacionpp").val();
var unidades = $("#unidades").val();
var preciop = $("#preciop").val();

if(codigoprecio==""||presentacion==""||preciop==""||unidades==""){
        if (codigoprecio==""){
            $('#Datos_presentacion').modal('toggle');  
    //    respuesta="No ha seleccionada ningun producto";
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
  title: 'No ha seleccionado ningun producto'
})
    }
    else
    {
           if (presentacion==""&&preciop==""){
               $('#presentacionpp').focus();  
      //  respuesta="Complete el campo Tipo Precio";
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
  title: 'Complete los campos'
})
    }
    else
    {
        
    if (presentacion==""){
      //  respuesta="Complete el campo Tipo Precio";
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
  title: 'Complete el campo Presentación'
})
    }
     if (preciop==""){
      //  respuesta="Complete el campo Tipo Precio";
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
  title: 'Complete el campo Precio'
})
    }
         if (unidades==""){
      //  respuesta="Complete el campo Tipo Precio";
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
  title: 'Complete el campo Unidades'
})
    }
    
    
    }
    }
  

 
    
}
else
{
     $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion.php',
   type: 'POST',
   data: 'codigo='+$("#codigoprecio").val()+'&precio='+$("#preciop").val()+'&presentacion='+$("#presentacionpp").val()+'&unidades='+$("#unidades").val(),
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
   
//   busca_precios();
   busca();
   $('#Datos_presentacion').modal('toggle');  
   //$('#Datos_presentacion').hide();
 
   },
        error: function(jqXHR,estado,error){
        }
       }); 
}
  
 }
/*****************************************************************************/  
function eliminarprecio(id){
   var precios=id;
    //  var idcl=precios.split("|");
//   codigo=idcl[0];
 //  presentacionpp=idcl[1];
Swal.fire({
  title: 'Está seguro de eliminar?',
  text: "Se eliminará un precio",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText : 'Cancelar',
  confirmButtonText: 'Si, eliminar!'
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
  title: '¡Eliminado!'
})
    
    
           $.ajax({
         
          url: 'Eliminarprecios.php',
          type: 'POST',
          data: 'id='+precios,
          success: function(x){

      //recuperar_alimentos();
            busca_precios();
            busca();
           },
           error: function(jqXHR,estado,error){
           }
           });
    
  }
})
  
}
/*****************************************************************************/  

/*****************************************************************************/  

function eliminaproducto_s1(){
        // event.preventDefault();
   var codigo=vreli;
Swal.fire({
  title: 'Está seguro de eliminar?',
  text: "Se eliminará un producto",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText : 'Cancelar',
  confirmButtonText: 'Si, eliminar!'
}).then((result) => {
  if (result.isConfirmed) {
    
                
    var tipodoc=document.title;

if (tipodoc=='Inventario # 1'){    

// eliminaproducto_s2();

}
    
           $.ajax({
         
          url: 'Eliminarproductos.php',
          type: 'POST',
          data: 'id='+codigo,
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
  title: '¡Eliminado!'
})

            // busca_precios();
            busca();
           },
           error: function(jqXHR,estado,error){
           }
           });
    
  }
})



// var tipodoc=document.title;
// if (tipodoc=='Inventario # 1'){    
// eliminaproducto_s2(codigo);
// }

  
}

/*****************************************************************************/  

function eliminaproducto_s2(){
        // event.preventDefault();
   var codigo=vreli;

         $.ajax({
         
          url: 'Eliminarproductos_s2.php',
          type: 'POST',
          data: 'id='+codigo,
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
  title: '¡Eliminado!'
})

            busca_precios();
            busca();
           },
           error: function(jqXHR,estado,error){
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
document.getElementById(art.trim()+"a").src="imagenes/add.png";  


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
function Error_Cargar() {
document.getElementById("image1a").src="imagenes/add.png";
}
function Error_Cargar2() {
document.getElementById("image2a").src="imagenes/add.png";
}
function Error_Cargar3() {
document.getElementById("image3a").src="imagenes/add.png";
}
function Error_Cargar4() {
document.getElementById("image4a").src="imagenes/add.png";
}
function Error_Cargar5() {
document.getElementById("image5a").src="imagenes/add.png";
}
function Error_Cargar6() {
document.getElementById("image6a").src="imagenes/add.png";
}
/*****************************************************************************/  
function calcula(){
var cainversion = 0;
var caprecio = 0;
var caexistencia=0;

 if($('#existencia').val()==''){
caexistencia=0;
 }
 else
 {
   caexistencia=parseFloat($('#existencia').val());
 }

 caprecio =parseFloat($('#costo').val());
 
 cainversion=caexistencia*caprecio;
       $('#inversion').val(cainversion);

}
      
      
/***********************************************/
var destanteria="";
function nuevaestanteria(){


Swal
    .fire({
        title: "Ingrese una estantería",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: "",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value=="") {
              resolve('Ingrese una estantería')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            
             destanteria = resultado.value;

            
        guardarestanteria();

        }
    });
    

  }
      
      /*************************************************************************************/
function guardarestanteria(){

   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_estanteria.php',
   type: 'POST',
   data: 'estanteria='+destanteria,
  success: function(x){
       buscaestan();
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


   },
        error: function(jqXHR,estado,error){
        }
       }); 
       
 }
/***********************************************/      
      function mostraes(){
          if(destanteria==""){
              
          }else
          {
          $("#estanteria").val(destanteria);    
          }
          
      }
      
      
      function calcula(){
          var precioa=0.00;
          var porcentaje=0.00;
          var preciob=0.00;
           precioa =parseFloat($("#precioa").val());
           preciob =parseFloat($("#preciob").val());
           porcentaje =parseFloat($("#precioc").val());
          var total=0.00;
          
          total=precioa+(precioa*(porcentaje/100));
          
          if((porcentaje==0) || (porcentaje =="")){
              $("#preciob").val(precioa);   
          }else
          {
              $("#preciob").val(total);              
          }

      }
      
      function cambiarprecio(agrega){
          
          
          
           var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            
            
                var precioa=0.00;
          var porcentaje=0.00;
          var preciob=0.00;
          var total=0.00;
          var idcambia=idcl[0];
          var xd=0;
           xd=idcl[2];
          
          
          Swal
    .fire({
        title: "Ingrese un porcentaje",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: xd,

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve('Ingrese un porcentaje válido')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            
             porcentajexx = resultado.value;
       
           
          
            
            var precioa=parseFloat(idcl[1]);
            
          
            total=precioa+(precioa*(porcentajexx/100));
          
            // alert(total);
            
            
         
     event.preventDefault();



var form = document.querySelector("#formdatos");
var formData = new FormData(form);
formData.append('codigop', idcambia);
formData.append('preciob', total);
formData.append('precioc', porcentajexx);




       $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_porcentaje.php',
  //type: 'POST',
              method: "POST",
             data: formData,
            contentType:false,
   processData:false,
   success: function(x){
   guardadocorrecto();
//   $("#scriptsxd").html(x);
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 


 
 
          
         
            
            // dfactura=ofactura;
            // dtotal=dcantidad*dprecio;
            // guardarorden();
            
                   
               
             
     
        }
    });
      }
      
      
      
      var porcentajexx=0.00;
      
      
      
       function agregarexistencia(cod){
           
           if(rev_usuario==""){
               ver_usuario(cod);
           }else
           {
               var codbarra= cod;
         var cantidad=0;
         
         
         Swal
    .fire({
        title: "Agregar existencia",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: "",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value=="") {
              resolve('Ingrese una cantidad válida')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            
             cantidad = resultado.value;
            
               $.ajax({
   beforeSend: function(){
   },
   url: 'agregar_existencia.php',
   type: 'POST',
   data: 'codigo='+codbarra+'&cantidad='+cantidad+'&usuario='+rev_usuario,
  success: function(x){
     
   busca();
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
  title: 'Existencia actualizada'
})

rev_usuario="";
   },
        error: function(jqXHR,estado,error){
        }
       }); 
        

        }
    });
         
           }
         
     }
     
     
     var rev_usuario=""

function ver_usuario(id){
    
    var cod=id;
    
    
    (async () => {

const { value: password } = await Swal.fire({
  title: 'Ingresa tu contraseña',
  input: 'password',
  inputPlaceholder: 'Contraseña',

  inputAttributes: {
    maxlength: 20,
    autocapitalize: 'off',
    autocorrect: 'off',
    autocomplete: 'new-password'
    
  }
})

if (password) {




 $.ajax({
      beforeSend: function(){
      },
      url: 'buscausuario.php',
      dataType: 'json',
      type: 'POST',
      data: 'pass='+password,
      success: function(data){
          
          if(data!=""){
rev_usuario=data[0].Usuario;
if((rev_usuario=="Admin") || (rev_usuario=="admin" || (rev_usuario=="Marisela"))){
agregarexistencia(cod);    
}else
{
    Swal.fire(
  'Sin permisos',
  'No tienes permisos para esta acción',
  'error'
)
rev_usuario="";
}

          }else
          {
    
const Toast = Swal.mixin({
  toast: true,
  position: 'center',
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
})

Toast.fire({
  icon: 'error',
  title: 'Contraseña incorrecta'
})

         
setTimeout(function() {
   ver_usuario(cod);
}, 1000);

          }



      },
      error: function(jqXHR,estado,error){
      }
      });  



}

})()


    
}

     
          function porcentaje_pi(){
var porcentaje=0.00;
var costo=parseFloat($("#preciocosto").val());
var publico=parseFloat($("#preciod").val());

porcentaje=((publico-costo)*100)/costo;

$("#preciodx").val(porcentaje.toFixed(2));

porcentaje_x();
}

     function porcentaje_p(){
var publico=0.00;
var costo=parseFloat($("#preciocosto").val());
var porcentajex=parseFloat($("#preciodx").val());

publico=((porcentajex/100)*costo)+costo;
$("#preciod").val(publico.toFixed(2));

porcentaje_x();
}


     function porcentaje_x(){
var mayorista=0.00;
var dist1=0.00;
var dist2=0.00;
var publico=parseFloat($("#preciod").val());
var porcentajec=parseFloat($("#preciocx").val());
var porcentajeb=parseFloat($("#preciobx").val());
var porcentajea=parseFloat($("#precioax").val());


mayorista=publico-((porcentajec/100)*publico);
dist1=publico-((porcentajeb/100)*publico);
dist2=publico-((porcentajea/100)*publico);




$("#precioc").val(mayorista.toFixed(2));
$("#preciob").val(dist1.toFixed(2));
$("#precioa").val(dist2.toFixed(2));
}


       function agregarexistencia(cod){
           
           if(rev_usuario==""){
               ver_usuario(cod);
           }else
           {
               var codbarra= cod;
         var cantidad=0;
         
         
         Swal
    .fire({
        title: "Agregar existencia",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Ok",
        cancelButtonText: "Cancelar",
        inputValue: "",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value=="") {
              resolve('Ingrese una cantidad válida')
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            
             cantidad = resultado.value;
            
               $.ajax({
   beforeSend: function(){
   },
   url: 'agregar_existencia.php',
   type: 'POST',
   data: 'codigo='+codbarra+'&cantidad='+cantidad+'&usuario='+rev_usuario,
  success: function(x){
     
   busca();
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
  title: 'Existencia actualizada'
})

rev_usuario="";
   },
        error: function(jqXHR,estado,error){
        }
       }); 
        

        }
    });
         
           }
         
     }
     

    </script>
    <script type="text/javascript">
       
    </script>
  </body>
</html>