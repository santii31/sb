<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use Models\Locker as Locker;
    use Models\MobileParasol as MobileParasol;
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\ServicexLocker as ServicexLocker;
    use Models\ServicexMobileParasol as ServicexMobileParasol;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ClientDAO as ClientDAO;
    use DAO\MobileParasolDAO as MobileParasolDAO;
    use DAO\LockerDAO as LockerDAO;
    use DAO\ParkingDAO as ParkingDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use DAO\ServicexMobileParasolDAO as ServicexMobileParasolDAO;
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use Controllers\AdminController as AdminController;
    use Controllers\ReservationController as ReservationController; 
    use Controllers\ParkingController as ParkingController; 

    class AdditionalServiceController {

        private $additionalServiceDAO;
        private $reservationxserviceDAO;
        private $servicexlockerDAO;
        private $servicexmobileParasolDAO;
        private $servicexparkingDAO;
        private $clientDAO;
        private $reservationDAO;
        private $adminController;
        private $reservationController;
        private $parkingController;
        private $mobileParasolDAO;
        private $lockerDAO;

        public function __construct() {
            $this->additionalServiceDAO = new AdditionalServiceDAO();
            $this->mobileParasolDAO = new MobileParasolDAO();
            $this->lockerDAO = new LockerDAO();
            $this->clientDAO = new ClientDAO();
            $this->reservationDAO = new ReservationDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexmobileParasolDAO = new ServicexMobileParasolDAO();
            $this->servicexparkingDAO = new ServicexParkingDAO();
            $this->reservationxserviceDAO = new ReservationxServiceDAO();
            $this->adminController = new AdminController();
            $this->reservationController = new ReservationController();
            $this->parkingController = new ParkingController();
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
                

        public function addLocker($id_locker_man = "", $id_locker_woman = "", $price, $id_reserve) {
            
            $reservationTemp = new Reservation();
            $reservationTemp->setId($id_reserve);
            $reservation = $this->reservationDAO->getById($reservationTemp); 

           if (!empty($id_locker_man) || !empty($id_locker_woman)) {
                
                $flag=0;
                $service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve);
                if (!empty($id_locker_man)){
                    $lockerMan = new Locker();
                    $servicexlocker = new ServicexLocker();
                     
                    $lockerMan->setId($id_locker_man);
                    $locker = $this->lockerDAO->getById($lockerMan);
                    
                    $totalService = $service->getTotal() + $price;
                    $totalReserve = $reservation->getPrice() + $price;
                    

                    $service->setTotal($totalService);
                    $reservation->setPrice($totalReserve);
                    echo $reservation->getPrice() . "|";
                    $update_by = $this->adminController->isLogged();
                    $this->additionalServiceDAO->update($service, $update_by);
                    $this->reservationDAO->update($reservation, $update_by);
                    
                    $servicexlocker->setIdService($service->getId());
                    $servicexlocker->setIdLocker($locker->getId());
                    $reservationAux = $this->reservationDAO->getById($reservation);
                    echo $reservationAux->getPrice();
                    $this->servicexlockerDAO->add($servicexlocker);
                    $flag++;
                }
                if (!empty($id_locker_woman)){
                    $totalService = 0;
                    $totalReserve = 0;
                    $lockerWoman = new Locker();
                    $servicexlocker = new ServicexLocker();
                    $lockerWoman->setId($id_locker_woman);
                    $locker = $this->lockerDAO->getById($lockerWoman);
                    
                    $totalService = $service->getTotal() + $price;
                    $totalReserve = $reservation->getPrice() + $price;

                    $service->setTotal($totalService);
                    $reservation->setPrice($totalReserve);
                    $update_by = $this->adminController->isLogged();
                    $this->reservationDAO->update($reservation, $update_by);

                    $this->additionalServiceDAO->update($service, $update_by);
                    $this->reservationDAO->update($reservation, $update_by);

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

        public function addParasol($id_mobileParasol = "", $price, $id_reserve) {
            
            if (!empty($id_mobileParasol)) {
                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reserve);
                $reservation = $this->reservationDAO->getById($reservationTemp);
                $flag=0;
                $service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve);
                    
                $mobileParasolTemp = new MobileParasol();
                $servicexmobileParasol = new ServicexMobileParasol();
                $mobileParasolTemp->setId($id_mobileParasol);
                $mobileParasol = $this->mobileParasolDAO->getById($mobileParasolTemp);
                        
                $totalService = $service->getTotal() + $price;
                $totalReserve = $reservation->getPrice() + $price;
                $service->setTotal($totalService);
                $reservation->setPrice($totalReserve);
                $update_by = $this->adminController->isLogged();
                $this->additionalServiceDAO->update($service, $update_by);
                $this->reservationDAO->update($reservation, $update_by);
                $servicexmobileParasol->setIdService($service->getId());
                $servicexmobileParasol->setIdMobileParasol($mobileParasol->getId());
                $this->servicexmobileParasolDAO->add($servicexmobileParasol);
                $flag++;                
            }
            if ($flag > 0) {
                return false;
            } else {
                return true;
            }
        }

            
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
                if ($answer == "yes"){
                    $this->addSelectServicePath($id_reserve, null, null);
                } else {
                    // vista a pagar
                }
            }
        }

        public function optionsDistributor($service, $id_reserve) {
            if ($service == "parasol") {
                $this->addMobileParasolPath($id_reserve, null, null, null);
            }
            else if ($service == "locker") {
                $this->addLockerPath($id_reserve, null, null, null);
            }
            else if ($service == "parking") {
                $this->parkingController->parkingMap($id_reserve, null);
            }

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
                
                $lockers = array();


                
                    foreach ($reservations as $reservation) {
                        
                        $service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        $flag = 1;
                        $lockerServ = $this->servicexlockerDAO->getLockerByService($service->getId());

                        if($lockerServ == false){
                            $flag = 0;
                        }


                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($flag == 1) ) {
                             
                            foreach ($lockerServ as $lock) {
                                array_push($lockers, $lock);
                            }
                                  
                                   
                            
                        } else if ( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($flag == 1)  ) {
                            foreach ($lockerServ as $lock) {
                                if(($reservation->getDateEnd() < $reserve->getDateStart()) xor ($reservation->getDateStart() > $reserve->getDateEnd())){ 
                                    array_push($lockers, $lock);
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
                    if (($exist == false) && ($locker->getSex() == "mujer") ){
                        array_push($lockerWomanList, $locker);
                    }
                    else if (($exist == false) && ($locker->getSex() == "hombres")){
                        array_push($lockerManList, $locker);
                    }
                    $exist = false;
                }

            
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-locker.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function addMobileParasolPath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de sombrilla movil";
                
                $reserveTemp = new Reservation();
                $reserveTemp->setId($id_reservation);
                $reserve = $this->reservationDAO->getById($reserveTemp);
                $reservations = $this->reservationDAO->getAll();
                $listMobileParasoles = $this->mobileParasolDAO->getAll();
                
                $mobileParasoles = array();


                
                    foreach ($reservations as $reservation) {
                        
                        $service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        $flag = 1;
                        $mobileParasolServ = $this->servicexmobileParasolDAO->getMobileParasolByService($service->getId());

                        if($mobileParasolServ == false){
                            $flag = 0;
                        }


                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($flag == 1) ) {
                             
                            foreach ($mobileParasolServ as $mobileParasol) {
                                array_push($mobileParasoles, $mobileParasol);
                            }
                                  
                                   
                            
                        } else if ( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($flag == 1)  ) {
                            foreach ($mobileParasolServ as $mobileParasol) {
                                if(($reservation->getDateEnd() < $reserve->getDateStart()) xor ($reservation->getDateStart() > $reserve->getDateEnd())){ 
                                    array_push($mobileParasoles, $mobileParsol);
                                }
                            }
                        }
                    } 
                $mobileParasolFinalList = array();
                $exist=false;
                
                foreach ($listMobileParasoles as $mobileParasol){
                    foreach ($mobileParasoles as $mobileParasol2){
                        
                        if ($mobileParasol->getId() == $mobileParasol2->getId()){
                            $exist=true;
                        }
                    }
                    if ($exist == false){
                        array_push($mobileParasolFinalList, $mobileParasol);
                    }
                    $exist = false;
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