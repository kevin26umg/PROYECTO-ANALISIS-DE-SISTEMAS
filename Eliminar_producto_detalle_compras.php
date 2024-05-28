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

$codigo=$_POST['codi'];
$id=$_POST['id'];
$factura=$_POST['factura'];
$fecha= date ("Y-m-d");
$nit=$_POST['nit'];
$cliente=$_POST['cliente'];
$direccion=$_POST['direccion'];
$usuario=$_SESSION['nombre_de_usuario'];

//$update_comanda=("Update comandas set obs='Pendiente de Cobro' where id='$id'");
//$ejecuta=$db->consulta($update_comanda);  

//$busca_codigo=$db->consulta("Select codigo, id, cantidad, presentacion from detalle_compras where id='$id'");
//while($yy=$db->buscar_array($busca_codigo)){
$busca_codigo=$db->prepare("Select codigo, id, cantidad, presentacion from detalle_compras where id= :buscar");  
$busca_codigo->bindParam(":buscar",$id);
$busca_codigo->execute();
foreach($busca_codigo as $key =>$yy){
   $cantidad=$yy['cantidad'];
   $presentacion=$yy['presentacion'];
}

//$busca_unidades=$db->consulta("Select * from presentaciones where presentacion='$presentacion' and codigo='$codigo'");
//while($yyy=$db->buscar_array($busca_unidades)){
$busca_unidades=$db->prepare("Select * from presentaciones where presentacion= :presentacion and codigo=:buscar");
$busca_unidades->bindParam(":presentacion",$presentacion);
$busca_unidades->bindParam(":buscar",$codigo);
$busca_unidades->execute();
foreach($busca_unidades as $key =>$yyy){
   $uni=$yyy['unidades'];
}

//$busca_departamento=$db->consulta("Select preciocosto, existencia from inventario where codigo='$codigo'");
//while($y=$db->buscar_array($busca_departamento)){
$busca_departamento=$db->prepare("Select preciocosto, existencia from inventario where codigo= :buscar");
$busca_departamento->bindParam(":buscar",$codigo);
$busca_departamento->execute();
foreach($busca_departamento as $key =>$y){
   $existencia=$y['existencia'];
}

//$delete=$db->consulta("Delete from detalle_compras where id='$id'");
$delete=$db->prepare("Delete from detalle_compras where id= :buscar");
$delete->bindParam(":buscar",$id);
$delete->execute();

$candescargar=$cantidad*$uni;
$totalexistencia=$existencia - $candescargar;
//$update="Update inventario set existencia='$totalexistencia' where codigo='$codigo'";
//$ejecuta=$db->consulta($update);
$update=$db->prepare("Update inventario set existencia= :totalexistencia where codigo=:buscar");
$update->execute(array(":totalexistencia"=>$totalexistencia, ":buscar"=>$codigo));	

//$busca_id=$db->consulta("Select factura, total from detalle_compras where factura='$factura'");
//while($xy=$db->buscar_array($busca_id)){
$busca_id=$db->prepare("Select factura, total from detalle_compras where factura=:buscar");
$busca_id->bindParam(":buscar",$codigo);
$busca_id->execute();
foreach($busca_id as $key =>$xy){
   $totales +=$xy['total'];
}

//$modifica_factura=("Update compras set Nit='$nit', Proveedor='$cliente', Direccion='$direccion', Fecha='$fecha', Total='$totales', Usuario='$usuario' where Factura='$factura'");
//  $exec=$db->consulta($modifica_factura);
$modifica_factura=$db->prepare("Update compras set Nit=:nit Proveedor=:cliente, Direccion=:direccion, Fecha=:fecha, Total=:totales, Usuario=:usuario where Factura=:buscar");  
$modifica_factura->execute(array(":nit"=>$nit, ":cliente"=>$cliente, ":direccion"=>$direccion, ":fecha"=>$fecha, ":totales"=>$totales, ":usuario"=>$usuario,":buscar"=>$factura));	
echo "hola4";
?>