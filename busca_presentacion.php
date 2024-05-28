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
//$cadena=$db->consulta("Select * from presentaciones where codigo like '%$art%' limit 40");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from presentaciones where codigo like :buscar limit 40";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->codigo)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Código</th>";
    echo "<th>Presentación</th>";
    echo "<th>Unidades</th>";
    echo "<th>Precio</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td style="text-align:center;">'.$gt['codigo']."</td>";
    echo '<td style="text-align:center;">'.$gt['presentacion']."</td>";
    echo '<td style="text-align:center;">'.$gt['unidades']."</td>";
    echo '<td style="text-align:center;">'.$gt['precio']."</td>";
    $varproductos=$gt['codigo']."|".$gt['presentacion'];
    echo "<td style='text-align: right;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='modificar_presentacion(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: left;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminar_item(this.id);'><i class='fa fa-trash-o'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>