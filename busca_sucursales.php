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
$query = "Select * from sucursales where id!= :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->id)){
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Sucursal</th>";
    echo "<th>  </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$sucursal);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo "<td>".$gt['id']."</td>";
    echo "<td>".$gt['sucursal']."</td>";
    $varproductos=$gt['id'];
    echo "<td style='font-size:16px; text-align: center;'><button type='button' class='btn btn-primary btn-small' id='$varproductos' onclick='guardar_traslado(this.id);'><i class='fa fa-reply'> Elegir</button></td>";

    
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>