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
// $art="%$art%";
//$cadena=$db->consulta("Select * from inventario where producto like '%$art%' or codigo_alterno like '%$art%' order by codigo desc limit 30");
//if($db->numero_de_registros($cadena)>0){



 $aKeyword2 = explode("/", $art);
 $aKeyword = explode(" ", $aKeyword2[0]);
//  echo ":".$aKeyword2[1];
//  echo "--".$aKeyword;
 
    //   $query ="SELECT * FROM inventario WHERE producto like '%" . $aKeyword[0] . "%' OR codigo_alterno like '%" . $aKeyword[0] . "%'  OR codigo like '%" . $aKeyword[0] . "%' OR marca like '%" . $aKeyword[0] . "%' OR presentacion like '%" . $aKeyword[0] . "%'";
    
    if($art==""){
    $query ="SELECT * FROM inventario WHERE (producto like '%" . $aKeyword[0] . "%')";
      
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " and (producto like '%" . $aKeyword[$i] . "%')";
        }
}

$query .= " and (proveedor like '%" . $aKeyword2[1] . "%') and (categoria like '%" . $aKeyword2[2] . "%') and (codigo_alterno like '%" . $aKeyword2[3] . "%') limit 50";    
    }else
    {
        $query ="SELECT * FROM inventario WHERE (producto like '%" . $aKeyword[0] . "%')";
      for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " and (producto like '%" . $aKeyword[$i] . "%')";
        }
}

$query .= " and (proveedor like '%" . $aKeyword2[1] . "%') and (categoria like '%" . $aKeyword2[2] . "%') and (codigo_alterno like '%" . $aKeyword2[3] . "%')";
    }
    

