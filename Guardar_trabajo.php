
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
$trabajo=$_POST['trabajo'];
$precio=$_POST['precio'];
$cantidad=1;
$categoria='Trabajo';
$fecha= date ("Y-m-d");
$fecha2= date ("Y-m-d H:i:s");
$tipo=$_POST['tipo'];





$revisa = "Select * from detalle_servicios where factura= :iddd and producto=:iddd2 and precio=:iddd3";
$resultadorevisa=$db->prepare($revisa);
$resultadorevisa->bindParam(":iddd",$factura);
$resultadorevisa->bindParam(":iddd2",$trabajo);
$resultadorevisa->bindParam(":iddd3",$precio);
$resultadorevisa->execute();	
foreach ($resultadorevisa as $key =>$ra){
$facturac=$ra['factura'];
$codigoc=$ra['producto'];
$cantidadc=$ra['cantidad'];
$precioc=$ra['precio'];
$totalc=$ra['total'];
}


$revisaga = "Select Factura, tp from servicios where Factura=:xdxdd order by Factura limit 1";
$resultadorevisaga=$db->prepare($revisaga);
$resultadorevisaga->bindParam(":xdxdd",$factura);
$resultadorevisaga->execute();	
foreach ($resultadorevisaga as $key =>$raga){
$tp=$raga['tp'];
}

//  echo $tipo;
//  echo $tp;
// echo '1'.$tipo;
if($tipo==$tp){
echo "123";
}else
{
// echo '2'.$tipo;
$update = "delete from detalle_servicios where tipo= :buscardd and factura=:buscarddd";
$upd=$db->prepare($update);
$upd->execute(array(":buscardd"=>$tp, ":buscarddd"=>$factura ));    

    if($tipo=="Eliminar"){
    //  echo '3'.$tipo;
      $tipo="";
}else
{
 $revisag = "Select * from tabla_servicios where tipo=:xdxd order by id";
$resultadorevisag=$db->prepare($revisag);
$resultadorevisag->bindParam(":xdxd",$tipo);
$resultadorevisag->execute();	
foreach ($resultadorevisag as $key =>$rag){
$xservicio=$rag['servicio'];
$xmo=$rag['mo'];
$xtipo=$rag['tipo']; 


$guardar = "Insert INTO detalle_servicios(factura, fecha, fecha2, producto, mo, cantidad, total, categoria, tipo) VALUES(?,?,?,?,?,?,?,?,?)";
$resul=$db->prepare($guardar);
$resul->bindParam(1,$factura);	
$resul->bindParam(2,$fecha);	
$resul->bindParam(3,$fecha2);	
$resul->bindParam(4,$xservicio);	
$resul->bindParam(5,$xmo);	
$resul->bindParam(6,$cantidad);	
$resul->bindParam(7,$xmo);	
$resul->bindParam(8,$categoria);	
$resul->bindParam(9,$tipo);	
$resul->execute();	 

}   
}


$sumatotal=0.00;
    $tbmo=0.00;
      $tbrep=0.00;
      
$totalnuevo2=0;
$querytotal2 = "select * from detalle_servicios where factura= :cod";
$resultadototal2=$db->prepare($querytotal2);
$rows = $resultadototal2->fetchAll(/* nothing here */);
if(!isset($rows[0]->total)){
      $resultadototal2->bindParam(":cod",$factura);	
      $resultadototal2->execute();
	  foreach ($resultadototal2 as $key =>$total2){
      $totalnuevo2+=$total2['total'];
       $tbmo=$total2['mo'];
       if(($total2['categoria']=="Trabajox") || ($total2['categoria']=="Trabajo")){
       $tbrep=0.00;    
       }else
       {
           $tbrep=$total2['repuestos'];
       }
      
      $sumatotal+=$tbmo+$tbrep;
      }
    }else{
   echo "0";
 }


$query4="Update servicios set total=?, tp=? where factura=?";
$resultado4=$db->prepare($query4);
$resultado4->bindParam(1,$sumatotal);	
$resultado4->bindParam(2,$tipo);	
$resultado4->bindParam(3,$factura);	
$resultado4->execute();		
}


?> 