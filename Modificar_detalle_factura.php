<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/funciones.php');
if ($_SESSION['sucursal']=="1"){
  include('./class_lib/class_conecta_mysql.php');
  }
  if ($_SESSION['sucursal']=="2"){
  include('./class_lib/class_conecta_mysql2.php');
  }
  if ($_SESSION['sucursal']=="3"){
  include('./class_lib/class_conecta_mysql3.php');
  }


$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$tipo=$_POST['tipo'];
$codigo=$_POST['codigo'];
$id=$_POST['id'];
$cantidad=$_POST['cantidad'];
$presentacion=$_POST['presentacion'];
$precio=$_POST['precio'];
$total=$_POST['total'];
$totales=$_POST['totales'];
$tipodoc=$_POST['tipodoc'];
//$busca_venta=$db->consulta("Select factura, codigo, presentacion from detalle_ventas where id='$id'");
//while($y=$db->buscar_array($busca_venta)){
$busca_venta = "Select factura, codigo, presentacion from detalle_ventas where id= :buscar";
$bv=$db->prepare($busca_venta);
$bv->bindParam(":buscar",$id);
$bv->execute();	
	foreach ($bv as $key =>$y){
   $factura=$y['factura'];
}

//$busca_unidades=$db->consulta("Select * from presentaciones where presentacion='$presentacion' and codigo='$codigo'");
//while($yyy=$db->buscar_array($busca_unidades)){
$busca_unidades = "Select * from presentaciones where presentacion= :presentacion and codigo= :buscar";
$bu=$db->prepare($busca_unidades);
$bu->bindParam(":presentacion",$presentacion);
$bu->bindParam(":buscar",$codigo);
$bu->execute();	
	foreach ($bu as $key =>$yyy){
   $uni=$yyy['unidades'];
}

//$busca_inventario=$db->consulta("Select codigo, existencia from inventario where codigo='$codigo'");
//while($yy=$db->buscar_array($busca_inventario)){
$busca_inventario = "Select codigo, existencia from inventario where codigo= :buscar";
$bi=$db->prepare($busca_inventario);
$bi->bindParam(":buscar",$codigo);
$bi->execute();	
	foreach ($bi as $key =>$yy){
   $existencia=$yy['existencia'];
}

//$busca_cliente=$db->consulta("Select * from clientes where nit='$nit'");
//while($rc=$db->buscar_array($busca_cliente)){
$busca_cliente = "Select * from clientes where nit= :buscar";
$bc=$db->prepare($busca_cliente);
$bc->bindParam(":buscar",$nit);
$bc->execute();	
	foreach ($bc as $key =>$rc){
   $saldo=$rc['saldo'];
   $saldolimite=$rc['saldo_limite'];
}
//if ($existencia>=$uni){
if ($tipo=='Efectivo' || $saldolimite >0.00 & $saldo >$total || $tipo=='Bajas' || $tipo=='Altas'){
$sumarcantidad=1;
$candescargar=$sumarcantidad*$uni;
if ($tipodoc=='Altas # 1' || $tipodoc=='Altas # 2' || $tipodoc=='Altas # 3'){
$totalexistencia=$existencia + $candescargar;
}else{
$totalexistencia=$existencia - $candescargar;
}
//$update="Update inventario set existencia='$totalexistencia' where codigo='$codigo'";
//$ejecuta=$db->consulta($update);
$update = "Update inventario set existencia= :totalexistencia where codigo= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":totalexistencia"=>$totalexistencia,":buscar"=>$codigo));	

$sumarcantidad=$cantidad+$sumarcantidad;
//$update_detalle="Update detalle_ventas set cantidad='$cantidad', total='$total' where id='$id'";
//$ejecuta=$db->consulta($update_detalle);
$update_detalle = "Update detalle_ventas set cantidad= :cantidad, total= :total where id= :buscar";
$updet=$db->prepare($update_detalle);
$updet->execute(array(":cantidad"=>$cantidad, ":total"=>$total, ":buscar"=>$id));	

//$modifica_factura=$db->consulta("Update ventas set Total='$totales' where Factura='$factura'");
//$exec=$db->consulta($modifica_factura);
$modifica_factura = "Update ventas set Total= :totales where Factura= :buscar";
$mf=$db->prepare($modifica_factura);
$mf->execute(array(":totales"=>$totales, ":buscar"=>$factura));	

}else{
?>    
    <script type="text/javascript">
    window.alert("Su limite de crédito no es suficiente...");
    </script>
<?php
} 
//}else{
 ?>    
    <script type="text/javascript">
    var exis = <?php echo $existencia;?>   
    var un = <?php echo $uni;?>   
    window.alert("Producto agotado...");
    window.alert(exis);
    window.alert(un);
    </script>
<?php    
//}
?>
 