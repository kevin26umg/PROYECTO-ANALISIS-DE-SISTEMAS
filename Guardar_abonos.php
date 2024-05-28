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
$id=$_POST['id'];
$cliente=$_POST['cliente'];
$saldoabono=$_POST['saldoabono'];
$abono=$_POST['abono'];
$saldofinalabonos=$_POST['saldofinalabonos'];
$usuario=$_SESSION['nombre_de_usuario'];
$fecha= date ("Y-m-d");
echo ' 1 ';
$revisacliente = "Select * from clientes where id= :iddd";
$resultadorevisa4=$db->prepare($revisacliente);
$resultadorevisa4->bindParam(":iddd",$id);
$resultadorevisa4->execute();	
foreach ($resultadorevisa4 as $key =>$a){
$nitr=$a['nit'];
}
echo ' 2 ';
$busca_factura=$db->prepare("Select Boleta from abonos order by Boleta asc");
$busca_factura->execute();	
foreach ($busca_factura as $key =>$y){
   $idboleta=$y['Boleta'];
}
echo ' 3 ';
$numero= 1;
$idboleta= $idboleta + $numero;	
$guardar="Insert into abonos(Boleta,  Nit, Cliente, Saldo, Abono, Fecha, Saldofinal, usuario) values(
'$idboleta',  '$nit', '$cliente', '$saldoabono', '$abono', '$fecha', '$saldofinalabonos', '$usuario')";
$guarda=$db->prepare($guardar);
$guarda->execute();	
//echo $saldofinalabonos.' '.$id;
$modifica_saldo=$db->prepare("Update clientes set saldo=? where id=?");
  //$exec=$db->consulta($modifica_saldo);
 //$resultado3=$db->prepare($query3);
$modifica_saldo->bindParam(1,$saldofinalabonos);	
$modifica_saldo->bindParam(2,$id);
$modifica_saldo->execute();	 

$modifica_saldo=$db->prepare("Update ventas set Factura=? where id=?");
  //$exec=$db->consulta($modifica_saldo);
 //$resultado3=$db->prepare($query3);
$modifica_saldo->bindParam(1,$saldofinalabonos);	
$modifica_saldo->bindParam(2,$id);
$modifica_saldo->execute();	 
?>
 