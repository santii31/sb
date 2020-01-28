<?php

    namespace Controllers;    
    
    use Models\Admin as Admin;
    use Models\Client as Client;    
    use Models\BeachTent as BeachTent;
    use Models\Reservation as Reservation;
    use Models\Check as Check;
    use DAO\CheckDAO as CheckDAO;
    use DAO\ClientDAO as ClientDAO;        
    use DAO\ConfigDAO as ConfigDAO;
    use DAO\ReservationDAO as ReservationDAO;    
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use DAO\ServicexMobileParasolDAO as ServicexMobileParasolDAO;
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientController as ClientController;
    use Controllers\ParkingController as ParkingController;    
    use Controllers\AdditionalServiceController as AdditionalServiceController;    
    
    class ReservationController {

        private $reservationDAO;
        private $adminController;
        private $clientController;          
        private $parkingController;
        private $additionalServiceController;
        private $clientDAO;
        private $reservationxserviceDAO;
        private $servicexlockerDAO;
        private $servicexparasolDAO;      
        private $servicexparkingDAO;
        private $configDAO;
        private $checkDAO;
        private $servicexmobileparasolDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();                                    
            $this->adminController = new AdminController();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexparasolDAO = new ServicexParasolDAO();
            $this->servicexparkingDAO = new ServicexParkingDAO();
            $this->configDAO = new ConfigDAO();
            $this->clientDAO = new ClientDAO();
            $this->checkDAO = new CheckDAO();
            $this->servicexmobileparasolDAO = new ServicexMobileParasolDAO();
        }               

        
        private function add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_tent, $price) {                        

            $this->clientController = new ClientController();                              
            
            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $l_name_s = filter_var($l_name, FILTER_SANITIZE_STRING);
            $addr_s = filter_var($addr, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);
            $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);     
            $vehicle_s = filter_var($vehicle, FILTER_SANITIZE_STRING);                                

            $client = new Client();
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($l_name_s) );
            $client->setAddress( strtolower($addr_s) );            
            $client->setCity( strtolower($city_s) );
            $client->setCp($cp);
            $client->setEmail($email_s);
            $client->setPhone($phone);
            $client->setFamilyGroup( strtolower($fam) );
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
                
                // DESCUENTO ???????
                $reservation->setDiscount(0);
                
                $tent = new BeachTent();
                $tent->setId($id_tent);  

                $reservation->setBeachTent($tent);
                $reservation->setClient($client);

                return $this->reservationDAO->add($reservation, $register_by); 
            }
            return false;
        }

        public function addReservation($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price) { 

            // Saves the inputs in case of validation error
            $inputs = array(
                "start" => $start, 
                "end" => $end,
                "name" => $name,
                "l_name" => $l_name,
                "addr" => $addr,
                "city" => $city,
                "cp" => $cp,
                "email" => $email,
                "phone" => $phone,
                "fam" => $fam,
                "aux_phone" => $auxiliary_phone,
                "tent" => $tent,
                "price"=> $price
            );
            
            if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price)) {
                
                if ($this->checkInterval($start, $end, $tent) == 1) {                                 

                    if ($lastId = $this->add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price)) {                                                    

                        $this->parkingController = new ParkingController();                                         
                        return $this->parkingController->parkingMap($lastId, null, $price, null);                                                

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
			
        private function isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent) {
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
        
        public function listReservationPath($page = 1, $showDisables = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                
                if ($showDisables == null) {
                    $title = "Reservas";    
                    $rsvCount = $this->reservationDAO->getActiveCount();                    
                    $pages = ceil ($rsvCount / MAX_ITEMS_PAGE);                                                                                   
                    $current = 0;                  
    
                    if ($page == 1) {                                        
                        $reservations = $this->reservationDAO->getAllActiveWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $reservations = $this->reservationDAO->getAllActiveWithLimit($startFrom);                    
                    }
                } else {                    
                    $title = "Reservas - Deshabilitadas";
                    $d_rsvCount = $this->reservationDAO->getDisableCount();         
                    $d_pages = ceil ($d_rsvCount / MAX_ITEMS_PAGE);                                                                           
                    $d_current = 0;                  
    
                    if ($page == 1) {                                        
                        $reservations = $this->reservationDAO->getAllDisableWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $reservations = $this->reservationDAO->getAllDisableWithLimit($startFrom);                    
                    }                                      
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
                    return $this->listReservationPath(1, null, null, RESERVATION_ENABLE);
                } else {
                    return $this->listReservationPath(1, null, DB_ERROR, null);
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
                    return $this->listReservationPath(1, true, null, RESERVATION_DISABLE);
                } else {
                    return $this->listReservationPath(1, null, DB_ERROR, null);
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
        
        public function update($id_rsv, $id_tent, $stay, $start, $end, $price) {    
                        
            if ($this->isFormUpdateNotEmpty($id_rsv, $id_tent, $stay, $start, $end, $price)) {                                 

				if ($this->checkIntervalToUpdate($start, $end, $id_tent, $id_rsv) == 1) {                                                         

                    $reservation = new Reservation();    
                    $reservation->setId($id_rsv);                  
                    $reservation->setStay($stay);
                    $reservation->setDateStart($start);
                    $reservation->setDateEnd($end);
                    $reservation->setPrice($price);

                    $tent = new BeachTent();
                    $tent->setId($id_tent);

                    $reservation->setBeachTent($tent);                    
                    
                    $update_by = $this->adminController->isLogged();

                    if ($this->reservationDAO->update($reservation, $update_by)) {                                                                
                        return $this->updatePath($id_rsv, $id_tent, null, RESERVATION_UPDATE);
                    } else {       
                        return $this->updatePath($id_rsv, $id_tent, DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id_rsv, $id_tent, RESERVATION_ERROR, null);
            }                        
            return $this->updatePath($id_rsv, $id_tent, EMPTY_FIELDS, null);
        }

        private function isFormUpdateNotEmpty($id_rsv, $id_tent, $stay, $start, $end, $price) {
            if (empty($id_rsv) || 
                empty($id_tent) || 
                empty($stay) || 
                empty($start) || 
                empty($end) || 
                empty($price)) {
                    return false;
            }
            return true;
        } 
                        
        private function checkIntervalToUpdate($date_start, $date_end, $id_tent, $id_rsv) {
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

        public function checkList($alert = "", $success = ""){
            if ($admin = $this->adminController->isLogged()) {
                $title = "Cheques - Buscar";
                $checks = $this->checkDAO->getAll();                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-check.php");
                require_once(VIEWS_PATH . "footer.php");
            }
        }

        public function payed($id_check){
            $checkTemp = new Check();
            $checkTemp->setId($id_check);
            $check = $this->checkDAO->getById($checkTemp);
            $check->setCharged("cobrado");
            
            if ($this->checkDAO->update($check)) {
                return true;
            } else {
                return false;
            }
        }

        public function unpayed($id_check){
            $checkTemp = new Check();
            $checkTemp->setId($id_check);
            $check = $this->checkDAO->getById($checkTemp);
            $check->setCharged("rechazado");
            
            if ($this->checkDAO->update($check)) {
                return true;
            } else {
                return false;
            }
        }


        // 
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

        // 
        public function paymentMethod($paymentMethod, $id_reserve, $alert = "", $success = ""){
            if ($admin = $this->adminController->isLogged()) {
                
                $this->additionalServiceController = new AdditionalServiceController();
                $update_by = $this->adminController->isLogged();

                if (!empty($paymentMethod)) {
                    if ($paymentMethod == "check") {
                        
                        $title = "Metodo de pago - Cheque";                        
                        $reserveTemp = new Reservation();
                        $reserveTemp->setId($id_reserve);
                        
                        if ($reservation = $this->reservationDAO->getById($reserveTemp)) {

                            $clientTemp = $reservation->getClient();
                            $clientTemp->setPaymentMethod($paymentMethod);
                            
                            if ($this->clientDAO->update($clientTemp, $update_by)) {                            
                                require_once(VIEWS_PATH . "head.php");
                                require_once(VIEWS_PATH . "sidenav.php");
                                require_once(VIEWS_PATH . "add-check.php");
                                require_once(VIEWS_PATH . "footer.php");
                            } else {                                
                                return $this->additionalServiceController->payPath($id_reserve, DB_ERROR, null);
                            }
                        } else {
                            return $this->additionalServiceController->payPath($id_reserve, DB_ERROR, null);                        
                        }
                    } else {
                        
                        $reserveTemp = new Reservation();
                        $reserveTemp->setId($id_reserve);
                        
                        if ($reservation = $this->reservationDAO->getById($reserveTemp)) {

                            $clientTemp = $reservation->getClient();
                            $clientTemp->setPaymentMethod($paymentMethod);
                            
                            if ($this->clientDAO->update($clientTemp, $update_by)) {                                
                                return $this->payPath($id_reserve);
                            }                        
                        }
                        return $this->additionalServiceController->payPath($id_reserve, DB_ERROR, null);
                    }                    
                }   
            } else {
                return $this->adminController->userPath();
            }
        }

        public function addCheck($bank, $account_number, $check_number, $id_client, $id_reserve){
            if (!empty($bank) && !empty($account_number) && !empty($check_number) && !empty($id_client)) {
                $check = new Check();
                $clientTemp = new Client();
                $check->setBank($bank);
                $check->setAccountNumber($account_number);
                $check->setCheckNumber($check_number);                
                $clientTemp->setId($id_client);
                $client = $this->clientDAO->getById($clientTemp);                
                $check->setClient($client);
                
                if ($this->checkDAO->add($check)) {                         
                    return $this->payPath($id_reserve);
                }
                return $this->paymentMethod("check", $id_reserve, DB_ERROR, null);
            }
            return $this->paymentMethod("check", $id_reserve, EMPTY_FIELDS, null);
        }        

        public function payPath($id_reservation) {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Reserva - Precio final";
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reservation);
                $reservation = $this->reservationDAO->getById($reservationTemp);
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "pay.php");
                require_once(VIEWS_PATH . "footer.php");
            }  else {                
                return $this->adminController->userPath();
			}
        }

    }
?>