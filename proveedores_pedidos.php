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
$art="provxx";



 echo' 
    <div class="form-group">
<select class="form-control select2" id="cmb'.$art.'"  style="width: 100%;" onChange="">
             ';
             
             

    $query2 = "SELECT DISTINCT categoria from inventario order by categoria asc";
$resultado2=$db->prepare($query2);
$rows2 = $resultado2->fetch(/* nothing here */);             
        //   $resultado2->bindParam(":cod",$art);	
            $resultado2->execute();
            
            
              echo' <option value="TODOS">TODOS</option>';        
            foreach ($resultado2 as $key2 =>$gtr){
            if(!isset($rows2[0]->codigo)){
                
               
                if($gtr['categoria']!=""){
            echo' <option value="'.$gtr['categoria'].'">'.$gtr['categoria'].'</option>';        
                }
            
            }          
            
          
            } 
             
            echo' </select>
             </div>
          
    ';


?>

 