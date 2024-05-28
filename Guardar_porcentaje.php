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


$codigo=$_POST['codigop'];
$preciob=$_POST['preciob'];
$precioc=$_POST['precioc'];



    
$query="Update inventario set preciob=?, precioc=? where codigo=?";
$resultado=$db->prepare($query);



$resultado->bindParam(1,$preciob);	
$resultado->bindParam(2,$precioc);	
$resultado->bindParam(3,$codigo);	
$resultado->execute();	

?>
<script type="text/javascript">
var codbarrax="";
codbarrax= <?php echo $codigo;?>;
$('#codigop').val(codbarrax);
</script>
 