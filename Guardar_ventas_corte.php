<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/funciones.php');
//if ($_SESSION['sucursal']=="1"){
    include('./class_lib/class_conecta_mysql.php');
  //  }
    //if ($_SESSION['sucursal']=="2"){
    //include('./class_lib/class_conecta_mysql2.php');
    //}
    //if ($_SESSION['sucursal']=="3"){
    //include('./class_lib/class_conecta_mysql3.php');
    //}

$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$factura=$_POST['factura'];
$efectivo=$_POST['efectivo'];
//$tarjeta=$_POST['tarjeta'];
$credito=$_POST['credito'];

$modifica_venta=$db->prepare("Update ventas set  efectivo=:efectivo, tarjeta=:tarjeta, credito=:credito where Factura=:factura");
$modifica_venta->execute(array(":efectivo"=>$efectivo,":tarjeta"=>$tarjeta, ":credito"=>$credito, ":factura"=>$factura)); 
?>
 