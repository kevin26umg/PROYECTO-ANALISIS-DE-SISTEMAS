<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
//session_start();
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

$db=new ConexionMySQL();
$set_names=$db->consulta("SET NAMES 'utf8'");
$factura=test_input($_POST['factura']);
$fecha= date ("Y-m-d");
$nit=test_input($_POST['nit']);
$cliente=test_input($_POST['cliente']);
$direccion=test_input($_POST['direccion']);
$tipo=test_input($_POST['tipo']);

$modifica_factura=$db->consulta("Update ventas set Nit='$nit', Cliente='$cliente', Direccion='$direccion', Tipo='$tipo' where Factura='$factura'");
  $exec=$db->consulta($modifica_factura);
	
?>
//$update="Update inventario set existencia='$totalexistencia' where codigo='$codigo'";
//$ejecuta=$db->consulta($update);