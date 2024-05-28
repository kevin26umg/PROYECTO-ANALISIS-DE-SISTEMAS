/********************************************************************/
function establece_caja(){
 $.ajax({
          beforeSend: function(){
           },
          url: 'establece_caja.php',
          type: 'POST',
          data: 'caja='+$("#numcaja").val(),
          success: function(x){
            alert("Se establecio el numero de caja en esta sesion...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-caja").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer el numero de caja, contacte a soporte inmediatamente...!");
           }
           });
}
/********************************************************************/
function establece_name_empresa(){
    $.ajax({
          beforeSend: function(){
           },
          url: 'estabelece_name_empresa.php',
          type: 'POST',
          data: 'name='+$("#nombre_empresa").val()+'&dom='+$("#dom_empresa").val(),
          success: function(x){
            alert("Se establecio el nombre de la empresa correctamente...!");
            window.location='parametros.php';
             },
           error: function(jqXHR,estado,error){
             $("#btn-name").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al establecer el nombre de la empresa, contacte a soporte inmediatamente...!");
           }
           });
}
/*****************************************************************************/
function registra_usr(){
  if($("#nombre").val()==""||$("#password").val()==""){
    alert("Debes de completar todos los campos...");
    $("#nombre").focus();
  }else{
    $.ajax({
          beforeSend: function(){
           },
          url: 'registra_users.php',
          type: 'POST',
          data: 'nombre='+$("#nombre").val()+'&pass='+$("#password").val()+'&permisos='+$("#permisos").val(),
          success: function(x){
              if(x!='0'){
                alert("Se registro el usuario correctamente...");
              }
              pone_users_registrados();
             },
           error: function(jqXHR,estado,error){
             $("#btn-reg-usr").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al registrar el usuario, contacte a soporte inmediatamente...!");
           }
           });
           }
}
/***********************************************************************************/
function pone_users_registrados(){
   $.ajax({
          beforeSend: function(){
            $("#users_registrados").html("<img src='dist/img/default.gif'></img>");
           },
          url: 'pone_users_regs.php',
          type: 'POST',
          data: null,
          success: function(x){
             $("#users_registrados").html(x);
             },
           error: function(jqXHR,estado,error){
             $("#users_registrados").html('Hubo un error: '+estado+' '+error);
             alert("Hubo un error al consultar usuarios registrados, contacte a soporte inmediatamente...!");
           }
           });
}
/*******************************************************************************/
function eliminar_item(id){
   var pid=id;  
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
          url: 'Eliminar_data_usuario.php',
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
            pone_users_registrados();
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