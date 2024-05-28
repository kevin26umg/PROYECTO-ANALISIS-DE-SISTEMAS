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
$db->query("SET NAMES 'utf8'");
//$cadena="Select * from clientes order by nit";
//$exe=$db->consulta($cadena);
//if($db->numero_de_registros($exe)>0){
$query = "SELECT * from clientes order by nit";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->nit)){
 echo "<table id='sample-table-3' class='table table-bordered table-hover'>";
 echo "<thead>";
 echo "<tr>";
 echo "<th>Nit</th><th>Nombre</th><th>Telefono</th><th>Saldo</th><th>Saldo Limite</th><th>Agregar</th>";
 echo "</tr>";
 echo "</thead>";
 echo "<tbody>";
 //while($e=$db->buscar_array($exe)){
 $resultado->execute();	
 foreach ($resultado as $key =>$e){
   echo "<tr>";
   echo "<td style='text-align: center;'>$e[nit]</td>";
   echo "<td style='text-align: center;'>$e[cliente]</td>";
   echo "<td style='text-align: center;'>$e[telefono]</td>";
   echo "<td style='text-align: center;'>$e[saldo]</td>";
   echo "<td style='text-align: center;'>$e[limite_saldo]</td>";
   
   $elidcliente=$e['nit']."|".$e['cliente']."|".$e['direccion'];
   echo "<td style='text-align: center;'><button type='button' class='btn btn-mini btn-success' id='$elidcliente' onclick='pone_cliente_contado(this.id);'>Agregar</button></td>";
   echo "</tr>";
    }
  echo "</tbody>";
  echo "</table>";
}else{
 echo "Actualmente no hay Clientes registrados...";
}


?>