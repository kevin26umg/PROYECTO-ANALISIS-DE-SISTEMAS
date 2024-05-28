/******************************************************************************************/
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
function busca_gastos(){
  $(document).ready(function (){
    if($("#fi").val()!=""||$("#ff").val()!=""){
       $.ajax({
            beforeSend: function(){
             $("#data").html("Buscando registros de compra, un momento...");
             },
            url: 'libro_compras_generado.php',
            type: 'POST',
            data: 'fechai='+$("#fi").val()+'&fechaf='+$("#ff").val(),
            success: function(x){
               $("#data").html(x);
               suma_gastos();
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
function suma_gastos(){
   $(document).ready(function(){
    var gasto=0.00;
    var total_gasto=0.00;
    $('#gastos_registrados > tbody > tr').each(function(){
                gasto = $(this).find('td').eq(4).html();
                etiqueta=$(this).find('td').eq(5).html();
                gasto=gasto.replace(",","");
                gasto=parseFloat(gasto);
            /*    if(etiqueta=='ACTIVO'){*/
                total_gasto+=gasto;
                /*}*/

     
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