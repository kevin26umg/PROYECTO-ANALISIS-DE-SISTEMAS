/*FUNCIONES PARA EL PUNTO DE VENTA*/
var pid='';
var ppresentacion='';
/************************************************************************************/
function busqueda_art(){
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

}
/*****************************************************************************/
function buscaaa(){
  var artbuscar=$("#articulo_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_articulos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_codigo_ayuda.php',
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
function agrega_a_listas(id){
  $("#id").val(id);
  $("#modal_busqueda_arts").modal('hide'); //ocultar modal
  //busqueda_presentacion();
}
/******************************************************************************************/
function busca_presentacion(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_presentacion.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid+'&presentacion='+ppresentacion,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].codigo);
            $(".widget-user-desc").html(data[0].presentacion);
            $("#id").val(data[0].codigo);
            $("#presentacion").val(data[0].presentacion);
            $("#unidades").val(data[0].unidades);
            $("#precio").val(data[0].precio);
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
 function busca_categoria(){
$(document).ready(function(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del articulo...");
           },
          url: 'busca_data_categoria.php',
          dataType: 'json',
          type: 'POST',
          data: 'id='+pid,
          success: function(data){
            if(data==0){
            }else{
            $(".widget-user-desc").html(data[0].id);
            $("#idd").val(data[0].id);
            $("#categoria").val(data[0].categoria);
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
function eliminar_item2(id){
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
          url: 'Eliminar_data_categoria.php',
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
            busca2();
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
   ppresentacion=idcl[1];
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
function modificar_presentacion(id){
   var alimentos=id;
   var idcl=alimentos.split("|");
   pid=idcl[0];
   ppresentacion=idcl[1];
   abrir_modal_datos_presentacion();
  // pid=id;
   busca_presentacion();
}
/****************************************************************************************/
function modificar_categoria(id){
   abrir_modal_datos_categoria();
   pid=id;
   busca_categoria();
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
function abrir_modal_datos_presentacion(){
   $("#id").val("");
   $("#presentacion").val("");
   $("#unidades").val("");
   $("#precio").val("");
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
function abrir_modal_datos_categoria(){
   $("#idd").val("");
   $("#categoria").val("");
   $("#Datos_categoria").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#Datos_categoria').on('shown.bs.modal', function () {
   $("#idd").focus();
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
        url: 'busca_presentacion.php',
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
function busca2(){
  var artbuscar=$("#codigo2").val();
    $.ajax({
        beforeSend: function(){
          $("#data2").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_categoria.php',
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
function guardar_categoria(){
$('#Datos_categoria').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_categoria.php',
   type: 'POST',
   data: 'id='+$("#idd").val()+'&categoria='+$("#categoria").val(),
   success: function(x){
//   alert("El dato se registro satisfactoriamente...!");
   busca2();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
function guardar(){
$('#Datos_presentacion').modal('toggle');  
   $.ajax({
   beforeSend: function(){
   },
   url: 'Guardar_presentacion.php',
   type: 'POST',
   data: 'id='+$("#id").val()+'&presentacion='+$("#presentacion").val()+'&unidades='+$("#unidades").val()+'&precio='+$("#precio").val(),
   success: function(x){
//   alert("El dato se registro satisfactoriamente...!");
   busca();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/  
