/*FUNCIONES PARA EL PUNTO DE VENTA*/
var pid='';
/************************************************************************************/
function modificar_inventario(id){
   pid=id;
   busca_inventario();
   abrir_modal_datos_clientes();
}
/****************************************************************************************/
function busca_inventario(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("<center><img src='dist/img/cargando.gif'></img>");
           },
          url: 'busca_data_inventario.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].codigo);
            $("#codigoo").val(data[0].codigo);
            $("#codigooalterno").val(data[0].codigo_alterno);
            $("#producto").val(data[0].producto);
            $("#proveedor").val(data[0].proveedor);
            $("#categoria").val(data[0].categoria);
            $("#existencia").val(data[0].existencia);
            $("#minima").val(data[0].minima);
            $("#maxima").val(data[0].maxima);
            $("#costo").val(data[0].preciocosto);
            busca_presenta();
            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          
          })
         }
 /*************************************************************************************/
 function busca_presenta(){
  var artbuscar=$("#codigoo").val();
    //alert($("#codigoo").val());
    //var artbuscar=150;
    $.ajax({
        beforeSend: function(){
          $("#data2").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_presentacion_compras.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#data2").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data2").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function busqueda_inventario_compras(){
   $("#modal_busqueda_inventario_compras").modal({
             show:true,
             //backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_inventario_compras').on('shown.bs.modal', function () {
   $("#lista_productos").html("");
   $("#producto_buscar").val("");
   $("#producto_buscar").focus();
   });

}
/*****************************************************************************/
function busca_inventario_comprassss(){
  var artbuscar=$("#producto_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_productos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_inventario_compra_ayuda.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#lista_productos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_productos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function eliminar_producto(id){
   pid=id;  
   var n = noty({
                  text: "Seguro que desea eliminar el elemento...?",
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
          url: 'Eliminar_data_inventario.php',
          type: 'POST',
          data: 'id='+pid,
          success: function(x){
             var n = noty({
              text: "Se elimino el elemento del listado...!",
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
/*********************************************************************************/
function eliminar_item(id){
   var alimentos=id;
   var idcl=alimentos.split("|");
   pid=idcl[0];
   ppresentacion=idcl[2];
   //alert(pid);
   //alert (ppresentacion);
   var n = noty({
                  text: "Seguro que desea eliminar el elemento...?",
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
          url: 'Eliminar_data_presentacion.php',
          type: 'POST',
          data: 'id='+pid+'&presentacion='+ppresentacion,
          success: function(x){
             var n = noty({
              text: "Se elimino el elemento del listado...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000,
            });
      //recuperar_alimentos();
            busca_presenta();
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
/*********************************************************************************/
function modificar_presentacion(id){
   var alimentos=id;
   var idcl=alimentos.split("|");
   $("#id").val(idcl[0]);
   $("#tipoprecio").val(idcl[1]);
   $("#presentacion").val(idcl[2]);
   $("#unidades").val(idcl[3]);
   $("#precio").val(idcl[4]);

   abrir_modal_datos_presentacion_modificar();

  // pid=id;
   //busca_presentacion();
}
/****************************************************************************************/
function abrir_modal_datos_presentacion_modificar(){
    $("#Datos_presentacion").modal({
             show:true,
             //backdrop: 'static',
             keyboard: false
            });
   $('#Datos_presentacion').on('shown.bs.modal', function () {
   $("#tipoprecio").focus();
   //$("#buscar_cliente2").focus();
   });
}
/*****************************************************************************/
function abrir_modal_datos_presentacion2(){
   $("#id").val($("#codigoo").val());
   $("#tipoprecio").val("");
   $("#presentacion").val("");
   $("#unidades").val("");
   $("#precio").val("");
   $("#Datos_presentacion").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_presentacion').on('shown.bs.modal', function () {
   $("#tipoprecio").focus();
   });
}
/*****************************************************************************/
function busca_clientee(){
      $(document).ready(function(){
               $("#modal_tabla_clientes").modal({
                      show:true,
                      backdrop: 'static',
                      keyboard: false
                    });
                       $.ajax({
                          beforeSend: function(){
                            $("#lista_clientes").html("Cargando los clientes...");
                          },
                          url: 'lista_clientes.php',
                          type: 'POST',
                          data: null,
                          success: function(x){
                            $("#lista_clientes").html(x);
                            $(document).ready(function() {
                             $('#sample-table-3').DataTable();
                            });
                           },
                          error: function(jqXHR,estado,error){
                            $("#lista_clientes").html('Hubo un error: '+estado+' '+error);
                          }
                       });
                       })
                      }
/*****************************************************************************/
function abrir_modal_datos_clientes(){
   $("#codigoo").val("");
   $("#codigooalterno").val("");
   $("#producto").val("");
   $("#proveedor").val("");
   $("#categoria").val("");
   $("#existencia").val("");
   $("#minima").val("");
   $("#maxima").val("");
   $("#costo").val("");
   $("#Datos_cliente").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_cliente').on('shown.bs.modal', function () {
   $("#codigooalterno").focus();
   //$("#buscar_cliente2").focus();
   });
}
/*****************************************************************************/
function busca(){
	var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_lista_inventario.php',
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
/****************************************************************************/
function busca_negativos(){
	var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_lista_inventario_negativos.php',
        type: 'POST',
        data: null,
        success: function(x){
         $("#data").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/****************************************************************************/
function busca_inventario_compras(){
  var artbuscar=$("#producto_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_productos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_inventario_compra_ayuda.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#lista_productos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_productos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function agrega_inventario_compras(varproductos){
  var alimentos=varproductos;
  var idcl=alimentos.split("|");
  $("#codigoo").val(idcl[0]);
  $("#codigoalterno").val(idcl[1]);
  $("#producto").val(idcl[2]);
  $("#proveedor").val(idcl[3]);
  $("#categoria").val(idcl[4]);
  $("#existencia").val(idcl[5]);
  $("#minima").val(idcl[6]);
  $("#maxima").val(idcl[7]);
  $("#costo").val(idcl[8]);
  $("#modal_busqueda_inventario_compras").modal('hide'); //ocultar modal
  busca_presenta2();
}
/******************************************************************************************/
function busca_presenta2(){
  var artbuscar=$("#codigoo").val();
    //alert($("#codigoo").val());
    //var artbuscar=150;
    $.ajax({
        beforeSend: function(){
          $("#data2").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_presentacion_compras.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#data2").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data2").html("Error en la peticion AJAX..."+estado+"      "+error);
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
function guardar_inventarios(){
var tipodoc=document.title;
this.guardar_inventario();
if (tipodoc=='Inventario # 1'){    
this.guardar_inventario_sucursal2();
this.guardar_inventario_sucursal3();
}
}
/*********************************************************************************/
function guardar_inventario2(){
$('#Datos_cliente').modal('toggle');  
var codigo=$("#codigoo").val();
var producto=$("#producto").val();
if(producto==""){
   var n = noty({
   text: "Completa la informacion del Producto...!",
   theme: 'relax',
   layout: 'center',
   type: 'information',
   timeout: 2000,
})
   return false;
}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_inventario.php',
   type: 'POST',
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val(),
   success: function(x){
   alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_inventario_sucursal2(){
$('#Datos_cliente').modal('toggle');  
var codigo=$("#codigoo").val();
var producto=$("#producto").val();
if(producto==""){
  // var n = noty({
  // text: "Completa la informacion del Producto...!",
  // theme: 'relax',
 //  layout: 'center',
 //  type: 'information',
 //  timeout: 2000,
//})
   return false;
}
   $.ajax({
   beforeSend: function(){
   },
   url: 'guardar_inventario_sucursal2.php',
   type: 'POST',
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val(),
   success: function(x){
  // alert("El dato se registro satisfactoriamente...!");
  // busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_inventario_sucursal3(){
$('#Datos_cliente').modal('toggle');  
var codigo=$("#codigoo").val();
var producto=$("#producto").val();
if(producto==""){
//   var n = noty({
  // text: "Completa la informacion del Producto...!",
  // theme: 'relax',
 //  layout: 'center',
 //  type: 'information',
 //  timeout: 2000,
//})
   return false;
}
   $.ajax({
   beforeSend: function(){
   },
   url: 'guardar_inventario_sucursal3.php',
   type: 'POST',
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val(),
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
 //  busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_presentaciones2(){
this.guardar_presentacion();
var tipodoc=document.title;
if (tipodoc=='Inventario # 1'){    
this.guardar_presentacion2();
this.guardar_presentacion3();
}
}
/*******************************************************************************************/  
function guardar_presentacion3(){
$('#Datos_presentacion').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion.php',
   type: 'POST',
   data: 'id='+$("#id").val()+'&presentacion='+$("#presentacionp").val()+'&unidades='+$("#unidades").val()+'&precio='+$("#precio").val()+'&tipoprecio='+$("#tipoprecio").val(),
   success: function(x){
   alert("El dato se registro satisfactoriamente...!");
   busca_presenta();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_presentacion2(){
$('#Datos_presentacion').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion2.php',
   type: 'POST',
   data: 'id='+$("#id").val()+'&presentacion='+$("#presentacion").val()+'&unidades='+$("#unidades").val()+'&precio='+$("#precio").val()+'&tipoprecio='+$("#tipoprecio").val(),
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
 //  busca_presenta();;
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_presentacion3(){
$('#Datos_presentacion').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion3.php',
   type: 'POST',
   data: 'id='+$("#id").val()+'&presentacion='+$("#presentacion").val()+'&unidades='+$("#unidades").val()+'&precio='+$("#precio").val()+'&tipoprecio='+$("#tipoprecio").val(),
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
   //busca_presenta();;
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  