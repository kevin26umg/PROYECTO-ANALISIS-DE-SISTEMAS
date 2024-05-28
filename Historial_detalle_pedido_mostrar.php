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
$query = "Select * from detalle_ventas where factura= :buscar order by id asc";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);

$noprecios=0.00;
    $nototales=0.00;
    
if(!isset($rows[0]->factura)){
   echo "<div class='panel panel-success'>";
   echo "<table class='table table-hover table-responsive table-striped' id='datax'>";
   echo "<thead>";
   echo "<tr style='background:#0085e0;color:white'>";
   echo "<th style='text-align:center;display:none;'>CODIGO</th>";
	 echo "<th style='text-align:center;'>CODIGO</th>";
	 echo "<th style='text-align:center;'>PRODUCTO</th>";
	 echo "<th style='text-align:center;'>PRESENTACIÓN</th>";
     echo "<th style='text-align:center;'>CANTIDAD</th>";
	 echo "<th style='text-align:center;'>PRECIO</th>";
	 //echo "<th style='text-align:center;'>TOTAL</th>";
	 echo "<th style='text-align:center;'>DESCUENTO</th>";
	 echo "<th style='text-align:center;'>PRECIO C/DESCT.</th>";
	 echo "<th style='text-align:center;'>TOTAL C/DESCT.</th>";
	 
// 	 echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
    //  echo "<th style='text-align:center;'></th>";
     echo "</tr>";
     echo "<tbody>";
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
    
    
	foreach ($resultado as $key =>$re){    
	  $n=$n +1;
      echo "<tr>";
      echo "<td style='text-align:center;display:none;'>".$re['id']."</td>";
	  echo "<td style='text-align:center;'>".$re['codigo']."</td>";
	  echo "<td style='text-align:center;'>".$re['producto']."</td>";
	  echo '<td style="text-align:center;">'.$re['presentacion']."</td>";
    echo "<td style='text-align:center;'>".$re['cantidad']."</td>";
    // $desprecio=($re['total']+$re['descuento'])/$re['cantidad'];
     $revisainventario = "Select descuento, preciocosto, codigo, preciod from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$re['codigo']);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        $descuentoinventario=$ra2['preciocosto'];
        $preciob=$ra2['preciod'];
        }
	  echo '<td style="text-align:center;">Q '.number_format($preciob,2,".",",")."</td>";
	  $totalsindescuento+=$preciob;
	  $desc11=$preciob/100;
	  $desc22=($preciob-$re['precio'])/$desc11;
	  $desc=$desc22;
	  echo '<td style="text-align:center;">' .number_format($desc,0,".",","). '% ---- Q '.$re['descuento']."</td>";
	  echo '<td style="text-align:center;">Q'.$re['precio']."</td>";
	  echo '<td style="text-align:center;">Q'.$re['total']."</td>";
	  
	  $totales=$re['total']+$totales;
      $fac=$re['factura'];
    $varproductos=$re['id']."|".$re['codigo']."|".$re['cantidad']."|".$re['precio']."|".$re['costo']."|".$re['factura']."|".$descuentoinventario."|".$desc."|".$preciob;
    echo "<td hidden style='text-align:center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Cambiar Precio Porcentaje Precio A' name='desc".$re['id']."' id='$varproductos' onclick='cambiar_precio(this.id);'><i class='fa fa-money'></i> </button></td>";
    // echo "<td style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Cambiar Precio' name='pre".$re['id']."' id='$varproductos' onclick='cambiar_precio2(this.id);'><i class='fa fa-money'></i> </button></td>";
	  echo "<td hidden style='text-align:center;'><button type='button' class='btn btn-info btn-xs' data-toggle='tooltip' data-placement='top' title='Agregar artículo' name='add".$re['id']."' id='$varproductos' onclick='agrega_articulo(this.id);'><i class='fa fa-plus'></i> </button></td>";
    echo "<td hidden style='text-align:center;'><button type='button' class='btn btn-azul btn-xs' data-toggle='tooltip' data-placement='top' title='Quitar artículo'  name='quitar".$re['id']."' id='$varproductos' onclick='elimina_articulo(this.id);'><i class='fa fa-minus'></i> </button></td>";
    echo "<td hidden style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento'  name='eliminar".$re['id']."' id='$varproductos' onclick='elimina_producto(this.id);'><i class='fa fa-trash-o'></i> </button></td>";
    echo "</tr>";
    
   $nocantidad+=$re['cantidad'];
    $noprecios+=$re['precio'];
    $nototales+=$re['total'];
    $nodescuento+=$re['descuento'];
    $noarticulos+=1;
    
    }
    echo "<tr style='background-color:#0085e0;font-weight: bold;font-size: 15px;'>";
     echo "<td style='text-align:center;'></td>";
	  //echo "<td style='text-align:center;'>Artículos: </td>";
	  echo '<td style="text-align:center;"></td>';
	   echo '<td style="text-align:right;">Artículos: </td>';
    echo "<td style='text-align:center;'>".$nocantidad."</td>";
    echo '<td style="text-align:center;">Q '.number_format($totalsindescuento,2,".",",")."</td>";
	  echo '<td style="text-align:center;">Q '.number_format($nodescuento,2,".",",")."</td>";
	  echo '<td style="text-align:center;"></td>';
	  echo '<td style="text-align:center;">Q '.number_format($nototales,2,".",",")."</td>";
// 	  echo '<td style="text-align:center;"></td>';
// 	  echo '<td style="text-align:center;"></td>';
// 	  echo '<td style="text-align:center;"></td>';
// 	  echo '<td style="text-align:center;"></td>';
// 	  echo '<td style="text-align:center;"></td>';
	  

    echo "</tr>";
    
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

<script>
            contextmenu();
               </script>