<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
//include 'plantilla_proyeccion.php';
include 'plantilla_pdf_cliente_compras.php';
//require('class_lib/class_conecta_mysql_pdf.php');

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
    $usuario=$_SESSION['nombre_de_usuario'];
    $queryusu = "SELECT * from usuarios where Usuario= :nom";
    $resultadousu=$db->prepare($queryusu);
    $resultadousu->bindParam(":nom",$usuario);	
    $resultadousu->execute();	
    foreach ($resultadousu as $key =>$data){
    $clave=$data['TipoUsuario'];
	}
	$cadena_buscada   = 'clientes';
	$posicion_coincidencia = strpos($clave, $cadena_buscada);
 
	if ($posicion_coincidencia === false) {
	header ('Location: inicio.php');
	/*	 echo "NO se ha encontrado la palabra deseada!!!!";*/
	} else {
	 /*         echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;*/
	}

$id=$_GET["id"];
$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$fechaf=$_GET["varf"];
$fechai=$_GET["vari"];
$usuario=$_GET["usuario"];
//$query = "SELECT * from clientes where saldo>0  order by id asc";
$query = "SELECT * from ventas where Cliente= :usuario  order by Factura  asc";
$resultado = $db->prepare($query);
$pdf = new PDF();
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',8); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);
  //  $pdf->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
	//$pdf->Cell(125,6, utf8_decode('PRODUCTO'),1,0,'C',1);
	//$pdf->Cell(20,6,'EXISTENCIA',1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÍNIMA'),1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÁXIMA'),1,1,'C',1);
	//$resultado->bindParam(":finicio",$fechai);
    //$resultado->bindParam(":ffinal",$fechaf);
    $resultado->bindParam(":usuario",$usuario);
     $resultado->execute();
foreach ($resultado as $key =>$row){

//while($row = $db->buscar_array($resultado)){
	$fecha=$row['Fecha'];
	$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
	$ddia=$ddias[date('w', strtotime($fechainicio))];
	$nnum=date('j', strtotime($fecha));
	$aanno=date('Y', strtotime($fecha));
	$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	$mmes=$mmes[(date('m', strtotime($fecha))* 1)-1];
	$ffecenletras=$nnum .'/' .$mmes .'/' .$aanno;	
	$totalletras=num2letras($total);
	$pdf->SetFont('Arial','',8);			
	$pdf->Cell(20,6,utf8_decode($row['Nit']),1,0,'C');
	$pdf->Cell(75,6,utf8_decode($row['Cliente']),1,0,'C');
	$pdf->Cell(20,6,utf8_decode ($row['Factura']),1,0,'L');
	$pdf->Cell(20,6, $row['Total'],1,0,'R');
	$pdf->Cell(30,6,utf8_decode ($ffecenletras),1,0,'C');
	
	//$pdf->Cell(20,6, $row['plazo'],1,0,'C');
	//$pdf->Cell(20,6, $row['saldo'],1,1,'R');	
	}
ob_start(); 		
$pdf->Output();
?>	