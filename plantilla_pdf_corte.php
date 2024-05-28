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
        $this->SetFont('Arial','B',16);
     //   $this->Line(10,10,206,10);
     //   $this->Line(10,35.5,206,35.5);
       // $this->Cell(30,25,'',0,0,'C',$this->Image('images/logo.png', 152,12, 19));
       // $this->Cell(111,25,'ALGÚN TÍTULO DE ALGÚN LUGAR',0,0,'C', $this->Image('images/logoIzquierda.png',20,12,20));
       // $this->Cell(40,25,'',0,0,'C',$this->Image('images/logoDerecha.png', 175, 12, 19));
        //Se da un salto de línea de 25
        $fechaf=$_GET["varf"];
        $fechai=$_GET["vari"];
        $fechahoy=date ("d/m/Y");
        if ($_SESSION['sucursal']=="1"){
        $sucursal='GUADALUPANA';
        }
        if ($_SESSION['sucursal']=="2"){
        $sucursal='GUADALUPANA';
        }
        if ($_SESSION['sucursal']=="3"){
        $sucursal='Buen Precio Terminal';
        }
        $dias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $dia=$dias[date('w', strtotime($fechai))];
        $num=date('j', strtotime($fechai));
        if ($num<10){
                $num='0'.$num;
            }
        $ano=date('Y', strtotime($fechai));
        $mes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $mes=$mmes[(date('m', strtotime($fechai))* 1)-1];
        $fechaenletrasi=$num .'/' .$mes .'/' .$ano;  

        $ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
        $ddia=$ddias[date('w', strtotime($fechaf))];
        $nnum=date('j', strtotime($fechaf));
        if ($nnum<10){
                $nnum='0'.$nnum;
            }
        $aanno=date('Y', strtotime($fechaf));
        $mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        $mmes=$mmes[(date('m', strtotime($fechaf))* 1)-1];
        $fechaenletrasf=$nnum .'/' .$mmes .'/' .$aanno;  
        $this->Cell(185,6,utf8_decode('Envios por Fecha:  ').$sucursal,0,0,'C',0);    
        $this->SetFont('Arial','B',10);
        $this->Ln(8);
        $this->Cell(70,6, 'Fecha Inicial: '.$fechaenletrasi,0,0,'L');    
        $this->Cell(30,6, 'Fecha Inicial: '.$fechaenletrasf.'                                   Fecha Hoy: '.$fechahoy,0,1,'L');   
        $this->Ln(3);
        $this->SetFillColor(232,232,232);
        $this->SetFont('Arial','B',7);
        $this->Cell(15,6,utf8_decode('CÓDIGO'),1,0,'C',1);
        $this->Cell(15,6,utf8_decode('CANTIDAD'),1,0,'C',1);
        $this->Cell(90,6, utf8_decode('PRODUCTO'),1,0,'C',1);
        $this->Cell(15,6,'PRECIO',1,0,'C',1);
        $this->Cell(15,6,utf8_decode('DESCUENTO'),1,0,'C',1);
        $this->Cell(15,6,utf8_decode('TOTAL'),1,0,'C',1);
        $this->Cell(15,6,utf8_decode('ENVIO No.'),1,0,'C',1);
        $this->Cell(15,6,utf8_decode('FECHA'),1,1,'C',1);

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
