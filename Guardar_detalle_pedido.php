
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
$cantidadn=$_POST['cantidadn'];
$total=$_POST['total'];
$categoria=$_POST['categoria'];
$costo=$_POST['costo'];
$presentacion=$_POST['presentacion'];
$descuento=$_POST['descuento'];

$unidades=$_POST['unidades'];





$revisa = "Select * from detalle_ventas where factura= :iddd and codigo=:iddd2 and precio=:iddd3";
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
$existenciamenos=$existenciaactual-$cantidadn;

$query="Update detalle_ventas set fecha=?, fecha2=?, producto=?, cantidad=?, total=?, categoria=?, costo=?, presentacion=?, unidades=? where factura=? and codigo=? and precio=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$fecha);	
$resultado->bindParam(2,$fecha2);	
$resultado->bindParam(3,$producto);	
$resultado->bindParam(4,$cantidadnueva);	
$resultado->bindParam(5,$totalnuevo);	
$resultado->bindParam(6,$categoria);	
$resultado->bindParam(7,$costo);	
$resultado->bindParam(8,$presentacion);
$resultado->bindParam(9,$unidades);
$resultado->bindParam(10,$factura);	
$resultado->bindParam(11,$codigo);	
$resultado->bindParam(12,$precio);	
$resultado->execute();	

$query2="Update inventario set existencia=? where codigo=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$existenciamenos);	
$resultado2->bindParam(2,$codigo);	
$resultado2->execute();	

$totalnuevo1=0;
$querytotal = "select * from detalle_ventas where factura= :cod";
$resultadototal=$db->prepare($querytotal);
$rows3 = $resultadototal->fetchAll(/* nothing here */);
if(!isset($rows3[0]->total)){
      $resultadototal->bindParam(":cod",$factura);	
      $resultadototal->execute();
	  foreach ($resultadototal as $key =>$total){
      $totalnuevo1+=$total['total'];
      }
    }else{
   echo "0";
 }
 


$query5="Update ventas set total=? where factura=?";
$resultado5=$db->prepare($query5);
$resultado5->bindParam(1,$totalnuevo1);	
$resultado5->bindParam(2,$factura);	
$resultado5->execute();	


}else{

$existenciamenos2=$existenciaactual-$cantidadn;

$guardar = "Insert INTO detalle_ventas(factura, fecha, fecha2, codigo, producto, precio, cantidad, descuento, total, categoria, costo, presentacion,unidades) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$factura);	
$resul->bindParam(2,$fecha);	
$resul->bindParam(3,$fecha2);	
$resul->bindParam(4,$codigo);	
$resul->bindParam(5,$producto);	
$resul->bindParam(6,$precio);	
$resul->bindParam(7,$cantidad);	
$resul->bindParam(8,$descuento);	
$resul->bindParam(9,$total);	
$resul->bindParam(10,$categoria);	
$resul->bindParam(11,$costo);	
$resul->bindParam(12,$presentacion);	
$resul->bindParam(13,$unidades);	
$resul->execute();	


$query3="Update inventario set existencia=? where codigo=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$existenciamenos2);	
$resultado3->bindParam(2,$codigo);	
$resultado3->execute();	



$totalnuevo2=0;
$querytotal2 = "select * from detalle_ventas where factura= :cod";
$resultadototal2=$db->prepare($querytotal2);
$rows2 = $resultadototal2->fetchAll(/* nothing here */);
if(!isset($rows2[0]->total)){
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