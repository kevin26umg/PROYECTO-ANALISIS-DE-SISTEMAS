function lista_clientes(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#lista_clientes").html("Recuperando clientes...");
           },
          url: 'pone_clientes_cartera.php',
          type: 'POST',
          data: null,
          success: function(x){
 			$("#lista_clientes").html(x);
            $(".select2").select2();
	       },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/**********************************************************************/
function obtener_nit(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#obtener_nit").html("Recuperando clientes...");
           },
          url: 'busca_data_clientes_abonos.php',
          type: 'POST',
          data: 'nit='+$("#nit").val(),
          success: function(x){
 			$("#obtener_nit").html(x);
            $(".select2").select2();
		   },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/**********************************************************************/
function pone_cliente(elid,varcliente){
                 var client=elid;
                 var idcl=client.split("|");
                 $("#nit").val(idcl[0]);
                 $("#cliente").val(idcl[1]);
				 $("#saldoactual").val(idcl[2]);
                 $("#modal_tabla_clientes").modal('hide');
                 //window.alert(client);
				 $("#abono").focus();
               }
/*********************************************************************************************/
function pone_provs(){
	var buscar=$("#nit").val();
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#pone_provs").html("Recuperando lista de clientes...");
           },
          url: 'lista_clientes_abonos.php',
          type: 'POST',
          data: null,
          success: function(x){
            $("#pone_provs").html(x);
            $(".select2").select2();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
     }
/************************************************************/
function script_guardar(){
var nit=$("#nit").val();
var cliente=$("#cliente").val();
var saldoactual=$("#saldoactual").val();
var abono=$("#abono").val();
var saldofinal=$("#saldofinal").val();
var tipo=$("#tipo").val();
if(nit==""||cliente==""||saldoactual==""||abono==""||saldofinal==""){
   var n = noty({
   text: "Completa la informacion del abono...!",
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
   url: 'guardar_abono_cliente.php',
   type: 'POST',
   data: 'nit='+nit+'&cliente='+cliente+'&saldoactual='+saldoactual+'&abono='+abono+'&saldofinal='+saldofinal+'&tipo='+tipo,
   success: function(x){
   $("#nit").val('');
   $("#cliente").val('');
   $("#saldoactual").val('0.00');
   $("#abono").val('0.00');
   $("#saldofinal").val('');
   alert("El el abono se registro satisfactoriamente...!");
   pone_provs();
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 
 
}
/*******************************************************************************************/
function busca_cuentas_cliente(){
  $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#cartera_clientes").html("Consultando informacion...");
           },
          url: 'consulta_cuenta_cliente.php',
          type: 'POST',
          data: 'idcliente='+$("#cliente").val(),
          success: function(x){
            $("#cartera_clientes").html(x);
           },
           error: function(jqXHR,estado,error){
             $("#cartera_clientes").html(estado+"    "+error);
           }
           });
          });
}
/****************************************************************************/
function abona_ticket(ti){
      var de=ti.split("|");
      var id_client=de[0];
      var nombre_cliente=de[1];
      var serie=de[2];
      var numero=de[3];
      var abonado=de[5];
      var total_ticket=de[4];
      //alert(ti);
      $("#modal_abono_ticket").modal({
        show:true,
        backdrop: 'static',
        keyboard: false
     });
    $('#modal_abono_ticket').on('shown.bs.modal', function () {
    $("#abono").val("");
    //$("#el_resto").val("");
    $("#abono").select();
    $('#abono').focus();
    });
    $("#elidcliente").val(id_client);
    $("#abonado").val(abonado);
    $("#nombre_c").val(nombre_cliente);
    $("#s_ticket").val(serie);
    $("#n_ticket").val(numero);
   $("#total_de_ticket").val(total_ticket);
   calcula_resto();
    }
