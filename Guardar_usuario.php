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
$id=$_POST['id'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$tipouser=$_POST['tipouser'];
$comision=$_POST['comision'];
$imagen1 = $_FILES['archivo']['name'];	


$cotizaciones=$_POST['cotizaciones'];
$histocotizaciones=$_POST['histocotizaciones'];
$ventas=$_POST['ventas'];
$histoventas=$_POST['histoventas'];
$compras=$_POST['compras'];
$histocompras=$_POST['histocompras'];
$clientes=$_POST['clientes'];
$inventario=$_POST['inventario'];
$reporte=$_POST['reporte'];
$proveedores=$_POST['proveedores'];
$usuarios=$_POST['usuarios'];

$revisa = "Select * from usuarios where id= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$id);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$condi){
$user2=$condi['id'];
$ri1=$condi['imagen'];
}

if ($imagen1==null){
$imagen1=$ri1;    
}

if(($id=="") || ($id==0)){
   $query = "Select id from usuarios order by id asc";
$resultado=$db->prepare($query);
$resultado->execute();	
foreach ($resultado as $key =>$y){
$id=$y['id'];

}

$id = $id + 1;	

$guarda1="Insert into usuarios (id, Usuario, Password, imagen, ventas, historialventas, compras, historialcompras, clientes, proveedores, reporteinventario, usuarios, cotizaciones, historialcotizaciones, inventario) values ('$id','$user','$pass','$imagen1','$ventas','$histoventas','$compras','$histocompras','$clientes','$proveedores','$reporte','$usuarios','$cotizaciones','$histocotizaciones','$inventario')";
$guarda=$db->prepare($guarda1);
$guarda->execute();	


    }else{
      if($user2==$id){
        echo " ntra";
        $query="Update usuarios set Usuario=?, Password=?, ventas=?, historialventas=?, compras=?, historialcompras=?, clientes=?, proveedores=?, reporteinventario=?, usuarios=?, cotizaciones=?, historialcotizaciones=?, inventario=?, imagen=? where id=?";
        $resultado=$db->prepare($query);
        $resultado->bindParam(1,$user);	
        $resultado->bindParam(2,$pass);	
        $resultado->bindParam(3,$ventas);	
        $resultado->bindParam(4,$histoventas);	
        $resultado->bindParam(5,$compras);	
        $resultado->bindParam(6,$histocompras);	
        $resultado->bindParam(7,$clientes);	
        $resultado->bindParam(8,$proveedores);	
        $resultado->bindParam(9,$reporte);	
        $resultado->bindParam(10,$usuarios);	
        $resultado->bindParam(11,$cotizaciones);	
        $resultado->bindParam(12,$histocotizaciones);	
        $resultado->bindParam(13,$inventario);	
        $resultado->bindParam(14,$imagen1);	
        $resultado->bindParam(15,$id);	
        echo " ntra2";
        $resultado->execute();	
        echo " ntra3";
         
        }
    }



?> 