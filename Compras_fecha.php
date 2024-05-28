<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
//include 'plantilla_proyeccion.php';
include 'plantilla_pdf_compra.php';
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
//require 'conexion.php';
$fechai=$_GET["varfi"];
$fechaf=$_GET["varff"];
$db=conectar();
$set_names=$db->query("SET NAMES 'utf8'");
//$query = "SELECT * from compras where Fecha>='$fechai' and Fecha<='$fechaf' order by Proveedor asc";
//$resultado = $db->consulta($query);
$query = "SELECT * from compras where Fecha>= :buscar and Fecha<= :buscar2 order by Proveedor asc";
$resultado=$db->prepare($query);
$pdf = new PDF();
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',8); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);
  //  $pdf->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
	//$pdf->Cell(125,6, utf8_decode('PRODUCTO'),1,0,'C',1);
	//$pdf->Cell(20,6,'EXISTENCIA',1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÍNIMA'),1,0,'C',1);
	//$pdf->Cell(20,6,utf8_decode('MÁXIMA'),1,1,'C',1);
    

//while($row = $db->buscar_array($resultado)){
    $resultado->bindParam(":buscar",$fechai);	
    $resultado->bindParam(":buscar2",$fechaf);	
    $resultado->execute();	
	foreach ($resultado as $key =>$row){
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
	$pdf->Cell(15,6,utf8_decode ($ffecenletras),1,0,'C');
	$pdf->Cell(20,6,utf8_decode($row['Factura']),1,0,'C');
	$pdf->Cell(20,6, $row['Nit'],1,0,'C');
	$pdf->Cell(75,6,utf8_decode ($row['Proveedor']),1,0,'L');
	$pdf->Cell(20,6,utf8_decode ( $row['tipo']),1,0,'C');
	$pdf->Cell(20,6, $row['total'],1,0,'R');	
	$pdf->Cell(25,6,utf8_decode ($row['Usuario']),1,1,'C');
	}
$pdf->Output();
?>	