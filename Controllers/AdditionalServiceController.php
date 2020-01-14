<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use Models\Locker as Locker;
    use Models\Parasol as Parasol;
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ClientDAO as ClientDAO;
    use DAO\ParasolDAO as ParasolDAO;
    use DAO\LockerDAO as LockerDAO;
    use DAO\ParkingDAO as ParkingDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use Controllers\AdminController as AdminController;
    use Controllers\ReservationController as ReservationController;  

    class AdditionalServiceController {

        private $additionalServiceDAO;
        private $reservationxserviceDAO;
        private $servicexlockerDAO;
        private $servicexparasolDAO;
        private $servicexparkingDAO;
        private $clientDAO;
        private $reservationDAO;
        private $adminController;
        private $reservationController;
        private $parasolDAO;
        private $lockerDAO;

        public function __construct() {
            $this->additionalServiceDAO = new AdditionalServiceDAO();
            $this->parasolDAO = new ParasolDAO();
            $this->lockerDAO = new LockerDAO();
            $this->clientDAO = new ClientDAO();
            $this->reservationDAO = new ReservationDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexparasolDAO = new ServicexParasolDAO();
            $this->servicexparkingDAO = new ServicexParkingDAO();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->adminController = new AdminController();
            $this->reservationController = new ReservationController();
        }
        

        /*private function addServiceWithLocker($description, $locker, $id_reservation) {
            if(!empty($locker)) {
                $total = 0;
                $description_s = filter_var($description, FILTER_SANITIZE_STRING);
                $additionalService = new AdditionalService();
                $reservationxservice = new ReservationxService();
                $servicexLocker = new ServicexLocker();
                $additionalService->setDescription( strtolower($description_s) );
            
                $total = $total + $locker->getPrice();
                $additionalService->setTotal($total);
                $register_by = $this->adminController->isLogged();
                $lastId = $this->additionalServiceDAO->add($additionalService, $register_by);
                if ($lastId == false) {
                    return false;
                } else {
                    return true;
                }
                $reservationxservice->setIdReservation($id_reservation);
                $reservationxservice->setIdService($lastId);
                $reservationxserviceDAO->add($reservationxservice);
                $servicexlocker->setIdService($lastId);
                $servicexlocker->setIdLocker($locker->setId());
                $this->servicexlockerDAO->add($servicexlocker);
            }
            
        }*/

        private function addLocker(AdditionalService $additionalService, $locker) {
            $total = 0;
            $servicexLocker = new ServicexLocker();
            if(!empty($locker)) {
                $total = $additionalService->getTotal() + $locker->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexlocker->setIdService($additionalService->getId());
                $servicexlocker->setIdLocker($locker->setId());
                $this->servicexlockerDAO->add($servicexlocker);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }


        /*private function addServiceWithParasol($description, $parasol, $id_reservation) {
            $total = 0;
            $description_s = filter_var($description, FILTER_SANITIZE_STRING);
            $additionalService = new AdditionalService();
            $reservationxservice = new ReservationxService();
            $servicexParasol = new ServicexParasol();
            $additionalService->setDescription( strtolower($description_s) );
            if(!empty($parasol)) {
                $total = $total + $parasol->getPrice();
                $additionalService->setTotal($total);
                $register_by = $this->adminController->isLogged();
                $lastId = $this->additionalServiceDAO->add($additionalService, $register_by);
                $reservationxservice->setIdReservation($id_reservation);
                $reservationxservice->setIdService($lastId);
                $reservationxserviceDAO->add($reservationxservice);
                $servicexparasol->setIdService($lastId);
                $servicexparasol->setIdParasol($parasol->setId());
                $this->servicexparasolDAO->add($servicexparasol);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }*/

        private function addParasol(AdditionalService $additionalService, $parasol) {
            $total = 0;
            $servicexParasol = new ServicexParasol();
            if(!empty($parasol)) {
                $total = $additionalService->getTotal() + $parasol->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexparasol->setIdService($additionalService->getId());
                $servicexparasol->setIdParasol($parasol->setId());
                $this->servicexparasolDAO->add($servicexparasol);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }

        private function addServiceWithParking($description, $parking, $id_reservation) {
            $total = 0;
            $description_s = filter_var($description, FILTER_SANITIZE_STRING);
            $additionalService = new AdditionalService();
            $servicexParking = new ServicexParking();
            $reservationxservice = new ReservationxService();
            $additionalService->setDescription( strtolower($description_s) );
            if(!empty($parking)) {
                $total = $total + $parking->getPrice();
                $additionalService->setTotal($total);
                $register_by = $this->adminController->isLogged();
                $lastId = $this->additionalServiceDAO->add($additionalService, $register_by);
                $reservationxservice->setIdReservation($id_reservation);
                $reservationxservice->setIdService($lastId);
                $reservationxserviceDAO->add($reservationxservice);
                $servicexparking->setIdService($lastId);
                $servicexparking->setIdParking($parking->setId());
                $this->servicexparkingDAO->add($servicexparking);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }

        private function addParking(AdditionalService $additionalService, $parking) {
            $total = 0;
            $servicexParking = new ServicexParking();
            if(!empty($parking)) {
                $total = $additionalService->getTotal() + $parking->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexparking->setIdService($additionalService->getId());
                $servicexparking->setIdParking($parking->setId());
                $this->servicexparkingDAO->add($servicexparking);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }



        public function addService($description, $locker, $parasol, $parking) {
            if ($this->isFormRegisterNotEmpty($description, $locker, $parasol, $parking)) {   
                                                                             
                $serviceTemp = new AdditionalService();
                $serviceTemp->setDescription( strtolower($description) );                
                
				if ($this->additionalServiceDAO->getByDescription($serviceTemp) == null) {                                                       
                    if ($this->add($description, $locker, $parasol, $parking)) {                                                
                        return $this->addServicePath(null, SERVICE_ADDED);
                    } else {                        
                        return $this->addServicePath(DB_ERROR, null);        
                    }    
                }                
                return $this->addServicePath(SERVICE_ERROR, null);
            }            
            return $this->addServicePath(EMPTY_FIELDS, null);            
        }

        

        public function optionsDistributor($services, $id_client) {
           
            if($services == "parasol") {
                $this->addParasolPath(null, $id_client, null, null);
            }
            else if($services == "locker") {
                $this->addLockerPath(null, $id_client, null, null);
            }
            else if($services == "parking") {
                $this->addParkingPath(null, $id_client, null, null);
            }            
        }

        public function optionsDistributorWithReserve($service, $id_reserve) {   
            if($service == "parasol") {
                $this->addParasolPath($id_reserve, null, null, null);
            }
            else if($service == "locker") {
                $this->addLockerPath($id_reserve, null, null, null);
            }
            else if($service == "parking") {
                $this->addParkingPath($id_reserve, null, null, null);
            }            
        }

        private function isFormRegisterNotEmpty($description, $locker, $parasol, $parking) {
            if (empty($description) ) {
                return false;
            }
            if (empty($locker) || empty($parasol) || empty($parking)) {
                return false;
            }

            return true;
        }        

        



        public function addSelectServicePath($id_reservation="", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Seleccione servicio adicional";
                if(empty($id_reservation)) {
                    $clientList = $this->clientDAO->getAll();
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "select-service-client.php");
                    require_once(VIEWS_PATH . "footer.php");
                }else{
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "select-service.php");
                    require_once(VIEWS_PATH . "footer.php");
                }                   
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function addLockerPath($id_reservation="", $id_client="", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de locker";
                if(empty($id_reservation)) {
                    $reservations = $this->reservationDAO->getAllByClientId($id_client);
                    $reservationTemp = array_shift($reservations);
                    $id_reservation = $reservationTemp->getId();
                    foreach($reservations as $reservation) {
                        if($reservation->getId() > $id_reservation) {
                            $id_reservation = $reservation->getId();
                        }
                    }
                }
                $reserve = $this->reservationDAO->getById($id_reservation);
                $reservations = $this->reservationDAO->getAll();
                $listLockers = $this->lockerDAO->getAll();
                
                $lockers = array();
                foreach($listLockers as $locker) {
                    foreach($reservations as $reservation) {
                        $id_reserve = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($id_reserve != false) ) {
                            if($this->servicexlockerDAO->getLockerByService($id_reserve) != false) {
                                if($this->servicexlockerDAO->getLockerByService($id_reserve)->getId() == $locker->getId() ){ 
                                    array_push($lockers, $locker);
                                }
                            }
                        }else if( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($id_reserve != false)  ) {
                            if($this->servicexlockerDAO->getLockerByService($id_reserve) != false) {
                                if($this->servicexlockerDAO->getLockerByService($id_reserve)->getId() == $locker->getId() ){ 
                                    array_push($lockers, $locker);
                                }
                            }
                        }
                    } 
                }
                $lockerListFinal = array();
                $exist=false;
                foreach($listLockers as $locker){
                    foreach($lockers as $locker2){
                        if($locker->getId() == $locker2->getId()){
                            $exist=true;
                        }
                    }
                    if($exist == false){
                        array_push($lockerListFinal, $locker);
                    }
                }
                

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-locker.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }


        public function addParasolPath($id_reservation="", $id_client="",$alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Seleccione numero de sombrilla";
                if(empty($id_reservation)) {
                    $reservations = $this->reservationDAO->getAllByClientId($id_client);
                    $reservationTemp = array_shift($reservations);
                    $id_reservation = $reservationTemp->getId();
                    foreach($reservations as $reservation) {
                        if($reservation->getId() > $id_reservation) {
                            $id_reservation = $reservation->getId();
                        }
                    }
                }
                $reserve = $this->reservationDAO->getById($id_reservation);
                $reservations = $this->reservationDAO->getAll();
                $listParasoles = $this->parasolDAO->getAll();
                
                $parasoles = array();
                foreach($listParasoles as $parasol) {
                    foreach($reservations as $reservation) {
                        $id_reserve = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($id_reserve != false) ) {
                            if($this->servicexparasolDAO->getParasolByService($id_reserve) != false) {
                                if($this->servicexparasolDAO->getParasolByService($id_reserve)->getId() == $parasol->getId() ){ 
                                    array_push($parasoles, $parasol);
                                }
                            }
                        }else if( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($id_reserve != false)  ) {
                            if($this->servicexparasolDAO->getParasolByService($id_reserve) != false) {
                                if($this->servicexparasolDAO->getParasolByService($id_reserve)->getId() == $parasol->getId() ){ 
                                    array_push($parasoles, $parasol);
                                }
                            }
                        }
                    } 
                }

                $parasolListFinal = array();
                $exist=false;
                foreach($listParasoles as $parasol){
                    foreach($parsoles as $parasol2){
                        if($parasol->getId() == $parasol2->getId()){
                            $exist=true;
                        }
                    }
                    if($exist == false){
                        array_push($parasolListFinal, $parasol);
                    }
                }

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-parasol.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function addParkingPath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Seleccione cochera";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-parking.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }        

        public function listServicePath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Servicios adicionales";
                $services = $this->additionalServiceDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-services.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }

        

                

    }
    
?>