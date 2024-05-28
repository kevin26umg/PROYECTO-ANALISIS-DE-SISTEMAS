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

    $query = "Select DISTINCT proveedor from proveedores order by proveedor asc";


$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->cliente)){

                                      
                                        
echo '<option disabled selected value="">Seleccione un proveedor</option>';


   	$resultado->execute();	
	foreach ($resultado as $key =>$re){    
	    
	   // if(($re['categoria']=="") || ($re['categoria']=="a") || ($re['categoria']=="x") || ($re['categoria']=="xxxx") || ($re['categoria']=="null")){
	        
	   // }else
	   // {
echo ' <option value="'.$re['proveedor'].'">'.$re['proveedor'].'</option>';	        
	   // }
  
 

    }
    
?>    

<?php   





}else{
 echo "<li><h3>No hay datos</h3></li>";
}
	
?>

