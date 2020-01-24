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
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\ConfigDAO as ConfigDAO;
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
        private $servicexparkingDAO;
        private $configDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();                                    
            $this->adminController = new AdminController();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexparasolDAO = new ServicexParasolDAO();
            $this->servicexparkingDAO = new ServicexParkingDAO();
            $this->configDAO = new ConfigDAO();
        }               


        // falta descuento
        private function add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $payment_method, $auxiliary_phone, $vehicle, $id_tent, $price) {                        

            $this->clientController = new ClientController();                              
            
            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $l_name_s = filter_var($l_name, FILTER_SANITIZE_STRING);
            $addr_s = filter_var($addr, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);
            $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);   
            $payment_method_s = filter_var($payment_method, FILTER_SANITIZE_EMAIL);    
            $vehicle_s = filter_var($vehicle, FILTER_SANITIZE_EMAIL);                                

            $client = new Client();
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($l_name_s) );
            $client->setAddress( strtolower($addr_s) );            
            $client->setCity( strtolower($city_s) );
            $client->setCp($cp);
            $client->setEmail($email_s);
            $client->setPhone($phone);
            $client->setFamilyGroup( strtolower($fam) );
            $client->setPaymentMethod( strtolower($payment_method_s) );
            $client->setAuxiliaryPhone($auxiliary_phone);
            $client->setVehicleType( strtolower($vehicle_s) );       

            $register_by = $this->adminController->isLogged();

            if ($clientId = $this->clientController->addObj($client, $register_by)) {

                $client->setId($clientId);
                                
                $reservation = new Reservation();
                $reservation->setDateStart($start);
                $reservation->setDateEnd($end);            
                $reservation->setStay($stay);
                $reservation->setPrice($price);
                $reservation->setDiscount(0);
                
                $tent = new BeachTent();
                $tent->setId($id_tent);  

                $reservation->setBeachTent($tent);
                $reservation->setClient($client);

                return $this->reservationDAO->add($reservation, $register_by); 
            }
            return false;
        }

        public function addReservation($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $payment_method, $auxiliary_phone, $vehicle, $tent, $price) { 

            // Saves the inputs in case of validation error
            $inputs = array(
                "start"=> $start, 
                "end"=> $end,
                "name"=> $name,
                "l_name"=> $l_name,
                "addr"=> $addr,
                "city"=> $city,
                "cp"=> $cp,
                "email"=> $email,
                "phone"=> $phone,
                "fam"=> $fam,
                "aux_phone"=> $auxiliary_phone,
                "price"=> $price
            );
            
            if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $payment_method, $auxiliary_phone, $vehicle, $tent, $price)) {
                
                if ($this->checkInterval($start, $end, $tent) == 1) {                                 

                    if ($lastId = $this->add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $payment_method, $auxiliary_phone, $vehicle, $tent, $price)) {                                                    

                        $this->parkingController = new ParkingController();                    
                        return $this->parkingController->parkingMap($lastId);                                                

                    } else {                        
                        return $this->addReservationPath(null, DB_ERROR, null, $inputs);        
                    }
                }                             
                return $this->addReservationPath(null, RESERVATION_ERROR, null, $inputs);
            }            
            return $this->addReservationPath($tent, EMPTY_FIELDS, null, $inputs);            
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
			
        private function isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $payment_method, $auxiliary_phone, $vehicle, $tent) {
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
                empty($payment_method) ||
                empty($auxiliary_phone) ||
                empty($vehicle) || 
                empty($tent)) {
                    return false;
            }
            return true;
        } 
        
        public function addReservationPath($id_tent = "", $alert = "", $success = "", $inputs = array()) { 
            if ($admin = $this->adminController->isLogged()) {
                $config = $this->configDAO->get();                     
                $title = "Reserva - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-reserve.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listReservationPath($showAll = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Reservas";    
                if ($showAll != null) {
                    $reservations = $this->reservationDAO->getAllDisables();
                } else {
                    $reservations = $this->reservationDAO->getAllActives();                                     
                }                             
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
                    return $this->listReservationPath(null, null, RESERVATION_ENABLE);
                } else {
                    return $this->listReservationPath(null, DB_ERROR, null);
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
                    return $this->listReservationPath(null, null, RESERVATION_DISABLE);
                } else {
                    return $this->listReservationPath(null, DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }       

        public function updatePath($id_rsv, $id_tent, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Reserva - Modificar informacion";       
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_rsv);                
                $reservation = $this->reservationDAO->getById($reservationTemp);               
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-reserve.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function isFormUpdateNotEmpty($id_rsv, $id_tent, $stay, $start, $end) {
            if (empty($id_rsv) || 
                empty($id_tent) || 
                empty($stay) || 
                empty($start) || 
                empty($end)) {
                    return false;
            }
            return true;
        } 
                
        // borrar o probar
        public function checkIntervalToUpdate($date_start, $date_end, $id_tent, $id_rsv) {
			$existance = $this->getByIdTent($id_tent);			
			$flag = 1;
			if ($existance != null) {
				foreach ($existance as $reserve) {
                    if ($reserve->getId() != $id_rsv) {
                        if ( ($date_end < $reserve->getDateStart()) xor ($date_start > $reserve->getDateEnd())  ) {
                            $flag *= 1;	
                        } else {
                            $flag *= 0;
                        }
                    }
				}
            }
            return $flag;
        }
        
        public function update($id_rsv, $id_tent, $stay, $start, $end) {    
            
            if ($this->isFormUpdateNotEmpty($id_rsv, $id_tent, $stay, $start, $end)) {     
                
				if ($this->checkIntervalToUpdate($start, $end, $id_tent, $id_rsv) == 1) {                                                         

                    $reservation = new Reservation();    
                    $reservation->setId($id_rsv);                  
                    $reservation->setStay($stay);
                    $reservation->setDateStart($start);
                    $reservation->setDateEnd($end);

                    $tent = new BeachTent();
                    $tent->setId($id_tent);

                    $reservation->setBeachTent($tent);                    
                    
                    $update_by = $this->adminController->isLogged();

                    // echo '<pre>';
                    // var_dump($reservation);
                    // echo '</pre>';

                    if ($this->reservationDAO->update($reservation, $update_by)) {                                                                
                        return $this->updatePath(null, null, RESERVATION_UPDATE);
                    } else {       
                        return $this->updatePath(null, DB_ERROR, null);        
                    }
                }                
                // return $this->updatePath($id_tent, RESERVATION_ERROR, null);
            }            
            // return $this->updatePath($id_tent, EMPTY_FIELDS, null);
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

        public function listReservationByAdminPath($id_admin, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Reservas por administrador";                    
                $adminTemp = new Admin();
                $adminTemp->setId($id_admin);
                $reservations = $this->reservationDAO->getAllByAdmin($admin);                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-reservation.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
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

        public function getAllReservations() {
            return $this->reservationDAO->getAll();
        }

        public function getReservationsByDate($date) {
            return $this->reservationDAO->getByDate($date);
        }

        public function getReservationsBetweenDates($date_start, $date_end) {
            return $this->reservationDAO->getBetweenDates($date_start, $date_end);
        }

        public function futureReservations() {
            $futureReserve = array();
            $reserveList = $this->reservationDAO->getAll();
            $today = date("Y-m-d");
            $dateToCompare = strtotime( $today );            
            
            foreach ($reserveList as $reserve) {                
                $reserveDate = strtotime( $reserve->getDateStart() );
                if ($reserveDate > $dateToCompare) {
                    array_push($futureReserve, $reserve);
                }                
            }
            return $futureReserve;
        }
        
        public function getRsvClientsCount() {
            return $this->reservationDAO->getCount();
        }

        public function getAllReservationsWithClients($start) {
            return $this->reservationDAO->getAllRsvWithClientsWithLimit($start);
        }

        public function getSalesMonthly() {
            return $this->reservationDAO->getSalesMonthly();
        }
    }
?>