function obtener_nit(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#obtener_nit").html("Recuperando proveedores...");
           },
          url: 'busca_data_proveedores_abonos.php',
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
function lista_proveedores(){
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
function pone_proveedores(elid,varcliente){
                 var client=elid;
                 var idcl=client.split("|");
                 $("#nit").val(idcl[0]);
                 $("#proveedor").val(idcl[1]);
				 $("#saldoactual").val(idcl[2]);
                 $("#modal_tabla_proveedores").modal('hide');
                 //window.alert(client);
				 $("#abono").focus();
               }
/*********************************************************************************************/
function pone_provs(){
	var buscar=$("#nit").val();
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#pone_provs").html("Recuperando lista de proveedores...");
           },
          url: 'lista_proveedores_abonos.php',
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
var proveedor=$("#proveedor").val();
var saldoactual=$("#saldoactual").val();
var abono=$("#abono").val();
var saldofinal=$("#saldofinal").val();
var tipo=$("#tipo").val();
if(nit==""||proveedor==""||saldoactual==""||abono==""||saldofinal==""){
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
   url: 'guardar_abono_proveedor.php',
   type: 'POST',
   data: 'nit='+nit+'&proveedor='+proveedor+'&saldoactual='+saldoactual+'&abono='+abono+'&saldofinal='+saldofinal+'&tipo='+tipo,
   success: function(x){
   $("#nit").val('');
   $("#proveedor").val('');
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
 function lista_abonos(){
    $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#lista_abonos").html('<b>Actualizando lista de abonos...</b>');
           },
          url: 'lista_proveedores_abonos.php',
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
 function busca_proveedores(){
      $(document).ready(function(){
               $("#modal_tabla_proveedores").modal({
                      show:true,
                      backdrop: 'static',
                      keyboard: false
                    });
                       $.ajax({
                          beforeSend: function(){
                            $("#lista_proveedores").html("Cargando los proveedores...");
                          },
                          url: 'busca_data_proveedores_abonos.php',
                          type: 'POST',
                          data: null,
                          success: function(x){
                            $("#lista_proveedores").html(x);
                            $(document).ready(function() {
                             $('#sample-table-3').DataTable();
                            });
                           },
                          error: function(jqXHR,estado,error){
                            $("#lista_proveedores").html('Hubo un error: '+estado+' '+error);
                          }
                       });
                       })
         }
 /*************************************************************************************/
 function busqueda_art(){
   $("#modal_busqueda_arts").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_arts').on('shown.bs.modal', function () {
   $("#lista_proveedores").html("");
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
          $("#lista_proveedores").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_proveedores_ayuda.php',
        type: 'POST',
        data: 'proveedor='+artbuscar,
        success: function(x){
         $("#lista_proveedores").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_proveedores").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#nit").val(art.trim());
  busca_proveedores();
}
/*********************************************************************************/