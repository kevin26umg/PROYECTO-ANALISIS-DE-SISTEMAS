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
          url: 'Eliminar_data_proveedor.php',
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
function modificar_compra(id){
   //abrir_modal_datos_clientes();
   //pid=id;
   //busca_cliente();
   window.location.href= "Compras.php?id="+id;   
}
/****************************************************************************************/
function imprimir_compra(id){
//abrir_contrato(); 
var id=id;
window.location.href= "Impresion_compra.php?id="+id;   
//window.location.href= "pedidos_modifica.php?id="+id;   
//window.location.href= "prueba_imprimir.php";      
 }
/*******************************************************************************************/
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
        url: 'busca_lista_compras.php',
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
