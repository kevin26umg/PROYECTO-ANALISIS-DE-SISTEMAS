<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/funciones.php');
include('./class_lib/class_conecta_mysql3.php');

$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$codigo=$_POST['codigo'];
$codigoalterno=$_POST['codigoalterno'];
$producto=$_POST['producto'];
$proveedor=$_POST['proveedor'];
$categoria=$_POST['categoria'];
$existencia=$_POST['existencia'];
$presentacion2=$_POST['presentacion2'];
$minima=$_POST['minima'];
$maxima=$_POST['maxima'];
$costo=$_POST['costo'];

$revisa = "Select * from inventario where codigo= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$codigo);
$resultadorevisa->execute();
$bus=$resultadorevisa->fetch(PDO::FETCH_ASSOC);
if($bus){
$query="Update inventario set codigo_alterno=?, producto=?, proveedor=?, categoria=?, minima=?, maxima=?, preciocosto=?, presentacion=? where codigo=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$codigoalterno);	
$resultado->bindParam(2,$producto);	
$resultado->bindParam(3,$proveedor);	
$resultado->bindParam(4,$categoria);	
$resultado->bindParam(5,$minima);	
$resultado->bindParam(6,$maxima);	
$resultado->bindParam(7,$costo);	
$resultado->bindParam(8,$presentacion2);	
$resultado->bindParam(9,$codigo);	
$resultado->execute();	
}else{	
//$query = "Select codigo from inventario order by codigo asc";
//$resultado=$db->prepare($query);
//$resultado->execute();	
//foreach ($resultado as $key =>$y){
//$codigo=$y['codigo'];
//}
//$numero= 1;
//$codigo= $codigo + $numero;	
$guardar = "Insert INTO inventario(codigo, codigo_alterno, producto, proveedor, preciocosto, existencia, minima, maxima, categoria, presentacion) VALUES(:codigo,:codigoalterno,:producto,:proveedor,:costo,:existencia,:minima,:maxima,:categoria,:presentacion)";
$resul=$db->prepare($guardar);
$resul->execute(array(":codigo"=>$codigo, ":codigoalterno"=>$codigoalterno, ":producto"=>$producto, ":proveedor"=>$proveedor, ":costo"=>$costo, ":existencia"=>"0.00", ":minima"=>$minima, ":maxima"=>$maxima, ":categoria"=>$categoria, ":presentacion"=>$presentacion));	
}
?>
 