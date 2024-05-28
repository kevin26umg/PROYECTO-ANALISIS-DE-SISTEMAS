<?php include "./class_lib/sesionSecurity.php"; ?>
<?php
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
$fac=$_GET["id"];
$db=Conectar();
$set_names=$db->query("SET NAMES 'utf8'");
$query = "SELECT a.Factura as Factura, a.Factura, a.Telefono, a.Nit, a.Cliente, a.Direccion, a.Fecha, a.Tipo, a.Total, a.Usuario FROM ventas a where a.Factura= :seyscom";
$resultado=$db->prepare($query);
	
$pdf = new PDF('P', 'mm', 'letter', true);
    $mediacarta=array(311,396);
	$pdf->AddPage('L',array(150,218)); //Vertical, Carta
    $pdf->SetFont('Arial','B',12); //Arial, negrita, 12 puntos
    $resultado->bindParam(":seyscom",$fac);
    $resultado->execute();

if ($resultado->rowcount()>=1){
    $row=$resultado->fetch();
		$factura=$row['Factura'];
		$nit=$row['Nit'];
		$cliente=utf8_decode($row['Cliente']);
		$direccion=utf8_decode($row['Direccion']);
		$fecha=$row['Fecha'];
		$telefono=$row['Telefono'];
		$tipo=utf8_decode($row['Tipo']);
		$total=$row['Total'];
		$usuario=utf8_decode($row['Usuario']);
		//$comentario=utf8_decode($row['comentario']);
	}
	if($telefono==0){
	    $telefono="";
	}
$queryy = "SELECT a.factura as factura, a.factura, a.codigo, a.producto, a.presentacion, a.precio, a.cantidad, a.descuento, a.total, a.fecha, a.id FROM detalle_ventas a where a.factura= :seyscomm order by a.id";
$resultadoo=$db->prepare($queryy);
    
$ddias=array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
$ddia=$ddias[date('w', strtotime($fecha))];
$nnum=date('j', strtotime($fecha));
$aanno=date('Y', strtotime($fecha));
$mmes=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
$mmes=$mmes[(date('m', strtotime($fecha))* 1)-1];
$ffecenletras=$ddia .' ' .$nnum .'/' .$mmes .'/' .$aanno;	
$totalletras=num2letras($total);

