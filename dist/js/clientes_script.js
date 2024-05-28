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
function mostrar_cliente(){
 $(document).ready(function (){
    if($("#fi").val()!=""||$("#ff").val()!=""){
       $.ajax({
            beforeSend: function(){
             $("#data").html("Buscando los Abonos por Fechas, un momento...");
             },
            url: 'Abonos_cliente_imprimir.php',
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
function botones(){
 $(document).ready(function(){
    var gasto=0.00;
    var total_gasto=0.00;
    $('#gastos_registrados > tbody > tr').each(function(){
               
         $(".aqui").html("");
         $(".aqui").html("<h4> </span> <button class='btn btn-primary no-print' onclick='print_gastos();'><i class='fa fa-print'></i> Vista Previa</button></h4>");
        });
     })
}
/*********************************************************************************/
function print_gastos(){
   $(".print7").printArea();
}
/************************************************************************************/