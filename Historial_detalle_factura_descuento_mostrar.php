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
$descuento=$_POST['descuento'];
// echo $descuento;
$query = "Select * from detalle_servicios where (factura= :buscar)  order by id asc";
$resultado=$db->prepare($query);
//$rows = $resultado->fetchAll(/* nothing here */);
//if(!isset($rows[0]->factura)){
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){    
	  //$desc=$re['total']+$re['descuento'];
	  //echo '<td style="text-align:center;">Q '.number_format($desc,2,".",",")."</td>";
	  //$totalsindescuento+=$desc;
	  //$desc=($re['descuento']/$desc)*100;    
	    $revisainventario = "Select descuento, codigo, preciob from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$re['codigo']);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        $descuentoinventario=$ra2['descuento'];
        $precio=$ra2['preciob'];
        }
        
        if((($re['categoria']=="Trabajo") || ($re['categoria']=="Trabajox")) &&($re['codigo']=="")){
            
        }else if(($re['codigo']!="")){
            if ($descuentoinventario>$descuento){
        $descuentoinventario=$descuento;
    }    
    $descuento2=$precio*($descuentoinventario/100);
    $precio=$precio-$descuento2;
    $total=$precio*$re['cantidad'];
    echo ' '.$descuento2;
    $descuento2= $descuento2*$re['cantidad'];
    $update = "Update detalle_servicios set descuento= :descuento, repuestos= :precio, total= :total where id= :buscar";
    $upd=$db->prepare($update);
    $upd->execute(array(":descuento"=>$descuento2,":precio"=>$total, ":total"=>$total, ":buscar"=>$re['id']));
            
        }

    
    
	
	}  
	
	
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

