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
$nombre=$_POST['nombre'];
$permisos=$_POST['permisos'];
$pass=$_POST['pass'];
if ($permisos=='1'){
$clave='ventas caja inventario compras proveedores clientes rinventario usuarios';	
}
if ($permisos=='2'){
$clave='ventas compras';	
}
if ($permisos=='3'){
$clave='ventas caja';	
}
if ($permisos=='4'){
$clave='ventas';	
}
echo $_POST['permisos'];
$cadena=$db->prepare("Insert INTO usuarios(Usuario, Password, TipoUsuario) VALUES(:nom, :pas, :clave)");
$cadena->execute(array(":nom"=>$nombre, ":pas"=>$pass, ":clave"=>$clave));
echo '5';
?>


