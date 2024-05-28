
<?php
/*busca el articulo para punto de venta*/
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
$factura=$_POST['factura'];
$proveedor=$_POST['proveedor'];
$tipodoc=$_POST['tipodoc'];

//$cadena="select * from ventas where Factura='$factura'";
//$exe=$db->consulta($cadena);
 //if($db->numero_de_registros($exe)>0){
 
//  if($proveedor==""){
     $query = "select * from compras where factura= :buscar";
//  }else
//  {
// $query = "select * from compras where factura= :buscar and proveedor= :buscar2";     
//  }

$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->factura)){ 
   $array=array();
   $i=0;
    $resultado->bindParam(":buscar",$factura);	
    // $resultado->bindParam(":buscar2",$proveedor);
    $resultado->execute();	
	foreach ($resultado as $key =>$re){ 
      $array[$i]=$re;
      $i++;
   }
   echo json_encode($array);
}else{
 }
 

?>