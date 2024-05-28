<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
$sucursal=$_POST['sucursal'];
if ($sucursal=='RETALHULEU'){
  include('./class_lib/class_conecta_mysql.php');
}
if ($sucursal=='TECÚN UMÁN'){
  include('./class_lib/class_conecta_mysql2.php');
}
if ($sucursal=='CABALLO BLANCO'){
  include('./class_lib/class_conecta_mysql3.php');
}
require('class_lib/funciones.php');
$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
echo '1 '.$sucursal;
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
$metros=$_POST['metros'];
$unidades=$_POST['unidades'];
$presentacion=$_POST['presentacion'];

echo ' 2 '.$factura;

$query3="Update detalle_traslados set sucursal=? where factura=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$sucursal);	
$resultado3->bindParam(2,$factura);	
$resultado3->execute();	

?> 