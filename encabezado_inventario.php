<?php
	require('fpdf/fpdf.php');
	
	class PDF extends FPDF
	{
		function Header()
		{
		//	$this->Image('images/logo.png', 5, 5, 30 );
			$this->SetFont('Arial','B',12);
			$this->Cell(30);
			$this->Cell(120,10, 'Reporte De Estados',0,0,'C');
			$this->Ln(10);
			$pdf->SetFillColor(232,232,232);
    $pdf->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
	$pdf->Cell(125,6, utf8_decode('PRODUCTO'),1,0,'C',1);
	$pdf->Cell(20,6,'EXISTENCIA',1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('MÍNIMA'),1,0,'C',1);
	$pdf->Cell(20,6,utf8_decode('MÁXIMA'),1,1,'C',1);
		}
		
		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial','I', 8);
		$this->Cell(0,10, 'CrediSoft - - - Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}
		
		
	}
	
?>
