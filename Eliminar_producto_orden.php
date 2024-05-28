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



$revisainventariox = "Select * from detalle_servicios where id=:idddax";
$resultadorevisa2x=$db->prepare($revisainventariox);
$resultadorevisa2x->bindParam(":idddax",$id);
$resultadorevisa2x->execute();	
foreach ($resultadorevisa2x as $key =>$ra2x){
$codigorev=$ra2x['codigo'];
}


if(($codigorev!="") || ($codigorev!=0)){
$revisainventarioxx = "Select * from detalle_servicios where factura=:idddaxx and codigo=:codigorev order by id desc limit 1";
$resultadorevisa2xx=$db->prepare($revisainventarioxx);
$resultadorevisa2xx->bindParam(":idddaxx",$factura);
$resultadorevisa2xx->bindParam(":codigorev",$codigo);
$resultadorevisa2xx->execute();	
foreach ($resultadorevisa2xx as $key =>$ra2xx){
    
$idr=$ra2xx['id'];

 $codigor=$ra2xx['codigo'];

 $cantidadr=$ra2xx['cantidad'];

$revisainventario = "Select * from inventario where codigo= :iddda";
$resultadorevisa2=$db->prepare($revisainventario);
$resultadorevisa2->bindParam(":iddda",$codigo);
$resultadorevisa2->execute();	
foreach ($resultadorevisa2 as $key =>$ra2){
$existenciaactual=$ra2['existencia'];
}

$existenciamenos=$existenciaactual+$cantidadr;
$query2="Update inventario set existencia=? where codigo=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$existenciamenos);	
$resultado2->bindParam(2,$codigo);	
$resultado2->execute();


$update = "delete from detalle_servicios where id= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":buscar"=>$id));

$updatex = "delete from detalle_servicios where id= :buscar";
$updx=$db->prepare($updatex);
$updx->execute(array(":buscar"=>$idr));
}
    
    
    
}else{
$update = "delete from detalle_servicios where id= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":buscar"=>$id));
}
/*

$update = "delete from detalle_servicios where id= :buscar";
$upd=$db->prepare($update);
$upd->execute(array(":buscar"=>$id));

*/


 
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
 