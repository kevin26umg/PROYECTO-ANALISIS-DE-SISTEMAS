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
$categoria="";
$set_names=$db->query("SET NAMES 'utf8'");
$codigo=$_POST['codigop'];
$codigoalterno=$_POST['codigobarra'];
$producto=$_POST['producto'];
$proveedor=$_POST['proveedor'];
$marca=$_POST['marca'];
$inversion=$_POST['inversion'];
$aplicacion=$_POST['aplicacion'];
$existencia=$_POST['existencia'];
$presentacion2=$_POST['presentacionp'];
$minima=$_POST['minima'];
$maxima=$_POST['maxima'];
$categoria=$_POST['categoria'];
$categoriax=$_POST['categoriaxd'];

if($categoriax!=""){
    $categoria=$categoriax;
}

echo $categoria."-cate";


$precioa=$_POST['precioa'];
$preciob=$_POST['preciob'];
$precioc=$_POST['precioc'];
$preciod=$_POST['preciod'];
$precioe=$_POST['precioe'];

$uprecioe=$_POST['upe'];


$costo=$_POST['preciocosto'];
$descuento=$_POST['descuento'];
$estanteria=$_POST['estanteria'];



$imagen1 = $_FILES['archivo']['name'];	
$imagen2 = $_FILES['archivo2']['name'];	
$imagen3 = $_FILES['archivo3']['name'];	
$imagen4 = $_FILES['archivo4']['name'];	
$imagen5 = $_FILES['archivo5']['name'];	
$imagen6 = $_FILES['archivo6']['name'];	


$revisa = "Select * from inventario where codigo= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$codigo);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$condi){
$codigoalterno2=$condi['codigo'];
$ri1=$condi['imagen'];
$ri2=$condi['imagen2'];
$ri3=$condi['imagen3'];
$ri4=$condi['imagen4'];
$ri5=$condi['imagen5'];
$ri6=$condi['imagen6'];
}

if ($imagen1==null){
$imagen1=$ri1;    
}
if ($imagen2==null){
$imagen2=$ri2;    
}
if ($imagen3==null){
$imagen3=$ri3;    
}
if ($imagen4==null){
$imagen4=$ri4;    
}
if ($imagen5==null){
$imagen5=$ri5;    
}
if ($imagen6==null){
$imagen6=$ri6;    
}



if($codigo==""){
    
$guarda1="Insert into inventario (codigo_alterno, producto, proveedor, categoria, minima, maxima, precioa, preciob, precioc,preciod,precioe, presentacion, existencia, imagen, imagen2, imagen3, imagen4, imagen5, imagen6, preciocosto, descuento, marca, upe) values ('$codigoalterno','$producto','$proveedor', '$categoria', '$minima', '$maxima', '$precioa','$preciob','$precioc','$preciod','$precioe','$presentacion2', '$existencia', '$imagen', '$imagen2', '$imagen3', '$imagen4', '$imagen5', '$imagen6', '$costo', '$descuento', '$marca', '$uprecioe')";
$guarda=$db->prepare($guarda1);
$guarda->execute();	

$revisax = "Select * from inventario order by codigo desc limit 1";
$resultadorevisax=$db->prepare($revisax);
$resultadorevisax->execute();	
foreach ($resultadorevisax as $key =>$condix){
$codigo=$condix['codigo'];
}
}else

{
    
    
        if($codigoalterno2==$codigo){
            
         
    
$query="Update inventario set producto=?, proveedor=?, marca=?, categoria=?, minima=?, maxima=?, precioa=?, presentacion=?, existencia=?, imagen=?, imagen2=?, imagen3=?, imagen4=?, imagen5=?, imagen6=?, codigo_alterno=?, preciob=?, precioc=?,preciod=?,precioe=?, preciocosto=?, descuento=?,upe=? where codigo=?";
$resultado=$db->prepare($query);


$resultado->bindParam(1,$producto);	
$resultado->bindParam(2,$proveedor);	
$resultado->bindParam(3,$marca);
$resultado->bindParam(4,$categoria);
$resultado->bindParam(5,$minima);	
$resultado->bindParam(6,$maxima);	
$resultado->bindParam(7,$precioa);	
$resultado->bindParam(8,$presentacion2);
$resultado->bindParam(9,$existencia);	
$resultado->bindParam(10,$imagen1);
$resultado->bindParam(11,$imagen2);	
$resultado->bindParam(12,$imagen3);	
$resultado->bindParam(13,$imagen4);	
$resultado->bindParam(14,$imagen5);	
$resultado->bindParam(15,$imagen6);	
$resultado->bindParam(16,$codigoalterno);	
$resultado->bindParam(17,$preciob);	
$resultado->bindParam(18,$precioc);
$resultado->bindParam(19,$preciod);	
$resultado->bindParam(20,$precioe);	
$resultado->bindParam(21,$costo);	
$resultado->bindParam(22,$descuento);	
$resultado->bindParam(23,$uprecioe);	
$resultado->bindParam(24,$codigo);	
$resultado->execute();	
}else
{

}
}
?>
<script type="text/javascript">
var codbarrax="";
codbarrax= <?php echo $codigo;?>;
$('#codigop').val(codbarrax);
</script>
 