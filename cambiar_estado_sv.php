
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

echo $factura=$_POST['factura'];
echo $estado=$_POST['estado'];




$query4="Update servicios set estado=? where Factura=?";
$resultado4=$db->prepare($query4);
$resultado4->bindParam(1,$estado);	
$resultado4->bindParam(2,$factura);	
$resultado4->execute();	

?> 