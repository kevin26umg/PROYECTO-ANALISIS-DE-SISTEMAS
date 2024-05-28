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

$db=new ConexionMySQL();
$set_names=$db->consulta("SET NAMES 'utf8'");

$id=test_input($_POST['id']);
$categoria=test_input($_POST['categoria']);

$revisa_articulo=$db->consulta("Select * from categorias where id='$id'");
if($db->numero_de_registros($revisa_articulo)>0){
$modifica_articulo=$db->consulta("Update categorias set categoria='$categoria' where id='$id'");
  $exec=$db->consulta($modifica_articulo);
  echo "3";	
}else{	
$busca_factura=$db->consulta("Select id from categorias order by id asc");
while($y=$db->buscar_array($busca_factura)){
   $id=$y['id'];
}
$numero= 1;
$id= $id + $numero;	
$guardar="Insert into categorias(id, categoria) values(
'$id', '$categoria')";
$exec=$db->consulta($guardar);
}
?>
 