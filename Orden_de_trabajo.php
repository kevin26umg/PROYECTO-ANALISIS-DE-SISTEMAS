<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
//include 'plantilla_proyeccion.php';
include 'plantilla_pdf.php';

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
//require('rounded_rect2.php');
$fac=$_GET["id"];

$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$query = "SELECT * FROM servicios where Factura= :seyscom";
$resultado=$db->prepare($query);

	
$pdf = new PDF('P', 'mm', 'letter', true);
//$pdf = new PDF_AutoPrint();
    //$mediacarta=array(311,396);
    //$pdf = new PDF_AutoPrint();
	//$pdf->AddPage('portrait',array(105,164)); //Vertical, Carta
	$pdf->AddPage('P','letter'); //Vertical, Carta
    $pdf->SetFont('Arial','B',12); //Arial, negrita, 12 puntos
    $resultado->bindParam(":seyscom",$fac);
    $resultado->execute();

if ($resultado->rowcount()>=1){
    $row=$resultado->fetch();
		$factura=$row['Factura'];
		$nit=$row['Nit'];
		$cliente=utf8_decode($row['Cliente']);
		$direccion=utf8_decode($row['Direccion']);
		$fechaingreso=$row['fechaingreso'];
		$fechaprometida=$row['fechaprometida'];
		$fechacompra=$row['fechacompra'];
		$tipo=utf8_decode($row['Tipo']);
		$telefono=utf8_decode($row['telefono']);
		$total=$row['Total'];
		$usuario=utf8_decode($row['Usuario']);
		$comentario=utf8_decode($row['comentario']);
		
		$ano=utf8_decode($row['ano']);
		$placa=utf8_decode($row['placa']);
		$nomotor=utf8_decode($row['nomotor']);
		$cc=utf8_decode($row['cc']);
		$estilo=utf8_decode($row['estilo']);
		$color=utf8_decode($row['color']);
		$kilometraje=utf8_decode($row['kilometraje']);
		$nochasis=utf8_decode($row['nochasis']);
		$tiposervicio=utf8_decode($row['tiposervicio']);
	}
$queryy = "SELECT * FROM detalle_servicios where factura= :seyscomm order by categoria";
$resultadoo=$db->prepare($queryy);
    

	
	if(utf8_decode($tiposervicio)=="Garant?a"){
	    $garantia="X";
	}
	
	if(utf8_decode($tiposervicio)=="Reparaci?n"){
	    $reparacion="X";
	}
	
	
///////////compra////////////////    
$ddias1=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia1=$ddias1[date('w', strtotime($fechacompra))];
$nnum1=date('j', strtotime($fechacompra));
$aanno1=date('Y', strtotime($fechacompra));
$mmes1=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes1=$mmes1[(date('m', strtotime($fechacompra))* 1)-1];
$feccompra=$ddia1 .' ' .$nnum1 .'/' .$mmes1 .'/' .$aanno1;	

///////////ingreso////////////////    
$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia=$ddias[date('w', strtotime($fechaingreso))];
$nnum=date('j', strtotime($fechaingreso));
$aanno=date('Y', strtotime($fechaingreso));
$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes=$mmes[(date('m', strtotime($fechaingreso))* 1)-1];
$fecingreso=$ddia .' ' .$nnum .'/' .$mmes .'/' .$aanno;	
$totalletras=num2letras($total);
///////////////prometida////////////////////
$ddias2=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia2=$ddias2[date('w', strtotime($fechaprometida))];
$nnum2=date('j', strtotime($fechaprometida));
$aanno2=date('Y', strtotime($fechaprometida));
$mmes2=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes2=$mmes2[(date('m', strtotime($fechaprometida))* 1)-1];
$fecprometida=$ddia2 .' ' .$nnum2 .'/' .$mmes2 .'/' .$aanno2;	



