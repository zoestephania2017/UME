
<?php

class PDF extends FPDF {

    // Cabecera de página
    function Header() {
        $this->SetFont('Times', 'B', 20); // tipo de letra, negrita, tamaño
        //$this->Image('views/assets/img/logo.png', 10, 16, 30); //posicion de la imagen x, y z
        $this->Image('views/assets/img/logoclinica.jpg', 160, 3, 50); //posicion de la imagen x, y z
        $this->SetXY(65, 20); //x, y posicion del titulo
        $this->cell(0, 10, "Atenciones por Ambulancia", 0, 1); //ancho, largo, contenido,salto de linea
        $this->SetFont('Times', 'B', 12); // tipo de letra, negrita, tamaño
        $this->SetXY(10, 40); //x, y posicion del titulo
        $this->cell(0, 10, "Fecha Inicio: " . $_POST['inicio'], 0, 1); //ancho, largo, contenido,salto de linea
        $this->SetXY(10, 50); //x, y posicion del titulo
        $this->cell(0, 10, "Fecha Fin: " . $_POST['fin'], 0, 1); //ancho, largo, contenido,salto de linea
        $this->Ln(5); //saltos de linea de l que se va a imprimir
        $this->SetFont('Times', 'B', 12); // tipo de letra, negrita, tamaño
    }

    // Pie de página
    function Footer() {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Times', 'I', 10);
        $this->SetTextColor(0, 0, 0); // tipo de letra, negrita, tamaño   
        // Nota de Footer
        $this->SetX(60);
        $this->Cell(160, 10, utf8_decode("Todos los Derechos Reservados Unidad Médica de Emergencias"), 0, 0); //ancho, largo, contenido,salto de linea
        // Número de página
        $this->SetX(180);
        $this->Cell(25, 10, utf8_decode('Pagína') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFillColor(203, 203, 203); // RGB  
$pdf->SetDrawColor(61, 61, 61); // RGB  //COLOR DE BORDES
//Encabezados
$pdf->SetX(10); //ancho, largo, contenido,salto de linea
$pdf->Cell(10, 8, utf8_decode("N.º"), 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->Cell(36, 8, "Departamento", 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->Cell(36, 8, "Ciudad", 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->Cell(36, 8, utf8_decode("Punto Estratégico"), 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->Cell(36, 8, "Ambulancia", 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->Cell(36, 8, "Atenciones", 'B', 1, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color

$pdf->SetFillColor(233, 229, 235); // RGB  

$pdf->SetFont('Times', '', 12); // tipo de letra, negrita, tamaño   
$i = 1;
$total = 0;
while ($atencion = $atenciones->fetch_object()) {
    $departamento = substr(utf8_decode($atencion->departamento), 0, 22);
    $ciudad = substr(utf8_decode($atencion->ciudad), 0, 22);
    $punto = substr(utf8_decode($atencion->punto), 0, 22);
    $ambulancia = substr(utf8_decode($atencion->unidad), 0, 22);
    $pdf->SetX(10); //ancho, largo, contenido,salto de linea
    $pdf->Cell(10, 8, $i, 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $pdf->Cell(36, 8, $departamento, 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $pdf->Cell(36, 8, $ciudad, 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $pdf->Cell(36, 8, $punto, 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $pdf->Cell(36, 8, $ambulancia, 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $pdf->Cell(36, 8, $atencion->totales, 'B', 1, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
    $i++;
    $total += $atencion->totales;
}
//Encabezados
$pdf->SetFillColor(255, 0, 0); // RGB 
$pdf->SetX(10); //ancho, largo, contenido,salto de linea
$pdf->SetFont('Times', 'B', 12); // tipo de letra, negrita, tamaño
$pdf->SetTextColor(255, 255, 255); // tipo de letra, negrita, tamaño
$pdf->Cell(154, 8, "Total", 'B', 0, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
$pdf->SetTextColor(255, 255, 255); // tipo de letra, negrita, tamaño
$pdf->Cell(36, 8, $total, 'B', 1, 'C', 1); //ancho, largo, contenido,borde,salto de linea,alineado, color
ob_get_clean();
$pdf->Output('', 'ambulancia.pdf');
?>