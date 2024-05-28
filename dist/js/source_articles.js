/***********************************************************/
$(function(){
      $('#daterange-btn').daterangepicker(
            {
              ranges: {
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
 function pone_provs(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#marca").html("Recuperando lista de marcas...");
           },
          url: 'pone_provs.php',
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
function mostrar_productos(){
 $(document).ready(function (){
    if($("#fi").val()!=""||$("#ff").val()!=""){
       $.ajax({
            beforeSend: function(){
             $("#data").html("Buscando productos vendidos por fecha, un momento...");
             },
            url: 'Productos_vendidos_mostrar.php',
            type: 'POST',
            data: 'fechai='+$("#fi").val()+'&fechaf='+$("#ff").val(),
            success: function(x){
               $("#data").html(x);
               botones();
              },
            error: function(jqXHR,estado,error){
               $("#data").html(estado+"   "+error);
              }
          });
     }else{
      alert("Ingresa las fechas de busqueda..");
    }
  })
}
/**********************************************************************************/
function pone_lineas(){
        $( document ).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#pone_lineas").html("Recuperando lista de lineas...");
           },
          url: 'pone_lineas.php',
          type: 'POST',
          data: null,
          success: function(x){
            $("#pone_lineas").html(x);
            $(".select2").select2();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/***************************************************************/
function pone_grupos(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
            $("#pone_grupos").html("Recuperando lista de grupos...");
           },
          url: 'pone_grupos.php',
          type: 'POST',
          data: 'linea='+$("#linea").val(),
          success: function(x){
            $("#pone_grupos").html(x);
            $(".select2").select2();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/***************************************************************/
function alta_articulo(){
          var codigo=$("#codigo").val();
          var descripcion=$("#descripcion").val();
          var marca=$("#marca").val();
		  var precio=$("#precio").val();
		  var costo=$("#costo").val();
          var existencia=$("#existencia").val();
		  var minima=$("#minima").val();
          var fecha_cad=$("#fecha_caducidad").val();
		  var estanteria=$("#estanteria").val();
		  var departamento=$("#departamento").val();
		  var presentacion=$("#presentacion").val();
		  var codigointerno=$("#codigointerno").val();
  		  var codigoreferencia=$("#codigoreferencia").val();
          if(codigo==""||descripcion==""){
            var n = noty({
                 text: "Completa la informacion del articulo...!",
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
              url: 'save_articulo.php',
              type: 'POST',
              data: 'codigo='+codigo+'&descripcion='+descripcion+'&marca='+marca+'&precio='+precio+'&costo='+costo+'&existencia='+existencia+'&minima='+minima+'&fecha_caducidad='+fecha_cad+'&estanteria='+estanteria+'&departamento='+departamento+'&presentacion='+presentacion+'&codigointerno='+codigointerno+'&codigoreferencia='+codigoreferencia,
              success: function(x){
                $("#btn-altas").prop('disabled', true);
                if(x==3){
                 alert("El codigo del articulo ya se encuentra registrado...!");
                 $("#btn-altas").prop('disabled', false);
                }

                if(x==1){
                 $("#codigo").prop('disabled', true);
              /*   lista_articulos();*/
                 var n = noty({
                  text: "Se registro el articulo, Deseas agregar una imagen...?",
                  theme: 'relax',
                  layout: 'center',
                  type: 'information',
                  buttons     : [
                    {addClass: 'btn btn-primary',
                     text    : 'Si',
                     onClick : function ($noty){
                          $noty.close();
                          $('#btn-imagen').uploadify({
                          'buttonClass': 'btn btn-success',
                          'swf'      : 'plugins/uploadify/uploadify.swf',
                          'uploader' : 'uploadify.php',
                          'buttonText' : 'Agregar Imagen...',
                          'multi' : false,
                          'removeTimeout': 2,
                          'cancelImg' : 'plugins/uploadify/uploadify-cancel.png',
                          'checkExisting' : 'check-exists.php',
                          'onUploadStart' : function() {
                              $("#btn-imagen").uploadify("settings", "formData", {'codigo' : $("#codigo").val()});
                             },
                          'onUploadSuccess' : function(file, data, response){
                            var n = noty({
                                text: "Se guardo la imagen con nombre de archivo "+ file.name,
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 3000,
                                });
                              $("#codigo").prop('disabled', false);
                              $("#codigo").val('');
                              $("#descripcion").val('');
                              $("#costo").val('0.00');
                              $("#precio").val('0.00');
						      $("#presentacion").val('');
							  $("#existencia").val('');
							  $("#minima").val('');
							 
							  $("#estanteria").val('');
                              $("#btn-imagen").empty();
                              $("#btn-imagen-queue").empty();
                              $("#btn-altas").prop('disabled', false);
                             }
                         });
                      }
                   },
                   {addClass: 'btn btn-danger',
                    text    : 'No',
                    onClick : function ($noty){
                       $noty.close();
                       $("#codigo").prop('disabled', false);
                       $("#codigo").val('');
                       $("#descripcion").val('');
                       $("#costo").val('0.00');
                       $("#precio").val('0.00');
					   $("#presentacion").val('');
					   $("#existencia").val('');
					   $("#minima").val('');
					   
					   $("#estanteria").val('');
                       $("#btn-imagen").empty();
                       $("#btn-imagen-queue").empty();
                       $("#btn-altas").prop('disabled', false);
                    }
                    }
                  ]
                  });
                 }
                 if(x=="error"){
                 var n = noty({
                 text: "No se registro el articulo, verifique los campos...!",
                 theme: 'relax',
                 layout: 'center',
                 type: 'information',
                 timeout: 2000,
                 });
                 $("#btn-altas").prop('disabled', false);
                }
                }
                ,
                /**************************/
                error: function(jqXHR,estado,error){
                var n = noty({
                 text: "Ocurrio un error al registrar el articulo, consulte a Soporte...!",
                 theme: 'relax',
                 layout: 'center',
                 type: 'information',
                 });
                }
             });
         }
/*******************************************************************************************/
function busca_articulo(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#btn-buscar").prop('disabled', true);
           },
          url: 'busca_articulo.php',
          type: 'POST',
          data: 'codigo='+$("#codigo_busqueda").val(),
          success: function(x){
              if(x==0){
               alert("El codigo del articulo, no existe...");
                $("#btn-buscar").prop('disabled', false);
                $("#codigo_busqueda").select();
                $("#codigo_busqueda").focus();
              }else{
              $("#info_articulo").html(x);
              $("#btn-procede-baja").prop('disabled', false);
              $("#btn-cancela-baja").prop("disabled", false);
              }
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/*******************************************************************************************/
function elimina_articulo(){
           var n = noty({
                  text: "Seguro que desea eliminar el articulo...?",
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
          url: 'delete_articulo.php',
          type: 'POST',
          data: 'codigo='+$("#codigo_busqueda").val(),
          success: function(x){
             var n = noty({
              text: "Se elimino la informacion del articulo...!",
              theme: 'relax',
              layout: 'center',
              type: 'information',
              timeout: 2000,
            });
             cancela_eliminacion();
         /*    lista_articulos();*/
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
/*************************************************************************************/
function cancela_eliminacion(){
           $("#info_articulo").empty();
           $("#codigo_busqueda").val('');
           $("#btn-cancela-baja").prop('disabled', true);
           $("#btn-procede-baja").prop('disabled', true);
           $("#btn-buscar").prop('disabled', false);
           $("#codigo_busqueda").focus();
         }
/****************************************************************************************/
function cancela_alta_articulo(){
    $("#codigo").val('');
    $("#descripcion").val('');
    $("#costo").val('0.00');
    $("#precio").val('0.00');
	$("#presentacion").val('');
	$("#existencia").val('');
	$("#minima").val('');
	$("#maxima").val('');
	$("#estanteria").val('');
    $("#codigo").focus();
}
/************************************************************************************/
function busca_articulo_cambio(){
         $(document).ready(function(){
          $.ajax({
          beforeSend: function(){
             $("#btn-buscar-cambio").prop('disabled', true);
           },
          url: 'busca_articulo_cambio.php',
          type: 'POST',
          data: 'codigo='+$("#codigo_busqueda_cambio").val(),
          success: function(x){
              if(x==0){
               alert("El codigo del articulo, no existe...");
                $("#btn-buscar-cambio").prop('disabled', false);
              }else{
              $("#codigo_busqueda_cambio").prop('disabled', true);
              $("#info_articulo_cambio").html(x);
              $(".cantidades").inputmask('mask',{'alias':'numeric','autogroup':true,'digits':2,'digitsOptional': false});
              $(".select2").select2();
              $("#fecha_caducidad_cambio").datepicker({
                  language: "es",
                  format: "yyyy-mm-dd"
              });
              $("#btn-procede-cambio").prop('disabled', false);
              $("#btn-cancela-cambio").prop("disabled", false);
              $('#cambia_imagen').uploadify({
                          'buttonClass': 'btn btn-success',
                          'swf'      : 'plugins/uploadify/uploadify.swf',
                          'uploader' : 'uploadify.php',
                          'buttonText' : 'Cambiar imagen...',
                          'multi' : false,
                          'removeTimeout': 2,
                          'cancelImg' : 'plugins/uploadify/uploadify-cancel.png',
                          'checkExisting' : 'check-exists.php',
                          'onUploadStart' : function() {
                              $("#cambia_imagen").uploadify("settings", "formData", {'codigo' : $("#codigo_busqueda_cambio").val()});
                             },
                          'onUploadSuccess' : function(file, data, response){
                            var n = noty({
                                text: "Se actualizo la imagen a "+ file.name,
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 3000,
                                });
                             }
                         });
              }
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/**************************************************************************************/
function cambia_grupos(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
           },
          url: 'cambia_grupos.php',
          type: 'POST',
          data: 'linea='+$("#linea_cambio").val(),
          success: function(x){
             if(x==0){

             }else{
               $("#grupo_para_cambiar").html(x);
               $(".select2").select2();
               }
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/************************************************************************************/
function procede_cambio(){
         $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#btn-procede-cambio").prop('disabled', true);
           },
          url: 'procede_cambio.php',
          type: 'POST',
          data: 'codigo='+$("#codigo_busqueda_cambio").val()+'&descripcion='+$("#descripcion_cambio").val()+'&presentacion='+$("#presentacion_cambio").val()+'&costo='+$("#costo_cambio").val()+'&precio='+$("#precio_cambio").val()+'&minima='+$("#minima_cambio").val()+'&estanteria='+$("#estanteria_cambio").val()+'&marca='+$("#marca_cambio").val()+'&fecha_caducidad='+$("#fecha_caducidad_cambio").val()+'&departamento='+$("#departamento_cambio").val(),
          success: function(x){
            if(x=='error'){
               var n = noty({
                                text: "Verifique los campos, no se realizo el cambio!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                                });
                                $("#btn-procede-cambio").prop('disabled', false);
               }else{
               var n = noty({
                                text: "Se actualizo la informacion del articulo...!",
                                theme: 'relax',
                                layout: 'center',
                                type: 'information',
                                timeout: 2000,
                                });
                 cancela_cambios();
            /*   lista_articulos();*/
               }
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
         }
/*****************************************************************************/
function cancela_cambios(){
           $("#info_articulo_cambio").empty();
           $("#codigo_busqueda_cambio").val('');
           $("#codigo_busqueda_cambio").prop('disabled', false);
           $("#btn-cancela-cambio").prop('disabled', true);
           $("#btn-procede-cambio").prop('disabled', true);
           $("#btn-buscar-cambio").prop('disabled', false);
         }
/********************************************************************************/
     function anular(e) {
          tecla = (document.all) ? e.keyCode : e.which;
          return (tecla != 13);
     }
 /*****************************************************************************/
 function lista_articulos(){
    $(document).ready(function() {
          $.ajax({
          beforeSend: function(){
             $("#lista_articulos").html('<b>Actualizando lista de articulos...</b>');
           },
          url: 'lista_articulos.php',
          type: 'POST',
          data: null,
          success: function(x){
            $("#lista_articulos").html(x);
            $("#tabla_articulos").dataTable();
           },
           error: function(jqXHR,estado,error){
           }
           });
          });
 }
 /**********************************************************************************/
 function botones(){
 $(document).ready(function(){
    var gasto=0.00;
    var total_gasto=0.00;
    $('#datos_registrados > tbody > tr').each(function(){
               
         $(".aqui").html("");
         $(".aqui").html("<h4> </span> <button class='btn btn-primary no-print' onclick='print_gastos();'><i class='fa fa-print'></i> Vista Previa</button></h4>");
        });
     })
}
/*****************************************************************************************/
function print_gastos(){
  $(".print7").printArea();
}
/************************************************************************************/