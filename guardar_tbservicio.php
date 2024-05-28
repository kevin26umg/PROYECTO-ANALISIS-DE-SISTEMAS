
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
$servicio=$_POST['trabajo'];
$mo=$_POST['precio'];
$tipo=$_POST['tipo'];
$cantidad=1;
$categoria='Trabajo';
$fecha= date ("Y-m-d");
$fecha2= date ("Y-m-d H:i:s");






$revisa = "Select * from detalle_servicios where factura= :iddd and producto=:iddd2 and precio=:iddd3";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$factura);
$resultadorevisa->bindParam(":iddd2",$trabajo);
$resultadorevisa->bindParam(":iddd3",$precio);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$ra){
$facturac=$ra['factura'];
$codigoc=$ra['producto'];
$cantidadc=$ra['cantidad'];
$precioc=$ra['precio'];
$totalc=$ra['total'];
}


if($facturac==$factura && $codigoc==$trabajo && $precioc==$precio){


$query="Update detalle_servicios set cantidad=?, total=?, categoria=?, fecha=?, fecha2=? where factura=? and producto=? and precio=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$cantidad);	
$resultado->bindParam(2,$precio);	
$resultado->bindParam(3,$categoria);	
$resultado->bindParam(4,$fecha);	
$resultado->bindParam(5,$fecha2);	
$resultado->bindParam(6,$factura);	
$resultado->bindParam(7,$trabajo);	
$resultado->bindParam(8,$precio);	

}else{


$guardar = "Insert INTO tabla_servicios(servicio, mo, tipo) VALUES(?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$servicio);	
$resul->bindParam(2,$mo);	
$resul->bindParam(3,$tipo);	
$resul->execute();	



}
?> 