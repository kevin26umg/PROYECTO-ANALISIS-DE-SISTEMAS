<?php
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
$art=$_POST['producto'];
$art="%$art%";
//$cadena=$db->consulta("Select codigo, producto, presentacion, preciocosto, preciocosto, existencia, proveedor from inventario where producto like '%$art%' or codigo like '%$art%' limit 15 ");
//if($db->numero_de_registros($cadena)>0){
$query = "SELECT codigo, producto, presentacion, preciocosto, existencia, proveedor from inventario where producto like :buscar OR codigo like :buscar OR proveedor like :buscar limit 45";
$resultado=$db->prepare($query);
$rows = $resultado->fetch(/* nothing here */);
if(!isset($rows[0]->codigo)){
//if($resultado->fetchColumn() > 0) {
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Codigo</th>";
    echo "<th>Producto</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Presentacion</th>";
    echo "<th>Existencia</th>";
    // echo "<th>Existencia</th>";
   // echo "<th>Precio</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<tbody>";
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();
	foreach ($resultado as $key =>$gt){
  //while($gt=$db->buscar_array($cadena)){
    echo "<tr>";
    echo "<td>".$gt['codigo']."</td>";
    echo "<td>".$gt['producto']."</td>";
    echo "<td>".$gt['proveedor']."</td>";
    echo "<td>".$gt['presentacion']."</td>";
    echo '<td style="text-align:center;">'.$gt['existencia']."</td>";
    //echo '<td style="text-align:right;">'.$gt['preciod']."</td>";
	  $varproductos=($gt['codigo'])."|".$gt['preciod']."|".$gt['cantidad']."|".$gt['preciocosto']."|".$gt['existencia']."|".$gt['producto'];
   // $varproductos=$gt['codigo'];
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' id='$varproductos' onclick='agrega_a_listas_index(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-naranja btn-xs' id='$varproductos' onclick='mostrar_existencias(this.id);'><i class='fa fa-search'> + Existencias</button></td>";
    
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>