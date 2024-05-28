
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



$comentario=$_POST['comentario'];
$tipo=$_POST['tipo'];
$tiposervicio=$_POST['tiposervicio'];
$cc=$_POST['cc'];
$ano=$_POST['ano'];
$placa=$_POST['placa'];
$nomotor=$_POST['nomotor'];
$estilo=$_POST['estilo'];
$color=$_POST['color'];
$kilometraje=$_POST['kilometraje'];
$nochasis=$_POST['nochasis'];
$usuario=$_POST['tecnico'];
$fechaingreso= date ("Y-m-d");
$horaingreso= date ("H:i:s");
$fechaprometida=$_POST['fechaprometida'];
$direccion=$_POST['direccion'];
$marca=$_POST['marca'];
$estado="En proceso";

$imagen1 = $_FILES['archivo']['name'];	
$imagen2 = $_FILES['archivo2']['name'];	
$imagen3 = $_FILES['archivo3']['name'];	
$imagen4 = $_FILES['archivo4']['name'];	
$imagen5 = $_FILES['archivo5']['name'];	
$imagen6 = $_FILES['archivo6']['name'];	



//$revisa_articulo=$db->consulta("Select * from clientes where id='$id'");
//if($db->numero_de_registros($revisa_articulo)>0){
$revisa = "Select * from servicios where factura= :iddd";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$factura);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$condi){
$facturac=$condi['Factura'];
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

if(($factura=="") || ($factura==0)){
    
$revisax = "Select * from servicios order by Factura desc limit 1";
$resultadorevisax=$db->prepare($revisax);
$resultadorevisax->execute();	
foreach ($resultadorevisax as $key =>$condix){
$factura=$condix['Factura'];
echo "0.1:".$factura." ";
}

if($factura==""){
    $factura="10001";
    echo "1:".$factura." ";
}else
{
    $factura=$factura+1;
    echo "2:".$factura." ";
}

    
$guarda1="Insert into servicios (Factura, Nit, Cliente, Direccion, Tipo, Total, Usuario, comentario, fechaingreso, horaingreso, fechaprometida, telefono, tiposervicio, ano, placa, nomotor, cc, estilo, color, kilometraje, nochasis, imagen, imagen2, imagen3, imagen4, imagen5, imagen6, estado, marca) values ('$factura','$nit','$cliente','$direccion','$tipo','$total','$usuario','$comentario','$fechaingreso','$horaingreso','$fechaprometida','$telefono','$tiposervicio','$ano','$placa','$nomotor','$cc','$estilo','$color','$kilometraje','$nochasis', '$imagen', '$imagen2', '$imagen3', '$imagen4', '$imagen5', '$imagen6', '$estado', '$marca')";
$guarda=$db->prepare($guarda1);
$guarda->execute();	


$revisacliente = "Select * from clientes where nit= :iddd";
$resultadorevisa4=$db->prepare($revisacliente);
$resultadorevisa4->bindParam(":iddd",$nit);
$resultadorevisa4->execute();	
foreach ($resultadorevisa4 as $key =>$a){
$nitr=$a['nit'];
}

if($nitr==$nit){
 $query3="Update clientes set cliente=?, telefono=? where nit=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$cliente);	
$resultado3->bindParam(2,$telefono);
$resultado3->bindParam(3,$nit);	 
$resultado3->execute();	
}
else
{
  $guarda2="Insert into clientes (nit, cliente, telefono) values ('$nit','$cliente','$telefono')";
$guarda2=$db->prepare($guarda2);
$guarda2->execute();	  
}

$revisaclientey = "Select * from vehiculos where nochasis= :idddy";
$resultadorevisa4y=$db->prepare($revisaclientey);
$resultadorevisa4y->bindParam(":idddy",$nochasis);
$resultadorevisa4y->execute();	
foreach ($resultadorevisa4y as $key =>$ay){
$nochasisy=$ay['nochasis'];
}


if($nochasisy==$nochasis){
 $query3y="Update vehiculos set nit=?, ano=?, placa=?, nomotor=?, cc=?, estilo=?, color=?, kilometraje=?, marca=?, cliente=?, telefono=?, direccion=?, observacion=?  where nochasis=?";
$resultado3y=$db->prepare($query3y);
$resultado3y->bindParam(1,$nit);	
$resultado3y->bindParam(2,$ano);
$resultado3y->bindParam(3,$placa);	 
$resultado3y->bindParam(4,$nomotor);	 
$resultado3y->bindParam(5,$cc);	 
$resultado3y->bindParam(6,$estilo);	 
$resultado3y->bindParam(7,$color);	 
$resultado3y->bindParam(8,$kilometraje);	 
$resultado3y->bindParam(9,$marca);	 
$resultado3y->bindParam(10,$cliente);	
$resultado3y->bindParam(11,$telefono);	
$resultado3y->bindParam(12,$direccion);	
$resultado3y->bindParam(13,$comentario);	
$resultado3y->bindParam(14,$nochasis);	 
$resultado3y->execute();	
}
else
{
  $guarda2y="Insert into vehiculos (nit, ano, placa, nomotor, cc, estilo, color, kilometraje, nochasis, marca, cliente, direccion, telefono, observacion) values ('$nit','$ano','$placa','$nomotor','$cc','$estilo','$color','$kilometraje','$nochasis','$marca','$cliente','$direccion','$telefono','$comentario')";
$guarda2y=$db->prepare($guarda2y);
$guarda2y->execute();	  
}

    
}else
{
    
if($facturac==$factura){

$query="Update servicios set Nit=?, Cliente=?, Direccion=?, Tipo=?, Usuario=?, comentario=?, fechaprometida=?, telefono=?, tiposervicio=?, ano=?, placa=?, nomotor=?, cc=?, estilo=?, color=?, kilometraje=?, nochasis=?, imagen=?, imagen2=?, imagen3=?, imagen4=?, imagen5=?, imagen6=?, marca=? where Factura=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$nit);	
$resultado->bindParam(2,$cliente);	
$resultado->bindParam(3,$direccion);	
$resultado->bindParam(4,$tipo);	
$resultado->bindParam(5,$usuario);	
$resultado->bindParam(6,$comentario);	
$resultado->bindParam(7,$fechaprometida);
$resultado->bindParam(8,$telefono);
$resultado->bindParam(9,$tiposervicio);
$resultado->bindParam(10,$ano);
$resultado->bindParam(11,$placa);
$resultado->bindParam(12,$nomotor);
$resultado->bindParam(13,$cc);
$resultado->bindParam(14,$estilo);
$resultado->bindParam(15,$color);
$resultado->bindParam(16,$kilometraje);
$resultado->bindParam(17,$nochasis);
$resultado->bindParam(18,$imagen1);
$resultado->bindParam(19,$imagen2);
$resultado->bindParam(20,$imagen3);
$resultado->bindParam(21,$imagen4);
$resultado->bindParam(22,$imagen5);
$resultado->bindParam(23,$imagen6);
$resultado->bindParam(24,$marca);
$resultado->bindParam(25,$factura);
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



$revisaclientey = "Select * from vehiculos where nochasis= :idddy";
$resultadorevisa4y=$db->prepare($revisaclientey);
$resultadorevisa4y->bindParam(":idddy",$nochasis);
$resultadorevisa4y->execute();	
foreach ($resultadorevisa4y as $key =>$ay){
$nochasisy=$ay['nochasis'];
}


if($nochasisy==$nochasis){
 $query3y="Update vehiculos set nit=?, ano=?, placa=?, nomotor=?, cc=?, estilo=?, color=?, kilometraje=?, marca=?, cliente=?, telefono=?, direccion=?, observacion=?  where nochasis=?";
$resultado3y=$db->prepare($query3y);
$resultado3y->bindParam(1,$nit);	
$resultado3y->bindParam(2,$ano);
$resultado3y->bindParam(3,$placa);	 
$resultado3y->bindParam(4,$nomotor);	 
$resultado3y->bindParam(5,$cc);	 
$resultado3y->bindParam(6,$estilo);	 
$resultado3y->bindParam(7,$color);	 
$resultado3y->bindParam(8,$kilometraje);	 
$resultado3y->bindParam(9,$marca);	 
$resultado3y->bindParam(10,$cliente);	
$resultado3y->bindParam(11,$telefono);	
$resultado3y->bindParam(12,$direccion);	
$resultado3y->bindParam(13,$comentario);	
$resultado3y->bindParam(14,$nochasis);	 
$resultado3y->execute();	
}
else
{
  $guarda2y="Insert into vehiculos (nit, ano, placa, nomotor, cc, estilo, color, kilometraje, nochasis, marca, cliente, direccion, telefono, observacion) values ('$nit','$ano','$placa','$nomotor','$cc','$estilo','$color','$kilometraje','$nochasis','$marca','$cliente','$direccion','$telefono','$comentario')";
$guarda2y=$db->prepare($guarda2y);
$guarda2y->execute();	  
}

}
    
}

?> 

<script type="text/javascript">
var codbarrax="";
codbarrax= <?php echo $factura;?>;
$('#factura').val(codbarrax);
ofactura=codbarrax;
dfactura=codbarrax;
</script>