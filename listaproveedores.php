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
$factura=$_POST['cliente'];
$factura="%$factura%";
if($factura != ""){
    $query = "Select * from proveedores where proveedor like :buscar OR nit like :buscar order by proveedor asc limit 20";
}
else
{
    $query = "Select * from proveedores order by proveedor asc limit 20";
}

$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->cliente)){

                                      
                                        
                                        
    $resultado->bindParam(":buscar",$factura);	
    $resultado->execute();	
	foreach ($resultado as $key =>$re){    
	    $varproductos=$re['proveedor']."|".$re['nit']."|".$re['direccion']."|".$re['telefono']."|".$re['telefono'];
echo'

  <li onclick="agregacliente(this.id)"; id="'.$varproductos.'" class="listas">
 <div style="display: flex;justify-content: center;align-items: center;padding: 10px;">
  <img src="imagenes/cliente2.png" style="width:50px;height:50px;border-radius:150px;">
  </div>
  
  <br>
<div class="media-body">
                                    <div class="d-sm-flex justify-content-between mb-2">
                                        <h5 id="clientec" class="mb-sm-0">'.$re['proveedor'].'</h5>
                                      
                                    </div>
                                    
                                <ul class="card-profile__info">
                                    <li class="mb-1"><span id="">'.$re['nit'].'</span></li>
                                    <li><span id="">'.$re['direccion'].'</span></li>
                                     </div>
  </li>
  ';
  
	  

    }
    
?>    

<?php   





}else{
 echo "<li><h3>No hay datos</h3></li>";
}
	
?>

