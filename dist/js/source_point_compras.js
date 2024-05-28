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
var pcosto=0.00;
/************************************************************************************/
function busqueda_inventario_compras(){
   $("#modal_busqueda_inventario_compras").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_inventario_compras').on('shown.bs.modal', function () {
   $("#lista_productos").html("");
   $("#producto_buscar").val("");
   $("#producto_buscar").focus();
   });

}
/*****************************************************************************/
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
  $("#costo").val(idcl[2]);
  $("#proveedor").val(idcl[3]);
  $("#categoria").val(idcl[4]);
  $("#existencia").val(idcl[5]);
  $("#minima").val(idcl[6]);
  $("#maxima").val(idcl[7]);
  $("#presentacion2").val(idcl[8]);
  $("#producto").val(idcl[9]);
  $("#modal_busqueda_inventario_compras").modal('hide'); //ocultar modal
  busca_presenta();
}
/******************************************************************************************/
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
function nuevo_producto(){
$("#codigoo").val("");
   $("#codigooalterno").val("");
   $("#producto").val("");
   $("#proveedor").val("");
   $("#categoria").val("");
   $("#existencia").val("");
   $("#minima").val("");
   $("#maxima").val("");
   $("#costo").val("");
busca_presenta();   
}
/*****************************************************************************/   
function abrir_modal_datos_inventario(){
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
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_presentacion').on('shown.bs.modal', function () {
   $("#id").focus();
   //$("#buscar_cliente2").focus();
   });
}
/*****************************************************************************/
function abrir_modal_datos_presentacion(){
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
function guardar_inventarios(){
var tipodoc=document.title;
this.guardar_inventario();
//agrega_inventario_compras();
if (tipodoc=='Detalle de Compras # 1'){    
//this.guardar_inventario_sucursal2();
//this.guardar_inventario_sucursal3();
}
}
/*********************************************************************************/
function guardar_inventario(){
//$('#Datos_cliente').modal('toggle');  
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
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val()+'&presentacion2='+$("#presentacion2").val(),
   success: function(x){
   //alert("El dato se registro satisfactoriamente...!");
 //  busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar_inventario_sucursal2(){
//$('#Datos_cliente').modal('toggle');  
$(document).ready(function(){
var codigo=$("#codigoo").val();
var producto=$("#producto").val();
//if(producto==""){
  // var n = noty({
  // text: "Completa la informacion del Producto...!",
  // theme: 'relax',
 //  layout: 'center',
 //  type: 'information',
 //  timeout: 2000,
//})
  // return false;
//}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_inventario_sucursal2.php',
   type: 'POST',
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val()+'&presentacion2='+$("#presentacion2").val(),
   success: function(x){
 //  alert("El dato se registro satisfactoriamente...!");
  // busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
       })
 }
/*******************************************************************************************/  
function guardar_inventario_sucursal3(){
//$('#Datos_cliente').modal('toggle');  
$(document).ready(function(){
var codigo=$("#codigoo").val();
var producto=$("#producto").val();
//if(producto==""){
//   var n = noty({
  // text: "Completa la informacion del Producto...!",
  // theme: 'relax',
 //  layout: 'center',
 //  type: 'information',
 //  timeout: 2000,
//})
  // return false;
//}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_inventario_sucursal3.php',
   type: 'POST',
   data: 'codigo='+$("#codigoo").val()+'&producto='+$("#producto").val()+'&proveedor='+$("#proveedor").val()+'&categoria='+$("#categoria").val()+'&existencia='+$("#existencia").val()+'&minima='+$("#minima").val()+'&maxima='+$("#maxima").val()+'&costo='+$("#costo").val()+'&codigoalterno='+$("#codigooalterno").val()+'&presentacion2='+$("#presentacion2").val(),
   success: function(x){
  // alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
       })
 }
/*******************************************************************************************/  
function guardar_presentaciones(){
this.guardar_presentacion();
var tipodoc=document.title;
if (tipodoc=='Detalle de Compras # 1'){    
//this.guardar_presentacion2();
//this.guardar_presentacion3();
}
}
/*******************************************************************************************/  
function guardar_presentacion(){
$('#Datos_presentacion').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion.php',
   type: 'POST',
   data: 'id='+$("#id").val()+'&presentacion='+$("#presentacion").val()+'&unidades='+$("#unidades").val()+'&precio='+$("#precio").val()+'&tipoprecio='+$("#tipoprecio").val(),
   success: function(x){
//   alert("El dato se registro satisfactoriamente...!");
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
//   alert("El dato se registro satisfactoriamente...!");
//   busca_presenta();;
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
//   alert("El dato se registro satisfactoriamente...!");
//   busca_presenta();;
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function precios(){
 $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#precios").html('<b>Actualizando lista de articulos...</b>');
           },
          url: 'lista_articulos_ventas.php',
          type: 'POST',
          data: null,
          success: function(x){
            $("#precios").html(x);
            $("#tabla_articulo").dataTable();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
      }
/*******************************************************************************/
function busca_articulo(){
$(document).ready(function(){
      var cod=$("#codigo").val().trim();
          if(cod.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_articulo_pventa.php',
          dataType: 'json',
          type: 'POST',
          data: 'codigo='+$("#codigo").val(),
          success: function(data){
            if(data==0){
            alert("No existe el producto...!");
            $("#codigo").val("");
            $("#codigo").focus();
            $("#cantidad").attr("disabled", true);
            $("#preciou").attr("disabled", true);
            }else{
            $(".widget-user-desc").html(data[0].producto);
            pcodigo2=data[0].codigo;
            pproducto=data[0].producto;
            busca_presentacion2();
            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          }else{
          }
          })
         }
 /*************************************************************************************/
 function busca_datos_pedidos(){
//$(document).ready(function(){
         //$(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("<center><img src='dist/img/cargando.gif'></img>");
           },
          url: 'busca_data_pedidos_compra.php',
          dataType: 'json',
          type: 'POST',
          data: 'factura='+$("#factura").val(),
          success: function(data){
            if(data==0){
            alert("No existe la compra...!");
            }else{
            $(".widget-user-desc").html(data[0].Factura);
            $("#totales").html(data[0].Total);
            $("#idcliente_credito").val(data[0].Proveedor);
            $("#nitcliente").val(data[0].Nit);
            pdireccion=data[0].Direccion;
            var vertipo=data[0].tipo;
            ptipo=data[0].tipo;
            
            var vercliente=data[0].Proveedor;
            if (vertipo=='Efectivo'){
              $("#tipo_venta").val("2");
            }
            if (vertipo=='Al Crédito'){
              $("#tipo_venta").val("1");
            }
            $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+vertipo+" a "+vercliente);
            detalle_factura();
            }
           },
           error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          //});
          
  //        })
         }
 /*************************************************************************************/
 function agrega_a_listas(varproductos){
  var alimentos=varproductos;
  var idcl=alimentos.split("|");
 
  pcodigo=idcl[0];
  
  ppreciod=idcl[3];
  //idpublica=idcl[4];
  pcosto=idcl[3];
  pexistencias=idcl[4]; 
  //alert(pcodigo);
  pproducto=idcl[5];
  $("#modal_busqueda_arts").modal('hide'); //ocultar modal
  busqueda_presentacion();
}
/******************************************************************************************/
 function busqueda_presentacion(){
var tipo=$("#tipo_venta").val();
   $("#modal_tabla_presentación").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_tabla_presentación').on('shown.bs.modal', function () {
   busca_presentacion();
   });
}
/*****************************************************************************/
function busca_presentacion(){
  //pcodigo=$("#articulo_buscar").val();
        $.ajax({
        beforeSend: function(){
          $("#lista_presentacion").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda_presentacion.php',
        type: 'POST',
        data: 'producto='+pcodigo+'&existencia='+pexistencias,
        success: function(x){
         $("#lista_presentacion").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_presentacion").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function busca_presentacion2(){
  //pcodigo=$("#articulo_buscar").val();
        $.ajax({
        beforeSend: function(){
          $("#lista_presentacion2").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda_presentacion.php',
        type: 'POST',
        data: 'producto='+pcodigo2,
        success: function(x){
         $("#lista_presentacion2").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_presentacion2").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
 function agrega_a_lista(varproductos){
  /* registrar_detalle_ventas();*/
   $(document).ready(function(){
      var alimentos=varproductos;
            var idcl=alimentos.split("|");
            var producto=idcl[0];
            var presentacion=idcl[2];
            var preciod=idcl[1];
            var uni=idcl[3];
            ppreciod=ppreciod*uni;
            if (uni>1){
            var cantidad =1;
            }else{
            var cantidad = prompt("Ingrese una cantidad");
      //Detectamos si el usuario ingreso un valor
      if (cantidad != null){
      //alert("Ingrese cantidad de elementos al menú " + cantidad);
      
      }
      //Detectamos si el usuario NO ingreso un valor
      else {
      alert("Error: ingrese una cantidad válida");
      
      }
      }
      var precos = prompt("Ingrese precio costo unitario", pcosto);    
      ppreciod=precos;
      var id=idcl[4];
      idpublica=id;
      var total=cantidad*ppreciod;
      totalesmonto=totalesmonto+total;
      $("#totales").html('Q' + totalesmonto.toFixed(2));
      $.ajax({
      beforeSend: function(){
        },

      url: 'Guardar_detalle_compras.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&producto='+pproducto+'&precio='+ppreciod+'&total='+total+'&totales='+totalesmonto+'&codigo='+pcodigo+'&factura='+$("#factura").val()+'&proveedor='+$("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+pdireccion+'&tipo='+ptipo+'&presentacion='+presentacion+'&uni='+uni,
      success: function(x){
       //alert(x);
       $("#codigo").focus();
       detalle_factura();                       
       },
      error: function(jqXHR,estado,error){
      }
       });  
       
      $("#modal_busqueda_arts").modal('hide'); //ocultar modal
      //descargar_alimentos();
      detalle_factura();      
      $("#modal_tabla_presentación").modal('hide'); //ocultar modal
      $("#modal_tabla_presentación2").modal('hide'); //ocultar modal
  /*    $("#modal_tabla_consumos").modal('hide');
            $("#tabla_articulos > tbody").append("<tr><td class='center'>"+id+"</td><td class='center'>"+producto+"</td><td class='center'>"+cantidad+"</td><td class='center'>"+preciod+"</td><td class='center'>"+total.toFixed(2)+"</td><td class='center'><button class='btn btn-block btn-danger btn-xs delete'><i class='fa fa-trash-o fa-fw'></i> Eliminar</button></td></tr>");
      resumen();
      $.ajax({
      beforeSend: function(){
      },
      url: 'seleccionar_alimentos.php',
      type: 'POST',
      data: 'id='+id,
      success: function(x){
      //alert(x);
      },
      error: function(jqXHR,estado,error){
      }
      }); */
    })
         }
/******************************************************************************************/
function agrega(){
  var tipo=$("#tipo_venta").val();
//alert (tipo);
if (ptipo=="Efectivo" || tipo=="Al Crédito" || tipo=="3"){
   $("#modal_tabla_presentación2").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_tabla_presentación2').on('shown.bs.modal', function () {
   busca_articulo();
   });
}else{  
alert ("Especifique el tipo de pedido");  
}   
}
/******************************************************************************************/
function detalle_factura(){
 $(document).ready(function (){
    
       $.ajax({
            beforeSend: function(){
             $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
             },
        url: 'Historial_detalle_compras_mostrar.php',
            type: 'POST',
            data: 'factura='+$("#factura").val(),
            success: function(x){
        $("#data").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });
     
  })
}
/*********************************************************************************/
function eliminar_productos(varproducto){
   //idpublica=id;  
   var alimentos=varproducto;
   var idcl=alimentos.split("|");
           // puni=idcl[0];
            var iidd=idcl[1];
            var coodd=idcl[0];
           // var can=idcl[2];
   var n = noty({
                  text: "Seguro que desea eliminar el producto...?",
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
          url: 'Eliminar_producto_detalle_compras.php',
          type: 'POST',
          data: 'id='+iidd+'&factura='+$("#factura").val()+'&cliente='+$("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+$("#direccion").val()+'&codi='+coodd,
          success: function(x){
             var n = noty({
              text: "Se elimino el producto de la compra...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000,
            });
      //recuperar_alimentos();
            detalle_factura();
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
$(function(){
         // Evento que selecciona la fila y la elimina
		    $(document).on("click",".delete",function(){
	     	var parent = $(this).parents().parents().get(0);
		  $(parent).remove();
           resumen();
           
       	});
       });
/****************************************************************************************/
function pone_num_venta(){
          $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#num_ticket").html("Buscando...");
           },
          url: 'busca_ticket.php',
          type: 'POST',
          data: 'caja='+$("#ncaja").val(),
          success: function(x){
            $("#num_ticket").html("Caja: "+$("#ncaja").val()+" - Ticket # " +x);
           },
           error: function(jqXHR,estado,error){
             $("#num_ticket").html('Hubo un error: '+estado+' '+error);
           }
           });
          });
        }
/*****************************************************************************************/
function resumen(){
  $(document).ready(function(){
            var articulos=0.00;
            var monto=0.00;
            $('#tabla_articulos > tbody > tr').each(function(){
            articulos +=parseFloat($(this).find("td").eq(2).html());
            monto+=parseFloat($(this).find('td').eq(4).html());
            });
            $("#total_articulos").html("Total de Articulos: "+articulos.toFixed(2));
            $("#total_venta").val(monto.toFixed(2));
            $("#totales").html('Q ' + monto.toFixed(2));
            if(articulos>0){
              $("#btn-procesa").prop('disabled', false);
              $("#btn-cancela").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
              $("#btn-cancela").prop('disabled', true);
            }
            })
          }
/********************************************************************************************/
function busca_cliente(){
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
                          url: 'lista_proveedores_contado.php',
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
/*********************************************************************************************/
function busca_cliente_contado(){
      $(document).ready(function(){
               $("#modal_tabla_clientes").modal({
                      show:true,
                      backdrop: 'static',
                      keyboard: false
                    });
                       $.ajax({
                          beforeSend: function(){
                            $("#lista_clientes").html("Cargando los proveedores...");
                          },
                          url: 'lista_proveedores_contado.php',
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
/*********************************************************************************************/
function traslado(){
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
                          url: 'lista_clientes_traslado.php',
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
/*********************************************************************************************/
function pone_cliente(elid){
                 var client=elid;
                 var idcl=client.split("|");
                 $("#idcliente_credito").val(idcl[1]);
                 $("#nitcliente").val(idcl[0]);				 
                 pdireccion=idcl[2];
                 ptipo='Al Crédito';
			     $("#tipo_venta").val("1");
                 $("#modal_tabla_clientes").modal('hide');
                 $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+idcl[1]);
                 $("#btn_cre").attr('disabled', true);
                 //window.alert(client);
               }
/*********************************************************************************************/
function pone_cliente_contado(elid){
                 var client=elid;
                 var idcl=client.split("|");
                 $("#idcliente_credito").val(idcl[1]);
                 $("#nitcliente").val(idcl[0]);
                 pdireccion=idcl[2];
                 ptipo='Efectivo';
 			     $("#tipo_venta").val("2");
                 $("#modal_tabla_clientes").modal('hide');
                 $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+idcl[1]);
                 $("#btn_cre").attr('disabled', false);
                 //window.alert(client);
               }
/*********************************************************************************************/
function pone_cliente_traslado(elid){
                 var client=elid;
                 var idcl=client.split("|");
                 $("#nitcliente").val(idcl[0]);
			     $("#tipo_venta").val("3");				 
                 $("#modal_tabla_clientes").modal('hide');
                 $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button> Traslado a: "+idcl[1]);
                 $("#btn_cre").attr('disabled', false);
                 //window.alert(client);
               }
/*********************************************************************************************/
function quita_cliente(){
  $("#btn_cre").attr('disabled', false);
  $("#tipo_de_venta").html("");
  $("#tipo_venta").val("");         
  $("#idcliente_credito").val("");
}
/***********************************************************************************************/
function prepara_venta(){
  $(document).ready(function(){
   $("#modal_prepara_venta").modal({
        show:true,
        backdrop: 'static',
        keyboard: false
   });
   $('#modal_prepara_venta').on('shown.bs.modal', function () {
   $("#paga_con").select();
   $('#paga_con').focus();
   });
   $("#total_de_venta").val("$ "+ $("#total_venta").val());
   })
}
/***********************************************************************************/
function calcula_cambio(){
   var m1=$("#total_venta").val();
   var m2=$("#paga_con").val();
   var change=parseFloat(m2)-parseFloat(m1);
   $("#el_cambio").val("$ "+change.toFixed(2));
}
/**************************************************************************************/
function busqueda_art(){
var tipo=$("#tipo_venta").val();
//alert (tipo);
if (tipo=="1" || tipo=="2" || tipo=="3"){
   $("#modal_busqueda_arts").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_arts').on('shown.bs.modal', function () {
   $("#lista_articulos").html("");
   $("#articulo_buscar").val("");
   $("#articulo_buscar").focus();
   });
}else{  
alert ("Especifique el tipo de pedido");  
}   
}
/*****************************************************************************/
function busca(){
	var artbuscar=$("#articulo_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda3.php',
        type: 'POST',
        data: 'producto='+artbuscar,
        success: function(x){
         $("#lista_articulos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_articulos").html("Error en la peticion AJAX..."+estado+"      "+error);
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
function busca_producto(){
      $(document).ready(function(){
               $("#modal_busqueda_arts").modal({
                      show:true,
                      backdrop: 'static',
                      keyboard: false
                    });
                       $.ajax({
                          beforeSend: function(){
                            $("#lista_articulos").html("Cargando productos...");
                          },
                          url: 'busca_articulos_ayuda3.php',
                          type: 'POST',
                          data: null,
                          success: function(x){
                            $("#lista_articulos").html(x);
                            $(document).ready(function() {
                             $('#sample-table-3').DataTable();
                            });
                           },
                          error: function(jqXHR,estado,error){
                            $("#lista_articulos").html('Hubo un error: '+estado+' '+error);
                          }
                       });
                       })
                      }
/*********************************************************************************************/
