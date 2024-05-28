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
var totalboleta=0;
/************************************************************************************/
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
            $("#data_articulo").html("<center><img src='dist/img/cargando.gif'></img>");
           },
          url: 'busca_data_articulo_pventa.php',
          dataType: 'json',
          type: 'POST',
          data: 'codigo='+$("#codigo").val(),
          success: function(data){
            pexistencias=data[0].existencia;
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
            pexistencias=data[0].existencia;
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
  var tipodoc=document.title;  
 $(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },

          url: 'busca_data_pedidos.php',
          dataType: 'json',
          type: 'POST',
          data: 'factura='+$("#factura").val()+'&tipodoc='+tipodoc,
          success: function(data){
            if(data==0){
            alert("No existe el producto...!");
            }else{
            $(".widget-user-desc").html(data[0].Factura);
            $("#totales").html(data[0].Total);
            $("#idcliente_credito").val(data[0].Cliente);
            $("#nitcliente").val(data[0].Nit);
            pdireccion=data[0].Direccion;
            var vertipo=data[0].Tipo;
            ptipo=data[0].Tipo;
            var vercliente=data[0].Cliente;
            if (vertipo=='Efectivo'){
              $("#tipo_venta").val("2");
            }
            if (vertipo=='Al Crédito'){
              $("#tipo_venta").val("1");
            }
            $("#tipo_de_venta").html
            ("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+vertipo+" a "+vercliente);
            detalle_factura();
            if(data[0].Total>0){
              $("#btn-procesa").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
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
 /*************************************************************************************/
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
 function agrega_a_listas(productos){
  var alimentos=productos;
  var idcl=alimentos.split("|");
  pproducto=idcl[0];
  ppreciod=idcl[3];
  //idpublica=idcl[4];
  pcodigo=idcl[4];
  pexistencias=idcl[5];
 // $("#modal_busqueda_arts").modal('hide'); //ocultar modal
  busqueda_presentacion();
}
/******************************************************************************************/
function agrega(){
if (event.keyCode === 13) {
agregaa();  
}
if (event.keyCode === 113) {
busca_data_pedidos();  
}
if (event.keyCode === 121) { //112 f1
busqueda_art()
}
}
/******************************************************************************************/
function agregaa(){
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
function agrega_a_lista(varproductos){
     var alimentos=varproductos;
            var idcl=alimentos.split("|");
            pcodigo=idcl[0];
            ppreciod=idcl[1];
            ppresentacion=idcl[2];
            puni=idcl[3];
            psaldo=idcl[4];
            psaldolimite=idcl[5];
            pfactor=puni;
            var cantidad=puni;
            //alert(pfactor);
            cantidad = prompt("Ingrese una cantidad hola",'1');
            //pfactor=puni;
            pfactor=pfactor*cantidad;      

            var t=ppreciod*puni;
           //alert (pcodigo);
           // alert (psaldo);
            if (ptipo=="Efectivo" || psaldolimite >0.00 & psaldo > t ){
            if (pexistencias >= pfactor   ){
            ppreciod=ppreciod*puni;
            if (puni>=1){
           // pcantidad =1;
           pcantidad=cantidad;
        //    alert (pcodigo);
        //    if ($("#factura").val()=="S/N"){
      this.correlativo();    
      //}    
            guardar_producto();
            //detalle_factura();                       
            }else{
            var cantidad = prompt("Elementos...", "");
      pfactor=pfactor*cantidad;      
      if (cantidad != null  ||   pexistencias > pfactor){
      //var pcodigo=idcl[0];
      pcantidad=cantidad;
      //idpublica=id;
      //var total=cantidad*ppreciod;
      //if ($("#factura").val()=="S/N"){
      this.correlativo();    
      //}    
       guardar_producto();
     // detalle_factura();                       
      }else {
            alert("Error: No hay suficiente existencia para este producto...");
            }
      }}else {
            alert("Error: No hay suficiente existencia para este producto...");
    }}else{
      alert("Error: Su limite de crédito a sido superado...");
    }
    $("#modal_tabla_presentación").modal('hide'); //ocultar modal
    $("#modal_tabla_presentación2").modal('hide'); //ocultar modal
     $("#modal_busqueda_arts").modal('hide'); //ocultar modal
    
  }
/******************************************************************************************/
function mostrar_existencias(exis){
  var alimentos=exis;
  var idcl=alimentos.split("|");
  pproducto=idcl[0];
  ppreciod=idcl[3];
  //idpublica=idcl[4];
  pcodigo=idcl[4];
  pexistencias=idcl[5];
  $("#existencias_sucursales").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
 $('#existencias_sucursales').on('shown.bs.modal', function () {
  precios_sucursales();
  
  });
}
/******************************************************************************************/
function precios_sucursales(){
   $(document).ready(function(){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Precios_sucursales.php',
      type: 'POST',
      data: 'codigo='+pcodigo,
      success: function(x){
      $("#codigo").focus();
      busca_existencias();
      },
      error: function(jqXHR,estado,error){
      }
      });  
    })
     }
/******************************************************************************************/
  function guardar_producto(){
  //busca_datos_pedidos();  
  //if ($("#factura").val()!=''){  
  var tipodoc=document.title;  
  
  $(document).ready(function(){
      var total=pcantidad*ppreciod;
      //alert(pcodigo);
      totalesmonto=parseFloat($("#total_venta").val())+parseFloat(total);
      $("#total_venta").val(totalesmonto);
      $("#totales").html('Q' + totalesmonto.toFixed(2));
      if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3'){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Guardar_detalle_factura.php',
      type: 'POST',
      data: 'cantidad='+pcantidad+'&producto='+pproducto+'&precio='+ppreciod+'&total='+total+'&totales='+totalesmonto+'&codigo='+pcodigo+'&factura='+totalboleta+'&cliente='+$            ("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+pdireccion+'&tipo='+ptipo+'&presentacion='+ppresentacion+'&uni='+puni,
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
       },
      error: function(jqXHR,estado,error){
      }
      });   
    }
    })  
//}else{
  //correlativo();
//}
}
/******************************************************************************************/
function agrega_articulo(agrega){
  var tipodoc=document.title;  
   $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            var codigo=idcl[0];
            var id=idcl[1];
            var preciod=idcl[3];
            var presentacion=idcl[4];
      var cantidad=idcl[2];     
      cantidad=parseFloat(cantidad)+1;
      var total=cantidad*preciod;
        //totalesmonto=totalesmonto+total;
      totalesmonto=parseFloat($("#total_venta").val())+parseFloat(preciod);
      $("#total_venta").val(totalesmonto);
      $("#totales").html('Q' + totalesmonto.toFixed(2));
      
      if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3'){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Modificar_detalle_factura.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+preciod+'&total='+total+'&totales='+totalesmonto+'&id='+id+'&codigo='+codigo+'&presentacion='+presentacion+'&tipo='+ptipo,
      success: function(x){
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
      url: 'Modificar_detalle_cotizacion.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+preciod+'&total='+total+'&totales='+totalesmonto+'&id='+id+'&codigo='+codigo+'&presentacion='+presentacion+'&tipo='+ptipo,
      success: function(x){
      $("#codigo").focus();
      detalle_factura();                       
      },
      error: function(jqXHR,estado,error){
      }
      });
    }
      $("#modal_tabla_presentación").modal('hide'); //ocultar modal
      $("#modal_tabla_presentación2").modal('hide'); //ocultar modal
     //detalle_factura();      
     })

         }
