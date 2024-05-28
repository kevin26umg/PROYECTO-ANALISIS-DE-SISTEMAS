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
$artt=$_POST['producto'];
$artt="%$artt%";
//$cadena=$db->consulta("Select * from categorias where categoria like '%$artt%'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from categorias where categoria like :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->categoria)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Categoría</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
  //while($gt=$db->buscar_array($cadena)){
  $resultado->bindParam(":buscar",$artt);	
  $resultado->execute();	
  foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td style="text-align:center;">'.$gt['id']."</td>";
    echo '<td style="text-align:center;">'.$gt['categoria']."</td>";
    $varproductos=$gt['id'];
    echo "<td style='text-align: right;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='modificar_categoria(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: left;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminar_item2(this.id);'><i class='fa fa-trash-o'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>