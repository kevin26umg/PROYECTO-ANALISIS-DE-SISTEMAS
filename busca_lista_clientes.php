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
$query = "Select * from clientes where cliente like :buscar";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->cliente)){
    echo "<div class='panel panel-success'>";
    echo "<table class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th class=text-align:'center'>Id</th>";
    echo "<th>Nit</th>";
    echo "<th>Cliente</th>";
    echo "<th>Contacto</th>";
    echo "<th>Dirección</th>";
    echo "<th>Telefóno</th>";
    echo "<th>Correo</th>";
    echo "<th>Limite Crédito</th>";
    echo "<th>Descuento %</th>";
    echo "<th>Plazo</th>";
    echo "<th>Saldo</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<th> </th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    echo '<td style="text-align:center;">'.$gt['id']."</td>";
    echo '<td style="text-align:center;">'.$gt['nit']."</td>";
    echo '<td style="text-align:left;">'.$gt['cliente']."</td>";
    echo '<td style="text-align:left;">'.$gt['contacto']."</td>";
    echo '<td style="text-align:left;">'.$gt['direccion']."</td>";
    echo '<td style="text-align:center;">'.$gt['telefono']."</td>";
    echo '<td style="text-align:left;">'.$gt['correo']."</td>";
    echo '<td style="text-align:right">'.$gt['saldo_limite']."</td>";
    echo '<td style="text-align:center;">'.$gt['descuento']."</td>";
    echo '<td style="text-align:center;">'.$gt['plazo']."</td>";
    echo '<td style="text-align:right;">'.$gt['saldo']."</td>";
  	$varproductos=$gt['id'];
    $varnit=$gt['nit'];
    $varcliente=$gt['cliente'];
    $varclientes=$gt['id']."|".$gt['cliente']."|".$gt['saldo'];
    //echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Abonos Cliente' id='$varclientes' onclick='abonos(this.id);'><i class='fa fa-money'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Abonos Cliente' id='$varcliente' onclick='busca_creditos(this.id);'><i class='fa fa-money'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Ventas al Crédito' id='$varcliente' onclick='reporte_historial(this.id);'><i class='fa fa-print'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar elemento' id='$varproductos' onclick='modificar_cliente(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Borrar elemento' id='$varproductos' onclick='eliminar_item(this.id);'><i class='fa fa-trash-o'></button></td>";
        echo "<td style='text-align: center;'><button type='button' class='btn btn-naranja btn-xs' data-toggle='tooltip' data-placement='top' title='Reporte Abonos' id='$varnit' onclick='reporte_abonos(this.id);'><i class='fa fa-print'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>