<?php 

require('../fpdf/fpdf.php');
header('Content-Type: text/html; charset=UTF-8');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Times','B',20);
        $this->Image('img/triangulosrecortados.png',0,10,50);
        $this->setXY(60,15);
        $this->Cell(150,8,'Reporte de Acceso portal web',0,1,'C',0);
        $this->Ln(20); // Espacio debajo del encabezado
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','B',10);
        $this->Cell(170,10,'Todos los derechos reservados',0,0,'C',0);
        $this->Cell(25,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación del objeto PDF
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(10,10,10);
$pdf->SetAutoPageBreak(true,20);
$pdf->SetFont('Helvetica','B',12);

$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(10,8,'N',1,0,'C',1);
$pdf->Cell(20,8,'Fecha',1,0,'C',1);
$pdf->Cell(20,8,'Hora',1,0,'C',1);
$pdf->Cell(230,8,utf8_decode('Descripción'),1,1,'C',1);

// Leer archivo            
$ruta = 'C:/laragon/www/READLOG/Media/login_attempts.log';
if (file_exists($ruta)) {
    $lineas = file($ruta);
    
    $pdf->SetFont('Arial','',10);
    $contador = 1; // Para numerar las filas
    
    foreach ($lineas as $linea) {
        $fecha = substr($linea, 0, 10);//formato ingles 2022-01-01
        $fechaSegmentada = explode("-", $fecha);
        $fecha = $fechaSegmentada[2]."-".$fechaSegmentada[1]."-".$fechaSegmentada[0];
        $hora = substr($linea, 11, 8);
        $msg = substr($linea, 21);

        // Evitar desbordamiento de texto en la celda de descripción
        $msg = utf8_encode(trim($msg)); // Evitar errores de codificación
        
        $pdf->Cell(10,8,$contador,1,0,'C');
        $pdf->Cell(20,8,$fecha,1,0,'C');
        $pdf->Cell(20,8,$hora,1,0,'C');
        $pdf->Cell(230,8,utf8_decode($msg),1,1,'L'); 
        
        $contador++;
    }
} else {
    $pdf->Cell(280,8,utf8_decode('Error: No se encontró el archivo de logs.'),1,1,'C');
}

// Agregar nueva página para productos.log
$pdf->AddPage();
$pdf->SetFont('Helvetica','B',12);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(10,8,'N',1,0,'C',1);
$pdf->Cell(20,8,'Fecha',1,0,'C',1);
$pdf->Cell(20,8,'Hora',1,0,'C',1);
$pdf->Cell(230,8,utf8_decode('Descripción'),1,1,'C',1);

if (isset($_GET['productos'])) {
    $productos_data = json_decode(urldecode($_GET['productos']), true);
    if (!empty($productos_data)) {
        $pdf->SetFont('Arial','',10);
        $contador = 1; // Para numerar las filas
        foreach ($productos_data as $producto) {
            // Suponiendo que cada línea del archivo productos.log tiene el formato: "YYYY-MM-DD HH:MM:SS Descripción"
            $fecha = substr($producto, 0, 10);
            $hora = substr($producto, 11, 8);
            $msg = substr($producto, 20);

            $pdf->Cell(10,8,$contador,1,0,'C');
            $pdf->Cell(20,8,$fecha,1,0,'C');
            $pdf->Cell(20,8,$hora,1,0,'C');
            $pdf->Cell(230,8,utf8_decode($msg),1,1,'L');

            $contador++;
        }
    } else {
        $pdf->Cell(280,8,utf8_decode('No hay datos de productos.'),1,1,'C');
    }
} else {
    $pdf->Cell(280,8,utf8_decode('No se recibieron datos de productos.'),1,1,'C');
}

// Generar el PDF
$pdf->Output();
?>
