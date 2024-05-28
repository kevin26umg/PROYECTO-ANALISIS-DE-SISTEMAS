/*FUNCIONES PARA EL PUNTO DE VENTA*/
var pid='';
/************************************************************************************/
function busca_cliente(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_cliente.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].id);
            $("#id").val(data[0].id);
            $("#nit").val(data[0].nit);
            $("#nombre").val(data[0].cliente);
            $("#contacto").val(data[0].contacto);
            $("#direccion").val(data[0].direccion);
            $("#telefono").val(data[0].telefono);
            $("#correo").val(data[0].correo);
            $("#listado").val(data[0].listado_precio);
            $("#saldolimite").val(data[0].saldo_limite);
            $("#plazo").val(data[0].plazo);
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
function eliminar_item(id){
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
          url: 'Eliminar_data_cliente.php',
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
function abonos(idabonos){
  var alimentos=idabonos;
  var idcl=alimentos.split("|");
   $("#boleta").val("");
   $("#idcliente").val(idcl[0]);
   $("#nombrecliente").val(idcl[1]);
   $("#saldoabono").val(idcl[2]);
   $("#abono").val("");
   $("#saldofinalabonos").val("");
   $("#modal_abonos").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_abonos').on('shown.bs.modal', function () {
   $("#abono").focus();
   });
}
/****************************************************************************************/
function guardar_abonos(){
$('#modal_abonos').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_abonos.php',
   type: 'POST',
   data: 'id='+$("#idcliente").val()+'&cliente='+$("#nombrecliente").val()+'&saldoabono='+$("#saldoabono").val()+'&abono='+$("#abono").val()+'&saldofinalabonos='+$("#saldofinalabonos").val(),
   success: function(x){
   alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function reporte_abonos(id){
window.location.href= "Abonos_cliente.php?id="+id;   
 }
/*******************************************************************************************/  
function calcula(){
   var m1=$("#saldoabono").val();
   var m2=$("#abono").val();
   var change=parseFloat(m1)-parseFloat(m2);
   $("#saldofinalabonos").val(change.toFixed(2));
}
/**************************************************************************************/
function modificar_cliente(id){
   abrir_modal_datos_clientes();
   pid=id;
   busca_cliente();
}
/****************************************************************************************/
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
        url: 'busca_lista_clientes.php',
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
});
   return false;
}
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_cliente.php',
   type: 'POST',
   data: 'nit='+$("#nit").val()+'&cliente='+$("#nombre").val()+'&contacto='+$("#contacto").val()+'&direccion='+$("#direccion").val()+'&telefono='+$("#telefono").val()+'&correo='+$("#correo").val()+'&listado='+$("#listado").val()+'&saldolimite='+$("#saldolimite").val()+'&plazo='+$("#plazo").val()+'&saldo='+$("#saldo").val()+'&id='+$("#id").val(),
   success: function(x){
   alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