/******************************************************************************************/
function cambiar_precio(agrega){
  var tipodoc=document.title;  
   $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            var codigo=idcl[0];
            var id=idcl[1];
            var preciodd=idcl[3];
            var presentacion=idcl[4];
            var costo=idcl[5];
      var cantidad=idcl[2];     
      //cantidad=parseFloat(cantidad)+1;
      var preciod = prompt("Ingrese un precio válido");
      var total=cantidad*preciod;
        //totalesmonto=totalesmonto+total;
      if (parseFloat(preciod) > parseFloat(costo) ){
      }else{
      alert ('Precio no válido, Precio Costo: '+ costo);
      preciod=preciodd;
      total=cantidad*preciod;
      }
      totalesmonto=parseFloat($("#total_venta").val());
      $("#total_venta").val(totalesmonto);
      $("#totales").html('Q' + totalesmonto.toFixed(2));
     // alert(totalesmonto);
      $.ajax({
      beforeSend: function(){
      },
      url: 'Modificar_precio.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+preciod+'&total='+total+'&totales='+totalesmonto+'&id='+id+'&codigo='+codigo+'&presentacion='+presentacion+'&tipo='+ptipo,
      success: function(x){
      $("#codigo").focus();
      detalle_factura();                       
      },
      error: function(jqXHR,estado,error){
      }
      });  
         
     // $("#modal_tabla_presentación").modal('hide'); //ocultar modal
      //$("#modal_tabla_presentación2").modal('hide'); //ocultar modal
     detalle_factura();      
     })

         }