$pdf->SetFont('Arial','',7);	
$pdf->Image('imagenes/freedom2.png', 10, 12, 55, "JPG", "" ); //margen izquierdo, interlineado, tamaño de imagen
$pdf->SetFont('Arial','',7);
    $pdf->SetFont('Arial','B',14);	
    $pdf->Cell(210,4,utf8_decode('CENTRO DE SERVICIO'),0,0,'C',0);
    $pdf->SetFont('Arial','B',11);	
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,4,utf8_decode('PBX: 7736-4151'),0,0,'C',0);
    $pdf->SetFont('Arial','B',11);
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,4,utf8_decode('Móvil: 5989-1254'),0,0,'C',0);
        $pdf->SetFont('Arial','B',10);
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,4,utf8_decode('9na. Calle 9-99 Zona 1 Avenida Circunvalación Retalhuleu'),0,0,'C',0);
	$pdf->SetY(15);
	$pdf->SetX(150);
	
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(52,12,utf8_decode('ORDEN DE TRABAJO No.  '.$factura),1,0,'C');
	
	$pdf->SetFont('Arial','',10);	
// 	$pdf->SetY(30);
// 	$pdf->SetX(70);
// 	$pdf->Cell(20,4,utf8_decode('Fecha de Compra:'));
// 	$pdf->SetY(28);
// 	$pdf->SetX(100);
// 	$pdf->Cell(35,7,$feccompra,1,0,'C');

	$pdf->SetY(40);
	$pdf->SetX(70);
	$pdf->Cell(20,4,utf8_decode('Fecha de Ingreso:'));
	$pdf->SetY(38);
	$pdf->SetX(100);
	$pdf->Cell(35,7,$fecingreso,1,0,'C');
	$pdf->SetY(40);
	$pdf->SetX(138);
	$pdf->Cell(20,4,utf8_decode('Fecha Prometida:'));
	$pdf->SetY(38);
	$pdf->SetX(168);
	$pdf->Cell(35,7,$fecprometida,1,0,'C');
	
	$pdf->SetY(50);
	$pdf->SetX(30);
	$pdf->Cell(14,4,utf8_decode('_______________________________________________________________'));
	$pdf->SetY(50);
	$pdf->Cell(20,4,utf8_decode('Cliente:'));
	$pdf->MultiCell(85,4,$cliente);
	$pdf->SetY(50);
	$pdf->SetX(170);
	$pdf->Cell(14,4,utf8_decode('__________________'));
	$pdf->SetY(50);
	$pdf->SetX(160);
	$pdf->Cell(20,4,utf8_decode('Nit: '));
	$pdf->MultiCell(25,4,$nit);
	
	$pdf->SetY(57);
	$pdf->SetX(30);
	$pdf->Cell(14,4,utf8_decode('___________________'));
	$pdf->SetY(57);
	$pdf->Cell(20,4,utf8_decode('Teléfono:'));
	$pdf->MultiCell(85,4,$telefono);
	$pdf->SetY(57);
	$pdf->SetX(70);

	
	$pdf->Cell(20,4,utf8_decode('GARANTÍA:'));
	$pdf->SetY(55);
	$pdf->SetX(92);
	$pdf->Cell(15,7,utf8_decode($garantia),1,0,'C');
	$pdf->SetY(57);
	$pdf->SetX(110);
	$pdf->Cell(20,4,utf8_decode('REPARACIÓN:'));
	$pdf->SetY(55);
	$pdf->SetX(135);
	$pdf->Cell(15,7,utf8_decode($reparacion),1,0,'C');
	
	$pdf->SetY(65);
	$pdf->SetX(10);
	$pdf->SetFillColor(232,232,232);
	$pdf->Cell(50,8,utf8_decode('DATOS MOTOCICLETA'),1,0,'C',1);
	
	$pdf->SetY(75);
	$pdf->SetX(10);
	$pdf->Cell(50,8,utf8_decode(''),1,0,'C');
	$pdf->SetY(75);
	$pdf->SetX(10);
	$pdf->Cell(50,6,utf8_decode('C.C.:   '.$cc));
	
	$pdf->SetY(85);
	$pdf->SetX(10);
	$pdf->Cell(50,8,utf8_decode(''),1,0,'C');
	$pdf->SetY(85);
	$pdf->SetX(10);
	$pdf->Cell(50,6,utf8_decode('Estilo:   '.$estilo));
	
	$pdf->SetY(67);
	$pdf->SetX(65);
	$pdf->Cell(50,6,utf8_decode('Año    Placa'),0,0,'C');
	$pdf->SetY(72);
	$pdf->SetX(65);
	$pdf->Cell(50,8,utf8_decode($ano." | ".$placa ),1,0,'C');
	
	$pdf->SetY(80);
	$pdf->SetX(65);
	$pdf->Cell(50,6,utf8_decode('Color       Kilometraje'),0,0,'C');
	$pdf->SetY(85);
	$pdf->SetX(65);
	$pdf->Cell(50,8,utf8_decode($color." | ".$kilometraje." KM" ),1,0,'C');
	
	$pdf->SetY(67);
	$pdf->SetX(120);
	$pdf->Cell(50,6,utf8_decode('No. Motor'),0,0,'C');
	$pdf->SetY(72);
	$pdf->SetX(120);
	$pdf->Cell(50,8,utf8_decode($nomotor),1,0,'C');
	
	$pdf->SetY(80);
	$pdf->SetX(120);
	$pdf->Cell(50,6,utf8_decode('No. Chasis'),0,0,'C');
	$pdf->SetY(85);
	$pdf->SetX(120);
	$pdf->Cell(50,8,utf8_decode($nochasis),1,0,'C');
	
	$pdf->SetY(65);
	$pdf->SetX(175);
	$pdf->Cell(33,8,utf8_decode(''),1,0,'C');
	$pdf->SetY(65);
	$pdf->SetX(175);
	$pdf->Cell(15,8,utf8_decode('Costo:'),0,0,'R');
	
	$pdf->SetY(75);
	$pdf->SetX(175);
	$pdf->Cell(33,8,utf8_decode(''),1,0,'C');
	$pdf->SetY(75);
	$pdf->SetX(175);
	$pdf->Cell(15,8,utf8_decode('Anticipo:'),0,0,'R');
	
	$pdf->SetY(85);
	$pdf->SetX(175);
	$pdf->Cell(33,8,utf8_decode(''),1,0,'C');
	$pdf->SetY(85);
	$pdf->SetX(175);
	$pdf->Cell(15,8,utf8_decode('Saldo:'),0,0,'R');
	
	$pdf->SetY(95);
	$pdf->SetX(10);
	$pdf->Cell(100,5,'SERVICIOS REALIZADOS',1,0,'C',1);
	
		$resultadoo->bindParam(":seyscomm",$fac);
    $resultadoo->execute();
	$pdf->SetY(100);		
	foreach ($resultadoo as $key =>$roww){
    

		$ffactura=$roww['factura'];
		$codigo=$roww['codigo'];
		$producto=($roww['producto']);
		$presentacion=($roww['presentacion']);
		$precio=$roww['precio'];
		$cantidad=$roww['cantidad'];
		$descuento=$roww['descuento'];
		$ttotal=$roww['total'];
		$ffecha=$roww['fecha'];
		$id=$roww['id'];
		$categoria=$roww['categoria'];
	    
	    $cantida=$pdf->GetY();
    
    	$pdf->SetFont('Arial','',8);	
    	if (($categoria=='Repuestos') || ($categoria=='Repuestosx')){
    	$pdf->SetX(110);	
    	$pdf->Cell(10,6,utf8_decode($cantidad),0,0,'C');
		//$pdf->Cell(15,6,utf8_decode ($presentacion),0,0,'L');
		$pdf->Cell(70,6,utf8_decode (substr($producto, 0,45)),0,0,'L');
		$pdf->Cell(15,6,utf8_decode ($roww['total']),0,1,'R');	
	    $numfilarepuestos=100;    
    	}else{
    	if ($numfilarepuestos==0){
    	    $numfilarepuestos=100;
    	}
       	$pdf->SetY($numfilarepuestos);    
		$pdf->Cell(10,6,utf8_decode($cantidad),0,0,'C');
		//$pdf->Cell(15,6,utf8_decode ($presentacion),0,0,'L');
		$pdf->Cell(70,6,utf8_decode (substr($producto, 0,45)),0,0,'L');
		$pdf->Cell(15,6,utf8_decode ($roww['mo']),0,1,'R');	    
		$numfilarepuestos+=6;    
		}
		
	}
	
		$pdf->SetFont('Arial','',8);
	//$pdf->MultiCell(105,112, '');//ESPACIO
	$pdf->SetY(188);
	$pdf->SetX(110);	
	$pdf->Cell(95,2,utf8_decode ('Q. '.$total),0,0,'R');	
	$pdf->MultiCell(105,3, '');//ESPACIO
	$pdf->SetX(110);
	$pdf->Cell(25,2,utf8_decode ($totalletras),0,0,'L');	
	//$pdf->MultiCell(105,3, '');//ESPACIO
	
	$pdf->SetFont('Arial','',10);
	$pdf->SetY(95);
	$pdf->SetX(109);
	$pdf->Cell(99,5,'REPUESTOS ',1,0,'C',1);
	
	$pdf->SetY(100);
	$pdf->SetX(10);
	$pdf->Cell(99,95,'',1,0,'C');
	
	$pdf->SetY(100);
	$pdf->SetX(109);
	$pdf->Cell(99,95,'',1,0,'C');
	
	$pdf->SetY(197);
	$pdf->SetX(10);
	$pdf->Cell(99,20,'',1,0,'C');
	$pdf->SetY(197);
	$pdf->SetX(10);
	$pdf->Cell(99,8,(utf8_decode('Observación: ').$comentario),0,0,'L');
	
	$pdf->SetY(217);
	$pdf->SetX(10);
	$pdf->Cell(99,10,'',1,0,'C');
	$pdf->SetY(217);
	$pdf->SetX(10);
	$pdf->Cell(99,10,(utf8_decode('Nombre del Técnico: ').$usuario),0,0,'L');
	
	$pdf->SetY(197);
	$pdf->SetX(109);
	$pdf->Cell(99,30,'',1,0,'C');
	$pdf->SetY(197);
	$pdf->SetX(109);
	$pdf->Cell(99,8,utf8_decode('Historial:'),0,0,'L');
	
	$pdf->SetY(230);
	$pdf->SetX(10);
	$pdf->Cell(65,6,utf8_decode('_______________________'),0,0,'C');
	$pdf->SetY(235);
	$pdf->SetX(10);
	$pdf->Cell(65,6,utf8_decode('Nombre Cliente'),0,0,'C');
	
	$pdf->SetY(230);
	$pdf->SetX(80);
	$pdf->Cell(65,6,utf8_decode('_______________________'),0,0,'C');
	$pdf->SetY(235);
	$pdf->SetX(80);
	$pdf->Cell(65,6,utf8_decode('Firma Cliente'),0,0,'C');
	
	$pdf->SetY(230);
	$pdf->SetX(150);
	$pdf->Cell(65,6,utf8_decode('_______________________'),0,0,'C');
	$pdf->SetY(235);
	$pdf->SetX(150);
	$pdf->Cell(65,6,utf8_decode('Firma Receptor'),0,0,'C');
	
	$pdf->SetFont('Arial','',8);
	$pdf->SetY(240);
	$pdf->SetX(10);
//	$pdf->Cell(99,20,'',1,0,'C');
//	$pdf->SetY(197);
//	$pdf->SetX(10);
	$pdf->MultiCell(198,4,utf8_decode('extra'),1,0, 'FJ');
	
	
	
	
	
	
	
	


ob_start(); 

//$pdf->AutoPrint(true);
	 
$pdf->Output();
?>	