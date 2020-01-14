<?php

    namespace Controllers;    
    
    use Models\Admin as Admin;
    use Models\Client as Client;    
    use Models\BeachTent as BeachTent;
    use Models\Reservation as Reservation;        
    use DAO\ReservationDAO as ReservationDAO;    
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientController as ClientController;
    use Controllers\ParkingController as ParkingController;    
    
    class ReservationController {

        private $reservationDAO;
        private $adminController;
        private $clientController;          
        private $parkingController;      

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();                                    
            $this->adminController = new AdminController();
        }               


        // falta descuento
        private function add($date_start, $date_end, $name, $lastname, $estadia, $address, $city, $cp, $email, 
                             $tel1, $groupF, $addressEsta, $tel2, $beach_tent) {
                                            
            $this->clientController = new ClientController();
            
            $reservation = new Reservation();
            $reservation->setDateStart($date_start);
            $reservation->setDateEnd($date_end);            
            
            $tent = new BeachTent();
            $tent->setId($beach_tent);                        
            
            $client = new Client();
            $client->setName($name);
            $client->setLastName($lastname);
            $client->setAddress($address);
            $client->setStay("test");
            $client->setCity($city);
            $client->setCp($cp);
            $client->setEmail($email);
            $client->setPhone($tel1);
            $client->setFamilyGroup($groupF);
            $client->setStayAddress($addressEsta);
            $client->setPhoneStay($tel2);                            

            $register_by = $this->adminController->isLogged();

            if ($clientId = $this->clientController->addObj($client, $register_by)) {

                $client->setId($clientId);
                
                // $reservation->setPrice($beach_tent->getPrice() - $discount);
                $reservation->setPrice(0);
                $reservation->setDiscount(0);
                $reservation->setBeachTent($tent);
                $reservation->setClient($client);

                return $this->reservationDAO->add($reservation, $register_by); 
            }
            return false;
        }

        public function addReservation($start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2, $tent) { 

            if ($this->isFormRegisterNotEmpty($start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                     $tent)) {
                
                if ($this->checkInterval($start, $end, $tent) == 1) {                                                                                
                    if ($lastId = $this->add($start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                             $tent)) {                                                    

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
			
        private function isFormRegisterNotEmpty($start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                         $tent) {
            if (empty($start) || 
                empty($end) || 
                empty($name) || 
                empty($l_name) || 
                empty($stay) || 
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
                $title = "Reserva - Modificar informacion";       
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

        public function update($id, $start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2, $tent) {    
            
            if ($this->isFormRegisterNotEmpty($start, $end, $name, $l_name, $stay, $addr, $city, $cp, $email, $phone, $fam, $addrStay, $phone2,                                     $tent)) {     
                
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