<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);


  include('./class_lib/class_conecta_mysql2.php');

require('class_lib/funciones.php');
$db=conectar();
$id=$_POST['id'];
//$presentacion=$_POST['tipoprecio'];
//$delete=$db->consulta("Delete from presentaciones where codigo='$id' and presentacion='$presentacion'");
$query="Delete from inventario where codigo= :buscar";
$resultado=$db->prepare($query);
$resultado->bindParam(":buscar",$id);	
$resultado->execute();	

?>