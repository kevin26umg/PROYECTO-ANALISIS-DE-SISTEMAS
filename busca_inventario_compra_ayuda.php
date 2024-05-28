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
$art=$_POST['producto'];
$art="%$art%";
//$cadena=$db->consulta("Select * from inventario where producto like '%$art%' or codigo like '%$art%' limit 15");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from inventario where producto like :buscar OR codigo like :buscar limit 15";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->codigo)){

    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Codigo</th>";
    echo "<th>Producto</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Presentación</th>";
    echo "<th>Precio Costo</th>";
    echo "<th>   </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo "<td>".$gt['codigo']."</td>";
    echo "<td>".$gt['producto']."</td>";
    echo "<td>".$gt['proveedor']."</td>";
    echo "<td>".$gt['presentacion']."</td>";
    echo "<td>".$gt['preciocosto']."</td>";
    $varproductos=$gt['codigo']."|".$gt['codigo_alterno']."|".$gt['preciocosto']."|".$gt['proveedor']."|".$gt['categoria']."|".$gt['existencia']."|".$gt['minima']."|".$gt['maxima']."|".$gt['presentacion']."|".$gt['producto'];
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' id='$varproductos' onclick='agrega_inventario_compras(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";

    
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>