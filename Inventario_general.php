<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
$cate=$_GET['prov'];


//include 'plantilla_proyeccion.php';
include 'plantilla_pdf2.php';
    if ($_SESSION['sucursal']=="1"){
    include('./class_lib/class_conecta_mysql.php');
    }
    if ($_SESSION['sucursal']=="2"){
    include('./class_lib/class_conecta_mysql2.php');
    }
    if ($_SESSION['sucursal']=="3"){
    include('./class_lib/class_conecta_mysql3.php');
    }
//echo '11';


	require('class_lib/funciones.php');
	//if ($_SESSION['sucursal']=="1"){
    //include('./class_lib/class_conecta_mysql.php');
    //}
    // if ($_SESSION['sucursal']=="2"){
    // include('./class_lib/class_conecta_mysql_pdf2.php');
    // }
    // if ($_SESSION['sucursal']=="3"){
    // include('./class_lib/class_conecta_mysql_pdf3.php');
    // }
    echo '22';
    $db=conectar();
    $usuario=$_SESSION['nombre_de_usuario'];
    $queryusu = "SELECT * from usuarios where Usuario= :nom";
    $resultadousu=$db->prepare($queryusu);
    $resultadousu->bindParam(":nom",$usuario);	
    $resultadousu->execute();	
    foreach ($resultadousu as $key =>$data){
    $clave=$data['TipoUsuario'];
	}
	$cadena_buscada   = 'rinventarios';
	$posicion_coincidencia = strpos($clave, $cadena_buscada);
 
	if ($posicion_coincidencia === false) {
	header ('Location: inicio.php');
	/*	 echo "NO se ha encontrado la palabra deseada!!!!";*/
	} else {
	 /*         echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;*/
	}



$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");


if($cate=="TODOS"){
$query = "SELECT * from inventario order by categoria, producto asc";
}else
{
    $query = "SELECT * from inventario where categoria=:cate order by categoria, producto asc";
}



$resultado=$db->prepare($query);
$pdf = new PDF();
	$pdf->AddPage('L','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',8); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);
  //  $pdf->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
	//$pdf->Cell(125,6, utf8_decode('PRODUCTO'),1,0,'C',1);
	//$pdf->Cell(20,6,'EXISTENCIA',1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÍNIMA'),1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÁXIMA'),1,1,'C',1);
    //$resultado->bindParam();
    $resultado->bindParam(":cate",$cate);
    $resultado->execute();


foreach ($resultado as $key =>$row){
//while($row = $db->buscar_array($resultado)){
	$pdf->SetFont('Arial','',9);			
	$pdf->Cell(15,6,utf8_decode($row['codigo']),1,0,'C');
	$pdf->Cell(105,6,utf8_decode (substr($row['producto'], 0,65)),1,0,'L');
	$pdf->Cell(35,6,utf8_decode ($row['categoria']),1,0,'L');
	$pdf->Cell(20,6, $row['preciocosto'],1,0,'C');
	$pdf->Cell(20,6, $row['existencia'],1,0,'C');
	$pdf->Cell(20,6, $row['minima'],1,0,'C');
	$pdf->Cell(20,6, $row['maxima'],1,0,'C');
	$pdf->Cell(20,6,'       ',1,1,'C');	
	$costo+=$row['preciocosto']*$row['existencia'];
	}
	$pdf->Cell(15,6,utf8_decode(''),1,0,'C');
	$pdf->Cell(100,6,utf8_decode ('COSTO INVENTARIO: '),1,0,'C');
	$pdf->Cell(20,6, $costo,1,0,'C');
	ob_start(); 
$pdf->Output();
?>	