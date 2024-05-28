function agrega_a_lista(){
   $(document).ready(function(){
            var nombrec=$("#nombrec").val();
			var debe=0.00;
			var haber=0.00;
			debe=$("#debe").val();
			if (debe==''){
			debe=0.00;
			}
            haber=$("#haber").val();
			if (haber==''){
			haber=0.00;
			}
			$("#tabla_articulos > tbody").append("<tr><td class='center'>"+nombrec+"</td><td class='center'>"+debe+"</td><td class='center'>"+haber+"</td><td class='center'><button class='btn btn-block btn-danger btn-xs delete'><i class='icon-trash bigger-40'></i> Eliminar</button></td></tr>");
            $("#nombrec").val("");
            $("#debe").val("");
            $("#haber").val("");
			$("#cuentac").val("");
            $("#fecha2").attr("disabled", true);
            $("#cuentac").focus();
            resumen();
            })
         }
/******************************************************************************************/
function resumen(){
  $(document).ready(function(){
            var articulos=0.00;
            var monto=0.00;
            var montoo=0.00;
			$('#tabla_articulos > tbody > tr').each(function(){
            articulos +=parseFloat($(this).find("td").eq(2).html());
            monto+=parseFloat($(this).find('td').eq(1).html());
            montoo+=parseFloat($(this).find('td').eq(2).html());
            });
/*            $("#total_articulos").html("Total de Articulos: "+articulos.toFixed(2));*/
            $("#totaldebe").val(monto);
			$("#totalhaber").val(montoo);
/*            $("#total_debe").html('Q' + totald.toFixed(2));*/
            if(articulos>0){
        /*      $("#btn-procesa").prop('disabled', false);
              $("#btn-cancela").prop('disabled', false);*/
            }else{
/*              $("#btn-procesa").prop('disabled', true);
              $("#btn-cancela").prop('disabled', true);*/
            }
            })
          }
/********************************************************************************************/
$(function(){
         // Evento que selecciona la fila y la elimina
		    $(document).on("click",".delete",function(){
	     	var parent = $(this).parents().parents().get(0);
		  $(parent).remove();
           resumen();
           
       	});
       });
/****************************************************************************************/
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
function documento_correlativo(){
	  $(document).ready(function(){
          $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informaci\u00f3n...");
           },
          url: 'Documento_bancos.php',
          dataType: 'json',
          type: 'POST',
          data: 'cuenta='+$("#cuenta").val(),
          success: function(data){
            if(data==0){
		    var numero=1;
			var totalboleta=parseInt(numero);
			$("#documento").val(totalboleta);
            }else{
            $(".widget-user-desc").html(data[0].boleta);
			$("#documento").val(data[0].boleta);
			var totalboleta=$("#documento").val();
			var numero=1;
			totalboleta=parseInt(totalboleta) + parseInt(numero);
			$("#documento").val(totalboleta);
            }
           },
           error: function(jqXHR,estado,error){
	    	alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
          })
     }
