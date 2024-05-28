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
$buscav=$db->prepare($busca_venta);
$buscav->bindParam(":buscar",$id);	
    $buscav->execute();	
	foreach ($buscav as $key =>$y){
    $factura=$y['factura'];
}

//$busca_unidades=$db->consulta("Select * from presentaciones where presentacion='$presentacion' and codigo='$codigo'");
//while($yyy=$db->buscar_array($busca_unidades)){
$busca_unidades = "Select * from presentaciones where presentacion= :presentacion and codigo= :buscar";
$buscau=$db->prepare($busca_unidades);
$buscau->bindParam(":presentacion",$presentacion);	
$buscau->bindParam(":buscar",$codigo);	
    $buscau->execute();	
	foreach ($buscau as $key =>$yyy){
   $uni=$yyy['unidades'];
}

//$busca_inventario=$db->consulta("Select codigo, existencia from inventario where codigo='$codigo'");
//while($yy=$db->buscar_array($busca_inventario)){
$busca_inventario = "Select codigo, existencia from inventario where codigo= :buscar";
$buscai=$db->prepare($busca_inventario);
$buscai->bindParam(":buscar",$codigo);	
    $buscai->execute();	
	foreach ($buscai as $key =>$yy){
   $existencia=$yy['existencia'];
}

$sumarcantidad=1;
$candescargar=$sumarcantidad*$uni;
if ($tipodoc=='Altas # 1' || $tipodoc=='Altas # 2' || $tipodoc=='Altas # 3'){
$totalexistencia=$existencia - $candescargar;
}else{
$totalexistencia=$existencia + $candescargar;
}
//$update="Update inventario set existencia='$totalexistencia' where codigo='$codigo'";
//$ejecuta=$db->consulta($update);
$update="Update inventario set existencia= :totalexistencia where codigo= :buscar";
$resultadou=$db->prepare($update);
$resultadou->execute(array(":totalexistencia"=>$totalexistencia, ":buscar"=>$codigo));	

$sumarcantidad=$cantidad+$sumarcantidad;
//$update_detalle="Update detalle_ventas set cantidad='$cantidad', total='$total' where id='$id'";
//$ejecuta=$db->consulta($update_detalle);
$update_detalle="Update detalle_ventas set cantidad= :cantidad, total= :total where id= :buscar";
$resultadoud=$db->prepare($update_detalle);
$resultadoud->execute(array(":cantidad"=>$cantidad, ":total"=>$total, ":buscar"=>$id));	

//$modifica_factura=$db->consulta("Update ventas set Total='$totales' where Factura='$factura'");
//$exec=$db->consulta($modifica_factura);
$modifica_factura="Update ventas set Total= :totales where Factura= :buscar";
$resultadoumf=$db->prepare($modifica_factura);
$resultadoumf->execute(array(":totales"=>$totales, ":buscar"=>$factura));	
?>
 