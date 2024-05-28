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
$art=$_POST['producto'];
$art="%$art%";
//$cadena=$db->consulta("Select codigo, producto, presentacion, preciocosto, preciocosto, existencia, proveedor from inventario where producto like '%$art%' or codigo like '%$art%' limit 15 ");
//if($db->numero_de_registros($cadena)>0){
$query = "SELECT codigo, codigo_alterno, producto, presentacion, preciocosto, existencia, proveedor from inventario order by producto asc limit 50";
$resultado=$db->prepare($query);
$rows = $resultado->fetch(/* nothing here */);
if(!isset($rows[0]->codigo)){
//if($resultado->fetchColumn() > 0) {
    echo "<table onkeydown='focustable();' id='table' class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Codigo</th>";
    echo "<th>Producto</th>";
    echo "<th>Vencimiento</th>";
    echo "<th>Proveedor</th>";
    echo "<th>Presentacion</th>";
    echo "<th>Existencia</th>";
    // echo "<th>Existencia</th>";
   // echo "<th>Precio</th>";
    echo "<th>Precios</th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<tbody>";
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();
    
    
    

            
	foreach ($resultado as $key =>$gt){
  //while($gt=$db->buscar_array($cadena)){
    echo "<tr>";
    echo "<td>".$gt['codigo_alterno']."</td>";
    echo "<td>".$gt['producto']."</td>";
    echo "<td>".$gt['vencimiento']."</td>";
    echo "<td>".$gt['proveedor']."</td>";
    echo "<td>".$gt['presentacion']."</td>";
    echo '<td style="text-align:center;">'.$gt['existencia']."</td>";
    //echo '<td style="text-align:right;">'.$gt['preciod']."</td>";
	  $varproductos=($gt['codigo_alterno'])."|".$gt['preciod']."|".$gt['cantidad']."|".$gt['preciocosto']."|".$gt['existencia']."|".$gt['producto'];
    $varproductos2=$gt['codigo_alterno'];
    echo' <td  style="width: 13%;">
    <div class="form-group">
<select class="form-control select2" id="cmb'.$gt['codigo_alterno'].'"  style="width: 100%;" onChange="">
             ';
             
             
$codigopres=$gt['codigo_alterno'];

$existenciapres=$gt['existencia'];
$nit=$_POST['nit'];
$querypres = "Select nit, saldo, saldo_limite from clientes where nit= :ni";
$resultadopres=$db->prepare($querypres);
$rowspres = $resultadopres->fetchAll();
if(!isset($rowspres[0]->nit)){
$resultadopres->bindParam(":ni",$nit);	
$resultadopres->execute();	
foreach ($resultadopres as $keypres =>$rc){
$saldo=$rc['saldo'];
$saldolimite=$rc['saldo_limite'];
}
}




    $query2 = "Select codigo, presentacion,unidades, precio from presentaciones where codigo = :cod order by precio asc";
$resultado2=$db->prepare($query2);
$rows2 = $resultado2->fetch(/* nothing here */);             
           $resultado2->bindParam(":cod",$codigopres);	
            $resultado2->execute();
            
            
             
            foreach ($resultado2 as $key2 =>$gtr){
            if(!isset($rows2[0]->codigo)){
            echo' <option value="'.$gtr['precio']."|".$gtr['presentacion']."|".$gtr['unidades'].'">Q.'.$gtr['precio'].'  -'.$gtr['presentacion'].'-</option>';
            }          
            
             $varproductos3=$gt['codigo_alterno']."|".$gt['producto']."|".$gt['existencia']."|".$gt['preciocosto']."|".$gt['precio']."|".$gt['presentacion']."|".$gtr['presentacion'];
            } 
             
            echo' </select>
             </div>
             </td>
    ';
    //echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' id='$varproductos' onclick='agrega_a_listas(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' name='$varproductos2' id='$varproductos3' onclick='agrega_a_listas(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";
    
    
    
    echo "<td style='text-align: center;'><button type='button' class='btn btn-naranja btn-xs' id='$varproductos22' onclick='mostrar_existencias(this.id);'><i class='fa fa-search'> + Existencias</button></td>";
    
    echo "</tr>";
  }
  echo "</tbody>";
  echo "</table>";
  
  
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}


?>

<script>
            getSelectedRow();
               </script>
       
 