/************************************************************/
function script_guardar(){
var fecha=$("#fecha").val();
var cuenta=$("#cuenta").val();
var nombre=$("#nombre").val();
var banco=$("#banco").val();
var documento=$("#documento").val();
var beneficiario=$("#beneficiario").val();
var concepto=$("#concepto").val();
var monto=$("#monto").val();
if(fecha==""||cuenta==""||nombre==""||cuenta==""||banco==""||beneficiario==""||concepto==""||monto==""){
   var n = noty({
   text: "Completa la informacion del Cheque...!",
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
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/
 function lista_bancos(){
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
            $("#data_articulo").html("Buscando informaci\u00f3n...");
           },
          url: 'busca_data_clientes2.php',
          dataType: 'json',
          type: 'POST',
          data: 'nit='+$("#nit").val(),
          success: function(data){
            if(data==0){
            alert("No existe el dato...!");
            $("#nit").val("");
            $("#nit").focus();
            }else{
            $(".widget-user-desc").html(data[0].cliente);
            $("#nit2").val(data[0].nit);
			$("#cliente2").val(data[0].cliente);
			$("#telefono2").val(data[0].telefono);
			$("#direccion2").val(data[0].direccion);
		    $("#modelo").select();
            $("#modelo").focus();
		/*	documento_correlativo();*/
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
 function obtener_vehiculo(){
     $(document).ready(function(){
      var cod=$("#nit").val().trim();
         if(cod.trim()!=""){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informaci\u00f3n...");
           },
          url: 'busca_data_vehiculos2.php',
          dataType: 'json',
          type: 'POST',
          data: 'nit='+$("#nit").val(),
          success: function(data){
            if(data==0){
            alert("No existe el dato...!");
            $("#nit").val("");
            $("#nit").focus();
            }else{
            $(".widget-user-desc").html(data[0].cliente);
            $("#nit").val(data[0].nit);
			$("#cliente").val(data[0].cliente);
			$("#telefono").val(data[0].telefono);
			$("#direccion").val(data[0].direccion);
			$("#placas").val(data[0].placa);
			$("#modelo").val(data[0].modelo);
			$("#marca").val(data[0].marca);
			$("#color").val(data[0].color);
			$("#estilo").val(data[0].estilo);
			$("#kilometraje").val(data[0].kilometraje);
			$("#motor").val(data[0].motor);
			$("#chasis").val(data[0].chasis);
			$("#cc").val(data[0].cc);
		    $("#modelo").select();
            $("#modelo").focus();
		/*	documento_correlativo();*/
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
 function busqueda_vehiculos(){
   $("#modal_busqueda_vehiculos").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_vehiculos').on('shown.bs.modal', function () {
   $("#lista_vehiculos").html("");
   $("#vehiculo_buscar").val("");
   $("#vehiculo_buscar").focus();
   });
}
/*****************************************************************************/
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
function polizas(){
   $("#modal_polizas").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_polizas').on('shown.bs.modal', function () {
   $("#lista_proveedores").html("");
   $("#placa2").focus();
   });
}
/*****************************************************************************/
function nuevo_cliente(){
   $("#modal_busqueda_clientes").modal({
             show:true,
             backdrop: 'static',
             keyboard: false
            });
   $('#modal_busqueda_clientes').on('shown.bs.modal', function () {
   $("#lista_proveedores").html("");
   $("#nit3").focus();
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
        url: 'busca_data_clientes.php',
        type: 'POST',
        data: 'cliente='+artbuscar,
        success: function(x){
         $("#lista_proveedores").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_proveedores").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function busca_vehiculo(){
	var artbuscar=$("#vehiculo_buscar").val();
    $.ajax({
        beforeSend: function(){
          $("#lista_vehiculos").html("<img src='dist/img/default.gif'></img>");
          },
        url: 'busca_data_vehiculos.php',
        type: 'POST',
        data: 'cliente='+artbuscar,
        success: function(x){
         $("#lista_vehiculos").html(x);
         },
        error: function(jqXHR,estado,error){
          $("#lista_vehiculos").html("Error en la peticion AJAX..."+estado+"      "+error);
        }
       });
}
/*****************************************************************************/
function add_art(art){
  //alert(art);
  $("#modal_busqueda_arts").modal("toggle");
  $("#nit").val(art.trim());
  busca_clientes();
}
/*********************************************************************************/
function add_art_vehiculos(art){
  //alert(art);
  $("#modal_busqueda_vehiculos").modal("toggle");
  $("#nit").val(art.trim());
  obtener_vehiculo();
}
/*********************************************************************************/
function busca_cuenta(){
	      var nombrec=$("#nombrec").val();
		  $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
            $("#data_articulo").html("Buscando informaci\u00f3n...");
           },
          url: 'busca_data_nomeclatura.php',
          dataType: 'json',
          type: 'POST',
          data: 'nombrec='+nombrec,
          success: function(data){
            if(data==0){
            alert("No existe el dato...!");
            }else{
            $(".widget-user-desc").html(data[0].cuenta);
            $("#cuentac").val(data[0].cuenta);
			$("#debe").select();
            $("#debe").focus();
	        }
           },

		    error: function(jqXHR,estado,error){
            alert("Parece ser que hay un error por favor, reportalo a Soporte inmediatamente...!");
           }
           });
          });
        
         }
 /*************************************************************************************/
 function guardar(){
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
           var yapuso=0;
           $('#tabla_articulos > tbody > tr').each(function(){
                var nomcue = $(this).find('td').eq(0).html();
                var deb = $(this).find('td').eq(1).html();
                var hab  = $(this).find('td').eq(2).html();
                             $.ajax({
                             beforeSend: function(){
                              },
                             url: 'procesa_venta.php',
                             type: 'POST',
                             data: 'codigo='+cod+'&cantidad='+can+'&preciou='+preciou+'&credito='+credi+'&clienteid='+clients+'&caja='+$("#ncaja").val(),
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
                          })
                        }
/*******************************************************************************************/
function guardar_cheques(param1,param2,param3,param4,param5,param6,param7,param8,param9,param10){
   var cod=param1;
   var can=param2;
   var preciou=param3;
   var descripcion=param4;
   var serie=$("#ncaja").val();
   var yapuso=param5;
   var monto=param6;
   var total=param7;
   var pago=param8;
   var cambio=param9;
   var nn=param10;
  /* var factura=$("#factura").val();*/
   $.ajax({
        beforeSend: function(){
          },
        url: 'registrar_detalle_ventas.php',
        type: 'POST',
		data: 'codigo='+cod+'&cantidad='+can+'&preciou='+preciou+'&descripcion='+descripcion+'&serie='+serie+'&yapuso='+yapuso+'&monto='+monto+'&total='+total+'&supago='+pago+'&cambio='+cambio+'&numero_ticket='+nn,
        success: function(x){
         //alert(x);
         },
        error: function(jqXHR,estado,error){
        }
       });
}
/************************************************************************************/
function guardar_cliente(){
var nit=$("#nit3").val();
var cliente=$("#cliente3").val();
var direccion=$("#direccion3").val();
var telefono=$("#telefono3").val();
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
   url: 'guardar_cliente.php',
   type: 'POST',
   data: 'nit='+nit+'&cliente='+cliente+'&direccion='+direccion+'&telefono='+telefono,
   success: function(x){
   $("#nit3").val('');
   $("#cliente3").val('');
   $("#direccion3").val('');
   $("#telefono3").val('');
   alert("Los datos se guardaron satisfactoriamente...!");
   $("#modal_busqueda_clientes").modal("hide");
   $("#articulo_buscar").focus();
   },
   error: function(jqXHR,estado,error){
   }
   }); 
 }
/*******************************************************************************************/
function guardar_vehiculo(){
var placa=$("#placa2").val();
var marca=$("#marca2").val();
var estilo=$("#estilo2").val();
var modelo=$("#modelo2").val();
var color=$("#color2").val();
var kilometraje=$("#kilometraje2").val();
var cliente=$("#cliente2").val();
var telefono=$("#telefono2").val();
var direccion=$("#direccion2").val();
var nit=$("#nit2").val();
var motor=$("#motor2").val();
var chasis=$("#chasis2").val();
var cc=$("#cc2").val();
if(placa==""||marca==""||estilo==""||modelo==""||color==""||kilometraje==""||nit==""||cliente==""||direccion==""||telefono==""||motor==""||chasis==""||cc==""){
   var n = noty({
   text: "Completa la informacion del Vehículo...!",
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
   url: 'guardar_vehiculo.php',
   type: 'POST',
   data: 'placa='+placa+'&marca='+marca+'&estilo='+estilo+'&modelo='+modelo+'&color='+color+'&kilometraje='+kilometraje+'&cliente='+cliente+'&telefono='+telefono+'&direccion='+direccion+'&nit='+nit+'&motor='+motor+'&chasis='+chasis+'&cc='+cc,
   success: function(x){
   $("#placa2").val('');
   $("#marca2").val('');
   $("#estilo2").val('');
   $("#moodelo2").val('');
   $("#color").val('');
   $("#kilometraje2").val('');
   $("#nit2").val('');
   $("#cliente2").val('');
   $("#direccion2").val('');
   $("#telefono2").val('');
   $("#motor2").val('');
   $("#chasis2").val('');
   $("#cc2").val('');
   alert("Los datos se guardaron satisfactoriamente...!");
   $("#modal_polizas").modal("hide");
   },
        error: function(jqXHR,estado,error){
        }
       }); 
 }
/*******************************************************************************************/
function cerrar_ventana_cliente(){
 $("#modal_busqueda_clientes").modal("hide");
 $("#articulo_buscar").focus();	
}
/*******************************************************************************************/
function cerrar_ventana_vehiculo(){
 $("#modal_polizas").modal("hide");
 $("#vehiculo_buscar").focus();	
}
/*******************************************************************************************/
