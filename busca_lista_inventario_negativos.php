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
//$cadena=$db->consulta("Select * from inventario where producto like '%$art%' or codigo_alterno like '%$art%' order by codigo desc limit 30");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from inventario where existencia<0 order by codigo desc";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->producto)){
    echo "<div class='panel panel-info'>";
    //echo "<table class='table table-strip table-bordered'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Código</th>";
    echo "<th>Producto</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Categoría</th>";
    echo "<th>Existencia</th>";
    echo "<th>Miníma</th>";
    echo "<th>Máximo</th>";
    echo "<th>Costo</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    //$resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){

    echo "<tr>";
    if ($gt['existencia']>0){
    echo '<td style="text-align:center;">'.$gt['codigo']."</td>";
    echo '<td style="text-align:left;">'.$gt['producto']."</td>";
    echo '<td style="text-align:left;">'.$gt['proveedor']."</td>";
    echo '<td style="text-align:left;">'.$gt['categoria']."</td>";
    echo '<td style="text-align:center;">'.$gt['existencia']."</td>";
    echo '<td style="text-align:center;">'.$gt['minima']."</td>";
    echo '<td style="text-align:center;">'.$gt['maxima']."</td>";
    echo '<td style="text-align:right;">'.$gt['preciocosto']."</td>";    
    }else{
    echo '<td style="color:red; text-align:center;">'.$gt['codigo']."</td>";
    echo '<td style="color:red; text-align:left;">'.$gt['producto']."</td>";
    echo '<td style="color:red; text-align:left;">'.$gt['marca']."</td>";
    echo '<td style="color:red; text-align:left;">'.$gt['categoria']."</td>";
    echo '<td style="color:red; text-align:center;">'.$gt['existencia']."</td>";
    echo '<td style="color:red; text-align:center;">'.$gt['minima']."</td>";
    echo '<td style="color:red; text-align:center;">'.$gt['maxima']."</td>";
    echo '<td style="color:red; text-align:right;">'.$gt['preciocosto']."</td>";
    }
    
  	$varproductos=$gt['codigo'];
    echo "<td style='text-align: right;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' ><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: left;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' ><i class='fa fa-trash-o'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>