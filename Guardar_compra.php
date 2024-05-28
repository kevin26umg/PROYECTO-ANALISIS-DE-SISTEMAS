
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
$factura=$_POST['factura'];
$nit=$_POST['nit'];
$cliente=$_POST['cliente'];
$telefono=$_POST['telefono'];
$tipo=$_POST['tipo'];
$usuario=$_SESSION['nombre_de_usuario'];
$fecha= $_POST['fecha'];
$direccion=$_POST['direccion'];
$total=0;

//$revisa_articulo=$db->consulta("Select * from clientes where id='$id'");
//if($db->numero_de_registros($revisa_articulo)>0){
$revisa = "Select * from compras where factura= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$factura);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$condi){
$facturac=$condi['Factura'];
}

if(($factura!="") || ($factura!=0)){
    



if($facturac==$factura){

$query="Update compras set Nit=?, Proveedor=?, Direccion=?, Tipo=?, Usuario=?, Fecha=? where Factura=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$nit);	
$resultado->bindParam(2,$cliente);	
$resultado->bindParam(3,$direccion);	
$resultado->bindParam(4,$tipo);	
$resultado->bindParam(5,$usuario);	
$resultado->bindParam(6,$fecha);	
$resultado->bindParam(7,$factura);
$resultado->execute();	
 
 
 

}else
{
  $guarda1="Insert into compras (Factura, Nit, Proveedor, Direccion, tipo, Usuario, Fecha, total) values ('$factura','$nit','$cliente','$direccion','$tipo','$usuario','$fecha','$total')";
$guarda=$db->prepare($guarda1);
$guarda->execute();	  
}








    }
    /*
    else
    {
        
if($facturac==$factura){

$query="Update ventas set Nit=?, Cliente=?, Direccion=?, Tipo=?, Telefono=?, Usuario=?, Fecha=? where Factura=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$nit);	
$resultado->bindParam(2,$cliente);	
$resultado->bindParam(3,$direccion);	
$resultado->bindParam(4,$tipo);	
$resultado->bindParam(5,$telefono);
$resultado->bindParam(6,$usuario);	
$resultado->bindParam(7,$fecha);	
$resultado->bindParam(8,$factura);
$resultado->execute();	
 
 
 
$revisacliente = "Select * from clientes where nit= :iddd";
$resultadorevisa4=$db->prepare($revisacliente);
$resultadorevisa4->bindParam(":iddd",$nit);
$resultadorevisa4->execute();	
foreach ($resultadorevisa4 as $key =>$a){
$nitr=$a['nit'];
}

if($nitr==$nit){
 $query3="Update clientes set cliente=?, telefono=?, direccion=? where nit=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$cliente);	
$resultado3->bindParam(2,$telefono);
$resultado3->bindParam(3,$direccion);
$resultado3->bindParam(4,$nit);	 
$resultado3->execute();	
}
else
{
  $guarda2="Insert into clientes (nit, cliente, telefono, direccion) values ('$nit','$cliente','$telefono','$direccion')";
$guarda2=$db->prepare($guarda2);
$guarda2->execute();	  
}

}
    }

*/

?> 
