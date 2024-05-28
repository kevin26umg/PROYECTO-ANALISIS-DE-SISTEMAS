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
$id=$_POST['id'];
//$delete=$db->consulta("Delete from clientes where id='$id'");
$query="Delete from clientes where id= :buscar";
$resultado=$db->prepare($query);
$resultado->bindParam(":buscar",$id);	
$resultado->execute();	

?>