/**********************************************************************************/
function calcula_resto(){
   var m1=$("#total_de_ticket").val();
   m1=m1.replace(",","");
   var m2=$("#abono").val();
   var m3=$("#abonado").val();
   m3=m3.replace(",","");
   var change=parseFloat(m1)-parseFloat(m3);
   $("#el_resto").val(change.toFixed(2));
}
/***********************************************************************************/
function verifica_abono(){
  var m4=$("#abono").val();
  m4=m4.replace(",","");
  var m5=$("#el_resto").val();
  m5=m5.replace(",","");
  var dif=parseFloat(m5)-parseFloat(m4);
  if(dif>=0){
    $("#btn-procesa-abono").attr("disabled", false);
  }else{
    $("#btn-procesa-abono").attr("disabled", true)
  }
}
/***********************************************************************************/
function procesa_abono(){
   $(document).ready(function(){
     var n = noty({
                  text: "Seguro que desea preocesar el abono...?",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  buttons     : [
                    {addClass: 'btn btn-primary',
                     text    : 'Si',
                     onClick : function ($noty){
                          $noty.close();
                          var serie=$("#s_ticket").val();
                          var numero=$("#n_ticket").val();
                          var monto=$("#abono").val();
                          var id_cliente=$("#elidcliente").val();
          $.ajax({
          beforeSend: function(){
            $("#btn-procesa-abono").html("Procesando...");
           },
          url: 'procesa_abono_ticket.php',
          type: 'POST',
          data: 'serie='+serie+'&numero='+numero+'&monto='+monto+'&id_cliente='+id_cliente,
          success: function(x){
             if(x=='0'){
               alert("Ocurrio un error al registrar el pago, reporte a Soporte inmediatamente...");
             }else{
               $("#btn-procesa-abono").html("<i class='fa fa-print'></i> Procesar");
               $('#modal_abono_ticket').modal('toggle');
               busca_cuentas_cliente();
             }
           },
           error: function(jqXHR,estado,error){
             $("#btn-procesa-abono").html(estado+"    "+error);
           }
           });
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
          });
     }
/***********************************************************************************/
function revisa_pagos(nt){
      var nt=nt.split("|");
      var id_client=nt[0];
      var nombre_cliente=nt[1];
      var serie=nt[2];
      var numero=nt[3];
      //alert(ti);
      $.ajax({
          beforeSend: function(){
            $("#pagos_realizados").html("Buscando... <img src='dist/img/default.gif'></img>");
           },
          url: 'busca_abonos_declientes.php',
          type: 'POST',
          data: 'idcliente='+$("#cliente").val()+'&serie='+serie+'&numero='+numero,
          success: function(x1){
            $("#pagos_realizados").html(x1);
            $("#modal_revisa_pagos").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
           },
           error: function(jqXHR,estado,error){
            alert("Ocurrio un error, reporte a soporte..." +estado+"     "+error);
           }
           });
    }
/**************************************************************************************/
function print_pagos(){
  $(".print_abonos").printArea();
}
/***************************************************************************************/
 function lista_abonos(){
    $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#lista_abonos").html('<b>Actualizando lista de abonos...</b>');
           },
          url: 'lista_clientes_abonos.php',
          type: 'nit='+$("#nit").val(),
          data: null,
          success: function(x){
            $("#lista_abonos").html(x);
            $("#tabla_articulos").dataTable();
		/*	pone_provs();*/
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
 }
 /**********************************************************************************/
 function busca_clientes(){
     $(document).ready(function(){
      var cod=$("#nit").val().trim();
         if(cod.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informacion del cliente...");
           },
          url: 'Lista_clientes_para_abonos.php',
          dataType: 'json',
          type: 'POST',
          data: 'nit='+$("#nit").val(),
          success: function(data){
            if(data==0){
            alert("No existe el cliente...!");
            $("#nit").val("");
            $("#nit").focus();
            }else{
            $(".widget-user-desc").html(data[0].cliente);
            $("#cliente").val(data[0].cliente);
			$("#saldoactual").val(data[0].saldo);
			$("#abono").select();
            $("#abono").focus();
			/*pone_provs();*/
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
 function busca_clientes_abonos(){
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
                          url: 'Lista_clientes_para_abonos.php',
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
 function busqueda_art(){
   $("#modal_busqueda_arts").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_arts').on('shown.bs.modal', function () {
   $("#lista_clientes").html("");
   $("#articulo_buscar").val("");
   $("#articulo_buscar").focus();
   });
}
/*****************************************************************************/
function calculo_saldo_final(){
$saldoactual=$("#saldoactual").val();
$abono=$("#abono").val();
$saldofinal=$saldoactual - $abono;
$("#saldofinal").val($saldofinal);
}
/*****************************************************************************/	
function busca(){
	var artbuscar=$("#articulo_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_clientes").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_clientes_ayuda.php',
        type: 'POST',
        data: 'cliente='+artbuscar,
        success: function(x){
         $("#lista_clientes").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_clientes").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#nit").val(art.trim());

}
/*********************************************************************************/