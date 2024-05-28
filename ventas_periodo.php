<?php include "./class_lib/sesionSecurity.php"; ?>
<?php



//include 'plantilla_proyeccion.php';
// include 'plantilla_pdf_corte.php';

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
        $sucursal='SurtiMax Tienda 1';
        }
        if ($_SESSION['sucursal']=="2"){
        $sucursal='SurtiMax Tienda 2';
        }
        if ($_SESSION['sucursal']=="3"){
        $sucursal='SurtiMax Tienda 3';
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
	
    $db=conectar();
    $usuario=$_SESSION['nombre_de_usuario'];
    $queryusu = "SELECT * from usuarios where Usuario= :nom";
    $resultadousu=$db->prepare($queryusu);
    $resultadousu->bindParam(":nom",$usuario);	
    $resultadousu->execute();	
    foreach ($resultadousu as $key =>$data){
    $clave=$data['TipoUsuario'];
	}
	$cadena_buscada   = 'caja';
	$posicion_coincidencia = strpos($clave, $cadena_buscada);
 
	if ($posicion_coincidencia === false) {
	header ('Location: inicio.php');
	/*	 echo "NO se ha encontrado la palabra deseada!!!!";*/
	} else {
	 /*         echo "Éxito!!! Se ha encontrado la palabra buscada en la posición: ".$posicion_coincidencia;*/
	}

//$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$fechaf=$_GET["varf"];
$fechai=$_GET["vari"];
$tip='Efectivo';

$totales=0.00;
$pdf = new PDF();
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',6); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);


$queryventas = "SELECT * from ventas where Fecha>= :finicio and Fecha<= :ffinal  and tipo= :tipos order by Factura asc";
$resultad=$db->prepare($queryventas);
    $resultad->bindParam(":finicio",$fechai);
    $resultad->bindParam(":ffinal",$fechaf);
    $resultad->bindParam(":tipos",$tip);
    $resultad->execute();

foreach ($resultad as $key =>$rrrow){

$fac=$rrrow['Factura'];    
$query = "SELECT * from detalle_ventas where factura= :fact";
$resultado=$db->prepare($query);

    $resultado->bindParam(":fact",$fac);
    $resultado->execute();

$total=0.00;
$total2=0.00;


foreach ($resultado as $key =>$row){

$fecha=$row['fecha'];
$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia=$ddias[date('w', strtotime($fecha))];
$nnum=date('j', strtotime($fecha));
if ($nnum<10){
		$nnum='0'.$nnum;
	}
$aanno=date('Y', strtotime($fecha));
$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes=$mmes[(date('m', strtotime($fecha))* 1)-1];
$fechaenletras=$nnum .'/' .$mmes .'/' .$aanno;	

    $total=$total+$row['total'];
//     if($total2==0){
// $total2=$row['total'];        
//     }
    
	$pdf->SetFont('Arial','',7);			
	$pdf->Cell(15,6,utf8_decode($row['codigo']),1,0,'C');
	$pdf->Cell(15,6,utf8_decode($row['cantidad']),1,0,'C');
	$pdf->Cell(90,6,utf8_decode (substr($row['producto'],0,60)),1,0,'L');
	$pdf->Cell(15,6, 'Q '.$row['precio'],1,0,'R');
	$pdf->Cell(15,6, 'Q '.$row['descuento'],1,0,'R');
	$pdf->Cell(15,6, 'Q '.$row['total'],1,0,'R');	
	$pdf->Cell(15,6, $row['factura'],1,0,'C');	
	$pdf->Cell(15,6, $fechaenletras,1,1,'C');	
}	

	if ($total>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Total x Pedido No.: '.$row['factura'].'    Total:  Q '.number_format($total,2,".",","),0,0,'C',0);
	$totales=$totales+$total;
	$pdf->SetFont('Arial','',7);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Pedidos:    Total:  Q '.number_format($totales,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
	
// 	    $pdf->MultiCell(105,5, '');//ESPACIO
// 	$pdf->SetFont('Arial','',12);			
// 	$pdf->Cell(190,2, 'Servicios:    Total:  Q '.number_format($totales2,2,".",","),0,0,'C',0);
//     $pdf->SetFont('Arial','',4);			
// 	$pdf->MultiCell(105,5, '');//ESPACIO
	
	$totalgeneral=$totales+$totales2;
    
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'TOTAL GENERAL:  Q '.number_format($totalgeneral,2,".",","),0,0,'C',0);

    
	ob_start(); 
$pdf->Output();
?>	