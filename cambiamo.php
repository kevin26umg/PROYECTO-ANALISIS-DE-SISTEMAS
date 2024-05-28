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
$codigo=$_POST['codigo'];
$id=$_POST['id'];
$cantidad=$_POST['cantidad'];
$precio=$_POST['precio'];
$nuevoprecio=$_POST['nuevoprecio'];
$total=$_POST['total'];
$factura=$_POST['factura'];
$mo=$_POST['mo'];

$update = "Update detalle_servicios set mo= :moo where id= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":moo"=>$mo, ":buscar"=>$id));

    $sumatotal=0.00;
    $tbmo=0.00;
      $tbrep=0.00;
      
$totalnuevo2=0;
$querytotal2 = "select * from detalle_servicios where factura= :cod";
$resultadototal2=$db->prepare($querytotal2);
$rows = $resultadototal2->fetchAll(/* nothing here */);
if(!isset($rows[0]->total)){
      $resultadototal2->bindParam(":cod",$factura);	
      $resultadototal2->execute();
	  foreach ($resultadototal2 as $key =>$total2){
      $totalnuevo2+=$total2['total'];
       $tbmo=$total2['mo'];
       if(($total2['categoria']=="Trabajox") || ($total2['categoria']=="Trabajo")){
       $tbrep=0.00;    
       }else
       {
           $tbrep=$total2['repuestos'];
       }
      
      $sumatotal+=$tbmo+$tbrep;
      }
    }else{
   echo "0";
 }

$query44="Update servicios set total=? where factura=?";
$resultado44=$db->prepare($query44);
$resultado44->bindParam(1,$sumatotal);	
$resultado44->bindParam(2,$factura);	
$resultado44->execute();



?>
 