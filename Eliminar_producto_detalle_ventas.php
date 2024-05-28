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
$tipodoc=$_POST['tipodoc'];
//$update_comanda=("Update comandas set obs='Pendiente de Cobro' where id='$id'");
//$ejecuta=$db->consulta($update_comanda);  

//$busca_codigo=$db->consulta("Select codigo, id, cantidad, presentacion from detalle_ventas where id='$id'");
//while($yy=$db->buscar_array($busca_codigo)){
$busca_codigo = "Select codigo, id, cantidad, presentacion from detalle_ventas where id= :buscar";
$bc=$db->prepare($busca_codigo);
$bc->bindParam(":buscar",$id);	
    $bc->execute();	
	foreach ($bc as $key =>$yy){
   $cantidad=$yy['cantidad'];
   $presentacion=$yy['presentacion'];
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
//$busca_departamento=$db->consulta("Select preciocosto, existencia from inventario where codigo='$codigo'");
//while($y=$db->buscar_array($busca_departamento)){
$busca_departamento = "Select preciocosto, existencia from inventario where codigo= :buscar";
$bd=$db->prepare($busca_departamento);
$bd->bindParam(":buscar",$codigo);
$bd->execute();	
	foreach ($bd as $key =>$y){
   $existencia=$y['existencia'];
}
//$delete=$db->consulta("Delete from detalle_ventas where id='$id'");
$delete = "Delete from detalle_ventas where id= :buscar";
$borrar=$db->prepare($delete);
$borrar->execute(array(":buscar"=>$id));	

$candescargar=$cantidad*$uni;
if ($tipodoc=='Altas # 1' || $tipodoc=='Altas # 2' || $tipodoc=='Altas # 3'){
$totalexistencia=$existencia - $candescargar;
}else{
$totalexistencia=$existencia + $candescargar;
}
//$update="Update inventario set existencia='$totalexistencia' where codigo='$codigo'";
//$ejecuta=$db->consulta($update);  
$update = "Update inventario set existencia= :totalexistencia where codigo= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":totalexistencia"=>$totalexistencia,":buscar"=>$codigo));	

//$busca_id=$db->consulta("Select factura, total from detalle_ventas where factura='$factura'");
//while($yr=$db->buscar_array($busca_id)){
$busca_id = "Select factura, total from detalle_ventas where factura= :buscar";
$buscai=$db->prepare($busca_id);
$buscai->bindParam(":buscar",$factura);
$buscai->execute();	
	foreach ($buscai as $key =>$yr){
   $totales +=$yr['total'];
}

//$modifica_factura=("Update ventas set Nit='$nit', Cliente='$cliente', Direccion='$direccion', Fecha='$fecha', Total='$totales', Usuario='$usuario' where Factura='$factura'");
 // $exec=$db->consulta($modifica_factura);
$modifica_factura = "Update ventas set Nit= :nit Cliente= :cliente, Direccion= :direccion, Fecha= :fecha, Total= :totales, Usuario= :usuario where Factura= :buscar";
$mod=$db->prepare($modifica_factura);
$mod->execute(array(":nit"=>$nit, ":cliente"=>$cliente, ":direccion"=>$direccion, ":fecha"=>$fecha, ":totales"=>$totales, ":usuario"=>$usuario,":buscar"=>$factura));	
?>