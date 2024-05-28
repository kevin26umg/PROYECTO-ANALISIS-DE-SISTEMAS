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
$total=$_POST['total'];
$factura=$_POST['factura'];
echo ' 1 ';
$revisainventario = "Select descuento, precioa, preciob, codigo from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$codigo);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        $descuentoinventario=$ra2['precioa'];
        $preciob=$ra2['preciob'];
        }
echo ' 2 ';
$revisainventarioa = "Select * from detalle_servicios where id= :idddae";
$resultadorevisa2a=$db->prepare($revisainventarioa);
$resultadorevisa2a->bindParam(":idddae",$id);
$resultadorevisa2a->execute();	
foreach ($resultadorevisa2a as $key =>$ra2a){
$presentacion=$ra2a['presentacion'];
$descuento=$ra2a['descuento'];
}
echo ' 3 '.$descuento.' ';
$descuento=($preciob-$precio)*$cantidad;
$total=$precio*$cantidad;
$update = "Update detalle_servicios set  descuento= :descuento, precio= :precio, total= :total, cantidad= :cantidad where id= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":descuento"=>$descuento,":precio"=>$precio, ":total"=>$total, ":cantidad"=>$cantidad, ":buscar"=>$id));

$unidades=1;

echo ' 4 ';
$totalnuevo2=0;
$querytotal2 = "select * from detalle_servicios where factura= :cod";
$resultadototal2=$db->prepare($querytotal2);
$rows = $resultadototal2->fetchAll(/* nothing here */);
if(!isset($rows[0]->total)){
      $resultadototal2->bindParam(":cod",$factura);	
      $resultadototal2->execute();
	  foreach ($resultadototal2 as $key =>$total2){
      $totalnuevo2+=$total2['total'];
      }
    }else{
   echo "0";
 }

echo ' 5 ';
$query4="Update servicios set total=? where factura=?";
$resultado4=$db->prepare($query4);
$resultado4->bindParam(1,$totalnuevo2);	
$resultado4->bindParam(2,$factura);	
$resultado4->execute();	

echo ' 6 ';
$revisainventario = "Select * from inventario where codigo= :iddda";
$resultadorevisa2=$db->prepare($revisainventario);
$resultadorevisa2->bindParam(":iddda",$codigo);
$resultadorevisa2->execute();	
foreach ($resultadorevisa2 as $key =>$ra2){
$existenciaactual=$ra2['existencia'];
}

echo ' 7 ';
$existenciamenos=$existenciaactual-$unidades;
$query2="Update inventario set existencia=? where codigo=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$existenciamenos);	
$resultado2->bindParam(2,$codigo);	
$resultado2->execute();	
?>
 