<?php
require('plugins/fpdf181/fpdf.php');
class PDF extends FPDF
{
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
   //     $this->Cell(0,10,'Este es el pie de página creado con el método Footer() de la clase creada PDF que hereda de FPDF','T',0,'C');
    }
 
    function Header(){
        $this->SetFont('Arial','B',9);
     //   $this->Line(10,10,206,10);
     //   $this->Line(10,35.5,206,35.5);
       // $this->Cell(30,25,'',0,0,'C',$this->Image('images/logo.png', 152,12, 19));
       // $this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));
       // $this->Cell(40,25,'',0,0,'C',$this->Image('images/logoDerecha.png', 175, 12, 19));
        //Se da un salto de línea de 25
        $this->Ln(5);
    }
 
    function ImprimirTexto($file){
        //Se lee el archivo
        $txt = file_get_contents($file);
        $this->SetFont('Arial','',12);
        //Se imprime
        $this->MultiCell(30,5,$txt);
    }
}
 

?>
