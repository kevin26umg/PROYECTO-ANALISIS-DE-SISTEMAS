
<?php include "./class_lib/sesionSecurity.php"; ?>

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
$tipo=$_POST['tipo'];
$total=$_POST['total'];
$cliente=$_POST['cliente'];

echo $cliente.' ';
$revisacredito = "Select * from ventas where Factura= :factura";
$credito=$db->prepare($revisacredito);
$credito->bindParam(":factura",$factura);
$credito->execute();	 
foreach ($credito as $key =>$cre){
$tipo2=$cre['Tipo'];
$total2=$cre['Total'];
}
$saldoactual=0.00;
$revisacliente = "Select * from clientes where cliente= :cliente";
$resultadorevisa4=$db->prepare($revisacliente);
$resultadorevisa4->bindParam(":cliente",$cliente);
$resultadorevisa4->execute();	
foreach ($resultadorevisa4 as $key =>$a){
$saldoactual=$a['saldo'];
$id=$a['id'];
}
echo $tipo.' '.$tipo2;
if ((utf8_decode($tipo)=='Crédito') && ($tipo2=='Efectivo')){
$total=$saldoactual+$total;
echo ' '.$total;
$query2="Update clientes set saldo=? where cliente=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$total);	
$resultado2->bindParam(2,$cliente);	
$resultado2->execute();
}

$query="Update ventas set tipo=? where Factura=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$tipo);	
//$resultado->bindParam(2,$total);	
$resultado->bindParam(2,$factura);	
$resultado->execute();

?> 
