<?php

    namespace Controllers;    

    require('libs/FPDF/fpdf.php');
    use libs\FPDF\FPDF as FPDF;

    use Controllers\ReservationController as ReservationController;  

    class PDFController extends FPDF {
        
        function Header() {
            // Logo
            // $this->Image('logo_pb.png',10,8,33);            
            $this->SetFont('Arial','B',14);            
            $this->Cell(276, 5, 'Lista de reservas', 0, 0, 'C');
            $this->Ln();
            $this->setFont('Times', '', 12);
            $this->Cell(276,10,'Street address of employee office', 0, 0, 'C');
            $this->Ln(20);
        }
                
        function Footer() {            
            $this->SetY(-15);            
            $this->SetFont('Arial', '', 8);            
            $this->Cell(0, 10, 'Pag '.$this->PageNo().'/{nb}',0,0,'C');
        }

        function headerTable() {
            $this->setFont('Times', 'B', 12);
            $this->Cell(20, 10, 'Nº Carpa', 1, 0, 'C');
            $this->Cell(40, 10, 'Cliente', 1, 0, 'C');
            $this->Cell(40, 10, 'Periodo', 1, 0, 'C');
            $this->Cell(60, 10, 'Cochera Cubierta', 1, 0, 'C');
            $this->Cell(36, 10, 'Age', 1, 0, 'C');
            $this->Cell(30, 10, 'Start date', 1, 0, 'C');
            $this->Cell(50, 10, 'Salary', 1, 0, 'C');
            $this->Ln();
        }

        function viewTable($rsvList) {
            $this->setFont('Times', '', 12);
            
            foreach ($rsvList as $rsv) {
                $this->Cell(20, 10, $rsv->getBeachTent()->getNumber(), 1, 0, 'C');
                $this->Cell(40, 10, $rsv->getClient()->getLastName() . " " . $rsv->getClient()->getName(), 1, 0, 'L');
                $this->Cell(40, 10, $rsv->getStay(), 1, 0, 'L');
                $this->Cell(60, 10, $rsv->getBeachTent()->getNumber(), 1, 0, 'L');
                $this->Cell(36, 10, $rsv->getDateStart(), 1, 0, 'L');
                $this->Cell(30, 10, 'text', 1, 0, 'L');
                $this->Cell(50, 10, 'text', 1, 0, 'L');
                $this->Ln();
            }
        }
    }

    $reservationController = new ReservationController();
    $rsvList = $reservationController->getAllReservations();

    $pdf = new PDFController();    
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4', '');
    $pdf->headerTable();
    $pdf->viewTable($rsvList);        
    $pdf->Output();

?>