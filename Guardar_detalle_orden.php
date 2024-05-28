
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
$fecha= date ("Y-m-d");
$fecha2= date ("Y-m-d H:i:s");
$codigo=$_POST['codigo'];
$producto=$_POST['producto'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$precio=$precio*$cantidad;
$total=$_POST['total'];
$categoria=$_POST['categoria'];
$costo=$_POST['costo'];

$revisa = "Select * from detalle_servicios where factura= :iddd and codigo=:iddd2 and precio=:iddd3";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$factura);
$resultadorevisa->bindParam(":iddd2",$codigo);
$resultadorevisa->bindParam(":iddd3",$precio);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$ra){
$facturac=$ra['factura'];
$codigoc=$ra['codigo'];
$cantidadc=$ra['cantidad'];
$precioc=$ra['precio'];
$totalc=$ra['total'];
}

$revisainventario = "Select * from inventario where codigo= :iddda";
$resultadorevisa2=$db->prepare($revisainventario);
$resultadorevisa2->bindParam(":iddda",$codigo);
$resultadorevisa2->execute();	
foreach ($resultadorevisa2 as $key =>$ra2){
$existenciaactual=$ra2['existencia'];
}



//$rows = $resultadorevisa->fetchAll(/* nothing here */);
//if(!isset($rows[0]->id)){
if($facturac==$factura && $codigoc==$codigo && $precioc==$precio){
//$modifica_articulo=$db->consulta("Update clientes set nit='$nit', cliente='$cliente', contacto='$contacto', direccion='$direccion', telefono='$telefono', correo='$correo', listado_precio='$listado', saldo_limite='$saldolimite', plazo='$plazo', saldo='$saldo' where id='$id'");
 // $exec=$db->consulta($modifica_articulo);
$totalnuevo=$total+$totalc;
$cantidadnueva=$cantidad+$cantidadc;
$existenciamenos=$existenciaactual-$cantidad;

$query="Update detalle_servicios set fecha=?, fecha2=?, producto=?, cantidad=?, total=?, categoria=?, costo=? where factura=? and codigo=? and repuestos=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$fecha);	
$resultado->bindParam(2,$fecha2);	
$resultado->bindParam(3,$producto);	
$resultado->bindParam(4,$cantidadnueva);	
$resultado->bindParam(5,$totalnuevo);	
$resultado->bindParam(6,$categoria);	
$resultado->bindParam(7,$costo);	
$resultado->bindParam(8,$factura);	
$resultado->bindParam(9,$codigo);	
$resultado->bindParam(10,$precio);	
$resultado->execute();	
//echo ' 2cod '.$codigo.' ea '.$existenciaactual.' can '.$cantidad.' em2 '.$existenciamenos;
$query2="Update inventario set existencia=? where codigo=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$existenciamenos);	
$resultado2->bindParam(2,$codigo);	
$resultado2->execute();	

$totalnuevo1=0;
$querytotal = "select * from detalle_servicios where factura= :cod";
$resultadototal=$db->prepare($querytotal);
$rows = $resultadototal->fetchAll(/* nothing here */);
if(!isset($rows[0]->total)){
      $resultadototal->bindParam(":cod",$factura);	
      $resultadototal->execute();
	  foreach ($resultadototal as $key =>$total){
      $totalnuevo1+=$total['total'];
      }
    }else{
   echo "0";
 }
 


$query5="Update servicios set total=? where factura=?";
$resultado5=$db->prepare($query5);
$resultado5->bindParam(1,$totalnuevo1);	
$resultado5->bindParam(2,$factura);	
$resultado5->execute();	


}else{

$existenciamenos2=$existenciaactual-$cantidad;

$guardar = "Insert INTO detalle_servicios(factura, fecha, fecha2, codigo, producto, repuestos, cantidad, total, categoria, costo) VALUES(?,?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$factura);	
$resul->bindParam(2,$fecha);	
$resul->bindParam(3,$fecha2);	
$resul->bindParam(4,$codigo);	
$resul->bindParam(5,$producto);	
$resul->bindParam(6,$precio);	
$resul->bindParam(7,$cantidad);	
$resul->bindParam(8,$total);	
$resul->bindParam(9,$categoria);	
$resul->bindParam(10,$costo);	
$resul->execute();	

//echo ' cod '.$codigo.' ea '.$existenciaactual.' can '.$cantidad.' em2 '.$existenciamenos2;
$query3="Update inventario set existencia=? where codigo=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$existenciamenos2);	
$resultado3->bindParam(2,$codigo);	
$resultado3->execute();	


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
}
?> 