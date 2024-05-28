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

$id=$_POST['id'];
$nit=$_POST['nit'];
$cliente=$_POST['cliente'];
$contacto=$_POST['contacto'];
$direccion=$_POST['direccion'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$saldo=$_POST['saldo'];

//$revisa_articulo=$db->consulta("Select * from proveedores where id='$id'");
//if($db->numero_de_registros($revisa_articulo)>0){
//$modifica_articulo=$db->consulta("Update proveedores set nit='$nit', proveedor='$cliente', contacto='$contacto', direccion='$direccion', telefono='$telefono', correo='$correo', saldo='$saldo' where id='$id'");
 // $exec=$db->consulta($modifica_articulo);
  
//}else{	
//$busca_factura=$db->consulta("Select id from proveedores order by id asc");
//while($y=$db->buscar_array($busca_factura)){
  // $id=$y['id'];
//}
//$numero= 1;
//$id= $id + $numero;	
//$guardar="Insert into proveedores(id, nit, proveedor, contacto, direccion, telefono, correo, saldo) values('$id', '$nit', '$cliente', '$contacto', '$direccion', '$telefono', '$correo', '$saldo')";
//$exec=$db->consulta($guardar);
//}
$revisa = "Select * from clientes where id= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$id);
if ($id==''){
    $id=0;
}
if($id>0){
$query="Update proveedores set nit=?, proveedor=?, contacto=?, direccion=?, telefono=?, correo=?, saldo=? where id=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$nit);	
$resultado->bindParam(2,$cliente);	
$resultado->bindParam(3,$contacto);	
$resultado->bindParam(4,$direccion);	
$resultado->bindParam(5,$telefono);	
$resultado->bindParam(6,$correo);	
$resultado->bindParam(7,$saldo);	
$resultado->bindParam(8,$id);	
$resultado->execute();	
 
}else{	
$query = "Select id from proveedores order by id asc";
$resultado=$db->prepare($query);
$resultado->execute();	
foreach ($resultado as $key =>$y){
$id=$y['id'];
}
$numero= 1;
$id= $id + $numero;	

$guardar = "Insert INTO proveedores(id, nit, proveedor, contacto, direccion, telefono, correo, saldo) VALUES(?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$id);	
$resul->bindParam(2,$nit);	
$resul->bindParam(3,$cliente);	
$resul->bindParam(4,$contacto);	
$resul->bindParam(5,$direccion);	
$resul->bindParam(6,$telefono);	
$resul->bindParam(7,$correo);	
$resul->bindParam(8,$saldo);	
$resul->execute();	
}








?>
 