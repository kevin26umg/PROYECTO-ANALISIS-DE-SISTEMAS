
<?php include "./class_lib/sesionSecurity.php"; ?>

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
$descuento=$_POST['descuento'];
$saldolimite=$_POST['saldolimite'];
$plazo=$_POST['plazo'];
$saldo=$_POST['saldo'];

//$revisa_articulo=$db->consulta("Select * from clientes where id='$id'");
//if($db->numero_de_registros($revisa_articulo)>0){
$revisa = "Select * from clientes where id= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$id);
if ($id==''){
    $id=0;
}
//$rows = $resultadorevisa->fetchAll(/* nothing here */);
//if(!isset($rows[0]->id)){
if($id>0){
//$modifica_articulo=$db->consulta("Update clientes set nit='$nit', cliente='$cliente', contacto='$contacto', direccion='$direccion', telefono='$telefono', correo='$correo', listado_precio='$listado', saldo_limite='$saldolimite', plazo='$plazo', saldo='$saldo' where id='$id'");
 // $exec=$db->consulta($modifica_articulo);
$query="Update clientes set nit=?, cliente=?, contacto=?, direccion=?, telefono=?, correo=?, saldo_limite=?, plazo=?, saldo=?, descuento=? where id=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$nit);	
$resultado->bindParam(2,$cliente);	
$resultado->bindParam(3,$contacto);	
$resultado->bindParam(4,$direccion);	
$resultado->bindParam(5,$telefono);	
$resultado->bindParam(6,$correo);	
$resultado->bindParam(7,$saldolimite);	
$resultado->bindParam(8,$plazo);	
$resultado->bindParam(9,$saldo);	
$resultado->bindParam(10,$descuento);	
$resultado->bindParam(11,$id);	
$resultado->execute();	
 
}else{	
//$busca_factura=$db->consulta("Select id from clientes order by id asc");
//while($y=$db->buscar_array($busca_factura)){
$query = "Select id from clientes order by id asc";
$resultado=$db->prepare($query);
$resultado->execute();	
foreach ($resultado as $key =>$y){
$id=$y['id'];
}
$numero= 1;
$id= $id + $numero;	

$guardar = "Insert INTO clientes(id, nit, cliente, contacto, direccion, telefono, correo, saldo_limite, plazo, saldo, descuento) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$id);	
$resul->bindParam(2,$nit);	
$resul->bindParam(3,$cliente);	
$resul->bindParam(4,$contacto);	
$resul->bindParam(5,$direccion);	
$resul->bindParam(6,$telefono);	
$resul->bindParam(7,$correo);	
$resul->bindParam(8,$saldolimite);	
$resul->bindParam(9,$plazo);	
$resul->bindParam(10,$saldo);	
$resul->bindParam(11,$descuento);	
$resul->execute();	
}
?> 