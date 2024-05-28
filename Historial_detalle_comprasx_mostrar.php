<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
if ($_SESSION['sucursal']=="1"){
  include('./class_lib/class_conecta_mysql.php');
  }
  if ($_SESSION['sucursal']=="2"){
  include('./class_lib/class_conecta_mysql2.php');
  }
  if ($_SESSION['sucursal']=="3"){
  include('./class_lib/class_conecta_mysql3.php');
  }
require('class_lib/funciones.php');
$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$factura=$_POST['factura'];
$proveedor=$_POST['proveedor'];
// if($proveedor==""){
$query = "Select * from detalle_compras where factura= :buscar order by id asc";    
// }else
// {
//     $query = "Select * from detalle_compras where factura= :buscar and proveedor= :buscar2 order by id asc";
// }

$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->factura)){
   echo "<div class='panel panel-success'>";
   echo "<table class='table table-hover table-responsive' id='data'>";
   echo "<thead>";
   echo "<tr>";
	 echo "<th style='text-align:center;'>CODIGO</th>";
	 echo "<th style='text-align:center;'>PRODUCTO</th>";
// 	 echo "<th style='text-align:center;'>PRESENTACIÓN</th>";
// 	 echo "<th style='text-align:center;'>TIPO PRECIO</th>";
     echo "<th style='text-align:center;'>CANTIDAD</th>";
	 echo "<th style='text-align:center;'>COSTO</th>";
	 echo "<th style='text-align:center;'>TOTAL</th>";
	 
// 	 echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
     echo "<th style='text-align:center;'></th>";
     echo "</tr>";
     echo "<tbody>";
    $resultado->bindParam(":buscar",$factura);	
    // $resultado->bindParam(":buscar2",$proveedor);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){    
	  $n=$n +1;
      echo "<tr>";
	  echo "<td style='text-align:center;'>".$re['codigo']."</td>";
	  echo "<td style='text-align:center;'>".$re['producto']."</td>";
// 	  echo '<td style="text-align:center;">'.$re['tipo']."</td>";
// 	  echo '<td style="text-align:center;">'.$re['presentacion']."</td>";
    echo "<td style='text-align:center;'>".$re['cantidad']."</td>";
	  echo '<td style="text-align:center;">Q'.$re['precio']."</td>";
	  echo '<td style="text-align:center;">Q'.$re['total']."</td>";
	  
	  $totales=$re['total']+$totales;
      $fac=$re['factura'];
    $varproductos=$re['id']."|".$re['codigo']."|".$re['cantidad']."|".$re['precio']."|".$re['costo']."|".$re['factura']."|".$re['metros'];
//     echo "<td style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Cambiar Precio' id='$varproductos' onclick='cambiar_precio(this.id);'><i class='fa fa-money'></i> </button></td>";
// 	  echo "<td style='text-align:center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Agregar artículo' id='$varproductos' onclick='agrega_articulo(this.id);'><i class='fa fa-plus'></i> </button></td>";
//     echo "<td style='text-align:center;'><button type='button' class='btn btn-azul btn-xs' data-toggle='tooltip' data-placement='top' title='Quitar artículo' id='$varproductos' onclick='elimina_articulo(this.id);'><i class='fa fa-minus'></i> </button></td>";
    echo "<td style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='elimina_producto(this.id);'><i class='fa fa-trash-o'></i> </button></td>";
    echo "</tr>";
    }
    
?>    
    <script type="text/javascript">
      
    var totales = <?php echo $totales;?> 
    //var factura = <?php echo $fac;?> 
   // $("#totales").html("Q. "+totales.toFixed(2));
    $("#total_venta").val(totales);
    //$("#factura").val(factura);
    if(totales>0){
              $("#btn-procesa").prop('disabled', false);
            }else{
              $("#btn-procesa").prop('disabled', true);
            }
           
   
    </script>

<?php   

echo "</div>";



}else{
  echo "<td bgcolor='#33CFFF'>".''."</td>";
  echo "<div class='callout callout-info'>No hay datos registrados...</div>";
}
	
?>

