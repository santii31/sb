<?php

    namespace Controllers;    

    require('libs/FPDF/fpdf.php');
    use libs\FPDF\FPDF as FPDF;

    use DAO\ReservationxParkingDAO as ReservationxParkingDAO;
    use Controllers\ReservationController as ReservationController;  

    class PDFController extends FPDF {
        
        function Header() {       
            $date = getdate();            
            $today = date("d-m-Y");
            $title = 'PLANO DE TEMPORADA ' . $date["year"] . ' - FECHA DE MODIFICACION ' . $today;                        
            $this->setFont('Times', '', 16);
            $this->Cell(276, 10, $title, 0, 0, 'C');
            $this->Ln(20);
        }
                
        function Footer() {            
            $this->SetY(-15);            
            $this->SetFont('Arial', '', 8);            
            $this->Cell(0, 10, 'Pag '.$this->PageNo().'/{nb}',0,0,'C');
        }

        function headerTable() {
            $this->setFont('Times', 'B', 12);
            $this->Cell(40, 10, utf8_decode('Nº CARPA'), 1, 0, 'C');
            $this->setFillColor(5,230,230); 
            $this->Cell(80, 10, 'CLIENTE', 1, 0, 'C');
            $this->Cell(80, 10, 'PERIODO', 1, 0, 'C');
            $this->Cell(80, 10, 'COCHERA', 1, 0, 'C');            
            $this->Ln();
            $this->Cell(40, 10, '', 1, 0, 'C');
            $this->Cell(80, 10, '', 1, 0, 'C');
            $this->Cell(80, 10, '', 1, 0, 'C');
            $this->Cell(40, 10, 'CANTIDAD', 1, 0, 'C');
            $this->Cell(40, 10, 'NUMERO', 1, 0, 'C');
            $this->Ln();
        }

        function viewTable($controller, $rsvList) {
            $this->setFont('Times', '', 12);    

            foreach ($rsvList as $rsv) {
                $client = strtoupper( $rsv->getClient()->getLastName() . " " . $rsv->getClient()->getName() );
                $stay = strtoupper( str_replace('_', ' ', $rsv->getStay()) );
                $quantity = $controller->getSizeNumberParkingByReservation($rsv); 
                $numbers = $controller->getNumberParkingByReservation($rsv);
                
                $this->Cell(40, 10, $rsv->getBeachTent()->getNumber(), 1, 0, 'C');
                $this->Cell(80, 10, $client, 1, 0, 'C');
                $this->Cell(80, 10, $stay, 1, 0, 'C');
                $this->Cell(40, 10, $quantity, 1, 0, 'C');
                $this->Cell(40, 10, $numbers, 1, 0, 'C');                           
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
    $pdf->viewTable($reservationController, $rsvList);        
    $pdf->Output();

?>