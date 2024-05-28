<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/class_conecta_mysql.php');
require('class_lib/funciones.php');

$db=new ConexionMySQL();
$set_names=$db->consulta("SET NAMES 'utf8'");

$id=test_input($_POST['id']);
$nit=test_input($_POST['nit']);
$cliente=test_input($_POST['cliente']);
$contacto=test_input($_POST['contacto']);
$direccion=test_input($_POST['direccion']);
$telefono=test_input($_POST['telefono']);
$correo=test_input($_POST['correo']);
$listado=test_input($_POST['listado']);
$saldolimite=test_input($_POST['saldolimite']);
$plazo=test_input($_POST['plazo']);
$saldo=test_input($_POST['saldo']);

$busca_codigo=$db->consulta("Select * from inventario order by codigo asc");
while($yy=$db->buscar_array($busca_codigo)){
   $codigo=$yy['codigo'];
   $presentacion=$yy['presentacion'];
   $precioa=$yy['precioa'];
   $guardara="Insert into presentaciones(codigo, tipo_precio, presentacion, unidades, precio) values(
'$codigo', 'P. Mayorista 2', '$presentacion', '1', '$precioa')";
$exec=$db->consulta($guardara);

   $preciob=$yy['preciob'];
   $guardarb="Insert into presentaciones(codigo, tipo_precio, presentacion, unidades, precio) values(
'$codigo', 'P. Mayorista', '$presentacion', '1', '$preciob')";
$exec=$db->consulta($guardarb);

   $precioc=$yy['precioc'];
   $guardarc="Insert into presentaciones(codigo, tipo_precio, presentacion, unidades, precio) values(
'$codigo', 'P. Distribuidor', '$presentacion', '1', '$precioc')";
$exec=$db->consulta($guardarc);

   $preciod=$yy['preciod'];
   $guardard="Insert into presentaciones(codigo, tipo_precio, presentacion, unidades, precio) values(
'$codigo', 'P. Público', '$presentacion', '1', '$preciod')";
$exec=$db->consulta($guardard);

}   

?>
 