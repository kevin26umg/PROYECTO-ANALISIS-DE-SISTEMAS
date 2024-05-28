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
$producto=$_POST['producto'];
$presentacion=$_POST['presentacion'];
//$cantidad=test_input($_POST['cantidad'];
$precio=$_POST['precio'];
$total=$_POST['total'];
$factura=$_POST['factura'];
$fecha= date ("Y-m-d");
$fecha2= date ("Y-m-d H:i:s");
$codigo=$_POST['codigo'];
$nit=$_POST['nit'];
$cliente=$_POST['cliente'];
$direccion=$_POST['direccion'];
$tipo=$_POST['tipo'];
$totales=$_POST['totales'];
$usuario=$_SESSION['nombre_de_usuario'];
$uni=$_POST['uni'];
$tipodoc=$_POST['tipodoc'];

$query_departamento = "Select preciocosto, existencia, categoria from inventario where codigo= :buscar";
$resultadodep=$db->prepare($query_departamento);
$resultadodep->bindParam(":buscar",$codigo);	
$resultadodep->execute();	
foreach ($resultadodep as $key =>$y){
   $costo=$y['preciocosto'];
   $existencia=$y['existencia'];
   $categoria=$y['categoria'];
}
$cantidad=$_POST['cantidad'];

$candescargar=$cantidad*$uni;
$costo=$candescargar*$costo;
if ($tipodoc=='Altas # 1' || $tipodoc=='Altas # 2' || $tipodoc=='Altas # 3'){
$totalexistencia=$existencia + $candescargar;
}else{
$totalexistencia=$existencia - $candescargar;    
}

$queryupdate="Update inventario set existencia= :modificar where codigo= :buscar";
$resultadoupdate=$db->prepare($queryupdate);
$resultadoupdate->bindParam(":modificar",$totalexistencia);	
$resultadoupdate->bindParam(":buscar",$codigo);	
$resultadoupdate->execute();	

$query_factura = "Select id from detalle_ventas order by id asc";
$resultadofac=$db->prepare($query_factura);
$resultadofac->execute();	
foreach ($resultadofac as $key =>$yy){
   $id=$yy['id'];
}
$numero= 1;
$id= $id + $numero;

$inserta_productos="Insert INTO detalle_ventas(codigo, producto, precio, cantidad, descuento, total, factura, categoria, fecha, serie, id, costo, fecha2, presentacion) VALUES(:codigo, :producto, :precio, :cantidad, :descuento, :total, :factura, :categoria, :fecha, :serie, :id, :costo, :fecha2, :presentacion)";
$resultado=$db->prepare($inserta_productos);

$descuento='0.00';
$resultado->execute(array(":codigo"=>$codigo, ":producto"=>$producto, ":precio"=>$precio, ":cantidad"=>$cantidad, ":descuento"=>$descuento, ":total"=>$total, ":factura"=>$factura, ":categoria"=>$categoria, ":fecha"=>$fecha, ":serie"=>"", ":id"=>$id, ":costo"=>$costo, ":fecha2"=>$fecha, ":presentacion"=>$presentacion));

$revisa_factura = "Select * from ventas where Factura= :buscar";
$resultadorevisa=$db->prepare($revisa_factura);
$bus = $resultadorevisa->fetch(/* nothing here */);
if(isset($bus->Factura)){
$modifica_factura="Update ventas set Nit= :nitt, Cliente= :clie, Direccion= :dire, Tipo= tipp, Fecha= :fech, Total= :tota, Usuario= :usua where Factura= :buscar";
$resultadomodfac=$db->prepare($modifica_factura);	
$resultadomodfac->execute(array(":nitt"=>$nit, ":clie"=>$cliente, ":dire"=>$direccion, ":tipp"=>$tipo, ":fech"=>$fecha, ":tota"=>$totales, ":usua"=>$usuario, ":buscar"=>$factura));	 
}else{
$guardar_factura="Insert into ventas (Factura, Nit, Cliente, Direccion, Fecha, Tipo, Total, Usuario, comentario)values (:fact, :nitt, :clie, :dire, :fech, :tipp, :tota, :usua, :comentario)";
$resultadoguafac=$db->prepare($guardar_factura);
$resultadoguafac->execute(array(":fact"=>$factura, ":nitt"=>$nit, ":clie"=>$cliente, ":dire"=>$direccion,  ":fech"=>$fecha, ":tipp"=>$tipo, ":tota"=>$totales, ":usua"=>$usuario, ":comentario"=>""));	 
}	
?>
 