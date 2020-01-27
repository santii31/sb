<?php

    namespace Controllers;    
    
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\ServicexParking as ServicexParking;
    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxParking as ReservationxParking;
    use Models\ReservationxService as ReservationxService;
    use DAO\ParkingDAO as ParkingDAO;    
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ReservationxParkingDAO as ReservationxParkingDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use Controllers\AdminController as AdminController;  
    use Controllers\ReservationController as ReservationController;  
    use Controllers\AdditionalServiceController as AdditionalServiceController;  

    class ParkingController {

        private $parkingDAO;
        private $reservationxParkingDAO;
        private $additionalServiceDAO;
        private $reservationxserviceDAO;
        private $servicexparkingDAO;
        private $adminController;
        private $reservationController;
        private $additionalController;
        private $reservationDAO;

        public function __construct() {
            $this->parkingDAO = new ParkingDAO();
            $this->reservationxParkingDAO = new ReservationxParkingDAO();
            $this->additionalServiceDAO = new AdditionalServiceDAO();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->servicexparkingDAO = new ServicexParkingDAO();
            $this->adminController = new AdminController();
            $this->reservationDAO = new ReservationDAO();
        }        


        public function parkingMap($id_reservation = null, $price = null, $alert = "") {
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

        private function checkInterval($date_start, $date_end, $id_parking) {
            $parking = new Parking();
            $parking->setId($id_parking);
			$existance = $this->reservationxParkingDAO->getAllByParkingId($parking);			
			$flag = 1;
			if ($existance != null) {                
				foreach ($existance as $reserve) {                       
					if ( ($date_end < $reserve->getReservation()->getDateStart()) xor ($date_start > $reserve->getReservation()->getDateEnd())) {
						$flag *= 1;	
					} else {
						$flag *= 0;
                    }                    
				}
            }
            return $flag;
        }
        
        public function addPrice($reservation, $id_parking, $alert = "", $success = ""){
            if ($admin = $this->adminController->isLogged()) {                
                $title = "Precio de cochera";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-parking-price.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }

        public function reserve($price, $reservation, $id_parking) {
            
            if ($serv = $this->reservationxserviceDAO->getServiceByReservation($reservation) != false) {
                
                $parking = new Parking();
                $parking->setId($id_parking);
                $reservationByParking = $this->reservationxParkingDAO->getAllByParkingId($parking);
                
                if ($reservationByParking == null) {
                                        
                    $reservationTemp = new Reservation();
                    $reservationTemp->setId($reservation);

                    $reservationxParking = new ReservationxParking();
                    
                    if ($reservationAux = $this->reservationDAO->getById($reservationTemp)) {
                    
                        $reservationxParking->setReservation($reservationTemp);
                        $reservationxParking->setParking($parking);
                        
                        if ($this->reservationxParkingDAO->add($reservationxParking)) {                    
                            
                            $register_by = $this->adminController->isLogged();
                            $additionalService = new AdditionalService();
                            $reservationxservice = new ReservationxService();
                            $servicexparking = new ServicexParking();                        
                            $additionalService->setTotal($price);
                            $reservationAux->setPrice($reservationAux->getPrice() + $price);
                            
                            if ($lastId = $this->additionalServiceDAO->add($additionalService, $register_by)) {

                                $reservationxservice->setIdReservation($reservation);
                                $reservationxservice->setIdService($lastId);
                                $this->reservationxserviceDAO->add($reservationxservice);
    
                                if ($this->reservationDAO->update($reservationAux, $register_by)) {

                                    $servicexparking->setIdService($lastId);
                                    $servicexparking->setIdParking($parking->getId());
                                    if ($this->servicexparkingDAO->add($servicexparking)) {

                                        $this->additionalController = new AdditionalServiceController();
                                        return $this->additionalController->hasAdditionalService($reservation, null, null);                       
                                    }        
                                }    
                            }
                        } 
                    }                                  
                    return $this->parkingMap($reservation, $price, DB_ERROR);

                } else {            

                    $this->reservationController = new ReservationController();
                    $reserve = $this->reservationController->getById($reservation);

                    if ($this->checkInterval($reserve->getDateStart(), $reserve->getDateEnd(), $id_parking)) {

                        $reservationTemp = new Reservation();
                        $reservationTemp->setId($reservation);
                        $register_by = $this->adminController->isLogged();
        
                        $reservationxParking = new ReservationxParking();
                        
                        if ($reservationAux = $this->reservationDAO->getById($reservationTemp)) {
                        
                            $reservationxParking->setReservation($reservationTemp);
                            $reservationxParking->setParking($parking);

                            if ($this->reservationxParkingDAO->add($reservationxParking)) {    
                                
                                $register_by = $this->adminController->isLogged();
                                $additionalService = new AdditionalService();
                                $reservationxservice = new ReservationxService();
                                $servicexparking = new ServicexParking();                            
                                $additionalService->setTotal($price);
                                $reservationAux->setPrice($reservationAux->getPrice() + $price);
                                
                                if ($lastId = $this->additionalServiceDAO->add($additionalService, $register_by)) {

                                    $reservationxservice->setIdReservation($reservation);
                                    $reservationxservice->setIdService($lastId);
                                    if ($this->reservationxserviceDAO->add($reservationxservice)) {

                                        if ($this->reservationDAO->update($reservationAux ,$register_by)) {

                                            $servicexparking->setIdService($lastId);
                                            $servicexparking->setIdParking($parking->getId());
                                            
                                            if ($this->servicexparkingDAO->add($servicexparking)) {

                                                $this->additionalController = new AdditionalServiceController();
                                                return $this->additionalController->hasAdditionalService($reservation, null, null);               

                                            }                                            
                                        }        
                                    }                                    
                                }
                            }
                        }                        
                        return $this->parkingMap($reservation, $price, DB_ERROR);

                    } else {                                 
                        return $this->parkingMap($reservation, PARKING_ERROR);
                    }                
                }

            } else {

                if ($serv = $this->reservationxserviceDAO->getServiceByReservation($reservation)) {

                    $parking = new Parking();
                    $parking->setId($id_parking);
                    $reservationByParking = $this->reservationxParkingDAO->getAllByParkingId($parking);                                
    
                    if ($reservationByParking == null) {
                        
                        $reservationTemp = new Reservation();
                        $reservationTemp->setId($reservation);
    
                        if ($reservationAux = $this->reservationDAO->getById($reservationTemp)) {
    
                            $reservationxParking = new ReservationxParking();
                            $reservationxParking->setReservation($reservationTemp);
                            $reservationxParking->setParking($parking);
        
                            if ($this->reservationxParkingDAO->add($reservationxParking)) {                    
                                                                        
                                $update_by = $this->adminController->isLogged();
                                $reservationxservice = new ReservationxService();
                                $servicexparking = new ServicexParking();
                                $serv->setTotal($serv->getTotal() + $price);
                                $reservationAux->setPrice($reservationAux->getPrice() + $price);
        
                                if ($this->additionalServiceDAO->update($serv, $update_by)) {
    
                                    $reservationxservice->setIdReservation($reservation);
                                    $reservationxservice->setIdService($serv->getId());
    
                                    if ($this->reservationxserviceDAO->add($reservationxservice)) {
    
                                        if ($this->reservationDAO->update($reservationAux, $update_by)) {
    
                                            $servicexparking->setIdService($serv->getId());
                                            $servicexparking->setIdParking($parking->getId());
                                            
                                            if ($this->servicexparkingDAO->add($servicexparking)) {
    
                                                $this->additionalController = new AdditionalServiceController();
                                                return $this->additionalController->hasAdditionalService($reservation, null, null);                   
                                            }                                        
                                        }                                    
                                    }        
                                }
                            }
                        }
                        return $this->parkingMap($reservation, $price, DB_ERROR);
    
                    } else {            
    
                        $this->reservationController = new ReservationController();
    
                        if ($reserve = $this->reservationController->getById($reservation)) {
    
                            if ($this->checkInterval($reserve->getDateStart(), $reserve->getDateEnd(), $id_parking)) {
        
                                $reservationTemp = new Reservation();
                                $reservationTemp->setId($reservation);
                                $register_by = $this->adminController->isLogged();
                
                                $reservationxParking = new ReservationxParking();
                                $reservationxParking->setReservation($reservationTemp);
                                
                                $reservationAux = $this->reservationDAO->getById($reservationTemp);
                                $reservationxParking->setParking($parking);
        
                                if ($this->reservationxParkingDAO->add($reservationxParking)) {    
                                      
                                    $register_by = $this->adminController->isLogged();
                                    $reservationxservice = new ReservationxService();
                                    $servicexparking = new ServicexParking();
                                    $serv->setTotal($serv->getTotal() + $price);
                                    $reservationAux->setPrice($reservationAux->getPrice() + $price);
                                    
                                    if ($this->additionalServiceDAO->update($serv, $update_by)) {
    
                                        $reservationxservice->setIdReservation($reservation);
                                        $reservationxservice->setIdService($serv->getId());
            
                                        if ($this->reservationDAO->update($reservationAux, $update_by)) {
    
                                            if ($this->reservationxserviceDAO->add($reservationxservice)) {
    
                                                $servicexparking->setIdService($serv->getId());
                                                $servicexparking->setIdParking($parking->getId());
    
                                                if ($this->servicexparkingDAO->add($servicexparking)) {
                                                    
                                                    $this->additionalController = new AdditionalServiceController();
                                                    return $this->additionalController->hasAdditionalService($reservation, null, null);           
                                                }                                            
                                            }
                                        }        
                                    }
                                }
                                return $this->parkingMap($reservation, $price, DB_ERROR);
    
                            } else {                                 
                                return $this->parkingMap($reservation, $price, PARKING_ERROR);
                            }                
                        }
                    }
                }
            }            
            return $this->parkingMap($reservation, $price, DB_ERROR);
        }


        public function hasReservation($id_parking) {     
            $parking = new Parking();
            $parking->setId($id_parking);
            $reserveList = $this->reservationxParkingDAO->getAllByParkingId($parking);

            if ($reserveList != null) {
                return sizeof($reserveList);
            }
            
            return false;
        }

        public function reservationToday($id_parking) {
            $this->reservationController = new ReservationController();
            $parking = new Parking();
            $parking->setId($id_parking);
            $reserveList = $this->reservationxParkingDAO->getAllByParkingId($parking);   
            
            if ($reserveList != null) {
                foreach ($reserveList as $reserve) {
                    if ($reservation = $this->reservationController->checkIsDateReserved($reserve->getReservation())) {                    
                        return $reservation;
                    }
                }
            }

            return false;
        }

        public function hasFutureReservation($id_parking) {            
            $parking = new Parking();
            $parking->setId($id_parking);
            $futureReserve = array();
            $reserveList = $this->reservationxParkingDAO->getAllByParkingId($parking);            
            $today = date("Y-m-d");
            $dateToCompare = strtotime( $today );
            
            if ($reserveList != null) {
                foreach ($reserveList as $reserve) {                
                    $reserveDateStart = strtotime($reserve->getReservation()->getDateStart());
                    if ($reserveDateStart > $dateToCompare) {
                        array_push($futureReserve, $reserve);
                    }                
                }
            }

            return $futureReserve;
        }

        
    }
    
?>
