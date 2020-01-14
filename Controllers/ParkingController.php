<?php

    namespace Controllers;    
    
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\ReservationxParking as ReservationxParking;
    use DAO\ParkingDAO as ParkingDAO;    
    use DAO\ReservationxParkingDAO as ReservationxParkingDAO;
    use Controllers\AdminController as AdminController;  
    use Controllers\ReservationController as ReservationController;  

    class ParkingController {

        private $parkingDAO;
        private $reservationxParkingDAO;
        private $adminController;
        private $reservationController;

        public function __construct() {
            $this->parkingDAO = new ParkingDAO();
            $this->reservationxParkingDAO = new ReservationxParkingDAO();
            $this->adminController = new AdminController();
        }        


        public function parkingMap($id_reservation = "") {
            if ($admin = $this->adminController->isLogged()) {
                
                $title = "Plano de cocheras";       
                
                // parkings
                $firstRow = $this->parkingDAO->getN_row(1);
                $secondRow = $this->parkingDAO->getN_row(2);
                $thirdRow = $this->parkingDAO->getN_row(3);
                $fourthRow = $this->parkingDAO->getN_row(4);
                $fifthRow = $this->parkingDAO->getN_row(5);
                $sixthRow = $this->parkingDAO->getN_row(6);
                $seventhRow = $this->parkingDAO->getN_row(7);
                $eighthRow = $this->parkingDAO->getN_row(8);
                $ninthhRow = $this->parkingDAO->getN_row(9);
                $tenthRow = $this->parkingDAO->getN_row(10);

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "parking.php");
                require_once(VIEWS_PATH . "footer.php"); 
                
            } else {
                return $this->adminController->userPath();
            }
        }

        public function checkInterval($date_start, $date_end, $id_parking) {
            $parking = new Parking();
            $parking->setId($id_parking);
			$existance = $this->reservationxParkingDAO->getAllByParkingId($parking);			
			$flag = 1;
			if ($existance != null) {                
				foreach ($existance as $reserve) {                       
					if ( ($date_end < $reserve->getReservation()->getDateStart()) xor ($date_start > $reserve->getReservation()->getDateEnd())  ) {
						$flag *= 1;	
					} else {
						$flag *= 0;
                    }                    
				}
            }
            return $flag;
		}

        public function reserve($reservation, $id_parking) {

            $parking = new Parking();
            $parking->setId($id_parking);
            $reservationByParking = $this->reservationxParkingDAO->getAllByParkingId($parking);
            
            if ($reservationByParking == null) {
                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($reservation);

                $reservationxParking = new ReservationxParking();
                $reservationxParking->setReservation($reservationTemp);
                $reservationxParking->setParking($parking);

                if ($this->reservationxParkingDAO->add($reservationxParking)) {
                    echo 'agregado exito';
                    return ;
                }

            } else {            

                $this->reservationController = new ReservationController();
                $reserve = $this->reservationController->getById($reservation);

                if ($this->checkInterval($reserve->getDateStart(), $reserve->getDateEnd(), $id_parking)) {

                    $reservationTemp = new Reservation();
                    $reservationTemp->setId($reservation);
    
                    $reservationxParking = new ReservationxParking();
                    $reservationxParking->setReservation($reservationTemp);
                    $reservationxParking->setParking($parking);

                    if ($this->reservationxParkingDAO->add($reservationxParking)) {
                        echo 'agregado exito';
                        return ;
                    }

                } else {
                    echo 'estacionamiento ocupado durante estas fechas';
                }                
            }

        }


        
    }
    
?>
