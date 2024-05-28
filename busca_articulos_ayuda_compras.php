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
$proveedor=$_POST['proveedor'];
// $art="%$art%";
//$cadena=$db->consulta("Select codigo, producto, presentacion, preciocosto, preciocosto, existencia, proveedor from inventario where producto like '%$art%' or codigo like '%$art%' limit 15 ");
//if($db->numero_de_registros($cadena)>0){




 $aKeyword2 = explode("/", $art);
 $aKeyword = explode(" ", $aKeyword2[0]);
//  echo ":".$aKeyword2[1];
//  echo "--".$aKeyword;
 
    //   $query ="SELECT * FROM inventario WHERE producto like '%" . $aKeyword[0] . "%' OR codigo_alterno like '%" . $aKeyword[0] . "%'  OR codigo like '%" . $aKeyword[0] . "%' OR marca like '%" . $aKeyword[0] . "%' OR presentacion like '%" . $aKeyword[0] . "%'";
    $query ="SELECT * FROM inventario WHERE (producto like '%" . $aKeyword[0] . "%')";
      
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " and (producto like '%" . $aKeyword[$i] . "%')"; 
        }
}

$query .= "  and (codigo_alterno like '%" . $aKeyword2[1] . "%') and (proveedor = '".$proveedor."') limit 80";
// $query .= "  and codigo_alterno like '%" . $aKeyword2[1] . "%'  limit 80";


// $query = "SELECT codigo, codigo_alterno, producto, presentacion, preciocosto, existencia, proveedor from inventario where producto like :buscar OR codigo_alterno like :buscar OR presentacion like :buscar OR proveedor like :buscar order by producto asc limit 100";
$resultado=$db->prepare($query);
$rows = $resultado->fetch(/* nothing here */);
if(!isset($rows[0]->codigo)){
//if($resultado->fetchColumn() > 0) {
    echo "<table onkeydown='focustable();' id='table' class='table table-bordered table-hover'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='text-align:center;'>Codigo</th>";
    echo "<th style='text-align:center;'>Codigo Alterno</th>";
    echo "<th style='text-align:center;'>Producto</th>";
    // echo "<th>Vencimiento</th>";
    // echo "<th>Proveedor</th>";
    // echo "<th style='text-align:center;'>Presentacion</th>";
    
    // echo "<th>Existencia</th>";
   // echo "<th>Precio</th>";
    // echo "<th style='text-align:center;'>Precio - Tipo Precio - Presentación</th>";
    echo "<th style='text-align:center;'>Proveedor</th>";
    echo "<th style='text-align:center;'>Existencia</th>";
    echo "<th></th>";
    // echo "<th></th>";
    echo "<tbody>";
    // $resultado->bindParam(":buscar",$art);
    // $resultado->bindParam(":provx",$proveedor);	
    $resultado->execute();
    
    
    

            
	foreach ($resultado as $key =>$gt){
  //while($gt=$db->buscar_array($cadena)){
    echo "<tr>";
    echo "<td>".$gt['codigo']."</td>";
    echo "<td>".$gt['codigo_alterno']."</td>";
    echo "<td>".$gt['producto']."</td>";
    // echo "<td>".$gt['vencimiento']."</td>";
    // echo "<td>".$gt['proveedor']."</td>";
    // echo "<td>".$gt['presentacion']."</td>";
  
    //echo '<td style="text-align:right;">'.$gt['preciod']."</td>";
	  $varproductos=($gt['codigo'])."|".$gt['preciod']."|".$gt['cantidad']."|".$gt['preciocosto']."|".$gt['existencia']."|".$gt['producto'];
    $varproductos2=$gt['codigo'];
    
    echo' <td  style="width: 13%;display:none;">
    <div class="form-group">
<select class="form-control select2" id="cmb'.$gt['codigo'].'"  style="width: 400px;text-align-last: center;font-size: 18px;" onChange="">
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



/*
   $query2 = "Select codigo, presentacion,unidades, precio from presentaciones where codigo = :cod order by precio desc";
$resultado2=$db->prepare($query2);
$rows2 = $resultado2->fetch();             
          $resultado2->bindParam(":cod",$codigopres);	
            $resultado2->execute();
            
            
             
            foreach ($resultado2 as $key2 =>$gtr){
            if(!isset($rows2[0]->codigo)){
            echo' <option value="'.$gtr['precio']."|".$gtr['presentacion']."|".$gtr['unidades'].'">Q.'.$gtr['precio'].'  一 '.$gtr['presentacion'].' 一 '.$gtr['unidades'].'</option>';
            }          
            
             $varproductos3=$gt['codigo_alterno']."|".$gt['producto']."|".$gt['existencia']."|".$gt['preciocosto']."|".$gt['precio']."|".$gt['presentacion']."|".$gtr['presentacion'];
            } 
             */
             
            echo' </select>
             </div>
             </td>
    ';
    
    
        $varproductos3=$gt['codigo']."|".$gt['producto']."|".$gt['existencia']."|".$gt['preciocosto']."|".$gt['precio']."|".$gt['presentacion']."|".$gt['presentacion'];
    
    
    echo '<td style="text-align:center;font-size: 22px;">'.$gt['proveedor']."</td>";
      echo '<td style="text-align:center;font-size: 22px;">'.$gt['existencia']."</td>";
      
    //echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' id='$varproductos' onclick='agrega_a_listas(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' name='$varproductos2' id='$varproductos3' onclick='agrega_a_listas(this.id);'><i class='fa fa-reply'> Seleccionar</button></td>";
    
    
    
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
       
 