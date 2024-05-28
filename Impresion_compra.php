<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
//include 'plantilla_proyeccion.php';
include 'plantilla_pdf.php';

if ($_SESSION['sucursal']=="1"){
    include('./class_lib/class_conecta_mysql.php');
    }
    if ($_SESSION['sucursal']=="2"){
    include('./class_lib/class_conecta_mysql3.php');
    }
    if ($_SESSION['sucursal']=="3"){
    include('./class_lib/class_conecta_mysql3.php');
    }
require('class_lib/funciones.php');
$fac=$_GET["id"];
$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$query = "SELECT a.Factura as Factura, a.Factura,  a.Nit, a.Proveedor, a.Direccion, a.Fecha, a.Tipo, a.Total, a.Usuario FROM compras a, parametros b where a.Factura= :seyscom";
$resultado=$db->prepare($query);
	
$pdf = new PDF('P', 'mm', 'letter', true);
//$pdf = new PDF_AutoPrint();
    $mediacarta=array(311,396);
    //$pdf = new PDF_AutoPrint();
	$pdf->AddPage('portrait',array(105,164)); //Vertical, Carta
    $pdf->SetFont('Arial','B',12); //Arial, negrita, 12 puntos
    $resultado->bindParam(":seyscom",$fac);
    $resultado->execute();

if ($resultado->rowcount()>=1){
    $row=$resultado->fetch();
		$factura=$row['Factura'];
		$nit=$row['Nit'];
		$cliente=utf8_decode($row['Proveedor']);
		$direccion=utf8_decode($row['Direccion']);
		$fecha=$row['Fecha'];
		$tipo=utf8_decode($row['Tipo']);
		$total=$row['Total'];
		$usuario=utf8_decode($row['Usuario']);
		//$comentario=utf8_decode($row['comentario']);
	}
$queryy = "SELECT a.factura as factura, a.factura, a.codigo, a.producto, a.presentacion, a.precio, a.cantidad, a.descuento, a.total, a.fechahora, a.id FROM detalle_compras a, parametros b where a.factura= :seyscomm order by a.id";
$resultadoo=$db->prepare($queryy);
    
$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia=$ddias[date('w', strtotime($fecha))];
$nnum=date('j', strtotime($fecha));
$aanno=date('Y', strtotime($fecha));
$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes=$mmes[(date('m', strtotime($fecha))* 1)-1];
$ffecenletras=$ddia .' ' .$nnum .'/' .$mmes .'/' .$aanno;	


$pdf->SetFont('Arial','',7);	
//$pdf->Image('dist/img/logo.jpg', 40, 12, 54, "JPG", "" ); //margen izquierdo, interlineado, tamaño de imagen
$pdf->SetFont('Arial','',7);
    $pdf->Cell(35,6,utf8_decode('Le atendió:  '.$usuario),1,0,'C');
	$pdf->MultiCell(105,15, '');//ESPACIO
	$pdf->Cell(20,4,utf8_decode('Fecha:'));
	$pdf->MultiCell(85,4,$ffecenletras);
	$pdf->Cell(20,4,utf8_decode('No. Factura:'));
	$pdf->MultiCell(85,4,$factura);
	$pdf->Cell(20,4,utf8_decode('Proveedor:'));
	$pdf->MultiCell(85,4,$cliente);
	$pdf->Cell(20,4,utf8_decode('Dirección:'));
	$pdf->MultiCell(85,4,$direccion);
	$pdf->MultiCell(105,2, '');//ESPACIO
	//$pdf->MultiCell(105,1, $espacio);
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',6);
	$pdf->SetFont('Arial','B',6);
	$pdf->Cell(10,5,'CANT.',1,0,'C',1);
	//$pdf->Cell(15,5,' ',1,0,'C',1);
	$pdf->Cell(65,5,'PRODUCTO',1,0,'C',1);
	$pdf->Cell(15,5,'SUBTOTAL',1,1,'C',1);
	$resultadoo->bindParam(":seyscomm",$fac);
    $resultadoo->execute();
			
	foreach ($resultadoo as $key =>$roww){
    //$roww=$resultadoo->fetch();
	//if ($resultadoo->rowcount()>=1){		
	//	$fechaa=$roww['fechapago'];
	//	$dias=array('Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb');
	//	$dia=$dias[date('w', strtotime($fechaa))];
	//	$num=date('j', strtotime($fechaa));
	//	$anno=date('Y', strtotime($fechaa));
	//	$mes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
	//	$mes=$mes[(date('m', strtotime($fechaa))* 1)-1];
	//	$fechaenletras=$dia .' ' .$num .'/' .$mes .'/' .$anno;
        $totales=$totales+$roww['total'];
        $totalletras=num2letras($totales);
		$ffactura=$roww['factura'];
		$codigo=$roww['codigo'];
		$producto=utf8_decode($roww['producto']);
		$presentacion=utf8_decode($roww['presentacion']);
		$precio=$roww['precio'];
		$cantidad=$roww['cantidad'];
		$descuento=$roww['descuento'];
		$ttotal=$roww['total'];
		$ffecha=$roww['fecha'];
		$id=$roww['id'];
	
    	$pdf->SetFont('Arial','',6);			
		$pdf->Cell(10,6,utf8_decode($cantidad),1,0,'C');
		//$pdf->Cell(15,6,utf8_decode ($presentacion),1,0,'L');
		$pdf->Cell(65,6,utf8_decode ($producto),1,0,'L');
		$pdf->Cell(15,6,utf8_decode ($roww['total']),1,1,'R');	
		
	}//}
	$pdf->SetFont('Arial','',7);
	//$pdf->MultiCell(105,112, '');//ESPACIO
	$pdf->SetY(138);
	$pdf->Cell(90,2,utf8_decode ('Q. '.$totales),0,0,'R');	
	$pdf->MultiCell(105,3, '');//ESPACIO
	$pdf->Cell(25,2,utf8_decode ($totalletras),0,0,'L');	
	//$pdf->MultiCell(105,3, '');//ESPACIO
ob_start(); 

//$pdf->AutoPrint(true);
	 
$pdf->Output();
?>	