/*FUNCIONES PARA EL PUNTO DE VENTA*/
var pid='';
/************************************************************************************/
$(function(){
      $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Esta semana': [moment().startOf('week'), moment().endOf('week')],
        'Este dia': [moment(), moment()],
                'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Los ultimos 7 dias': [moment().subtract(6, 'days'), moment()],
                'Los ultimos 30 dias': [moment().subtract(29, 'days'), moment()],
                'Este mes': [moment().startOf('month'), moment().endOf('month')],
                'El mes pasado': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('.fe').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          var xstart=start.format('YYYY-MM-DD');
          var xend=end.format('YYYY-MM-DD');
          $("#fi").val(xstart);
          $("#ff").val(xend);
          //alert(start.format('YYYY-MM-DD')+'    '+end.format('YYYY-MM-DD'));
         }
        );
       });
/******************************************************************************************/
////VERIFICAR
function busca_cliente(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_proveedor.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].id);
            $("#id").val(data[0].id);
            $("#nit").val(data[0].nit);
            $("#nombre").val(data[0].proveedor);
            $("#contacto").val(data[0].contacto);
            $("#direccion").val(data[0].direccion);
            $("#telefono").val(data[0].telefono);
            $("#correo").val(data[0].correo);
            $("#saldo").val(data[0].saldo);
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
function anular_pedido(id){
   pid=id;  
   var n = noty({
                  text: "Seguro que desea anular el pedido...?",
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
          url: 'Anular_pedido.php',
          type: 'POST',
          data: 'id='+pid,
          success: function(x){
             var n = noty({
              text: "Se anulo el pedido...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000,
            });
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
function modificar_pedido(id){
   //abrir_modal_datos_clientes();
   //pid=id;
   //busca_cliente();
   window.location.href= "pedidos_modifica.php?id="+id;   
}
/****************************************************************************************/
function imprimir_pedido(id){
//abrir_contrato(); 
var id=id;
window.location.href= "Impresion_pedido.php?id="+id;   
//window.location.href= "pedidos_modifica.php?id="+id;   
//window.location.href= "prueba_imprimir.php";      
 }
/*******************************************************************************************/
////VERIFICAR
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
////VERIFICAR
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
        url: 'busca_lista_pedidos.php',
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
function busca_cotizaciones(){
  var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_lista_cotizaciones.php',
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
function busca_traslados(){
  var artbuscar=$("#codigo").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_traslados.php',
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
function busca_corte(){
  var artbuscar=$("#usuario").val();
    $.ajax({
        beforeSend: function(){
          $("#data").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_corte_caja.php',
        type: 'POST',
        data: 'usuario='+$("#usuario").val()+'&fechai='+$("#fi").val()+'&fechaf='+$("#ff").val(),
        success: function(x){
         $("#data").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#data").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
////VERIFICAR
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#codigo").val(art.trim());
  busca_articulo();
}
/*********************************************************************************/
////VERIFICAR
function guardar(){
$('#Datos_cliente').modal('toggle');  
var nit=$("#nit").val();
var cliente=$("#nombre").val();
if(nit==""||cliente==""){
   var n = noty({
   text: "Completa la informacion del Cliente...!",
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
   url: 'Guardar_proveedor.php',
   type: 'POST',
   data: 'nit='+$("#nit").val()+'&cliente='+$("#nombre").val()+'&contacto='+$("#contacto").val()+'&direccion='+$("#direccion").val()+'&telefono='+$("#telefono").val()+'&correo='+$("#correo").val()+'&listado='+$("#listado").val()+'&saldolimite='+$("#saldolimite").val()+'&plazo='+$("#plazo").val()+'&saldo='+$("#saldo").val()+'&id='+$("#id").val(),
   success: function(x){
//   alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
///SOLO SIRVE PARA JALAR PRECIOS POR PRESENTACIÓN
function Implementacion(){
//$('#Datos_cliente').modal('toggle');  
//var nit=$("#nit").val();
//var cliente=$("#nombre").val();
//if(nit==""||cliente==""){
  // var n = noty({
  // text: "Completa la informacion del Cliente...!",
   //theme: 'relax',
  // layout: 'center',
  // type: 'information',
   //timeout: 2000,
//})
  // return false;
//}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Implementacion.php',
   type: 'POST',
   data: 'nit='+$("#nit").val()+'&cliente='+$("#nombre").val()+'&contacto='+$("#contacto").val()+'&direccion='+$("#direccion").val()+'&telefono='+$("#telefono").val()+'&correo='+$("#correo").val()+'&listado='+$("#listado").val()+'&saldolimite='+$("#saldolimite").val()+'&plazo='+$("#plazo").val()+'&saldo='+$("#saldo").val()+'&id='+$("#id").val(),
   success: function(x){
//   alert("El dato se registro satisfactoriamente...!");
//   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function traslados(id){
pid=id;
var tipo=$("#tipo_venta").val();
   $("#sucursales").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#sucursales').on('shown.bs.modal', function () {
   busca_sucursales();
   });
}
/*****************************************************************************/
function busca_sucursales(){
        pcodigo='';
        $.ajax({
        beforeSend: function(){
          $("#lista_sucursales").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_sucursales.php',
        type: 'POST',
        data: 'producto='+pcodigo,
        success: function(x){
         $("#lista_sucursales").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_sucursales").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });

}
/*****************************************************************************/
function guardar_traslado(varid){
   var tipodoc=document.title;

   $("#sucursales").modal('hide'); 
   $.ajax({
   beforeSend: function(){
   },
   url: 'Traslado.php',
   type: 'POST',
   data: 'id='+pid+'&idd='+varid+'$tipodoc='+tipodoc,
   success: function(x){
   busca();   
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function descargar_inventario(varid){
   var alimentos=varid;
   var idcl=alimentos.split("|");
   var codigo=idcl[0];
   var fa=idcl[1];
   var cantidad=idcl[2];     
   
   //alert (fa);
   var tipodoc=document.title;
   $("#sucursales").modal('hide'); 
   $.ajax({
   beforeSend: function(){
   },
   url: 'Actualizar_existencias_traslados.php',
   type: 'POST',
   data: 'codigo='+codigo+'&cantidad='+cantidad+'&fa='+fa,
   success: function(x){
   busca_traslados(); 
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function corte(){
var id=$("#ff").val();
var idfi=$("#fi").val();
window.location.href= "corte_de_caja.php?varf="+encodeURIComponent(id)+' &vari=' + encodeURIComponent(idfi);
}
/*******************************************************************************************/