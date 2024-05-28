
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
$fecha= date ("Y-m-d");
$fecha2= date ("Y-m-d H:i:s");
$codigo=$_POST['codigo'];
$producto=$_POST['producto'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$cantidadn=$_POST['cantidadn'];
$total=$_POST['total'];
$categoria=$_POST['categoria'];
$costo=$_POST['costo'];
$metros=$_POST['metros'];
$unidades=$_POST['unidades'];
$presentacion=$_POST['presentacion'];
$proveedor=$_POST['proveedor'];



// $revisa = "Select * from detalle_compras where factura= :iddd and codigo=:iddd2 and precio=:iddd3";
// $resultadorevisa=$db->prepare($revisa);
// $resultadorevisa->bindParam(":iddd",$factura);
// $resultadorevisa->bindParam(":iddd2",$codigo);
// $resultadorevisa->bindParam(":iddd3",$precio);
// $resultadorevisa->execute();	
// foreach ($resultadorevisa as $key =>$ra){
// $facturac=$ra['factura'];
// $codigoc=$ra['codigo'];
// $cantidadc=$ra['cantidad'];
// $precioc=$ra['precio'];
// $totalc=$ra['total'];
// }

$revisainventario = "Select * from inventario where codigo= :iddda";
$resultadorevisa2=$db->prepare($revisainventario);
$resultadorevisa2->bindParam(":iddda",$codigo);
$resultadorevisa2->execute();	
foreach ($resultadorevisa2 as $key =>$ra2){
$existenciaactual=$ra2['existencia'];
}



$existenciamenos2=$existenciaactual+$cantidadn;

$guardar = "Insert INTO detalle_compras(factura, fecha, fecha2, codigo, producto, precio, cantidad, total, presentacion, proveedor) VALUES(?,?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$factura);	
$resul->bindParam(2,$fecha);	
$resul->bindParam(3,$fecha2);	
$resul->bindParam(4,$codigo);	
$resul->bindParam(5,$producto);	
$resul->bindParam(6,$precio);	
$resul->bindParam(7,$cantidad);	
$resul->bindParam(8,$total);	
$resul->bindParam(9,$presentacion);
$resul->bindParam(10,$proveedor);

$resul->execute();	


$query3="Update inventario set existencia=?, proveedor=?, preciocosto=? where codigo=?";
$resultado3=$db->prepare($query3);
$resultado3->bindParam(1,$existenciamenos2);	
$resultado3->bindParam(2,$proveedor);	
$resultado3->bindParam(3,$precio);	
$resultado3->bindParam(4,$codigo);	
$resultado3->execute();	



$totalnuevo2=0;
$querytotal2 = "select * from detalle_compras where factura= :cod";
$resultadototal2=$db->prepare($querytotal2);
$rows2 = $resultadototal2->fetchAll(/* nothing here */);
if(!isset($rows2[0]->total)){
      $resultadototal2->bindParam(":cod",$factura);	
      $resultadototal2->execute();
	  foreach ($resultadototal2 as $key =>$total2){
      $totalnuevo2+=$total2['total'];
      }
    }else{
   echo "0";
 }


$query4="Update compras set total=? where factura=?";
$resultado4=$db->prepare($query4);
$resultado4->bindParam(1,$totalnuevo2);	
$resultado4->bindParam(2,$factura);	
$resultado4->execute();	
// }
?> 