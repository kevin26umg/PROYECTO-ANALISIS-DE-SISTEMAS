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
$codigo=$_POST['producto'];
$existencia=$_POST['existencia'];
$nit=$_POST['nit'];
$sucursal=$_SESSION['sucursal'];    

//$cadena=$db->consulta("Select * from sucursales where id!='$sucursal'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from sucursales where id!= :suc";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->id)){
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Sucursal</th>";
    echo "<th>Existencia</th>";
    echo "<tbody>";
  //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":suc",$sucursal);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){         
    echo "<tr>";
    echo "<td>".$gt['id']."</td>";
    echo "<td>".$gt['sucursal']."</td>";
    echo "<td>".$gt['existencia']."</td>";
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>