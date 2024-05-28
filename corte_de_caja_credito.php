<?php include "./class_lib/sesionSecurity.php"; ?>
<?php



//include 'plantilla_proyeccion.php';
include 'plantilla_pdf_corte.php';
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
$tip='Crédito';
// $tip='';

$totales=0.00;
$pdf = new PDF();
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',6); //Arial, negrita, 12 puntos
    $pdf->SetFillColor(232,232,232);
$totalagricola=0.00;
$totalferreteria=0.00;
$totalmaquinaria=0.00;
$totalrepuestos=0.00;
$totalveterinaria=0.00;
//$queryventas = "SELECT * from ventas where Fecha>= :finicio and Fecha<= :ffinal  order by Factura asc";
$queryventas = "SELECT * from ventas where Fecha>= :finicio and Fecha<= :ffinal  and tipo= :tipos order by Factura asc";
$resultad=$db->prepare($queryventas);
    $resultad->bindParam(":finicio",$fechai);
    $resultad->bindParam(":ffinal",$fechaf);
    $resultad->bindParam(":tipos",$tip);
    $resultad->execute();

foreach ($resultad as $key =>$rrrow){


//$ciclo=0;

//while ($ciclo<5){
$agricola='AGRICOLA';
$ferreteria='FERRETERIA';
$maquinaria='MAQUINARIA';
$repuestos='REPUESTOS';
$veterinaria='VETERINARIA';    
//$ciclo=$ciclo+1;	
//if ($ciclo==1){
//	$categoria=$agricola;
//}
//if ($ciclo==2){
//	$categoria=$ferreteria;
//}	
//if ($ciclo==3){
//	$categoria=$maquinaria;
//}
//if ($ciclo==4){
//	$categoria=$repuestos;
//}
//if ($ciclo==5){
//	$categoria=$veterinaria;
//}

$fac=$rrrow['Factura'];    
//$query = "SELECT * from detalle_ventas where fecha>= :finicio and fecha<= :ffinal and categoria= :cat and factura= :fact order by factura asc";
//$query = "SELECT * from detalle_ventas where categoria= :cat and factura= :fact";
$query = "SELECT * from detalle_ventas where factura= :fact";
$resultado=$db->prepare($query);

  //  $resultado->bindParam(":finicio",$fechai);
  //  $resultado->bindParam(":ffinal",$fechaf);
    //$resultado->bindParam(":cat",$categoria);
    $resultado->bindParam(":fact",$fac);
    $resultado->execute();

$total=0.00;
$total2=0.00;


foreach ($resultado as $key =>$row){
//while($row = $db->buscar_array($resultado)){
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
//$total2=$rrrow['total2'];        
    $total=$total+$row['total'];
    if($total2==0){
$total2=$row['total'];        
    }
    
    if ($row['categoria']=='AGRICOLA'){
 	    $totalagricola=$totalagricola+$row['total'];
    }
    if ($row['categoria']=='FERRETERIA'){
        $totalferreteria=$totalferreteria+$row['total'];
    }	
    if ($row['categoria']=='MAQUINARIA'){
        $totalmaquinaria=$totalmaquinaria+$row['total'];
    }
    if ($row['categoria']=='REPUESTOS'){
        $totalrepuestos=$totalrepuestos+$row['total'];
    }
    if ($row['categoria']=='VETERINARIA'){
        $totalveterinaria=$totalveterinaria+$row['total'];
    }

	$pdf->SetFont('Arial','',7);			
	$pdf->Cell(15,6,utf8_decode($row['codigo']),1,0,'C');
	$pdf->Cell(15,6,utf8_decode($row['cantidad']),1,0,'C');
	$pdf->Cell(90,6,utf8_decode ($row['producto']),1,0,'L');
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
	if ($totalagricola>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Departamento: Agricola    Total:  Q '.number_format($totalagricola,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
    if ($totalferreteria>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Departamento: Ferreteria    Total:  Q '.number_format($totalferreteria,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
    if ($totalmaquinaria>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Departamento: Maquinaria    Total:  Q '.number_format($totalmaquinaria,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
    if ($totalrepuestos>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Departamento: Repuestos    Total:  Q '.number_format($totalrepuestos,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
    if ($totalveterinaria>0){
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'Departamento: Veterinaria    Total:  Q '.number_format($totalveterinaria,2,".",","),0,0,'C',0);
    $pdf->SetFont('Arial','',4);			
	$pdf->MultiCell(105,5, '');//ESPACIO
    }
    $pdf->MultiCell(105,5, '');//ESPACIO
	$pdf->SetFont('Arial','',12);			
	$pdf->Cell(190,2, 'TOTAL DEPARTAMENTOS:  Q '.number_format($totales,2,".",","),0,0,'C',0);
    
	ob_start(); 
$pdf->Output();
?>	