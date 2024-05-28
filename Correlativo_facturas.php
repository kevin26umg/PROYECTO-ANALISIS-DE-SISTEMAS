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
$query = "Select Factura from ventas order by Factura desc limit 5";
$resultado=$db->prepare($query);
$array=array();
$i=0;
   $resultado->execute();	
   foreach ($resultado as $key =>$y){
   $array[$i]=$y;
   $i++;
   $cuenta=$y['Factura'];
}
   echo json_encode($array);
?>