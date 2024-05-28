<?php
require('plugins/fpdf181/fpdf.php');
class PDF extends FPDF
{
//     function Footer(){
//         $this->SetY(-15);
//         $this->SetFont('Arial','I',8);
//   //     $this->Cell(0,10,'Este es el pie de página creado con el método Footer() de la clase creada PDF que hereda de FPDF','T',0,'C');

//     }

function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
}


 
    function Header(){
        $this->SetFont('Arial','B',9);
     //   $this->Line(10,10,206,10);
     //   $this->Line(10,35.5,206,35.5);
       // $this->Cell(30,25,'',0,0,'C',$this->Image('images/logo.png', 152,12, 19));
       // $this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));
       // $this->Cell(40,25,'',0,0,'C',$this->Image('images/logoDerecha.png', 175, 12, 19));
        //Se da un salto de línea de 25
        
        $feccc=date('d/m/Y');
        $this->Ln(2);
        $this->SetFillColor(255,255,255);
        if($this->PageNo()==1){
        $this->Cell(15,6,utf8_decode('             Fecha: ').$feccc,0,1,'C',1);    
        }
        
        $this->Ln(5);
        $this->SetFillColor(232,232,232);
        $this->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
        $this->Cell(105,6, utf8_decode('PRODUCTO'),1,0,'C',1);
        $this->Cell(35,6, utf8_decode('CATEGORÍA'),1,0,'C',1);
        $this->Cell(20,6,utf8_decode('P. COSTO'),1,0,'C',1);
        $this->Cell(20,6,'EXISTENCIA',1,0,'C',1);
        $this->Cell(20,6,utf8_decode('MÍNIMA'),1,0,'C',1);
        $this->Cell(20,6,utf8_decode('MÁXIMA'),1,0,'C',1);
        $this->Cell(20,6,utf8_decode('FÍSICO'),1,1,'C',1);

        $this->Ln(0);
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
