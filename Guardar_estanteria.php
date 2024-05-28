<?php echo 'aaaa'; ?>
<?php include "./class_lib/sesionSecurity.php"; ?>

<?php
session_start();
echo 'aaaa';
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

$estanteria=$_POST['estanteria'];

$estanteria='PRUEBA';





//$rows = $resultadorevisa->fetchAll(/* nothing here */);
//if(!isset($rows[0]->id)){
/*
if($facturac==$factura && $codigoc==$codigo && $precioc==$precio){


$query="Update detalle_ventas set fecha=?, fecha2=?, producto=?, cantidad=?, total=?, categoria=?, costo=?, presentacion=? where factura=? and codigo=? and precio=?";
$resultado=$db->prepare($query);
$resultado->bindParam(1,$fecha);	
$resultado->bindParam(2,$fecha2);	
$resultado->bindParam(3,$producto);	
$resultado->bindParam(4,$cantidadnueva);	
$resultado->bindParam(5,$totalnuevo);	
$resultado->bindParam(6,$categoria);	
$resultado->bindParam(7,$costo);	
$resultado->bindParam(8,$presentacion);
$resultado->bindParam(9,$factura);	
$resultado->bindParam(10,$codigo);	
$resultado->bindParam(11,$precio);	
$resultado->execute();	

$query2="Update inventario set existencia=? where codigo_alterno=?";
$resultado2=$db->prepare($query2);
$resultado2->bindParam(1,$existenciamenos);	
$resultado2->bindParam(2,$codigo);	
$resultado2->execute();	

$totalnuevo1=0;
$querytotal = "select * from detalle_ventas where factura= :cod";
$resultadototal=$db->prepare($querytotal);
$rows3 = $resultadototal->fetchAll();
if(!isset($rows3[0]->total)){
      $resultadototal->bindParam(":cod",$factura);	
      $resultadototal->execute();
	  foreach ($resultadototal as $key =>$total){
      $totalnuevo1+=$total['total'];
      }
    }else{
   echo "0";
 }
 


$query5="Update ventas set total=? where factura=?";
$resultado5=$db->prepare($query5);
$resultado5->bindParam(1,$totalnuevo1);	
$resultado5->bindParam(2,$factura);	
$resultado5->execute();	


}else{
*/
echo '1 ';

$guardar = "Insert INTO estanterias(estanteria) VALUES(?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$estanteria);	

$resul->execute();	
echo '2';

?> 