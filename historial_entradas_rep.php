<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
include 'plantilla_pdf_historp.php';
$suc=$_GET["sucursal"];

   
    include('./class_lib/class_conecta_mysql.php');


	require('class_lib/funciones.php');
    $db=conectar();

$set_names=$db->query("SET NAMES 'utf8'");
$fechaf=$_GET["varf"];
$fechai=$_GET["vari"];
$pdf = new PDF();
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',6); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);

$queryventas = "SELECT * from historial_existencias where (fecha>=:finicio and fecha<=:ffinal) order by fecha,hora, producto asc";
$resultad=$db->prepare($queryventas);
    $resultad->bindParam(":finicio",$fechai);
        $resultad->bindParam(":ffinal",$fechaf);
    $resultad->execute();
$totales=0.00;
foreach ($resultad as $key =>$rrrow){


$fecha=$rrrow['fecha'];
$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia=$ddias[date('w', strtotime($fecha))];
$nnum=date('j', strtotime($fecha));

$aanno=date('Y', strtotime($fecha));
$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes=$mmes[(date('m', strtotime($fecha))* 1)-1];
$fechaenletras=$nnum .'/' .$mmes .'/' .$aanno;	
    
    $originalDate = $rrrow['fecha'];
$newDate = date("d/m/Y", strtotime($originalDate));

$horax = date("h:i:s A", strtotime($rrrow['hora']));

	$pdf->SetFont('Arial','',7);			
	$pdf->Cell(15,6,utf8_decode($rrrow['codigo']),1,0,'C');
	$pdf->Cell(15,6,utf8_decode($rrrow['cantidad']),1,0,'C');
	$pdf->Cell(110,6,utf8_decode ($rrrow['producto']." ".$rrrow['tipo']),1,0,'L');
	$pdf->Cell(35,6, $newDate.' '.$horax,1,0,'R');	
	$pdf->Cell(25,6, $rrrow['usuario'],1,1,'R');
}
	
	ob_start(); 
$pdf->Output();
?>	