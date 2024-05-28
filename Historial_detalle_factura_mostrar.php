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
$query = "Select * from detalle_servicios where factura= :buscar and (categoria='Trabajox' or categoria='Trabajo' or categoria='Repuestosx') order by id asc";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->factura)){
   echo "<div class='panel panel-success'>";
   echo "<table class='table table-hover table-striped table-responsive table-dark' id='datax'>";
   echo "<thead>";
   echo "<tr style='background:#ffbc0e;'>";
   
	 echo "<th style='text-align:center;display:none;'>ID</th>";
	 echo "<th style='text-align:center;'>SERVICIO</th>";
	 echo "<th style='text-align:center;'>M/O</th>";
     echo "<th style='text-align:center;'>REPUESTOS</th>";
	 echo "<th style='text-align:center;'>DESCUENTO</th>";
	 echo "<th style='text-align:center;'>TOTAL</th>";
	 echo "<th style='text-align:center;'>OBSERVACIONES</th>";
	 echo "<th style='display:none;'></th>";

 
     echo "</tr>";
     echo "<tbody>";
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();
    
    $mototal=0.00;
    $reptotal=0.00;
    $totaltotal=0.00;
    $total1=0.00;
	foreach ($resultado as $key =>$re){    
	  $n=$n +1;
      echo "<tr>";
      
      	  echo "<td style='text-align:left;display:none;'>".$re['id']."</td>";
	  echo "<td style='text-align:left;'><i style='font-weight:bold;'>✔</i>   ".$re['producto']."</td>";
     $revisainventario = "Select descuento, precioa, codigo, preciob from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$re['codigo']);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        $descuentoinventario=$ra2['precioa'];
        $preciob=$ra2['preciob'];
       
        }
        
         $mototal+=$re['mo'];
         $reptotal+=$re['repuestos'];
         $total1=$re['mo']+$re['repuestos'];
	  echo '<td style="text-align:center;">Q '.number_format($re['mo'],2,".",",")."</td>";
	  echo '<td style="text-align:center;">Q '.number_format($re['repuestos'],2,".",",")."</td>";
	  $totalsindescuento+=$preciob;
	  $desc11=$preciob/100;
	  $desc22=($preciob-$re['precio'])/$desc11;
	  $desc=$desc22;
// 	  echo '<td style="text-align:center;">' .number_format($desc,0,".",","). '% ---- Q '.$re['descuento']."</td>";
echo '<td style="text-align:center;">Q '.$re['descuento']."</td>";
// 	  echo '<td style="text-align:center;">Q'.$re['precio']."</td>";
	  
	  
	  $totales=$re['total']+$totales;
      $fac=$re['factura'];
    $varproductos=$re['id']."|".$re['codigo']."|".$re['cantidad']."|".$re['precio']."|".$re['costo']."|".$re['factura']."|".$descuentoinventario."|".$desc."|".$preciob;
    
    $varproductosxd=$re['id']."|".$re['observaciones']."|".$re['producto']."|".$re['repuestos']."|".$re['mo']."|".$re['factura']."|".$descuentoinventario."|".$desc."|".$preciob;
    
    
	  echo '<td style="text-align:center;">Q'.number_format($total1,2,".",",")."</td>";
	  
	  
	  	   
	  	  
	  if($re['observaciones']==""){
	      
	      
	  echo "<td style='text-align:center;'> <button  style='text-align:center;display:none;' type='button' class='btn btn-info btn-xs' data-toggle='tooltip' data-placement='top' title='Agregar observación' name='obs".$re['id']."' id='$varproductosxd' onclick='agrega_observacion(this.id);'><i class='fa fa-pencil'></i> </button></td>";    
	  }else
	  {
	      echo '<td style="text-align:center;">'.$re['observaciones']."</td>";  
	      
	      echo "<td style='text-align:center;display:none;'> <button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Quitar observación' id='$varproductosxd' name='obs".$re['id']."' onclick='quitar_observacion(this.id);'><i class='fa fa-trash'></i> </button></td>";
	  }
	  
	    echo "<td style='text-align:center;display:none;'> <button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Quitar observación' id='$varproductosxd' name='mo".$re['id']."' onclick='cambiomo(this.id);'><i class='fa fa-trash'></i> </button></td>";
	  
	  	    echo "<td style='text-align:center;display:none;'> <button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Eliminar artículo' id='$varproductos' name='eli".$re['id']."' onclick='elimina_articulo(this.id);'><i class='fa fa-trash'></i> </button></td>";
	  
	  
	  
    // echo "<td style='text-align:center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Cambiar Precio Porcentaje Precio A' id='$varproductos' onclick='cambiar_precio(this.id);'><i class='fa fa-money'></i> </button></td>";
    // echo "<td style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Cambiar Precio' id='$varproductos' onclick='cambiar_precio2(this.id);'><i class='fa fa-money'></i> </button></td>";re['id']
// 	  echo "<td style='text-align:center;'><button type='button' class='btn btn-info btn-xs' data-toggle='tooltip' data-placement='top' title='Agregar artículo' id='$varproductos' onclick='agrega_articulo(this.id);'><i class='fa fa-plus'></i> </button></td>";
    // echo "<td style='text-align:center;'><button type='button' class='btn btn-azul btn-xs' data-toggle='tooltip' data-placement='top' title='Quitar artículo' id='$varproductos' onclick='elimina_articulo(this.id);'><i class='fa fa-minus'></i> </button></td>";
    // echo "<td style='text-align:center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='elimina_producto(this.id);'><i class='fa fa-trash-o'></i> </button></td>";
    echo "</tr>";
    
   $nocantidad+=$re['cantidad'];
    $noprecios+=$re['precio'];
    $nototales+=$re['total'];
    $nodescuento+=$re['descuento'];
    $noarticulos+=1;
    
    }
    
     
    $totaltotal=$mototal+$reptotal;
    echo "<tr style='background-color:#ffbc0e;font-weight: bold;font-size: 15px;'>";
     
	  //echo "<td style='text-align:center;'>Artículos: </td>";
	  
	   echo '<td style="text-align:right;">Artículos: '.$nocantidad.'</td>';
    // echo "<td style='text-align:center;'>".$nocantidad."</td>";
    echo '<td style="text-align:center;">Q '.number_format($mototal,2,".",",")."</td>";
	  echo '<td style="text-align:center;">Q '.number_format($reptotal,2,".",",")."</td>";
	  echo '<td style="text-align:center;"></td>';
	  echo '<td style="text-align:center;">Q '.number_format($totaltotal,2,".",",")."</td>";
	  echo '<td style="text-align:center;"></td>';
	  
	   
	 
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
