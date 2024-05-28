<?php
error_reporting(0);
session_start();
include('./class_lib/funciones.php');
if ($_POST['empresa']=='1'){
include('./class_lib/class_conecta_mysql.php');
$_SESSION['sucursal']='1';
}
if ($_POST['empresa']=='2'){
include('./class_lib/class_conecta_mysql2.php');
$_SESSION['sucursal']='2';
}
if ($_POST['empresa']=='3'){
include('./class_lib/class_conecta_mysql3.php');
$_SESSION['sucursal']='3';
}
$db= conectar();
$usuario=$_POST['usuario'];
$password=$_POST['pass'];
$set_names=$db->query("SET NAMES 'utf8'"); 
//$consulta = $db->consulta("SELECT Usuario, TipoUsuario, Password FROM usuarios where Usuario='$usuario' AND Password='$password'");
//if($db->numero_de_registros($consulta)>0){
$query = "SELECT * from usuarios where Usuario= :nom and Password= :passw";
$resultado=$db->prepare($query);
$resultado->bindParam(":nom",$_POST['usuario']);	
$resultado->bindParam(":passw",$_POST['pass']);	
$resultado->execute();
$bus = $resultado->fetch(PDO::FETCH_ASSOC);
if($bus){

    echo "hola2";
  /*visitas***/
  //$fp = fopen("contador.txt","r"); // Abrimos el fichero donde guardaremos y leeremos las visitas
  //$visitas = intval(fgets($fp)); // Leemos las visitas y usamos intval para asegurarnos de que devuelve un entero
  //$visitas++; // Incrementamos las visitas
  //fclose($fp); // Cerramos el archivo pues lo vamos a volver a abrir en modo escritura
  //$fp = fopen("contador.txt","w"); // Abrimos el archivo en modo escritura
  //fputs($fp,$visitas); // Escribimos las visitas sumadas
    $resultado->bindParam(":nom",$usuario);
    $resultado->bindParam(":passw",$password);
    $resultado->execute();
	foreach ($resultado as $key =>$data){
  //while($data=$db->buscar_array($consulta)){
 $_SESSION['autorizado']=1;
    $_SESSION['nombre_de_usuario']=$data['Usuario'];
    //$_SESSION['sucursal']=$data['bodega'];
    $_SESSION['clave']=$data['clave'];
    $_SESSION['foto']=$data['imagen'];
  $tipousuario=$data['clave'];


	     $_SESSION['usuarios']=$data['usuarios'];
    $_SESSION['ventas']=$data['ventas'];
    $_SESSION['corte']=$data['corte'];
    $_SESSION['cotizaciones']=$data['cotizaciones'];
    $_SESSION['compras']=$data['compras'];
    $_SESSION['inventario']=$data['inventario'];
    $_SESSION['clientes']=$data['clientes'];
    $_SESSION['proveedores']=$data['proveedores'];
    $_SESSION['reporte']=$data['reporteinventario'];
    $_SESSION['historialventas']=$data['historialventas'];
    $_SESSION['historialcompras']=$data['historialcompras'];
    $_SESSION['historialcotizaciones']=$data['historialcotizaciones'];
    
    
    $_SESSION['numero_de_caja']='1';
  $_SESSION['sucursal']=$_POST['empresa'];
  if ($_SESSION['sucursal']=='1'){
  $_SESSION['sucursal2']='TIENDA 1';  
  }
  if ($_SESSION['sucursal']=='2'){
  $_SESSION['sucursal2']='TIENDA 2';  
  }
  if ($_SESSION['sucursal']=='3'){
  $_SESSION['sucursal2']='TIENDA 3';  
  }
  }

  echo "
    <script>
      document.location.href = 'Pedidos.php';
    </script>
  ";
  echo "
    <script>
      document.location.href = 'Pedidos.php';
    </script>
  ";
}else{  
echo "hola1";
  echo "<script>

     swal(
                          'Nombre o contraseña invalidos',
                          'Por favor verifique sus datos e intente nuevamente',
                          'error'
                        );
                        
  </script>";

}
?>