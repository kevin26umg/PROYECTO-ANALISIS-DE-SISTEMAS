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
$codigo=$_POST['producto'];
$existencia=$_POST['existencia'];
$nit=$_POST['nit'];
//$cliente=$db->consulta("Select nit, saldo, saldo_limite from clientes where nit='$nit'");
//if($db->numero_de_registros($cliente)>0){
//while($rc=$db->buscar_array($cliente)){
$query = "Select nit, saldo, saldo_limite from clientes where nit= :ni";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->nit)){
$resultado->bindParam(":ni",$nit);	
$resultado->execute();	
foreach ($resultado as $key =>$rc){
$saldo=$rc['saldo'];
$saldolimite=$rc['saldo_limite'];
}
}    

//$inventario=$db->consulta("Select codigo, producto from inventario where codigo='$codigo'");
//if($db->numero_de_registros($inventario)>0){
//while($rcc=$db->buscar_array($inventario)){
$queryy = "Select codigo, producto from inventario where codigo= :cod";
$resultadoo=$db->prepare($queryy);
$rows = $resultadoo->fetchAll(/* nothing here */);
if(!isset($rows[0]->codigo)){
$resultadoo->bindParam(":cod",$codigo);	
$resultadoo->execute();	
foreach ($resultadoo as $key =>$rcc){
$pro=$rcc['producto'];
}
}    

//$cadena=$db->consulta("Select codigo, tipo_precio, presentacion, precio, unidades from presentaciones where codigo='$codigo' order by precio desc");
//if($db->numero_de_registros($cadena)>0){
$queryyy = "Select codigo, presentacion, precio, unidades from presentaciones where codigo= :cod order by precio desc";
$resultadooo=$db->prepare($queryyy);
$rows = $resultadooo->fetchAll(/* nothing here */);
if(!isset($rows[0]->codigo)){

    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Codigo</th>";
    echo "<th>Presentación</th>";
    echo "<th>Precio</th>";
    echo "<th>Exist.</th>";
    echo "<th>  </th>";
    echo "<tbody>";
    echo $pro;  
    $resultadooo->bindParam(":cod",$codigo);	
    $resultadooo->execute();	
    foreach ($resultadooo as $key =>$gt){
//    while($gt=$db->buscar_array($cadena)){
    
    echo "<tr>";
    $unidad=$gt['unidades'];
    $unidad=$existencia/$unidad;
    $unidad=number_format($unidad, 2, '.', ' ');
    echo "<td>".$gt['codigo']."</td>";
    echo "<td>".$gt['presentacion']."</td>";
    echo '<td style="text-align:right;">'.$gt['precio']."</td>";
    //if ($unidad > 1){
    echo '<td style="text-align:center;">'.$unidad.'</td>';
    //}else{
    //echo "<td>".$unidad."</td>";  
    //}
	  $varproductos=$gt['codigo']."|".$gt['precio']."|".$gt['presentacion']."|".$gt['unidades']."|".$saldo."|".$saldolimite;
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' id='$varproductos' onclick='agrega_a_lista(this.id);'><i class='fa fa-reply'> Agregar</button></td>";

    
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>