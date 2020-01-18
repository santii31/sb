<?php

    namespace Controllers;    
    
    use Models\Admin as Admin;
    use Models\Client as Client;    
    use Models\BeachTent as BeachTent;
    use Models\Reservation as Reservation;        
    use DAO\ReservationDAO as ReservationDAO;    
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientController as ClientController;
    use Controllers\ParkingController as ParkingController;    
    
    class ReservationController {

        private $reservationDAO;
        private $adminController;
        private $clientController;          
        private $parkingController;
        private $reservationxserviceDAO;
        private $servicexlockerDAO;
        private $servicexparasolDAO;      

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();                                    
            $this->adminController = new AdminController();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexparasolDAO = new ServicexParasolDAO();
        }               


        // falta descuento
        private function add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2, $id_tent) {
                                            
            $this->clientController = new ClientController();                              
            
            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $l_name_s = filter_var($l_name, FILTER_SANITIZE_STRING);
            $addr_s = filter_var($addr, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);
            $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);            
            
            // esto es un string? preguntar
            // $fam_s = filter_var($fam, FILTER_SANITIZE_STRING);        
            
            $addrStayl_s = filter_var($addrStay, FILTER_SANITIZE_STRING);

            $client = new Client();
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($l_name_s) );
            $client->setAddress( strtolower($addr_s) );            
            $client->setCity( strtolower($city_s) );
            $client->setCp($cp);
            $client->setEmail($email_s);
            $client->setPhone($phone);
            $client->setFamilyGroup( strtolower($fam) );                
            $client->setStayAddress( strtolower($addrStayl_s) );
            $client->setPhoneStay($phone2);                            

            $register_by = $this->adminController->isLogged();

            if ($clientId = $this->clientController->addObj($client, $register_by)) {

                $client->setId($clientId);
                
                // $reservation->setPrice($beach_tent->getPrice() - $discount);
                $reservation = new Reservation();
                $reservation->setDateStart($start);
                $reservation->setDateEnd($end);            
                $reservation->setStay($stay);
                $reservation->setPrice(0);
                $reservation->setDiscount(0);
                
                $tent = new BeachTent();
                $tent->setId($id_tent);  

                $reservation->setBeachTent($tent);
                $reservation->setClient($client);

                return $this->reservationDAO->add($reservation, $register_by); 
            }
            return false;
        }

        public function addReservation($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2, $tent) { 

            if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                     $tent)) {
                
                if ($this->checkInterval($start, $end, $tent) == 1) {                                                                                
                    if ($lastId = $this->add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                             $tent)) {                                                    

                        $this->parkingController = new ParkingController();                    
                        return $this->parkingController->parkingMap($lastId);                                                

                    } else {                        
                        return $this->addReservationPath(null, DB_ERROR, null);        
                    }
                }                             
                return $this->addReservationPath(null, RESERVATION_ERROR, null);
            }            
            return $this->addReservationPath($tent, EMPTY_FIELDS, null);            
        }
        
        public function checkInterval($date_start, $date_end, $id_tent) {
			$existance = $this->getByIdTent($id_tent);			
			$flag = 1;
			if ($existance != null) {
				foreach ($existance as $reserve) {
					if ( ($date_end < $reserve->getDateStart()) xor ($date_start > $reserve->getDateEnd())  ) {
						$flag *= 1;	
					} else {
						$flag *= 0;
					}
				}
            }
            return $flag;
		}
			
        private function isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                         $tent) {
            if (empty($stay) || 
                empty($start) || 
                empty($end) || 
                empty($name) || 
                empty($l_name) ||                 
                empty($addr) || 
                empty($city) || 
                empty($cp) || 
                empty($email) || 
                empty($phone) || 
                empty($fam) || 
                empty($addrStay) || 
                empty($phone2) || 
                empty($tent)) {
                    return false;
            }
            return true;
        } 
        
        public function addReservationPath($id_tent = "", $alert = "", $success = "") { 
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Reserva - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-reserve.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listReservationPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Reservas";
                $reservations = $this->reservationDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-reservation.php");
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

        public function updatePath($id_reservation, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Reserva - Modificar informacion";       
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reservation);                
                $reservation = $this->reservationDAO->getById($reservationTemp);               
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-reserve.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        // aca
        public function update($id, $stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2, $tent) {    
            
            if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                     $tent)) {     
                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id);                
                $reservationTemp->setDateStart($date_start);

				if ($this->reservationDAO->checkDateStart($reservationTemp) == null) {                                                           
                    
                    $reservation = new Reservation();  
                    $reservation->setId($id);
                    $reservation->setDateStart($date_start);
                    $reservation->setDateEnd($date_end);
                    $reservation->setPrice($total_price);
                    $reservation->setClient($client);
                    $reservation->setBeachTent($beach_tent);
                    $reservation->setParking($parking);  
                    
                    $update_by = $this->adminController->isLogged();

                    if ($this->reservationDAO->update($reservation, $update_by)) {                                                
                        return $this->listReservationPath(null, null, RESERVATION_UPDATE);
                    } else {                        
                        return $this->listReservationPath(null, DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, EMAIL_ERROR, null);
            }            
            return $this->updatePath($id, EMPTY_FIELDS, null);
        }

        public function checkIsDateReserved(Reservation $reservation) {                        
            $today = date("Y-m-d");
            $dateStart = strtotime( $reservation->getDateStart() ) ;
            $dateEnd = strtotime( $reservation->getDateEnd() );
            $dateToCompare = strtotime( $today );

            if ($dateToCompare >= $dateStart && $dateToCompare <= $dateEnd) {
                $reservation->setIsReserved(true);                                   
                return $reservation;
            }            
            return false;
        }

        
        // 
        public function getByIdTent($id_tent) {
            $tent = new BeachTent();
            $tent->setId($id_tent);
            return $this->reservationDAO->getByIdTent($tent);
        }

        public function getById($id_reservation) {
            $reservation = new Reservation();
            $reservation->setId($id_reservation);
            return $this->reservationDAO->getById($reservation);
        }
    }


        
?>