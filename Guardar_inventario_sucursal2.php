<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/funciones.php');
    include('./class_lib/class_conecta_mysql2.php');
$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");

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
if ($codigo==''){
    $codigo=0;
}
if($codigo>0){
$query="Update inventario set codigo_alterno=?, producto=?, proveedor=?, categoria=?, existencia=?, minima=?, maxima=?, preciocosto=?, presentacion=? where codigo=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$codigoalterno);	
$resultado->bindParam(2,$producto);	
$resultado->bindParam(3,$proveedor);	
$resultado->bindParam(4,$categoria);	
$resultado->bindParam(5,$existencia);	
$resultado->bindParam(6,$minima);	
$resultado->bindParam(7,$maxima);	
$resultado->bindParam(8,$costo);	
$resultado->bindParam(9,$presentacion2);	
$resultado->bindParam(10,$codigo);	
$resultado->execute();	
}else{	
$query = "Select codigo from inventario order by codigo asc";
$resultado=$db->prepare($query);
$resultado->execute();	
foreach ($resultado as $key =>$y){
$codigo=$y['codigo'];
}
$numero= 1;
$codigo= $codigo + $numero;	
$guardar = "Insert INTO inventario(codigo, codigo_alterno, producto, proveedor, categoria, existencia, minima, maxima, preciocosto, presentacion) VALUES(?,?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$codigo);	
$resul->bindParam(2,$codigoalterno);	
$resul->bindParam(3,$producto);	
$resul->bindParam(4,$proveedor);	
$resul->bindParam(5,$categoria);	
$resul->bindParam(6,$existencia);	
$resul->bindParam(7,$minima);	
$resul->bindParam(8,$maxima);	
$resul->bindParam(9,$costo);	
$resul->bindParam(10,$presentacion2);	
$resul->execute();	
}
?>
 