$pdf->SetFont('Arial','',7);	
$pdf->Image('imagenes/surtimax.png', 20, 8, 20, "JPG", "" ); //margen izquierdo, interlineado, tamaño de imagen
$pdf->SetFont('Arial','',7);
    
    $pdf->SetFont('Arial','B',11);	
    $pdf->Cell(210,4,utf8_decode('ENVIOS DE BODEGA'),0,0,'C');
    
    
        $pdf->SetFont('Arial','B',9);	
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,2,utf8_decode('PBX:  - Móvil: '),0,0,'C',0);
    $pdf->SetFont('Arial','B',9);
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,0,utf8_decode(''),0,0,'C',0);
        $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(105,5, '');//ESPACIO
    $pdf->Cell(210,4,utf8_decode(''),0,0,'C',0);
	$pdf->SetY(13);

	
    $pdf->SetFont('Arial','',9);	
    $pdf->SetX(155);
    $pdf->Cell(50,6,utf8_decode('Le atendió:  '.$usuario),1,0,'C');
	$pdf->MultiCell(105,12, '');//ESPACIO
	$pdf->SetY(30);
    $pdf->SetX(10);
    $pdf->Cell(20,5,'Fecha:',0,0,'L');
	$pdf->SetX(30);
	$pdf->Cell(10,5,$ffecenletras,0,0,'L');
	$pdf->SetX(65);
	$pdf->Cell(25,5,'No. envio: ',0,0,'L');
	$pdf->SetX(87);
	$pdf->Cell(25,5,$factura,0,0,'L');
    if ($tipo=='Efectivo'){
        $pdf->Cell(95,5,'[Efectivo]',0,1,'R');
    }else{
        $pdf->Cell(95,5,utf8_decode('[Crédito]'),0,1,'R');
    }
	$pdf->SetX(10);
    $pdf->Cell(20,5,'Nit:',0,0,'L');
	$pdf->SetX(30);
	$pdf->Cell(10,5,$nit,0,0,'L');
	$pdf->SetX(65);
	$pdf->Cell(25,5,'Cliente: ',0,0,'L');
	$pdf->SetX(87);
	$pdf->Cell(25,5,utf8_decode($cliente),0,0,'L');
	$pdf->SetX(125);
	$pdf->Cell(25,5,utf8_decode('Teléfono: '),0,0,'L');
	$pdf->SetX(140);
	$pdf->Cell(25,5,$telefono,0,1,'L');
	
	$pdf->Cell(20,5,utf8_decode('Dirección:'));
	$pdf->MultiCell(85,5,utf8_decode($direccion));
	$pdf->MultiCell(105,2, '');//ESPACIO
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',9);
	$pdf->Cell(15,5,'CANT.',1,0,'C');
	$pdf->Cell(125,5,'PRODUCTO',1,0,'C');
	$pdf->Cell(25,5,'PRECIO U.',1,0,'C');
	$pdf->Cell(30,5,'SUBTOTAL',1,1,'C');
	$resultadoo->bindParam(":seyscomm",$fac);
    $resultadoo->execute();
			
			$totales=0.00;
			$totales2=0.00;
			$totales3=0.00;
			$totales4=0.00;
			$metrosplus=0.00;
			 $numero=0;
			 			$totdesc=0.00;
			$totalb=0.00;
	foreach ($resultadoo as $key =>$roww){
    
    
      
$revisainventario = "Select descuento, preciocosto, codigo, preciod from inventario where codigo= :iddda";
        $resultadorevisa2=$db->prepare($revisainventario);
        $resultadorevisa2->bindParam(":iddda",$roww['codigo']);
        $resultadorevisa2->execute();	
        foreach ($resultadorevisa2 as $key =>$ra2){
        $descuentoinventario=$ra2['preciocosto'];
        $preciob=$ra2['preciod'];
        }
        
		$ffactura=$roww['factura'];
		$codigo=$roww['codigo'];
		$producto=$roww['producto'];
		//$tipo=$roww['tipo'];
		$presentacion=utf8_decode($roww['presentacion']);
		$precio=$roww['precio'];
		$cantidad=$roww['cantidad'];
		$descuento=$roww['descuento'];
		$ttotal=$roww['total'];
		$ffecha=$roww['fecha'];
		$id=$roww['id'];
		//$metros=$roww['metros'];
		
		
				
		$totdesc+=(($preciob-$precio)*$cantidad);
		$totalb+=$preciob*$cantidad;
		
		$metros=$metros*$cantidad;
		$metrosplus=$metros+$metrosplus;
		
		  $numero+=1;
	   	$pdf->SetFont('Arial','',9);			
    	if ($numero%2==0){
    	$pdf->SetFillColor(255, 255, 252);    
		$pdf->Cell(15,5,utf8_decode($cantidad),0,0,'C',1);
		$pdf->SetX(150);
		$pdf->Cell(25,5,utf8_decode ("Q.".number_format($preciob,2,".",",")),0,0,'R',1);	
		$pdf->SetX(175);
		$pdf->Cell(30,5,utf8_decode ("Q.".number_format($preciob*$cantidad,2,".",",")),0,0,'R',1);	
		$pdf->SetX(25);
		$pdf->MultiCell(125,5,utf8_decode ($producto),0,1,'FJ',1);
		}else{
    	$pdf->SetFillColor(235, 237, 238);    
		$pdf->Cell(15,5,utf8_decode($cantidad),0,0,'C',1);
		$pdf->SetX(150);
		$pdf->Cell(25,5,utf8_decode ("Q.".number_format($preciob,2,".",",")),0,0,'R',1);	
		$pdf->SetX(175);
		$pdf->Cell(30,5,utf8_decode ("Q.".number_format($preciob*$cantidad,2,".",",")),0,0,'R',1);	
		$pdf->SetX(25);
		$pdf->MultiCell(125,5,utf8_decode ($producto),0,1,'FJ',1);   
	   	}
	}
	$pdf->SetFont('Arial','',9);
	$pdf->SetX(100);
	$pdf->SetX(125);
	$pdf->SetFont('Arial','B',9);
	$pdf->SetY(119);
	$pdf->Cell(195,2,utf8_decode ("Subtotal:      Q".number_format($totalb,2,".",",")),0,0,'R');
	$pdf->SetY(123);
// 	$pdf->Cell(195,2,utf8_decode ("Descuento:    Q".number_format($totdesc,2,".",",")),0,0,'R');
	$pdf->SetY(127);
	$pdf->Cell(195,2,utf8_decode ("Total pedido:   Q".number_format($total,2,".",",")),0,0,'R');
	$pdf->MultiCell(105,1, '');//ESPACIO
ob_start(); 

$pdf->Output();
?>	