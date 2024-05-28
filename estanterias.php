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
$query = "SELECT estanteria from estanterias order by estanteria asc limit 100";
$resultado=$db->prepare($query);
$rows = $resultado->fetch(/* nothing here */);
if(!isset($rows[0]->codigo)){

    $resultado->execute();
    
    
    

            
	foreach ($resultado as $key =>$gt){
    echo '<option value="'.$gt['estanteria'].'">'.$gt['estanteria'].'</option>';
  }

  
  
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}


?>


       
 