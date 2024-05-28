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
$art=$_POST['codigoalterno'];
$art="$art";
//$cadena=$db->consulta("Select * from presentaciones where codigo='$art'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from presentaciones where codigo= :buscar order by precio asc";
$resultado=$db->prepare($query);
$resultado->bindParam(":buscar",$art);	
$resultado->execute();
$bus = $resultado->fetchAll(PDO::FETCH_ASSOC);
if($bus){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='text-align:center;'>ID</th>";
    echo "<th style='text-align:center;'>Presentación</th>";
    echo "<th style='text-align:center;'>Unidades</th>";
    echo "<th style='text-align:center;'>Precio</th>";
    echo "<th style='text-align:center;'>Editar</th>";
    echo "<th style='text-align:center;'>Eliminar</th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td  style="text-align:center;">'.$gt['id']."</td>";
    echo '<td style="text-align:center;">'.$gt['presentacion']."</td>";
    echo '<td style="text-align:center;">'.$gt['unidades']."</td>";
    echo '<td style="text-align:center;">Q'.$gt['precio']."</td>";
    $varproductos2=$gt['codigo']."|".$gt['tipo_precio']."|".$gt['precio']."|".$gt['unidades'];
    $varproductos=$gt['id'];
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='editarprecio(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminarprecio(this.id);'><i class='fa fa-trash-o'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>