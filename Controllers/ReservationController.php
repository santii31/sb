<?php

    namespace Controllers;    
    
    use Models\Check as Check;
    use Models\Admin as Admin;
    use Models\Client as Client;    
    use Models\Parasol as Parasol;    
    use Models\BeachTent as BeachTent;
    use Models\Reservation as Reservation;
    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use DAO\CheckDAO as CheckDAO;
    use DAO\ClientDAO as ClientDAO;        
    use DAO\ConfigDAO as ConfigDAO;    
    use DAO\ReservationDAO as ReservationDAO;    
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use DAO\ServicexParkingDAO as ServicexParkingDAO;    
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use DAO\ReservationxParkingDAO as ReservationxParkingDAO;
    use DAO\ServicexMobileParasolDAO as ServicexMobileParasolDAO;
    use Controllers\PDFController as PDFController;  
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
        private $reservationxparkingDAO;
        private $servicexlockerDAO;
        private $servicexparasolDAO;      
        private $servicexparkingDAO;
        private $configDAO;
        private $checkDAO;
        private $servicexmobileparasolDAO;

        public function __construct() {
            $this->reservationDAO = new ReservationDAO();                                    
            $this->adminController = new AdminController();
            $this->additionalServiceDAO = new AdditionalServiceDAO();     
            $this->reservationxserviceDAO = new ReservationxServiceDAO();            
            $this->reservationxparkingDAO = new ReservationxParkingDAO();
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

            // servicio adicional                   
            $additionalService = new AdditionalService();                                             
            $additionalService->setTotal(0);

            if ($lastIdService = $this->additionalServiceDAO->add($additionalService, $register_by)) {
                
                // cliente
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

                    // reserva
                    if ($lastIdReserve = $this->reservationDAO->add($reservation, $register_by)) {                        
                                                    
                        // reserva x service
                        $reservationxservice = new ReservationxService();
                        $reservationxservice->setIdReservation($lastIdReserve);
                        $reservationxservice->setIdService($lastIdService);                             
                        
                        if ($this->reservationxserviceDAO->add($reservationxservice)) {
                            return $lastIdReserve;
                        }                       
                    }
                }
            }            
            return false;
        }

        public function addReservation($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price) { 

            // Saves the inputs in case of validation error
            $inputs = array(
                "stay" => $stay,
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
                "vehicle" => $vehicle,
                "tent" => $tent,
                "price"=> $price
            );

            if (strtotime($start) <= strtotime($end)) {

                if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price)) {
                    
                    if ($this->checkInterval($start, $end, $tent) == 1) {                                 
    
                        if ($lastId = $this->add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $tent, $price)) {                                                    
    
                            $this->parkingController = new ParkingController();                                         
                            return $this->parkingController->parkingMap($lastId, null, $price, null);                                             
    
                        } else {                        
                            return $this->addReservationPath($tent, DB_ERROR, null, $inputs);        
                        }
                    }                             
                    return $this->addReservationPath($tent, RESERVATION_ERROR, null, $inputs);
                }            
                return $this->addReservationPath($tent, EMPTY_FIELDS, null, $inputs);            
            }
            return $this->addReservationPath($tent, 'Fecha de egreso menor a la fecha de ingreso', null, $inputs);   
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
                    $title = "Reservas - Carpas";    
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

        public function listReservationParasolPath($page = 1, $showDisables = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                
                if ($showDisables == null) {
                    $title = "Reservas - Sombrillas";    
                    $rsvCount = $this->reservationDAO->getParasolActiveCount();                    
                    $pages = ceil ($rsvCount / MAX_ITEMS_PAGE);                                                                                   
                    $current = 0;                  
    
                    if ($page == 1) {                                        
                        $reservations = $this->reservationDAO->getParasolAllActiveWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $reservations = $this->reservationDAO->getParasolAllActiveWithLimit($startFrom);                    
                    }
                } else {                    
                    $title = "Reservas - Deshabilitadas";
                    $d_rsvCount = $this->reservationDAO->getParasolDisableCount();         
                    $d_pages = ceil ($d_rsvCount / MAX_ITEMS_PAGE);                                                                           
                    $d_current = 0;                  
    
                    if ($page == 1) {                                        
                        $reservations = $this->reservationDAO->getParasolAllDisableWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $reservations = $this->reservationDAO->getParasolAllDisableWithLimit($startFrom);                    
                    }                                      
                }   
                      
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-reservation-parasol.php");
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
                $rsvService = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());

                if ($rsvService != null) {
                    if ($this->reservationDAO->disableById($reservation, $admin)) {                        
						
						if($rxp = $this->reservationxparkingDAO->getAllByReservationId($reservation)){							
							$this->reservationxparkingDAO->delete($reservation); 
						}
						if($sxl = $this->servicexlockerDAO->getLockerByService($rsvService->getId())){							
							$this->servicexlockerDAO->delete($rsvService);
						}
						if($sxmp = $this->servicexmobileparasolDAO->getMobileParasolByService($rsvService->getId())){							
							$this->servicexmobileparasolDAO->delete($rsvService);
						}
                        if($sxp = $this->servicexparkingDAO->getParkingByService($rsvService->getId())){							
							$this->servicexparkingDAO->delete($rsvService);
						}       
                        return $this->listReservationPath(1, true, null, RESERVATION_DISABLE);                                                    
                    }
                    return $this->listReservationPath(1, null, DB_ERROR, null);            
                }
                return $this->listReservationPath(1, null, DB_ERROR, null);            
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

                if (strtotime($start) <= strtotime($end)) {
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
                return $this->updatePath($id_rsv, $id_tent, 'Fecha de egreso menor a la fecha de ingreso', null);                
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
                $reservations = $this->reservationDAO->getAllByAdmin($adminTemp);                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-reservation.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }

        public function generatePDF() {  
            if ($admin = $this->adminController->isLogged()) {                                                               
                $pdfController = new PDFController();
            } else {
                return $this->adminController->userPath();
            }          
        }

        // parasol
        private function addParasol($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_parasol, $price) {                        

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

            // servicio adicional                   
            $additionalService = new AdditionalService();                                             
            $additionalService->setTotal(0);

            if ($lastIdService = $this->additionalServiceDAO->add($additionalService, $register_by)) {
                
                // cliente
                if ($clientId = $this->clientController->addObj($client, $register_by)) {

                    $client->setId($clientId);
                                    
                    $reservation = new Reservation();
                    $reservation->setDateStart($start);
                    $reservation->setDateEnd($end);            
                    $reservation->setStay($stay);
                    $reservation->setPrice($price);
                                    
                    $reservation->setDiscount(0);
                    
                    $parasol = new Parasol();
                    $parasol->setId($id_parasol);  
    
                    $reservation->setParasol($parasol);
                    $reservation->setClient($client);                

                    // reserva
                    if ($lastIdReserve = $this->reservationDAO->addSecundary($reservation, $register_by)) {                        
                                                    
                        // reserva x service
                        $reservationxservice = new ReservationxService();
                        $reservationxservice->setIdReservation($lastIdReserve);
                        $reservationxservice->setIdService($lastIdService);                             
                        
                        if ($this->reservationxserviceDAO->add($reservationxservice)) {
                            return $lastIdReserve;
                        }                       
                    }
                }
            }            
            return false;
        }

        public function addParasolMap($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_parasol, $price) { 

            // Saves the inputs in case of validation error
            $inputs = array(
                "stay" => $stay,
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
                "parasol" => $id_parasol,
                "price"=> $price
            );
            
            if (strtotime($start) <= strtotime($end)) {

                if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_parasol, $price)) {
                    
                    if ($this->checkIntervalParasol($start, $end, $id_parasol) == 1) {                                 

                        if ($lastId = $this->addParasol($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_parasol, $price)) {                                                    

                            $this->parkingController = new ParkingController();                                         
                            return $this->parkingController->parkingMap($lastId, null, $price, null);                                                

                        } else {                        
                            return $this->addReservationParasolPath($id_parasol, DB_ERROR, null, $inputs);        
                        }
                    }                             
                    return $this->addReservationParasolPath($id_parasol, RESERVATION_ERROR, null, $inputs);
                }            
                return $this->addReservationParasolPath($id_parasol, EMPTY_FIELDS, null, $inputs);        
            }    
            return $this->addReservationParasolPath($id_parasol, 'Fecha de egreso menor a la fecha de ingreso', null, $inputs);   
        }
        
        public function checkIntervalParasol($date_start, $date_end, $id_parasol) {
			$existance = $this->getByIdParasol($id_parasol);			
			$flag = 1;
			if ($existance != null) {
				foreach ($existance as $reserve) {
					if ( ($date_end < $reserve->getDateStart()) xor ($date_start > $reserve->getDateEnd()) ) {
						$flag *= 1;	
					} else {
						$flag *= 0;
					}
				}
            }
            return $flag;
        }
        
        public function addReservationParasolPath($id_parasol = "", $alert = "", $success = "", $inputs = array()) { 
            if ($admin = $this->adminController->isLogged()) {
                $config = $this->configDAO->get();                     
                $title = "Reserva - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-reserve-parasol.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function updateParasolPath($id_rsv, $id_parasol, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Reserva - Modificar informacion";       
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_rsv);                
                $reservation = $this->reservationDAO->getById($reservationTemp);   
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-reserve-parasol.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }
        
        public function updateParasol($id_rsv, $id_parasol, $stay, $start, $end, $price) {    
                        
            if ($this->isFormUpdateParasolNotEmpty($id_rsv, $id_parasol, $stay, $start, $end, $price)) {                                 

                if (strtotime($start) <= strtotime($end)) {

                    if ($this->checkIntervalToUpdateParasol($start, $end, $id_parasol, $id_rsv) == 1) {                                           

                        $reservation = new Reservation();    
                        $reservation->setId($id_rsv);                  
                        $reservation->setStay($stay);
                        $reservation->setDateStart($start);
                        $reservation->setDateEnd($end);
                        $reservation->setPrice($price);

                        $parasol = new Parasol();
                        $parasol->setId($id_parasol);

                        $reservation->setParasol($parasol);                    
                        
                        $update_by = $this->adminController->isLogged();

                        if ($this->reservationDAO->update($reservation, $update_by)) {                                                            
                            return $this->updateParasolPath($id_rsv, $id_parasol, null, RESERVATION_UPDATE);
                        } else {       
                            return $this->updateParasolPath($id_rsv, $id_parasol, DB_ERROR, null);        
                        }
                    }                
                    return $this->updateParasolPath($id_rsv, $id_parasol, RESERVATION_ERROR, null);
                }
                return $this->updateParasolPath($id_rsv, $id_parasol, 'Fecha de egreso menor a la fecha de ingreso', null);                
            }                        
            return $this->updateParasolPath($id_rsv, $id_parasol, EMPTY_FIELDS, null);
        }

        private function isFormUpdateParasolNotEmpty($id_rsv, $id_parasol, $stay, $start, $end, $price) {
            if (empty($id_rsv) || 
                empty($id_parasol) || 
                empty($stay) || 
                empty($start) || 
                empty($end) || 
                empty($price)) {
                    return false;
            }
            return true;
        } 
                        
        private function checkIntervalToUpdateParasol($date_start, $date_end, $id_parasol, $id_rsv) {
			$existance = $this->getByIdParasol($id_parasol);			
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

        public function getByIdParasol($id_parasol) {
            $parasol = new Parasol();
            $parasol->setId($id_parasol);
            return $this->reservationDAO->getByIdParasol($parasol);
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

        public function getByIdToBalance($id_reservation) {
            $reservation = new Reservation();
            $reservation->setId($id_reservation);
            return $this->reservationDAO->getByIdToBalance($reservation);
        }        

        public function getAllReservations() {
            return $this->reservationDAO->getAllToPDF();
        }

        public function getAllToBalanceReservations() {
            return $this->reservationDAO->getAllToBalance();
        }        

        public function getReservationsByDate($date) {
            return $this->reservationDAO->getByDate($date);
        }

        public function getReservationsByDateToBalance($date) {
            return $this->reservationDAO->getByDateToBalance($date);
        }

        public function getReservationsBetweenDates($date_start, $date_end) {
            return $this->reservationDAO->getBetweenDates($date_start, $date_end);
        }

        public function getReservationsBetweenDatesToBalance($date_start, $date_end) {
            return $this->reservationDAO->getBetweenDatesToBalance($date_start, $date_end);
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
        
        public function paymentMethod($paymentMethod, $id_reserve, $alert = "", $success = "") {
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

        public function addCheck($bank, $account_number, $check_number, $payment_date, $id_client, $id_reserve) {
            if (!empty($bank) && !empty($account_number) && !empty($check_number) && !empty($payment_date) && !empty($id_client)) {
                $check = new Check();
                $clientTemp = new Client();
                $check->setBank($bank);
                $check->setAccountNumber($account_number);
                $check->setCheckNumber($check_number);                
                $check->setPaymentDate($payment_date);
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

        public function checkList($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Cheques - Buscar";
                $checks = $this->checkDAO->getAll();                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-check.php");
                require_once(VIEWS_PATH . "footer.php");
            }
        }

        public function payPath($id_reservation) {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Reserva - Precio final";
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reservation);
                $reservation = $this->reservationDAO->getByIdWithTentOrParasol($reservationTemp);
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "pay.php");
                require_once(VIEWS_PATH . "footer.php");
            }  else {                
                return $this->adminController->userPath();
			}
        }

        public function payed($id_check) {
            $checkTemp = new Check();
            $checkTemp->setId($id_check);
            $check = $this->checkDAO->getById($checkTemp);
            $check->setCharged("cobrado");
            if ($this->checkDAO->update($check)) {
                $this->checkList(null, 'Cheque cobrado.');
            } else {
                $this->checkList(DB_ERROR, null);
            }
        }

        public function unpayed($id_check) {
            $checkTemp = new Check();
            $checkTemp->setId($id_check);
            $check = $this->checkDAO->getById($checkTemp);
            $check->setCharged("rechazado");
            if ($this->checkDAO->update($check)) {
                $this->checkList(null, 'Cheque rebotado.');
            } else {
                $this->checkList(DB_ERROR, null);
            }
        }

        // 
        public function getRsvClientsCount() {
            return $this->reservationDAO->getCount();
        }

        public function getAllReservationsWithClients($start) {
            return $this->reservationDAO->getAllRsvWithClientsWithLimit($start);
        }

        public function getSalesMonthly() {
            return $this->reservationDAO->getSalesMonthly();
        }

        public function getNumberParkingByReservation($rsv) {
            $parkings = array();
            $rsvParkingDAO = new ReservationxParkingDAO();
            $list = $rsvParkingDAO->getAllByReservationId($rsv);

            foreach ($list as $rsv_t) {
                array_push($parkings, $rsv_t->getParking()->getNumber());                
            }

            return implode( ", ", $parkings);            
        }

        public function getSizeNumberParkingByReservation($rsv) {
            $parkings = array();
            $rsvParkingDAO = new ReservationxParkingDAO();
            $list = $rsvParkingDAO->getAllByReservationId($rsv);

            foreach ($list as $rsv_t) {
                array_push($parkings, $rsv_t->getParking()->getNumber());                
            }

            return sizeof($parkings);            
        }


    }
?>
