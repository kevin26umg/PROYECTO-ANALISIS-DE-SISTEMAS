<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');
$db=conectar();
$id=$_POST['id'];
//$delete=$db->consulta("Delete from categorias where id='$id'");
$query="Delete from categorias where id= :buscar";
$resultado=$db->prepare($query);
$resultado->bindParam(":buscar",$id);	
$resultado->execute();	
?>