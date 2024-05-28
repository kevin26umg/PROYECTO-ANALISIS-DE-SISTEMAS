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
//echo $descuento;
$query = "Select * from detalle_ventas where factura= :buscar order by id asc";
$resultado=$db->prepare($query);
//$rows = $resultado->fetchAll(/* nothing here */);
//if(!isset($rows[0]->factura)){
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){
	    
	    
	   // $precio=$re["precio"];
	     $presen=$re["presentacion"];
	  //$desc=$re['total']+$re['descuento'];
	  //echo '<td style="text-align:center;">Q '.number_format($desc,2,".",",")."</td>";
	  //$totalsindescuento+=$desc;
	  //$desc=($re['descuento']/$desc)*100;    
	  
	  
	    $revisainventario = "Select descuento, codigo, precioa,preciob,precioc,preciod,precioe,upe from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$re['codigo']);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        // $descuentoinventario=$ra2['descuento'];
        if($presen=="Docena"){
            $precio=$ra2['preciod']*12;
        }else if($presen=="Fardo"){
            $precio=$ra2['precioe']*$ra2['upe'];
        }else if($presen=="Unidad 1")
        {
            $precio=$ra2['precioa'];
        }else if($presen=="Unidad 2")
        {
            $precio=$ra2['preciob'];
        }else if($presen=="Unidad 3")
        {
            $precio=$ra2['precioc'];
        }
        
        
        }
        
        
        
   
        $descuentoinventario=$descuento;
   
    $descuento2=$precio*($descuentoinventario/100);
    $precio=$precio-$descuento2;
    $total=$precio*$re['cantidad'];
//echo ' '.$descuento2;
    //echo ' '.$re['cantidad'];
    $descuento2=$descuento2*$re['cantidad'];
    $update = "Update detalle_ventas set descuento= :descuento, precio= :precio, total= :total where id= :buscar";
    $upd=$db->prepare($update);
    $upd->execute(array(":descuento"=>$descuento2,":precio"=>$precio, ":total"=>$total, ":buscar"=>$re['id']));
    $totalnuevo2=0;
    $querytotal2 = "select total, factura from detalle_ventas where factura= :cod";
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
    $query4="Update ventas set total=? where factura=?";
    $resultado4=$db->prepare($query4);
    $resultado4->bindParam(1,$totalnuevo2);	
    $resultado4->bindParam(2,$factura);	
    $resultado4->execute();	
	}  
?>

