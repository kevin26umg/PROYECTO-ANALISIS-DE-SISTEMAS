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
$codigo=$_POST['codigop'];
$codigoalterno=$_POST['codigobarra'];
$producto=$_POST['producto'];
$proveedor=$_POST['proveedor'];
$marca=$_POST['marca'];
$inversion=$_POST['inversion'];
$aplicacion=$_POST['aplicacion'];
$existencia=0;
$presentacion2=$_POST['presentacionp'];
$minima=$_POST['minima'];
$maxima=$_POST['maxima'];


$precioa=$_POST['precioa'];
$preciob=$_POST['preciob'];
$precioc=$_POST['precioc'];


$costo=$_POST['costo'];
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
    
$guarda1="Insert into inventario (codigo_alterno, producto, proveedor, marca, aplicacion, minima, maxima, precioa, preciob, precioc, presentacion, imagen, imagen2, imagen3, imagen4, imagen5, imagen6, preciocosto, descuento) values ('$codigoalterno','$producto','$proveedor', '$marca', '$aplicacion', '$minima', '$maxima', '$precioa','$preciob','$precioc','$presentacion2', '$imagen', '$imagen2', '$imagen3', '$imagen4', '$imagen5', '$imagen6', '$costo', '$descuento')";
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
            
         
    
$query="Update inventario set producto=?, proveedor=?, marca=?, aplicacion=?, minima=?, maxima=?, precioa=?, presentacion=?, imagen=?, imagen2=?, imagen3=?, imagen4=?, imagen5=?, imagen6=?, codigo_alterno=?, preciob=?, precioc=?, preciocosto=?, descuento=? where codigo=?";
$resultado=$db->prepare($query);


$resultado->bindParam(1,$producto);	
$resultado->bindParam(2,$proveedor);	
$resultado->bindParam(3,$marca);
$resultado->bindParam(4,$aplicacion);
$resultado->bindParam(5,$minima);	
$resultado->bindParam(6,$maxima);	
$resultado->bindParam(7,$precioa);	
$resultado->bindParam(8,$presentacion2);
$resultado->bindParam(9,$imagen1);
$resultado->bindParam(10,$imagen2);	
$resultado->bindParam(11,$imagen3);	
$resultado->bindParam(12,$imagen4);	
$resultado->bindParam(13,$imagen5);	
$resultado->bindParam(14,$imagen6);	
$resultado->bindParam(15,$codigoalterno);	
$resultado->bindParam(16,$preciob);	
$resultado->bindParam(17,$precioc);	
$resultado->bindParam(18,$costo);	
$resultado->bindParam(19,$descuento);	
$resultado->bindParam(20,$codigo);	
$resultado->execute();	

}else
{
//     $query2 = "Select codigo from inventario order by codigo asc";
// $resultadoa=$db->prepare($query2);
// $resultadoa->execute();	
$guarda1="Insert into inventario (codigo_alterno, producto, proveedor, marca, aplicacion, minima, maxima, precioa, preciob, precioc, presentacion, imagen, imagen2, imagen3, imagen4, imagen5, imagen6, preciocosto, descuento) values ('$codigoalterno','$producto','$proveedor', '$marca', '$aplicacion', '$minima', '$maxima', '$precioa','$preciob','$precioc','$presentacion2', '$imagen', '$imagen2', '$imagen3', '$imagen4', '$imagen5', '$imagen6', '$costo', '$descuento')";
$guarda=$db->prepare($guarda1);
$guarda->execute();	

$revisax = "Select * from inventario order by codigo desc limit 1";
$resultadorevisax=$db->prepare($revisax);
$resultadorevisax->execute();	
foreach ($resultadorevisax as $key =>$condix){
$codigo=$condix['codigo'];
}


}
}


?>
<script type="text/javascript">
var codbarrax="";
codbarrax= <?php echo $codigo;?>;
$('#codigop').val(codbarrax);
</script>
 