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
//$cadena=$db->consulta("Select * from proveedores where proveedor like '%$art%'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from proveedores where proveedor like :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->proveedor)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Id</th>";
    echo "<th>Nit</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Contacto</th>";
    echo "<th>Dirección</th>";
    echo "<th>Telefóno</th>";
    echo "<th>Correo</th>";
    echo "<th>Saldo</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td style="text-align:center;">'.$gt['id']."</td>";
    echo '<td style="text-align:center;">'.$gt['nit']."</td>";
    echo '<td style="text-align:left;">'.$gt['proveedor']."</td>";
    echo '<td style="text-align:left;">'.$gt['contacto']."</td>";
    echo '<td style="text-align:left;">'.$gt['direccion']."</td>";
    echo '<td style="text-align:center;">'.$gt['telefono']."</td>";
    echo '<td style="text-align:left;">'.$gt['correo']."</td>";
    echo '<td style="text-align:right;">'.$gt['saldo']."</td>";
  	$varproductos=$gt['id'];
    echo "<td style='text-align: right;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='modificar_cliente(this.id);'><i class='fa fa-edit'></button></td>";
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