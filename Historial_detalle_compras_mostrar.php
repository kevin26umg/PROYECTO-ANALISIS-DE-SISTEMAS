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
//$buscar=$db->consulta("Select * from detalle_compras where factura='$factura'");
//if($db->numero_de_registros($buscar)>0){
$query = "Select * from detalle_compras where Factura= :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->Factura)){

 //echo "<div class='box box-primary print7'>";
 // echo "<div class='box-header with-border'>";
   echo "<div class='panel panel-success'>";
//   echo " <div class='panel-heading'></div>";
 //echo  "<div class='panel-heading'>Detalle Pedido</div>";
      //<div class="panel-body">Panel Content</div>
    //</div>
//  echo "<h4 class='box-title aqui '></h4>";
 // echo "</div>";
 
 // echo "<div class='box-body'>";
   echo "<table class='table table-hover table-responsive' id='data'>";
   echo "<thead>";
   echo "<tr>";
	 echo "<th>ID</th>";
	 echo "<th></th>";
   echo "<th></th>";
	 echo "<th>CANTIDAD</th>";
	 echo "<th>PRECIO</th>";
	 echo "<th>TOTAL</th>";
	 echo "<th></th>";
     echo "</tr>";
     echo "<tbody>";
    //while($re=$db->buscar_array($buscar)){
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){    
	  $n=$n +1;
      echo "<ttr>";
	  echo "<td>".$re['id']."</td>";
	  echo "<td>".$re['producto']."</td>";
    echo "<td>".$re['presentacion']."</td>";
	  echo '<td style="text-align:center;">'.$re['cantidad']."</td>";
	  echo '<td style="text-align:right;">'.$re['precio']."</td>";
	  echo '<td style="text-align:right;">'.$re['total']."</td>";
	  $totales=$re['total']+$totales;
    $varproductos=$re['codigo']."|".$re['id']."|".$re['cantidad'];
	  echo "<td><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminar_productos(this.id);'><i class='fa fa-trash-o'></i> </button></td>";
      echo "</tr>";
    }
?>    
    <script type="text/javascript">
    var totales = <?php echo $totales;?>  
    $("#totales").html("Q. "+totales.toFixed(2));
    </script>
<?php    

//   echo "<td bgcolor='#E8F0F3'>".''."</td>";
//  echo "<td bgcolor='#E8F0F3'>".''."</td>";
//  echo "<td bgcolor='#E8F0F3'>".''."</td>";
//  echo "<td bgcolor='#E8F0F3'>".'Total a pagar...'."</td>";
//  echo "<td bgcolor='#E8F0F3'>".number_format($totales,2,".",",")."</td>"; 
//  echo "<td bgcolor='#E8F0F3'>".''."</td>";
//  echo "</tbody>";
//  echo "</table>";
  //echo "<td bgcolor='#99d6ff'>".'Total....................................................................................................................'."</td>";	  
  // echo "<td bgcolor='#99d6ff'>".number_format($totales,2,".",",")."</td>";
//  echo "</div>"; 
//  echo "</div>";
  echo "</div>";
}else{
  echo "<td bgcolor='#33CFFF'>".''."</td>";
  echo "<div class='callout callout-info'>No hay datos registrados...</div>";
}
$modifica_factura="Update compras set Total= :totales where Factura= :buscar";
$resultadomf=$db->prepare($modifica_factura);
//$resultadonf->bindParam(":totales",$totales);	
//$resultadomf->bindParam(":buscar",$factura);	
$resultadomf->execute(array(":totales"=>$totales, ":buscar"=>$factura));
?>