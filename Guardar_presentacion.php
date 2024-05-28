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
$id=$_POST['codigo'];
$precio=$_POST['precio'];
$presentacion=$_POST['presentacion'];
$unidades=$_POST['unidades'];

//$revisa_articulo=$db->consulta("Select * from presentaciones where codigo='$id' and tipo_precio='$tipoprecio'");
//if($db->numero_de_registros($revisa_articulo)>0){
$revisa_articulo=$db->prepare("Select * from presentaciones where codigo=:codigo and presentacion=:presentacion");
$revisa_articulo->bindParam(":codigo",$id);	
$revisa_articulo->bindParam(":presentacion",$presentacion);	
$revisa_articulo->execute();
$revisa = $revisa_articulo->fetch(PDO::FETCH_ASSOC);
if($revisa){
//$modifica_articulo=$db->consulta("Update presentaciones set presentacion='$presentacion', unidades='$unidades', precio='$precio' where codigo='$id' and tipo_precio='$tipoprecio'");
//  $exec=$db->consulta($modifica_articulo);
$modifica_articulo=$db->prepare("Update presentaciones set  precio=:precio, unidades=:unidades where codigo=:id and presentacion=:presentacion");
$modifica_articulo->execute(array(":precio"=>$precio,":unidades"=>$unidades,":id"=>$id, ":presentacion"=>$presentacion)); 
}else{	
//$guardar="Insert into presentaciones(codigo, tipo_precio,presentacion, unidades, precio) values('$id', '$tipoprecio', '$presentacion', '$unidades', '$precio')";
$guardar=$db->prepare("Insert into presentaciones(codigo, presentacion, precio, unidades) values(:id, :presentacion, :precio, :unidades)");
$guardar->execute(array(":id"=>$id, ":presentacion"=>$presentacion, ":precio"=>$precio, ":unidades"=>$unidades));
}
?>
 