/******************************************************************************************/
function elimina_articulo(agrega){
  var tipodoc=document.title;  
   $(document).ready(function(){
      var alimentos=agrega;
            var idcl=alimentos.split("|");
            //var producto=idcl[0];
            var codigo=idcl[0];
            var id=idcl[1];
            var preciod=idcl[3];
            var presentacion=idcl[4];
      totalesmonto=0.00;      
      var cantidad=idcl[2];     
      cantidad=parseFloat(cantidad)-1;
      var total=cantidad*preciod;
      //totalesmonto=totalesmonto+total;
      totalesmonto=parseFloat($("#total_venta").val())-parseFloat(preciod);
       $("#total_venta").val(totalesmonto);
      $("#totales").html('Q' + totalesmonto.toFixed(2));
      if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3'){
      $.ajax({
      beforeSend: function(){
      },
      url: 'Eliminar_detalle_factura.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+preciod+'&total='+total+'&totales='+totalesmonto+'&id='+id+'&codigo='+codigo+'&presentacion='+presentacion,
      success: function(x){
      detalle_factura();      
      $("#codigo").focus();

       },
      error: function(jqXHR,estado,error){
      }
      }); 
      }else{
      $.ajax({
      beforeSend: function(){
      },
      url: 'Eliminar_detalle_cotizacion.php',
      type: 'POST',
      data: 'cantidad='+cantidad+'&precio='+preciod+'&total='+total+'&totales='+totalesmonto+'&id='+id+'&codigo='+codigo+'&presentacion='+presentacion,
      success: function(x){
      detalle_factura();      
      $("#codigo").focus();

       },
      error: function(jqXHR,estado,error){
      }
      }); 
      } 
      $("#modal_tabla_presentación").modal('hide'); //ocultar modal
      $("#modal_tabla_presentación2").modal('hide'); //ocultar modal
      })
         }
/******************************************************************************************/