//$query = "Select * from inventario where producto like :buscar or codigo_alterno like :buscar or codigo like :buscar order by producto asc limit 60";
$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->producto)){
    echo "<div class='panel panel-info'>";
    // echo "<table class='table table-strip table-bordered'>";
    
    echo "<table onkeydown='focustable();' id='datax' class='table table-striped table-hover colores'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='text-align:center;'>#</th>";
    echo "<th style='text-align:center;'>Código</th>";
    echo "<th style='text-align:center;'>Producto</th>";
    echo "<th style='text-align:center;'>Vencimiento</th>";
    echo "<th style='text-align:center;'>Proveedor</th>";
    echo "<th style='text-align:center;'>Categoría</th>";
    
    echo "<th style='text-align:center;'>Existencia</th>";
    echo "<th style='text-align:center;'>Unidad</th>";
    echo "<th style='text-align:center;'>Blíster</th>";
    echo "<th style='text-align:center;'>Caja</th>";
    // echo "<th style='text-align:center;'>Distribuidor 2</th>";
    
    
    echo "<th style='text-align:center;'>Miníma</th>";
    // echo "<th style='text-align:center;'>Máximo</th>";
    
    echo "<th style='text-align:center;'></th>";
    echo "<th style='text-align:center;'>Existencias</th>";
    echo "<th style='text-align:center;'>Editar</th>";
    echo "<th style='text-align:center;'>Eliminar</th>";
    echo "<tbody>";
    //while($gt=$db->buscar_array($cadena)){
    $resultado->bindParam(":buscar",$art);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){

    echo "<tr>";
    if ($gt['existencia']>0){
    echo '<td style="text-align:center;">'.$gt['codigo']."</td>";
    echo '<td style="text-align:center;">'.$gt['codigo_alterno']."</td>";
    echo '<td style="text-align:left;">'.$gt['producto']."</td>";
    echo '<td style="text-align:left;">'.$gt['presentacion']."</td>";
    echo '<td style="text-align:left;">'.$gt['proveedor']."</td>";
    echo '<td style="text-align:left;">'.$gt['categoria']."</td>";
    

    echo '<td style="text-align:center;">'.$gt['existencia']."</td>";
    /*
    echo' <td  style="text-align:center;width: 13%;">
    <div class="form-group">
<select class="form-control select2" id="cmb'.$gt['codigo'].'"  style="width: 100%;" onChange="">
             ';
//echo' <option value="'.$gt['preciocosto'].'">Q.'.$gt['preciocosto'].'  '.$gt['codigo'].'</option>';


$codigopres=$gt['codigo'];
    $query2 = "Select codigo, presentacion, precio from presentaciones where codigo = :cod order by precio desc";
$resultado2=$db->prepare($query2);
$rows2 = $resultado2->fetch();             
           $resultado2->bindParam(":cod",$codigopres);	
            $resultado2->execute();

       foreach ($resultado2 as $key2 =>$gtr){
            if(!isset($rows2[0]->codigo)){
            echo' <option value="'.$gtr['precio'].'">Q.'.$gtr['precio'].'  -'.$gtr['presentacion'].'-</option>';
            }          
            } 
 echo' </select>
             </div>
             </td>';*/
    
    echo '<td style="text-align:center;">Q'.$gt['preciod']."</td>";
    echo '<td style="text-align:center;">Q'.$gt['precioc']."</td>";
    echo '<td style="text-align:center;">'.$gt['preciob']."</td>";
    // echo '<td style="text-align:center;">'.$gt['precioa']."</td>";
    
    echo '<td style="text-align:center;">'.$gt['minima']."</td>";
    // echo '<td style="text-align:center;">'.$gt['maxima']."</td>";
    // echo '<td style="text-align:right;">'.$gt['preciocosto']."</td>";    
    
 
    $file = 'imagenes/'.$gt['imagen'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $gt['imagen']!='') {
      echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" id="'.$file.'" onclick="muestraimg(this.id);" src="imagenes/'.$gt['imagen'].'"></img></div></td>';
} else {
    
    echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" src="imagenes/default.png"></img></div></td>'; 
}
    
    

    }else{
        

    
        echo '<td style="color:red;text-align:center;">'.$gt['codigo']."</td>";
        echo '<td style="text-align:center;">'.$gt['codigo_alterno']."</td>";
    echo '<td style="color:red;text-align:left;">'.$gt['producto']."</td>";
    echo '<td style="color:red;text-align:left;">'.$gt['presentacion']."</td>";
    echo '<td style="color:red;text-align:left;">'.$gt['proveedor']."</td>";
    echo '<td style="color:red;text-align:left;">'.$gt['categoria']."</td>";
    

    echo '<td style="color:red;text-align:center;">'.$gt['existencia']."</td>";
    
    echo '<td style="text-align:center;">Q'.$gt['preciod']."</td>";
    echo '<td style="text-align:center;">Q'.$gt['precioc']."</td>";
    echo '<td style="text-align:center;">Q'.$gt['preciob']."</td>";
    // echo '<td style="text-align:center;">Q'.$gt['precioa']."</td>";
    
    
    /*
    echo' <td  style="color:red;text-align:center;width: 13%;">
    <div class="form-group">
<select class="form-control select2" id="cmb'.$gt['codigo'].'"  style="width: 100%;" onChange="">
             ';
//echo' <option value="'.$gt['preciocosto'].'">Q.'.$gt['preciocosto'].'  '.$gt['codigo'].'</option>';


$codigopres=$gt['codigo'];
    $query2 = "Select codigo, presentacion, precio from presentaciones where codigo = :cod order by precio desc";
$resultado2=$db->prepare($query2);
$rows2 = $resultado2->fetch();             
           $resultado2->bindParam(":cod",$codigopres);	
            $resultado2->execute();

       foreach ($resultado2 as $key2 =>$gtr){
            if(!isset($rows2[0]->codigo)){
            echo' <option value="'.$gtr['precio'].'">Q.'.$gtr['precio'].'  -'.$gtr['presentacion'].'-</option>';
            }          
            } 
 echo' </select>
             </div>
             </td>';*/
    
    echo '<td style="color:red;text-align:center;">'.$gt['minima']."</td>";
    // echo '<td style="color:red;text-align:center;">'.$gt['maxima']."</td>";
    // echo '<td style="color:red;text-align:right;">'.$gt['preciocosto']."</td>";    
    
 
    $file = 'imagenes/'.$gt['imagen'].''; // 'images/'.$file (physical path)

if ((file_exists($file)) && $gt['imagen']!='') {
      echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" id="'.$file.'" onclick="muestraimg(this.id);" src="imagenes/'.$gt['imagen'].'"></img></div></td>';
} else {
    
    echo '<td style="color:red; text-align:center;"><div style="width:50px;height:50px;text-align:center;"><img style="width:100%;height:100%;text-align:center;" src="imagenes/default.png"></img></div></td>'; 
}
    
    

    }
    
  	$varproductos=$gt['codigo'];
  	
  	     $varproductosx=$gt['codigo']."|".$gt['precioa']."|".$gt['precioc']."|".$gt['precioa']."|".$gt['precioc']."|".$gt['presentacion']."|".$gt['preciob'];
  	     
//   	echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' id='$varproductosx' name='edit$varproductos' onclick='cambiarprecio(this.id);'><i class='fa fa-refresh'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' id='$varproductos' name='edit$varproductos' onclick='agregarexistencia(this.id);'><i class='fa fa-plus'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' id='$varproductos' name='edit$varproductos' onclick='editaproducto(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top'  id='$varproductos' name='delete$varproductos' onclick='eli_inv(this.id);' ><i class='fa fa-trash-o'></button></td>";
    echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}
?>

<script>
getSelectedRow();
</script>