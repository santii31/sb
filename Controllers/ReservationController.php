<?php

    namespace Controllers;    
    
    use Models\Reservation as Reservation;
    use Models\Admin as Admin;
    use Models\Client as Client;
    use Models\BeachTent as BeachTent;
    use Models\Parking as Parking;
	use DAO\ReservationDAO as ReservationDAO;
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientController as ClientController;
    
    class ReservationController {

        private $reservationDAO;
        private $adminController;
        private $clientController;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();
            $this->clientController = new ClientController();
            $this->adminController = new AdminController();
        }               

        private function add($date_start, $date_end, $total_price, Client $client, BeachTent $beach_tent, Parking $parking) {
            
            $reservation = new Reservation();            
            $reservation->setDateStart($date_start);
            $reservation->setDateEnd($date_end);
            $reservation->setPrice($total_price);
            $reservation->setClient($client);
            $reservation->setBeachTent($beach_tent);
            $reservation->setParking($parking);  
            
            $register_by = $this->adminController->isLogged();

            if ($this->reservationDAO->add($reservation, $register_by)) {
                return true;
            } else {
                return false;
            }
        }     

        public function addReservation($date_start, $date_end, $total_price, Client $client, BeachTent $beach_tent, Parking $parking) {
            if ($this->isFormRegisterNotEmpty($beach_tent, $client, $date_start, $date_end, $total_price, $parking, $additional_service)) {
                
                $reservationTemp = new Reservation();
                $reservationTemp->set($);                
                
                if ($this->reservationDAO->getBy($reservationTemp) == null) {                                                            
                    if ($this->add($beach_tent, $client, $date_start, $date_end, $total_price, $parking, $additional_service)) {            
                        return $this->addReservationPath(null, RESERVATION_ADDED);
                    } else {                        
                        return $this->addReservationPath(DB_ERROR, null);        
                    }
                }                
                return $this->addReservationPath(RESERVATION_ERROR, null);
            }            
            return $this->addReservationPath(EMPTY_FIELDS, null);            
        }

       private function isFormRegisterNotEmpty($date_start, $date_end, $total_price, Client $client, BeachTent $beach_tent, Parking $parking) {
            if (empty($beach_tent) || 
                empty($client) || 
                empty($date_start) || 
                empty($date_end) || 
                empty($total_price) || 
                empty($parking) || 
                empty($additional_service)) {
                    return false;
            }
            return true;
        } 
        
        public function addReservationPath($alert = "", $success = "") { //LE FALTA
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir reserva";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-reservation.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listReservationPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Reservas";
                $reservation = $this->reservationDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-resevation.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }        

        public function enable($id) {
            if ($reservation = $this->reservationController->isLogged()) {
                $reservation = new Reservation();
                $reservation->setId($id);
                if ($this->reservationDAO->enableById($reservation, $admin)) {
                    return $this->listReservationPath(null, RESERVATION_ENABLE);
                } else {
                    return $this->listReservationPath(DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $reservation = new Reservation();
                $reservation->setId($id);
                if ($this->reservationDAO->disableById($reservation, $admin)) {
                    return $this->listReservationPath(null, RESERVATION_DISABLE);
                } else {
                    return $this->listReservationPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }       

        public function updatePath($id_reservation, $alert = "") {
            if ($reservation = $this->reservationController->isLogged()) {      
                $title = "Modificar informacion";       
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reservation);                
                $reservation = $this->reservationDAO->getById($reservationTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-reservation.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function update($date_start, $date_end, $total_price, Client $client,BeachTent $beach_tent,Parking $parking) {      
            
            if ($this->isFormRegisterNotEmpty($date_start, $date_end, $total_price, $client, $beach_tent, $parking)) {     
                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id);                
                $reservationTemp->setDateStart($date_start);

				if ($this->reservationDAO->checkDateStart($reservationTemp) == null) {                                                           
                    
                    $reservation = new Reservation();            
                    $reservation->setDateStart($date_start);
                    $reservation->setDateEnd($date_end);
                    $reservation->setPrice($total_price);
                    $reservation->setClient($client);
                    $reservation->setBeachTent($beach_tent);
                    $reservation->setParking($parking);  
                    
                    $update_by = $this->adminController->isLogged();


                    if ($this->reservationDAO->update($reservation, $update_by)) {                                                
                        return $this->listReservationPath(null, RESERVATION_UPDATE);
                    } else {                        
                        return $this->listReservationPath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, EMAIL_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }

    }

        
?>