function busqueda_art(){
var tipo=$("#tipo_venta").val();
//alert (tipo);
if (ptipo=="Efectivo" || tipo=="Al Crédito" || tipo=="3"){
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
  if (event.keyCode === 27) {
$("#modal_busqueda_arts").modal('hide'); //ocultar modal
}
	var artbuscar=$("#articulo_buscar").val();
     $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<center><img src='dist/img/cargando.gif'></img>");
          },
        url: 'busca_articulos_ayuda.php',
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
function busca_presentacion(){
  //pcodigo=$("#articulo_buscar").val();
        $.ajax({
        beforeSend: function(){
          $("#lista_presentacion").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda_presentacion.php',
        type: 'POST',
        data: 'producto='+pcodigo+'&existencia='+pexistencias+'&nit='+$("#nitcliente").val(),
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
        data: 'producto='+pcodigo2+'&existencia='+pexistencias,
        success: function(x){
         $("#lista_presentacion2").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_presentacion2").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function busca_existencias(){
  //pcodigo=$("#articulo_buscar").val();
        $.ajax({
        beforeSend: function(){
          $("#lista_existencias").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_articulos_ayuda_existencia.php',
        type: 'POST',
        data: 'producto='+pcodigo+'&existencia='+pexistencias+'&nit='+$("#nitcliente").val(),
        success: function(x){
         $("#lista_existencias").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_existencias").html("Error en la peticion AJAX..."+estado+"      "+error);
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
                          url: 'busca_articulos_ayuda.php',
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
/*****************************************************************************/
function imprimir_pedido(){
//abrir_contrato(); 
//var id=$("#factura").val();
//window.location.href= "Impresion_pedido.php?id="+id;   
window.location.href= "Index.php";   
//window.location.href= "pedidos_modifica.php?id="+id;   
//window.location.href= "prueba_imprimir.php";      
 }
/*******************************************************************************************/
function detalle_factura(){
  var tipodoc=document.title;  
 $(document).ready(function (){
        if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3'){
        $.ajax({
            beforeSend: function(){
             $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
             },
        url: 'Historial_detalle_factura_mostrar.php',
            type: 'POST',
            data: 'factura='+$("#factura").val(),
            success: function(x){
            $("#data").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });     
      }else{
      $.ajax({
            beforeSend: function(){
             $("#data").html("<center><img src='dist/img/cargando.gif'></img>");
             },
        url: 'Historial_detalle_cotizacion_mostrar.php',
            type: 'POST',
            data: 'factura='+$("#factura").val(),
            success: function(x){
        $("#data").html(x);
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });     

      }
  })
}
/***********************************************************************************/
function eliminar_productos(varproducto){
  var tipodoc=document.title;  
   var alimentos=varproducto;
   var idcl=alimentos.split("|");
           // puni=idcl[0];
            var iidd=idcl[1];
            var coodd=idcl[0];

   if (tipodoc=='Envios de Bodega # 1' || tipodoc=='Envios de Bodega # 2' || tipodoc=='Envios de Bodega # 3'){
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
          url: 'Eliminar_producto_detalle_ventas.php',
          type: 'POST',
          data: 'id='+iidd+'&factura='+$("#factura").val()+'&cliente='+$("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+$("#direccion").val()+'&codi='+coodd,
          success: function(x){
             var n = noty({
              text: "Se elimino el producto del pedido...!",
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
}else{
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
          url: 'Eliminar_producto_detalle_cotizaciones.php',
          type: 'POST',
          data: 'id='+iidd+'&factura='+$("#factura").val()+'&cliente='+$("#idcliente_credito").val()+'&nit='+$("#nitcliente").val()+'&direccion='+$("#direccion").val()+'&codi='+coodd,
          success: function(x){
             var n = noty({
              text: "Se elimino el producto del pedido...!",
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
                            $("#lista_clientes").html("Cargando los clientes...");
                          },
                          url: 'lista_clientes_contado.php',
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
function inicial_ventas(){
                 //var client=elid;
                 //var idcl=client.split("|");
                 $("#idcliente_credito").val("Consumidor Final");
                 $("#nitcliente").val("C/F");
                 pdireccion="Ciudad";
                 ptipo='Efectivo';
                 $("#tipo_venta").val("Contado");
                 $("#modal_tabla_clientes").modal('hide');
                 $("#tipo_de_venta").html("<button class='btn btn-danger btn-xs' onclick='quita_cliente();'>Quitar</button>"+ptipo+" a "+$("#idcliente_credito").val());
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
function cancela_venta(){
         $("#btn_cancela").prop("disabled", true);
         var n = noty({
                  text: "Deseas cancelar la venta...?",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  buttons     : [
                    {addClass: 'btn btn-primary',
                     text    : 'Si',
                     onClick : function ($noty){
                          $noty.close();
                          $("#tabla_articulos > tbody:last").children().remove();
                          resumen();
                          cancela_codigo();
                          $("#codigo").focus();
                      }
                   },
                   {addClass: 'btn btn-danger',
                    text    : 'No',
                    onClick : function ($noty){
                      $("#btn_cancela").prop("disabled", false);
                       $noty.close();
                     }
                    }
                  ]
              });
       }
/***************************************************************************************/
function cancela_codigo(){
   $("#preciou").val("");
   $("#cantidad").val("");
   $("#preciou").attr("disabled", true);
   $("#cantidad").attr("disabled", true);
   $("#codigo").val("");
   $("#codigo").focus();
}
/***************************************************************************************/
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
   $("#total_de_venta").val("Q "+ $("#total_venta").val());
   })
}
/***********************************************************************************/
function calcula_cambio(){
   var m1=$("#total_venta").val();
   var m2=$("#paga_con").val();
   var change=parseFloat(m2)-parseFloat(m1);
   $("#el_cambio").val("Q "+change.toFixed(2));
}
/**************************************************************************************/
function pone_foco_ini(){
  $("#codigo").focus();
}
/**************************************************************************************/
function procesa_venta(){
  $(document).ready(function(){
    /*busca el numero de ticket*/
    var n_tic='';
      $.ajax({
          url: 'busca_ticket.php',
          type: 'POST',
          data: 'caja='+$("#ncaja").val(),
          success: function(x){
            n_tic=x;
           },
           error: function(jqXHR,estado,error){
             alert('Hubo un error, no se pudo establecer el numero de ticket, reporte a soporte!! '+estado+' '+error);
           }
           });
      ////******************************/////
    setTimeout('actualiza_ticket()',1000);
    $('#modal_prepara_venta').modal('toggle');
         var credi='0';
         var clients='0';
          //$("#btn-procesa").prop('disabled', true);
           if($('#idcliente_credito').val()!=""){
             credi='1';
             clients=$("#idcliente_credito").val();
         }
     
   /* var factura=$("#factura").val();*/
       
           var yapuso=0;
           $('#tabla_articulos > tbody > tr').each(function(){
                var descripcion_art=$(this).find('td').eq(1).html();
                var cod = $(this).find('td').eq(0).html();
                var can = $(this).find('td').eq(2).html();
                var preciou  = $(this).find('td').eq(3).html();
                var monto=$(this).find('td').eq(4).html();
                         $.ajax({
                             beforeSend: function(){
                              },
                             url: 'procesa_venta.php',
                             type: 'POST',
                             data: 'codigo='+cod+'&cantidad='+can+'&preciou='+preciou+'&credito='+credi+'&clienteid='+clients,
                             success: function(x){
                                  var n = noty({
                                   text: "Procesando venta...  articulo actual: "+cod,
                                   theme: 'relax',
                                   layout: 'topLeft',
                                   type: 'success',
                                   timeout: 2000,
                                  });
                               if(yapuso==0){
                               llena_ticket_archivo(cod,can,preciou,descripcion_art,yapuso,monto,$("#totales").html(),$("#paga_con").val(),$("#el_cambio").val(),n_tic);
                 guardar_detalle_ventas(cod,can,preciou,descripcion_art,yapuso,monto,$("#totales").html(),$("#paga_con").val(),$("#el_cambio").val(),n_tic);
                               yapuso=1;
                               }else{
                               llena_ticket_archivo(cod,can,preciou,descripcion_art,yapuso,monto,$("#totales").html(),$("#paga_con").val(),$("#el_cambio").val(),n_tic);
                 guardar_detalle_ventas(cod,can,preciou,descripcion_art,yapuso,monto,$("#totales").html(),$("#paga_con").val(),$("#el_cambio").val(),n_tic);
                               }
                 
                              },
                             error: function(jqXHR,estado,error){
                               $("#errores").html('Error... '+estado+'  '+error);
                              }
                             });
                           });
                      var total=$("#total_venta").val();
              var nitcliente=$("#nitcliente").val();
              var tipo_venta=$("#tipo_venta").val();
              $.ajax({
              url: 'registrar_venta.php',
              type: 'POST',
              data: 'total='+total+'&nitcliente='+nitcliente+'&tipo_venta='+tipo_venta,
              success: function(x){
              n_tic=x;
               },
               error: function(jqXHR,estado,error){
               alert('Hubo un error, no se pudo establecer el numero de ticket, reporte a soporte!! '+estado+' '+error);
               }
               });
            ////******************************/////
                         })
                        }
/*******************************************************************************************/
function actualiza_ticket(){
  $(document).ready(function(){
    $.ajax({
                             beforeSend: function(){
                              },
                             url: 'update_numero_ticket.php',
                             type: 'POST',
                             data: 'caja='+$("#ncaja").val(),
                             success: function(x){
                               //alert("Se actualizo el numero de ticket");
                               $("#tabla_articulos > tbody:last").children().remove();
                                resumen();
                                quita_cliente();
                                $("#codigo").focus();
                              },
                             error: function(jqXHR,estado,error){
                               $("#errores").html('Error... '+estado+'  '+error);
                              }
                             });
                             pone_num_venta();
                             $(".print_ticket").printPage({
                               url: "ticket.txt",
                               attr: "href",
                               message:"Generando vista previa del ticket.."
                             })
                             $(".print_ticket").click();
                             })
}
/*******************************************************************************************/
function correlativo(){
    //<script type="text/javascript">
       $(document).ready(function(){
          $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informaci\u00f3n...");
           },
          url: 'Correlativo_facturas.php',
          dataType: 'json',
          type: 'POST',
          data: null,
          success: function(data){
            if(data==0){
      //var numero=1;
      //var boleta=parseInt(numero);
      //$("#factura").val(Boleta);
            }else{
            $(".widget-user-desc").html(data[0].Factura);
      $("#factura").val(data[0].Factura);
      totalboleta=data[0].Factura;
      var numero=1;
      totalboleta=parseInt(totalboleta) + parseInt(numero);
      $("#factura").val(totalboleta);
            }
            //guardar_producto();
           },
           error: function(jqXHR,estado,error){
        alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          })
    //</script>
}