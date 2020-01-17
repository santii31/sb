<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use Models\Locker as Locker;
    use Models\Parasol as Parasol;
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\ServicexLocker as ServicexLocker;
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

        
        

        public function addLocker($id_locker_man = "", $id_locker_woman = "",$id_reserve) {
            
           if (!empty($id_locker_man) || !empty($id_locker_woman)) {
                $total = 0;
                $flag=0;
                $service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve);
                if (!empty($id_locker_man)){
                    $lockerMan = new Locker();
                    $servicexlocker = new ServicexLocker();
                    $lockerMan->setId($id_locker_man);
                    $locker = $this->lockerDAO->getById($lockerMan);
                    
                    $total = $service->getTotal() + $locker->getPrice();
                    $service->setTotal($total);
                    $update_by = $this->adminController->isLogged();
                    $this->additionalServiceDAO->update($service, $update_by);
                    $servicexlocker->setIdService($service->getId());
                    $servicexlocker->setIdLocker($locker->getId());
                    $this->servicexlockerDAO->add($servicexlocker);
                    $flag++;
                }
                if (!empty($id_locker_woman)){
                    $lockerWoman = new Locker();
                    $servicexlocker = new ServicexLocker();
                    $lockerWoman->setId($id_locker_woman);
                    $locker = $this->lockerDAO->getById($lockerWoman);
                    
                    $total = $service->getTotal() + $locker->getPrice();
                    $service->setTotal($total);
                    $update_by = $this->adminController->isLogged();
                    $this->additionalServiceDAO->update($service, $update_by);
                    $servicexlocker->setIdService($service->getId());
                    $servicexlocker->setIdLocker($locker->getId());
                    $this->servicexlockerDAO->add($servicexlocker);
                    $flag++;
                }
                
                
            }
            if ($flag > 0) {
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

        
        private function addParasol($id_parasol, $id_reservation) {
            if (!empty($id_parasol)) {
                $total = 0;
                $service = $this->reservationxserviceDAO->getServiceByReservation($id_reservation);
                $parasol = $this->parasolDAO->getById($id_parasol);
                $total = $service->getTotal() + $parasol->getPrice();
                $service->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($service, $update_by);
                $servicexparasol->setIdService($service->getId());
                $servicexparasol->setIdParasol($parasol->setId());
                $this->servicexparasolDAO->add($servicexparasol);
            }
            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }

        /*private function addServiceWithParking($description, $parking, $id_reservation) {
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
        }*/

        public function hasAdditionalService($id_reservation, $alert = "", $success = ""){
            if ($admin = $this->adminController->isLogged()) {                                       
                if (!empty($id_reservation)){ 
                    $title = "Desea agregar un servicio adicional a la reserva?";
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "has-additional-service.php");
                    require_once(VIEWS_PATH . "footer.php");
                }                      
			} else {                
                return $this->adminController->userPath();
			}
        }

        // 
        public function chose($answer, $id_reserve){
            if (!empty($answer) && !empty($id_reserve)){
                if($answer == "yes"){
                    $this->addSelectServicePath($id_reserve, null, null);
                }else{}
            }
        }

        public function optionsDistributor($service, $id_reserve) {
            if ($service == "parasol") {
                $this->addParasolPath($id_reserve, null, null, null);
            }
            else if ($service == "locker") {
                $this->addLockerPath($id_reserve, null, null, null);
            }
            else if ($service == "parking") {
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

        public function addSelectServicePath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Seleccione servicio adicional";
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "select-service.php");
                    require_once(VIEWS_PATH . "footer.php");
                }  else {                
                return $this->adminController->userPath();
			}
        }

        public function addLockerPath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de locker";
                
                $reserveTemp = new Reservation();
                $reserveTemp->setId($id_reservation);
                $reserve = $this->reservationDAO->getById($reserveTemp);
                $reservations = $this->reservationDAO->getAll();
                $listLockers = $this->lockerDAO->getAll();
                $contador = 1;
                
                $lockers = array();

                echo '<pre>';
                var_dump($reservations);
                echo '</pre>';

                foreach ($listLockers as $locker) {
                    foreach ($reservations as $reservation) {
                        
                        $service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());

                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($service != false) ) {
                            if($this->servicexlockerDAO->getLockerByService($service->getId()) != false) {
                                echo $this->servicexlockerDAO->getLockerByService($service->getId())[0]->getId();
                                if($this->servicexlockerDAO->getLockerByService($service->getId())[0]->getId() == $locker->getId() ){ 
                                    array_push($lockers, $locker);
                                }
                            }
                        } else if ( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($service != false)  ) {
                            if ($this->servicexlockerDAO->getLockerByService($service->getId()) != false) {
                                echo $this->servicexlockerDAO->getLockerByService($service->getId())[0]->getId();
                                if ($this->servicexlockerDAO->getLockerByService($service->getId())[0]->getId() == $locker->getId() ){ 
                                    array_push($lockers, $locker);
                                }
                            }
                        }
                    } 
                }

                $lockerManList = array();
                $lockerWomanList = array();
                $exist=false;
                
                foreach ($listLockers as $locker){
                    foreach ($lockers as $locker2){
                        if ($locker->getId() == $locker2->getId()){
                            $exist=true;
                        }
                    }
                    if ($exist == false && $locker->getSex() == "mujer" ){
                        array_push($lockerWomanList, $locker);
                    }
                    else if ($exist == false && $locker->getSex() == "hombres"){
                        array_push($lockerManList, $locker);
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
                if (empty($id_reservation)) {
                    $reservations = $this->reservationDAO->getAllByClientId($id_client);
                    $reservationTemp = array_shift($reservations);
                    $id_reservation = $reservationTemp->getId();
                    foreach ($reservations as $reservation) {
                        if ($reservation->getId() > $id_reservation) {
                            $id_reservation = $reservation->getId();
                        }
                    }
                }
                $reserve = $this->reservationDAO->getById($id_reservation);
                $reservations = $this->reservationDAO->getAll();
                $listParasoles = $this->parasolDAO->getAll();
                
                $parasoles = array();
                foreach ($listParasoles as $parasol) {
                    foreach ($reservations as $reservation) {
                        $id_reserve = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        if ( ($this->reservationController->checkIsDateReserved($reservation)) && ($id_reserve != false) ) {
                            if ($this->servicexparasolDAO->getParasolByService($id_reserve) != false) {
                                if ($this->servicexparasolDAO->getParasolByService($id_reserve)->getId() == $parasol->getId() ){ 
                                    array_push($parasoles, $parasol);
                                }
                            }
                        } else if ( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($id_reserve != false)  ) {
                            if ($this->servicexparasolDAO->getParasolByService($id_reserve) != false) {
                                if ($this->servicexparasolDAO->getParasolByService($id_reserve)->getId() == $parasol->getId() ){ 
                                    array_push($parasoles, $parasol);
                                }
                            }
                        }
                    } 
                }

                $parasolListFinal = array();
                $exist=false;
                foreach ($listParasoles as $parasol){
                    foreach ($parsoles as $parasol2){
                        if ($parasol->getId() == $parasol2->getId()){
                            $exist=true;
                        }
                    }
                    if ($exist == false){
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