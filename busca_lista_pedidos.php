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
$fecha=$_POST['fecha'];
$fecha="%$fecha%";
//$cadena=$db->consulta("Select * from ventas where cliente like '%$art%' or Factura like '%$art%'  order by Factura desc limit 30");
//if($db->numero_de_registros($cadena)>0){
// $query = "Select ventas.* from ventas INNER JOIN detalle_ventas ON detalle_ventas.factura=ventas.Factura where (ventas.fecha like :fecha) and  (detalle_ventas.producto like :buscar or ventas.cliente like :buscar or ventas.Factura like :buscar or ventas.Usuario like :buscar)  order by ventas.Factura desc limit 100";

$query = "Select ventas.*, GROUP_CONCAT(detalle_ventas.producto) AS Listado from detalle_ventas INNER JOIN ventas ON detalle_ventas.factura=ventas.Factura  where (ventas.fecha like :fecha) and  (detalle_ventas.producto like :buscar or ventas.cliente like :buscar or ventas.Factura like :buscar or ventas.Usuario like :buscar) GROUP BY ventas.Factura order by ventas.Factura desc limit 100";

$resultado=$db->prepare($query);
$rows = $resultado->fetchAll(/* nothing here */);
if(!isset($rows[0]->Factura)){
    echo "<div class=''>";
    echo "<table class='table table-hover table-responsive table-striped colores'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th style='bold:true; text-align:center;'>PEDIDO#</th>";
    echo "<th style='bold:true; text-align:center;'>FECHA</th>";
    
    echo "<th style='bold:true; text-align:center;'>PRODUCTO</th>";
    echo "<th style='bold:true; text-align:center;'>NIT</th>";
    echo "<th style='bold:true; text-align:center;'>CLIENTE</th>";
    // echo "<th style='bold:true; text-align:center;'>TIPO PAGO</th>";
    echo "<th style='bold:true; text-align:center;'>TOTAL</th>";
        echo "<th style='bold:true; text-align:center;'>ATENDIÓ</th>";
    echo "<th> </th>";
    echo "<th> </th>";
    // echo "<th> </th>";
    // echo "<th> </th>";
    // echo "<th> </th>";
    echo "<tbody>";
   //while($gt=$db->buscar_array($cadena)){
   $resultado->bindParam(":buscar",$art);
      $resultado->bindParam(":fecha",$fecha);	
    $resultado->execute();	
	foreach ($resultado as $key =>$gt){
    echo "<tr>";
    //$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
    //$ddia=$ddias[date('w', strtotime($fechainicio))];
    $nnum=date('j', strtotime($gt['Fecha']));
    $aanno=date('Y', strtotime($gt['Fecha']));
    $mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
    $mmes=$mmes[(date('m', strtotime($gt['Fecha']))* 1)-1];
    $ffecenletras=$ddia .' ' .$nnum .'/' .$mmes .'/' .$aanno;   
    $listado="";
    $aKeyword = explode(",", $gt['Listado']);
         for($i = 0; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $i2=$i+1;
            // $listado .= "<li><b>".$i2.".</b> ".$aKeyword[$i]."</li>";
            $listado .= "<li> ".$aKeyword[$i]."</li>";
        }
}

    if ($gt['comentario']=='ANULADA'){
    echo '<td style="color:red; text-align:center;">'.$gt['Factura']."</td>";
    echo '<td style="color:red; text-align:left;">'.$ffecenletras."</td>";
    
    echo '<td style="color:red; text-align:center;">'.$listado."</td>";
    echo '<td style="color:red; text-align:left;">'.$gt['Nit']."</td>";
    echo '<td style="color:red; text-align:left;">'.$gt['Cliente']."</td>";
    
    // echo '<td style="color:red; text-align:center;">'.$gt['Tipo']."</td>";
    echo '<td style="color:red; text-align:center;">'.$gt['Total']."</td>";
    // echo '<td style="color:red; text-align:center;">'.$gt['comentario']."</td>";
    echo '<td style="color:red; text-align:center;">'.$gt['Usuario']."</td>";
    }else{    
    echo '<td style="text-align:center;">'.$gt['Factura']."</td>";
    echo '<td style="text-align:left;">'.$ffecenletras."</td>";
    
    echo '<td style="text-align:left;">'.$listado."</td>";
    echo '<td style="text-align:left;">'.$gt['Nit']."</td>";
    echo '<td style="text-align:left;">'.$gt['Cliente']."</td>";
    
    // echo '<td style="text-align:center;">'.$gt['Tipo']."</td>";
    echo '<td style="text-align:center;">'.$gt['Total']."</td>";
    // echo '<td style="text-align:center;">'.$gt['comentario']."</td>";
    echo '<td style="text-align:center;">'.$gt['Usuario']."</td>";
    }
    $varproductos=$gt['Factura'];
    echo "<td style='text-align: center;'><button type='button' class='btn btn-primary btn-xs' data-toggle='tooltip' data-placement='top' title='Modificar Pedido' id='$varproductos' onclick='verdoc(this.id);'><i class='fa fa-edit'></button></td>";
    echo "<td style='text-align: center;'><button type='button' class='btn btn-warning btn-xs' data-toggle='tooltip' data-placement='top' title='Imprimir Pedido' id='$varproductos' onclick='imprimir_pedido2(this.id);'><i class='fa fa-print'></button></td>";
    // echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Facturar' id='$varproductos' onclick='eliminar_item(this.id);'><i class='fa fa-newspaper-o'></button></td>";
    // echo "<td style='text-align: center;'><button type='button' class='btn btn-danger btn-xs' data-toggle='tooltip' data-placement='top' title='Anular Pedido' id='$varproductos' onclick='anular_pedido(this.id);'><i class='fa fa-undo'></button></td>";
    // echo "<td style='text-align: center;'><button type='button' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' title='Traslado' id='$varproductos' onclick='traslados(this.id);'><i class='fa fa-shopping-cart'></button></td>";
    // echo "</tr>";
  }
  
  echo "</tbody>";
  echo "</table>";
  echo "</div>";
}else{
  echo "<div class='callout callout-danger'>No se encontraron coincidencias...</div>";
}

?>