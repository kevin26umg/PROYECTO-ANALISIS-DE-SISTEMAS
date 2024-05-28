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
$art=$_POST['producto'];
$art="%$art%";
//$cadena=$db->consulta("Select * from clientes where cliente like '%$art%'");
//if($db->numero_de_registros($cadena)>0){
$query = "Select * from usuarios where usuario like :buscar order by usuario asc";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->cliente)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-striped table-hover colores'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='text-align:center;'>ID</th>";
    echo "<th style='text-align:center;'>USUARIO</th>";
    echo "<th style='text-align:center;'>CONTRASEÑA</th>";
    echo "<th style='text-align:center;'>IMAGEN</th>";
    echo "<th style='text-align:center;'>EDITAR</th>";
    echo "<th style='text-align:center;'>ELIMINAR</th>";

    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td style="text-align:center;">'.$gt['id']."</td>";
    echo '<td style="text-align:center;">'.$gt['Usuario']."</td>";
    echo '<td style="text-align:left;">'.$gt['Password']."</td>";

    
        $file = 'imagenes/'.$gt['imagen'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $gt['imagen']!='') {
       echo '<td style="color:red; text-align:center;"><div style="text-align:center;"><img class="croppedx" width="50" style="text-align:center;" id="'.$file.'" onclick="muestraimg(this.id);" src="imagenes/'.$gt['imagen'].'"></img></div></td>';
} else {
    
    // echo '<td style="color:red; text-align:center;"><div style="text-align:center;"><img width="45" style="text-align:center;" src="imagenes/default.png"></img></div></td>';
    echo '<td style="color:red; text-align:center;"></td>'; 
}
    
;
  	$varproductos=$gt['id'];
  // $varnit=$gt['nit'];
   // $varclientes=$gt['id']."|".$gt['cliente']."|".$gt['saldo'];
    
 
    

    echo "<td style='text-align: center;'><center><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='modificar_cliente(this.id);'><i class='fas fa-pen'></button></center></td>";
    echo "<td style='text-align: center;'><center><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminar_item(this.id);'><i class='fas fa-trash'></button></center></td>";

    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>