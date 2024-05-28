<?php
function Conectar(){
$servidor='localhost';
$usuario ='u661509632_bruder2';
$password = 'Adminctrl2022';
$base_datos = 'u661509632_bruder2';
$opciones=[PDO::ATTR_CASE => PDO::CASE_LOWER, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_ORACLE_NULLS => PDO::NULL_EMPTY_STRING, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
  try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$base_datos", $usuario, $password);      
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexión realizada Satisfactoriamente";
      }
 
  catch(PDOException $e)
      {
      echo "La conexión ha fallado: " . $e->getMessage();
      }
 
  //$conexion = null;
  return $conexion;
}
?>

