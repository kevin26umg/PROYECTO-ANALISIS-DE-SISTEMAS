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
//$cadena=$db->consulta("Select * from compras where proveedor like '%$art%'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from compras where proveedor like :buscar OR Factura like :buscar order by fecha desc limit 100";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->proveedor)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Factura No.</th>";
    echo "<th>Fecha</th>";
    echo "<th>Nit</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Tipo Pago</th>";
    echo "<th>Total</th>";
    echo "<th>Atendió</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    $tipox=$gt['tipo'];
    if($tipox==""){
        $tipo=="Efectivo";
    }
    echo '<td style="text-align:center;">'.$gt['Factura']."</td>";
    echo '<td style="text-align:left;">'.$gt['Fecha']."</td>";
    echo '<td style="text-align:left;">'.$gt['Nit']."</td>";
    echo '<td style="text-align:left;">'.$gt['Proveedor']."</td>";
    echo '<td style="text-align:center;">'.$tipox."</td>";
    echo '<td style="text-align:center;">'.$gt['total']."</td>";
    echo '<td style="text-align:center;">'.$gt['Usuario']."</td>";
    $varproductos=$gt['Factura']."|".$gt['Proveedor'];
    echo "<td style='text-align: right;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar Compra' id='$varproductos' onclick='modificar_comprax(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: left;'><button type='button' class='btn btn-warning btn-xs' data-toggle='tooltip' data-placement='top' title='Imprimir Compra' id='$varproductos' onclick='imprimir_compra(this.id);'><i class='fa fa-print'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>