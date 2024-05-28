<?php include "./class_lib/sesionSecurity.php"; ?>
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

$db=new ConexionMySQL();
$set_names=$db->consulta("SET NAMES 'utf8'");
$factura=test_input($_POST['factura']);
$fecha= date ("Y-m-d");
$nit='C/F';
$cliente='Consumidor Final';
$direccion='Ciudad';
$tipo='Efectivo';
$totales='0.00';
$usuario=test_input($_SESSION['nombre_de_usuario']);

$busca_factura=$db->consulta("Select Factura from ventas order by Factura asc");
while($yy=$db->buscar_array($busca_factura)){
   $factura=$yy['Factura'];
}
$numero= 1;
$factura= $factura + $numero;

?>    
    <script type="text/javascript">
    var factura = <?php echo $factura;?> 
    $("#factura").val(factura);
    </script>

<?php    

if ($fac==''){///SI FACTURA NO TIENE NUMERO
$guardar_factura=("Insert into ventas(Factura, Nit, Cliente, Direccion, Fecha, Tipo, Total, Usuario) values('$factura', '$nit', '$cliente', '$direccion', '$fecha', '$tipo', '$totales', '$usuario')");
$exec=$db->consulta($guardar_factura);  
}
$revisa_factura=$db->consulta("Select * from ventas where Factura='$factura'");
if($db->numero_de_registros($revisa_factura)>0){
//$modifica_factura=$db->consulta("Update ventas set Nit='$nit', Cliente='$cliente', Direccion='$direccion', Tipo='$tipo', Fecha='$fecha', Total='$totales', Usuario='$usuario' where Factura='$factura'");
 // $exec=$db->consulta($modifica_factura);
 // echo "3";
}else{
$guardar_factura=("Insert into ventas(Factura, Nit, Cliente, Direccion, Fecha, Tipo, Total, Usuario) values('$factura', '$nit', '$cliente', '$direccion', '$fecha', '$tipo', '$totales', '$usuario')");
$exec=$db->consulta($guardar_factura);
echo "1";
}



?>
 