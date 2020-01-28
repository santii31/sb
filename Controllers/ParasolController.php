<?php

    namespace Controllers;    
    
    use Models\Client as Client;
    use Models\Parasol as Parasol;
    use Models\ParasolReservation as ParasolReservation;
    use DAO\ConfigDAO as ConfigDAO;
    use DAO\ParasolDAO as ParasolDAO;    
    use Controllers\AdminController as AdminController; 
    use Controllers\ClientController as ClientController;
    use Controllers\ParkingController as ParkingController;    
    use Controllers\AdditionalServiceController as AdditionalServiceController;    

    class ParasolController {

        private $parasolDAO;   
        private $configDAO;
        private $adminController;
        private $clientController;          
        private $parkingController;
        private $additionalServiceController;     

        public function __construct() {
            $this->parasolDAO = new ParasolDAO();   
            $this->configDAO = new ConfigDAO();   
            $this->adminController = new AdminController();         
        }        

        
        public function getRowParasol($n) {
            return $this->parasolDAO->getN_row($n);
        }        

        // Parasol Reservation
        private function add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $id_parasol, $price) {                        

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
                                
                $reservation = new ParasolReservation();
                $reservation->setDateStart($start);
                $reservation->setDateEnd($end);            
                $reservation->setStay($stay);
                $reservation->setPrice($price);                                
                
                $parasol = new Parasol();
                $parasol->setId($id_parasol);  

                $reservation->setParasol($parasol);
                $reservation->setClient($client);

                return $this->parasolDAO->add($reservation, $register_by); 
            }
            return false;
        }

        public function addReservation($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $parasol, $price) { 

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
                "parasol" => $parasol,
                "price"=> $price
            );
            
            if ($this->isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $parasol, $price)) {
                
                if ($this->checkInterval($start, $end, $parasol) == 1) {                                 

                    if ($lastId = $this->add($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $parasol, $price)) {                                                    

                        // cambiar aca
                        $this->parkingController = new ParkingController();                                         
                        return $this->parkingController->parkingMap($lastId, null, $price, null);                                                

                    } else {                        
                        return $this->addReservationPath(null, DB_ERROR, null, $inputs);        
                    }
                }                             
                return $this->addReservationPath(null, RESERVATION_ERROR, null, $inputs);
            }            
            return $this->addReservationPath($parasol, EMPTY_FIELDS, null, $inputs);            
        }
        
        public function checkInterval($date_start, $date_end, $id_parasol) {            	
            $existance = $this->parasolDAO->getByIdParasol($id_parasol);		
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
			
        private function isFormRegisterNotEmpty($stay, $start, $end, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle, $parasol) {
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
                empty($parasol)) {
                    return false;
            }
            return true;
        } 
        
        public function addReservationPath($id_parasol = "", $alert = "", $success = "", $inputs = array()) { 
            if ($admin = $this->adminController->isLogged()) {
                $config = $this->configDAO->get();                     
                $title = "Sombrilla - Añadir reserva";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-reserve-parasol.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        // 
        public function hasReservation($id_parasol) {            
            $reserveList = $this->parasolDAO->getByIdParasol($id_parasol);
            if ($reserveList != null) {                
                return sizeof($reserveList);
            }
            return false;
        }

        public function reservationToday($id_parasol) {
            $reserveList = $this->parasolDAO->getByIdParasol($id_parasol);  
            if ($reserveList != null) {
                foreach ($reserveList as $reserve) {
                    if ($reservation = $this->checkIsDateReserved($reserve)) {
                        return $reservation;
                    }
                }
            }           
            return false;
        }

        private function checkIsDateReserved(ParasolReservation $reservation) {                        
            $today = date("Y-m-d");
            $dateStart = strtotime( $reservation->getDateStart() ) ;
            $dateEnd = strtotime( $reservation->getDateEnd() );
            $dateToCompare = strtotime( $today );

            if ($dateToCompare >= $dateStart && $dateToCompare <= $dateEnd) {                                                  
                return $reservation;
            }            
            return false;
        }

        public function hasFutureReservation($id_parasol) {            
            $futureReserve = array();
            $reserveList = $this->parasolDAO->getByIdParasol($id_parasol);
            $today = date("Y-m-d");
            $dateToCompare = strtotime( $today );            
            
            if ($reserveList != null) {
                foreach ($reserveList as $reserve) {                
                    $reserveDate = strtotime( $reserve->getDateStart() );
                    if ($reserveDate > $dateToCompare) {
                        array_push($futureReserve, $reserve);
                    }                
                }
            }

            return $futureReserve;
        }

    }

?>