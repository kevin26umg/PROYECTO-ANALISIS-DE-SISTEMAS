
<?php
/*busca el articulo para punto de venta*/
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
$factura=$_POST['factura'];
$query = "select * from compras where Factura= :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll();
if(!isset($rows[0]->Factura)){ 
    
   $array=array();
   $i=0;
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){
      $array[$i]=$re;
      $i++;
   }
   echo json_encode($array);
 }else{
   echo "0";
 }
?>