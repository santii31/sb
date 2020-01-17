<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use Models\Locker as Locker;
    use Models\Parasol as Parasol;
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\ServicexLocker as ServicexLocker;
    use Models\ServicexParasol as ServicexParasol;
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
    use Controllers\ParkingController as ParkingController; 

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
        private $parkingController;
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

        public function addParasol($id_parasol = "",$id_reserve) {
            
            if (!empty($id_parasol)) {
                $total = 0;
                $flag=0;
                $service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve);
                 
                $parasolTemp = new Parasol();
                $servicexparasol = new ServicexParasol();
                $parasolTemp->setId($id_parasol);
                $parasol = $this->parasolDAO->getById($parasolTemp);
                     
                $total = $service->getTotal() + $parasol->getPrice();
                $service->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $this->additionalServiceDAO->update($service, $update_by);
                $servicexparasol->setIdService($service->getId());
                $servicexparasol->setIdParasol($parasol->getId());
                $this->servicexparasolDAO->add($servicexparasol);
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



        public function addParasolPath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de sombrilla";
                
                $reserveTemp = new Reservation();
                $reserveTemp->setId($id_reservation);
                $reserve = $this->reservationDAO->getById($reserveTemp);
                $reservations = $this->reservationDAO->getAll();
                $listParasoles = $this->parasolDAO->getAll();
                
                $parasoles = array();


                
                    foreach ($reservations as $reservation) {
                        
                        $service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());
                        $flag = 1;
                        $parasolServ = $this->servicexparasolDAO->getParasolByService($service->getId());

                        if($parasolServ == false){
                            $flag = 0;
                        }


                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($flag == 1) ) {
                             
                            foreach ($parasolServ as $parasol) {
                                array_push($parasoles, $parasol);
                            }
                                  
                                   
                            
                        } else if ( ($this->reservationController->checkIsDateReserved($reservation) == false) && ($flag == 1)  ) {
                            foreach ($parasolServ as $parasol) {
                                if(($reservation->getDateEnd() < $reserve->getDateStart()) xor ($reservation->getDateStart() > $reserve->getDateEnd())){ 
                                    array_push($parasoles, $parsol);
                                }
                            }
                        }
                    } 
                
                $parasolFinalList = array();
                $exist=false;
                
                foreach ($listParasoles as $parasol){
                    foreach ($parasoles as $parasol2){
                        
                        if ($parasol->getId() == $parasol2->getId()){
                            $exist=true;
                        }
                    }
                    if ($exist == false){
                        array_push($parasolFinalList, $parasol);
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