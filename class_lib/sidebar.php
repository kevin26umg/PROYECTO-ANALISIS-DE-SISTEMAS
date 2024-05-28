<!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">-->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@500&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/bdf26aeed8.js" crossorigin="anonymous"></script>

<style>

body {
    font-family: 'Nunito', sans-serif!important;
}


#lista_articulos{
    font-family: Nunito, sans-serif!important;
}


.colores thead th {
    background: #e00000!important;
    padding: 8px 16px!important;
}

.btn {
    
    padding: 6px 12px!important;
}
    
    
#table{

     margin-bottom: 0px; 

}


.btn-lg {
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 16px;
    margin: 2px;
        
    }
    
.table-striped>tbody>tr:nth-child(odd)>td, 
.table-striped>tbody>tr:nth-child(odd)>th {
   background-color: #e0000026; 
 }
 
 .modal-body {
    position: relative;
    padding: 0px!important;
}
 .selected{background-color:#006bef99!important}
.sidebar-menu .treeview-menu > li > a {
    
    color: #000000!important;
}
.sidebar-menu > li > a {
     color: #000!important;
}
.sidebar {
    padding-bottom: 10px;
    background-color: #ffffff!important;
    color: #000!important;
    height: 100%;
}
.main-sidebar, .left-side {
    background-color: #ffffff!important;
}
.user-panel a {
    color: #000!important;
}
.main-header .logo {

    background-color: #e00000!important;

}
.main-footer {
    padding: 15px;
    background-color: #ffffff !important;
    color: #000 !important;
}


.main-sidebar, .left-side {
    min-height: 100%!important;
}   
.navbar {
    background-color: #e00000!important;
}
.main-header > .navbar a {
    color: white!important;
}
.main-header > .navbar a {
    font-weight: bold;
}
.wrapper {
  
    background: white!important;
}

</style>
<section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="imagenes/<?php 
            
              
                  $file = 'imagenes/'.$_SESSION['foto'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $_SESSION['foto']!='') {
   echo $_SESSION['foto'];
} else {
    
     echo "userlg1.png";
}
              
              ?>" class="img-circle" alt="User Image">
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
            <li class="header">MENU</li>
             <!--Optionally, you can add icons to the links -->
             
            <!--             <li class="treeview">-->
            <!--  <a href="Pedidos.php"><i class="fa-solid fa-bars-staggered"></i> <span>Cotización</span> <i class="fa fa-angle-left pull-right"></i></a>-->
           
            <!--  <ul class="treeview-menu">-->
                
            <!--    <li><a href="Cotizacion.php"><i class="fa fa-calendar"></i> Cotización</a></li>-->
                
				        <!--<li><a href="Historial_cotizacion.php"><i class="fa fa-calendar-o"></i> Historial de Cotizaciones</a></li>-->
				
            <!--   </ul>-->
            <!--</li>-->
            
            
            
            
               <?php
if (($_SESSION['historialventas']==1) ||($_SESSION['ventas']==1)) {
?>



             
            <li class="treeview">
              <a href="Pedidos.php"><i class="fas fa-list"></i> <span>Pedidos</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  
                  				 <?php
  if ($_SESSION['ventas']==1) {
    ?>
<li><a href="Pedidos.php"><i class="fas fa-check-square"></i> Pedidos de Clientes</a></li>
     <?php
  }
 ?>
 
 
                  				 <?php
  if ($_SESSION['historialventas']==1) {
    ?>
<li><a href="Lista_pedidos.php"><i class="fa fa-calendar-o"></i> Historial de Pedidos</a></li>
     <?php
  }
 ?>
 

 
                
	          	<!--<li><a href="Clientes.php"><i class="fa fa-usd"></i> Abonos de Clientes</a></li>-->
                

               </ul>
            </li>
            
       
            
              <?php
  }
 ?>
 
<?php
if (($_SESSION['historialcompras']==1) ||($_SESSION['compras']==1)) {
?>



			    <li class="treeview">
              <a href="#"><i class=" fa fa-shopping-cart"></i> <span>Compras</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  
                                     				 <?php
  if ($_SESSION['compras']==1) {
    ?>
             	<li><a href="Compras2.php"><i class=" fa fa-shopping-cart"></i> Compras</a></li>
     <?php
  }
 ?>
 
                    				 <?php
  if ($_SESSION['historialcompras']==1) {
    ?>
<li><a href="Lista_compras2.php"><i class=" fa fa-shopping-cart"></i> Historial de Compras</a></li>
     <?php
  }
 ?>
 
 
				        
          <!--    <li><a href="Compras_por_fecha.php"><i class="fa fa-male"></i> Compras por fecha</a></li> -->
			       <!-- 	<li><a href="Facturas_por_pagar.php"><i class=" fa  fa-calendar-o"></i> Facturas x pagar</a></li>-->
			      	<!--<li><a href="Solicitud_compras.php"><i class=" fas  fa-check-square"></i> Solicitud Compras</a></li>-->
				
				    </ul>
            </li>
            
                          <?php
  }
 ?>
			 <?php
if (($_SESSION['inventario']==1) ||($_SESSION['reporte']==1)) {
?>



  
			 <li class="treeview">
              <a href="#"><i class=" fa fa-barcode"></i> <span>Bodega</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <!--<li><a href="Altas.php"><i class="fa fa-upload"></i> Altas</a></li>-->
                <!--<li><a href="Bajas.php"><i class="fa fa-download"></i> Bajas</a></li>  -->
                
                                    				 <?php
  if ($_SESSION['inventario']==1) {
    ?>
<!--<li><a href="Despachos2.php"><i class="fa-solid fa-box-open"></i> Despachos</a></li>-->
<li><a href="Inventario.php"><i class=" fa fa-qrcode"></i> Inventario General</a></li>
     <?php
  }
 ?>
 
                     				 <?php
  if ($_SESSION['reporte']==1) {
    ?>
<li><a href="Ventas_por_periodo.php"><i class=" fa fa-calendar-o"></i> Ventas por periodo</a></li>
				<li><a onclick="reportegeneral2()"><i class=" fa  fa-calendar-o"></i> Reporte Inventario</a></li>
                <li><a onclick="reporteporagotar2()" ><i class=" fa fa-ban"></i> Productos por Agotar</a></li>
                <li><a onclick="reporteagotados2()"><i class=" fa fa-ban"></i> Productos Agotados</a></li>
                <?php
  }
 ?>
 
                
                
                
				</ul>
            </li>
			             <?php
  }
 ?>
			<?php
if (($_SESSION['clientes']==1) ||($_SESSION['proveedores']==1)) {
?>



			<li class="treeview">
              <a href="#"><i class="fa fa-users"></i> <span>Clientes y Prov.</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                 <!--<li><a href="abc_lineas.php"><i class="fa fa-bars"></i> Lineas</a></li>-->
<?php
  if ($_SESSION['clientes']==1) {
    ?>
<li><a href="Clientes.php"><i class="fa fa-male"></i> Clientes</a></li> 
<!--<li><a href="Reporte_clientes.php"><i class="fa fa-male"></i> Reporte Clientes</a></li> -->
     <?php
  }
 ?>
 
 <?php
  if ($_SESSION['proveedores']==1) {
    ?>
       <li><a href="Proveedores.php"><i class="fa fa-truck"></i> Proveedores</a></li>
     <?php
  }
 ?>
 
			    
          <!--<li><a href="Historial_compras_clientes_credito.php"><i class="fa fa-calendar-o"></i> Historial Compras al Crédito</a></li>--> 
          <!--<li><a href="Reporte_clientes_saldos.php"><i class="fa fa-male"></i> Saldos de Clientes</a></li> -->
          <!--<li><a href="Abonos_por_fecha.php"><i class="fa fa-male"></i> Abonos por fecha: Clientes</a></li> -->
   
              </ul>
            </li>
            
            
               <?php
  }
 ?>
			
			
			<?php
if (($_SESSION['usuarios']==1) ||($_SESSION['corte']==1)) {
?>



  
			<li class="treeview">
              <a href="#"><i class="fa fa-wrench"></i> <span>Administración</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                  
                  
                                  				 <?php
  if ($_SESSION['corte']==1) {
    ?>
<!--<li><a href="Corte_Caja.php"><i class="fa fa-calendar-o"></i> Corte de Caja</a></li>-->
     <?php
  }
 ?>
 
                   <?php
  if ($_SESSION['usuarios']==1) {
    ?>
       <li><a href="Usuarios.php"><i class="fa fa-user"></i> Usuarios</a></li>
     <?php
  }
 ?>
 
    
 
 
			    <!--<li><a href="Datos_empleado.php"><i class="fa fa-male"></i> Utilidades</a></li>-->
			     <!--<li><a href="Comisiones_ventas.php"><i class="fa fa-calendar-o"></i> Comisiones Ventas</a></li>-->
				
				<!--<li><a href="Permisos.php"><i class="fa fa-user"></i> Permisos</a></li>-->
                <!--<li><a href="parametros.php"><i class="fas fa-map"></i> Parametros de Aplicacion</a></li>-->
                <!--<li><a href="valida_cambio.php?opt=582963741"><i class="fa fa-folder-open"></i> Respaldo de BD</a></li>-->
              </ul>
            </li>
            
                         <?php
  }
 ?>
          </ul>
          <!-- /.sidebar-menu -->
        </section>

<script>

        function reporteporagotar(){
           Swal
    .fire({
        title: "Ingrese un proveedor",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        inputValue: "TODOS",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve();
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            

              var x = resultado.value;
   window.open("Inventario_minima.php?prov="+encodeURIComponent(x))

    
        
        }
    });
        }
        function reporteagotados(){
            Swal
    .fire({
        title: "Ingrese un proveedor",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        inputValue: "TODOS",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve();
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            

              var x = resultado.value;
   window.open("Inventario_agotados.php?prov="+encodeURIComponent(x))

    
        
        }
    });
        }
        
         function reportegeneral(){
            Swal
    .fire({
        title: "Ingrese un proveedor",
        input: "text",
        showCancelButton: true,
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
        inputValue: "TODOS",

             inputValidator: (value) => {
            return new Promise((resolve) => {
            if (!value || value==0) {
              resolve();
            } else {
                
                  resolve();
            }
            });
        }
    })
    .then(resultado => {
        if (resultado.value) {
            

              var x = resultado.value;
   window.open("Inventario_general.php?prov="+encodeURIComponent(x));

    
        
        }
    });
        }
        
        function reporteporagotar2(){
            
            busca_precios_modalx();
            
Swal.fire({
  title: 'INVENTARIO MÍNIMA',
  html:
    
'<br><div style="font-size: 22px;font-weight: bold;    color: blue;"> SELECCIONE CATEGORÍA</div> <br>'+
    '<div id="precios"></div> ',
    
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    'Ok',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    'Cancelar',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {

  if (result.isConfirmed) {
      
      var cmbprecio = ($("#cmbprovxx").val());
  var idcl2=cmbprecio.split("|");
  var proveedor=idcl2[0];
  
   window.open("Inventario_minima.php?prov="+encodeURIComponent(proveedor));
  
  } 
})

        }
        
        function reporteagotados2(){
            
            busca_precios_modalx();
            
Swal.fire({
  title: 'INVENTARIO AGOTADOS',
  html:
    
   '<br><div style="font-size: 22px;font-weight: bold;    color: blue;"> SELECCIONE CATEGORÍA</div> <br>'+
    '<div id="precios"></div> ',
    
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    'Ok',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    'Cancelar',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {

  if (result.isConfirmed) {
      
      var cmbprecio = ($("#cmbprovxx").val());
  var idcl2=cmbprecio.split("|");
  var proveedor=idcl2[0];
  
   window.open("Inventario_agotados.php?prov="+encodeURIComponent(proveedor));
  
  } 
})

        }
        
        function reportegeneral2(){
            
            busca_precios_modalx();
            
Swal.fire({
  title: 'INVENTARIO GENERAL',
  html:
    
    '<br><div style="font-size: 22px;font-weight: bold;    color: blue;"> SELECCIONE CATEGORÍA</div> <br>'+
    '<div id="precios"></div> ',
    
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText:
    'Ok',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    'Cancelar',
  cancelButtonAriaLabel: 'Thumbs down'
}).then((result) => {

  if (result.isConfirmed) {
      
      var cmbprecio = ($("#cmbprovxx").val());
  var idcl2=cmbprecio.split("|");
  var proveedor=idcl2[0];
  
   window.open("Inventario_general.php?prov="+encodeURIComponent(proveedor));
  
  } 
})

        }
        
        
        function busca_precios_modalx(){
	
     $.ajax({
 
        url: 'proveedores_pedidos.php',
        type: 'POST',
        data: null,
        success: function(x){
         $("#precios").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#precios").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}


baroff();
function baroff(){
    setTimeout(function(){
// document.getElementsByName("btnside")[0].click();
 $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
}, 500);

}

document.addEventListener('keydown', (event) => {
  const keyName = event.key;
  if (event.keyCode === 220) {
document.getElementsByName("btnside")[0].click();
//  $("body").addClass('sidebar-collapse').trigger('collapsed.pushMenu');
                
}

// keysPressed[event.key] = true;
 keysPressed[event.key] = true;
  if (keysPressed['Control'] && event.keyCode == 112) {
window.location.href = "Pedidos.php";
                
}
  if (keysPressed['Control'] && event.keyCode == 113) {
window.location.href = "Cotizacion.php";
                
}
  if (keysPressed['Control'] && event.keyCode == 114) {
window.location.href = "Servicios2.php";
                
}

});


let keysPressed = {};
</script>