<?php
session_start();
if($_SESSION['autorizado']<>1){
    header("Location: index.php");
}
error_reporting(0);
require('class_lib/funciones.php');
    include('./class_lib/class_conecta_mysql2.php');

$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$id=$_POST['id'];
$presentacion=$_POST['presentacion'];
$unidades=$_POST['unidades'];
$precio=$_POST['precio'];
$tipoprecio=$_POST['tipoprecio'];

//$revisa_articulo=$db->consulta("Select * from presentaciones where codigo='$id' and tipo_precio='$tipoprecio'");
//if($db->numero_de_registros($revisa_articulo)>0){
$revisa_articulo=$db->prepare("Select * from presentaciones where codigo=:codigo and tipo_precio=:tipoprecio");
$revisa_articulo->bindParam(":codigo",$id);	
$revisa_articulo->bindParam(":tipoprecio",$tipoprecio);	
$revisa_articulo->execute();
$revisa = $revisa_articulo->fetch(PDO::FETCH_ASSOC);
if($revisa){
    
//$modifica_articulo=$db->consulta("Update presentaciones set presentacion='$presentacion', unidades='$unidades', precio='$precio' where codigo='$id' and tipo_precio='$tipoprecio'");
//  $exec=$db->consulta($modifica_articulo);
$modifica_articulo=$db->prepare("Update presentaciones set presentacion=:presentacion, unidades=:unidades, precio=:precio where codigo=:id and tipo_precio=:tipoprecio");
$modifica_articulo->execute(array(":presentacion"=>$presentacion, ":unidades"=>$unidades, ":precio"=>$precio,":id"=>$id, ":tipoprecio"=>$tipoprecio)); 
}else{	
//$guardar="Insert into presentaciones(codigo, tipo_precio,presentacion, unidades, precio) values('$id', '$tipoprecio', '$presentacion', '$unidades', '$precio')";
$guardar=$db->prepare("Insert into presentaciones(codigo, tipo_precio, presentacion, unidades, precio) values(:id, :tipoprecio, :presentacion, :unidades, :precio)");
$guardar->execute(array(":id"=>$id, ":tipoprecio"=>$tipoprecio, ":presentacion"=>$presentacion, ":unidades"=>$unidades, ":precio"=>$precio));
}
?>
 