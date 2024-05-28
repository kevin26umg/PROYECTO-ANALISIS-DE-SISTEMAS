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
 $aKeyword2 = explode("/", $art);
 $aKeyword = explode(" ", $aKeyword2[0]);
    $query ="SELECT * FROM inventario WHERE (producto like '%" . $aKeyword[0] . "%' or codigo_alterno like '%" . $aKeyword[0] . "%' or categoria like '%" . $aKeyword[0] . "%')";
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " and (producto like '%" . $aKeyword[$i] . "%')";
        }
}
$query .= " and (proveedor like '%" . $aKeyword2[1] . "%') and (categoria like '%" . $aKeyword2[2] . "%') and (codigo_alterno like '%" . $aKeyword2[3] . "%') order by producto asc limit 50";
$resultado=$db->prepare($query);
$rows = $resultado->fetch(/* nothing here */);
if(!isset($rows[0]->codigo)){
    echo "<table onkeydown='focustable();' id='table' class='table table-striped table-hover colores'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Codigo B.</th>";
    echo "<th>Producto</th>";
    // echo "<th>Equivalencia</th>";
    echo "<th>Categoría</th>";
    // echo "<th>Proveedor</th>";
    echo "<th>Presentacion</th>";
    echo "<th>Existencia</th>";
    echo "<th>Precio</th>";
    if($_SESSION["nombre_de_usuario"]=="Admin"){
    echo "<th>Costo</th>";    
    }
    
    // echo "<th></th>";
    echo "<th style='display: none;'></th>";
    // echo "<th></th>";
    echo "<tbody>";
    $resultado->execute();
	foreach ($resultado as $key =>$gt){
	    
	    if($gt['existencia']==0){
	        $xcol="color:red;font-weight:bold;";
	    }else
	    {
	        if($gt['existencia']<=$gt['minima']){
	            $xcol="color:#00ab26";
	        }else{
	            $xcol="color:black";
	        }
	        
	        
	    }
	    
    echo "<tr style='".$xcol."'tabindex='0' id='cmb".$gt['codigo']."' >";
    echo "<td>".$gt['codigo']."</td>";
    echo "<td>".$gt['codigo_alterno']."</td>";
    echo "<td>".$gt['producto']."</td>";
    // echo "<td>".$gt['equivalencia']."</td>";
    echo "<td>".$gt['categoria']."</td>";
    // echo "<td>".$gt['proveedor']."</td>";
    echo "<td>".$gt['presentacion']."</td>";
    echo '<td style="text-align:center;">'.$gt['existencia']."</td>";
  $varproductos=($gt['codigo'])."|".$gt['preciod']."|".$gt['cantidad']."|".$gt['preciocosto']."|".$gt['existencia']."|".$gt['producto']."|".$gt['presentacion']."|".$gt['descuento'];
    $varproductos2=$gt['codigo'];
    echo "<td>Q".$gt['preciod']."</td>";
    if($_SESSION["nombre_de_usuario"]=="Admin"){
    echo "<td>Q".$gt['preciocosto']."</td>";    
    }
    
    $varproductos3=$gt['codigo']."|".$gt['producto']."|".$gt['existencia']."|".$gt['preciocosto']."|".$gt['preciod']."|".$gt['presentacion']."|".$gt['preciob']."|".$gt['descuento']."|".$gt['precioa']."|".$gt['preciob']."|".$gt['precioc']."|".$gt['preciod']."|".$gt['uunidad']."|".$gt['ublister']."|".$gt['ucaja']."|".$gt['upe']."|".$gt['precioe'];
        $file = 'imagenes/'.$gt['imagen'].''; // 'images/'.$file (physical path)
        
        
// if ((file_exists($file)) && $gt['imagen']!='') {
    //   echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" id="'.$file.'" onclick="muestraimg(this.id);" src="imagenes/'.$gt['imagen'].'"></img></div></td>';
// } else {
//     echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" src="imagenes/default.png"></img></div></td>'; 
// }

    echo "<td style='display: none;text-align: center;'><button type='button' class='btn btn-primary btn-xs' name='$varproductos2' id='$varproductos3' onclick='agrega_a_listas(this.id);'><i class='fa fa-reply'> </button></td>";
    // echo "<td style='text-align: center;'><button type='button' class='btn btn-naranja btn-xs' id='$varproductos22' onclick='mostrar_existencias(this.id);'><i class='fa fa-search'> + Existencias</button></td>";
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
       
 