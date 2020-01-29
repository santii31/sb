<?php

    namespace Controllers;    

    require('libs/FPDF/fpdf.php');
    use libs\FPDF\FPDF as FPDF;

    use Controllers\ReservationController as ReservationController;  

    class PDFController extends FPDF {
        
        function Header()
        {
            // Logo
            // $this->Image('logo_pb.png',10,8,33);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Movernos a la derecha
            $this->Cell(80);
            // Título
            $this->Cell(30,10,'Title',1,0,'C');
            // Salto de línea
            $this->Ln(20);
        }
        
        // Pie de página
        function Footer()
        {
            // Posición: a 1,5 cm del final
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Número de página
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
    }

    $reservationController = new ReservationController();
    $rsvList = $reservationController->getAllReservations();

    $pdf = new PDFController();    
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 16);

    foreach ($rsvList as $reserve) {
        $pdf->Cell(80, 10, $reserve->getClient()->getName() . " " . $reserve->getClient()->getLastName(), 1, 0, "C", 0);
        $pdf->Cell(40, 10, $reserve->getDateStart(), 1, 0, "C", 0);
        $pdf->Cell(40, 10, $reserve->getDateEnd(), 1, 0, "C", 0);
        $pdf->Cell(30, 10, $reserve->getBeachTent()->getNumber(), 1, 1, "C", 0);    
    }    

    $pdf->Output();

?>