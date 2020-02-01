<?php

    namespace Controllers;    

    use Models\Locker as Locker;
    use Models\Parking as Parking;
    use Models\Reservation as Reservation;
    use Models\MobileParasol as MobileParasol;
    use Models\ServicexLocker as ServicexLocker;
    use Models\AdditionalService as AdditionalService;
    use Models\ReservationxService as ReservationxService;
    use Models\ServicexMobileParasol as ServicexMobileParasol;    
    use DAO\ClientDAO as ClientDAO;
    use DAO\LockerDAO as LockerDAO;
    use DAO\ParkingDAO as ParkingDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\MobileParasolDAO as MobileParasolDAO;
    use DAO\ServicexLockerDAO as ServicexLockerDAO;
    use DAO\ServicexParkingDAO as ServicexParkingDAO;
    use DAO\ServicexParasolDAO as ServicexParasolDAO;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ReservationxServiceDAO as ReservationxServiceDAO;
    use DAO\ServicexMobileParasolDAO as ServicexMobileParasolDAO;
    use Controllers\AdminController as AdminController;
    use Controllers\ParkingController as ParkingController; 
    use Controllers\ReservationController as ReservationController; 

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


        public function addLocker($id_locker_man = "", $id_locker_woman = "", $price, $id_reserve, $fromList = null) {
            
            $reservationTemp = new Reservation();
            $reservationTemp->setId($id_reserve);
            $servicexlockerW = new ServicexLocker();
            $servicexlockerM = new ServicexLocker();
            
            if ($reservation = $this->reservationDAO->getById($reservationTemp)) {
            
                if (!empty($id_locker_man) || !empty($id_locker_woman)) {
                    
                    $flag = 0;

                    if ($service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve)) {                

                        if (!empty($id_locker_man) && empty($id_locker_woman)) {
                            $lockerMan = new Locker();
                            
                            $lockerMan->setId($id_locker_man);
                            
                            if ($locker = $this->lockerDAO->getById($lockerMan)) {

                                if ($price != 0) {

                                    $totalService = $service->getTotal() + $price;
                                    $totalReserve = $reservation->getPrice() + $price;
                                    
                                    $service->setTotal($totalService);
                                    $reservation->setPrice($totalReserve);                    
                                    $update_by = $this->adminController->isLogged();
        
                                    if ($this->additionalServiceDAO->update($service, $update_by)) {
                                        if ($this->reservationDAO->update($reservation, $update_by)) {
        
                                            $servicexlockerM->setIdService($service->getId());
                                            $servicexlockerM->setIdLocker($locker->getId());                    
                                        
                                            if ($this->servicexlockerDAO->add($servicexlockerM)) {
                                                $flag++;
                                            }    
                                        }
                                    }

                                } else {
                                    $servicexlockerM->setIdService($service->getId());
                                    $servicexlockerM->setIdLocker($locker->getId());               
                                    if ($this->servicexlockerDAO->add($servicexlockerM)) {
                                        $flag++;
                                    }
                                }
                            }                                                        
                        }

                        if (!empty($id_locker_woman) && empty($id_locker_man)) {
                            $lockerWoman = new Locker();
                            
                            $lockerWoman->setId($id_locker_woman);
                            
                            if ($locker = $this->lockerDAO->getById($lockerWoman)) {

                                if ($price != 0) {
                                    
                                    $totalService = $service->getTotal() + $price;
                                    $totalReserve = $reservation->getPrice() + $price;
                                    
                                    $service->setTotal($totalService);
                                    $reservation->setPrice($totalReserve);                            
                                    $update_by = $this->adminController->isLogged();
                                    
                                    if ($this->additionalServiceDAO->update($service, $update_by)) {

                                        if ($this->reservationDAO->update($reservation, $update_by)) {

                                            $servicexlockerW->setIdService($service->getId());
                                            $servicexlockerW->setIdLocker($locker->getId());      

                                            if ($this->servicexlockerDAO->add($servicexlockerW)) {
                                                $flag++;
                                            }
                                        }
                                    }  

                                } else {
                                    $servicexlockerW->setIdService($service->getId());
                                    $servicexlockerW->setIdLocker($locker->getId());               
                                    if ($this->servicexlockerDAO->add($servicexlockerW)) {
                                        $flag++;
                                    }
                                }                              
                            }                            
                        }

                        if (!empty($id_locker_woman) && !empty($id_locker_man)) {                            

                            $lockerWoman = new Locker();
                            $lockerMan = new Locker();
                            $lockerWoman->setId($id_locker_woman);
                            
                            if ($lockerW = $this->lockerDAO->getById($lockerWoman)) {

                                $lockerMan->setId($id_locker_man);
                                
                                if ($lockerM = $this->lockerDAO->getById($lockerMan)) {

                                    if ($price != 0) {
                                        $totalService = $service->getTotal() + $price;
                                        $totalReserve = $reservation->getPrice() + $price;
                                        
                                        $service->setTotal($totalService);
                                        $reservation->setPrice($totalReserve);                            
                                        $update_by = $this->adminController->isLogged();                                                                                                      
                                        if ($this->additionalServiceDAO->update($service, $update_by)) {

                                            if ($this->reservationDAO->update($reservation, $update_by)) {

                                                $servicexlockerW->setIdService($service->getId());
                                                $servicexlockerW->setIdLocker($lockerW->getId());
                    
                                                $servicexlockerM->setIdService($service->getId());
                                                $servicexlockerM->setIdLocker($lockerM->getId());

                                                if ($this->servicexlockerDAO->add($servicexlockerW)) {

                                                    if ($this->servicexlockerDAO->add($servicexlockerM)) {
                                                        $flag++;
                                                    }
                                                }
                                            }
                                        }   

                                    } else {

                                        $servicexlockerW->setIdService($service->getId());
                                        $servicexlockerW->setIdLocker($lockerW->getId());
                    
                                        $servicexlockerM->setIdService($service->getId());
                                        $servicexlockerM->setIdLocker($lockerM->getId());

                                        if ($this->servicexlockerDAO->add($servicexlockerW)) {

                                            if ($this->servicexlockerDAO->add($servicexlockerM)) {
                                                $flag++;
                                            }
                                        }
                                    }                                      
                                }                                
                            }
                        }                              
                    }
                }
            }            

            if ($fromList != null) {                
                if ($flag > 0) { 
                    return $this->reservationController->listReservationPath(1, null, null, "Locker añadido con exito");                         
                } else {
                    return $this->reservationController->listReservationPath(1, null, DB_ERROR, null);                         
                }                
            } else {
                if ($flag > 0) {                                
                    return $this->hasAdditionalService($id_reserve, null, null, null);
                } else {
                    return $this->addLockerPath($id_reserve, null, DB_ERROR, null);
                }
            }
        }

        public function addParasol($id_mobileParasol = "", $price, $id_reserve, $fromList = null) {            
            if (!empty($id_mobileParasol)) {
                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reserve);
                
                if ($reservation = $this->reservationDAO->getById($reservationTemp)) {
                    
                    $flag = 0;

                    if ($service = $this->reservationxserviceDAO->getServiceByReservation($id_reserve)) {

                        $mobileParasolTemp = new MobileParasol();
                        $servicexmobileParasol = new ServicexMobileParasol();
                        $mobileParasolTemp->setId($id_mobileParasol);
                        
                        if ($mobileParasol = $this->mobileParasolDAO->getById($mobileParasolTemp)) {

                            if ($price != 0) {

                                $totalService = $service->getTotal() + $price;
                                $totalReserve = $reservation->getPrice() + $price;
                                $service->setTotal($totalService);
                                $reservation->setPrice($totalReserve);
                                $update_by = $this->adminController->isLogged(); 
    
                                if ($this->reservationDAO->update($reservation, $update_by)) {

                                    if ($this->additionalServiceDAO->update($service, $update_by)) {

                                        $servicexmobileParasol->setIdService($service->getId());
                                        $servicexmobileParasol->setIdMobileParasol($mobileParasol->getId());
                                        
                                        if ($this->servicexmobileParasolDAO->add($servicexmobileParasol)) {                                       
                                            
                                            if ($fromList != null) {                
                                            
                                                return $this->reservationController->listReservationPath(1, null, null, "Sombrilla añadida con exito");     

                                            } else {
                                            
                                                return $this->hasAdditionalService($id_reserve);                                        
                                            }                                                        
                                            
                                        }
                                    }
                                }
                            } else {
                                
                                $servicexmobileParasol->setIdService($service->getId());
                                $servicexmobileParasol->setIdMobileParasol($mobileParasol->getId());
                                
                                if ($this->servicexmobileParasolDAO->add($servicexmobileParasol)) {                                       
                                    
                                    if ($fromList != null) {                
                                    
                                        return $this->reservationController->listReservationPath(1, null, null, "Sombrilla añadida con exito");     
                                    } else {
                                    
                                        return $this->hasAdditionalService($id_reserve);                                        
                                    }                                                        
                                    
                                }              
                            } 
                        }
                    }                        
                }               
            }
            return $this->addMobileParasolPath($id_reserve, DB_ERROR);
        }

        public function addLockerPath($id_reservation = "", $fromList = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de locker";                
                $reserveTemp = new Reservation();
                $reserveTemp->setId($id_reservation);
                $reserve = $this->reservationDAO->getById($reserveTemp);
                $reservations = $this->reservationDAO->getAllAux();
                $listLockers = $this->lockerDAO->getAll();                
                $lockers = array();
                
                foreach ($reservations as $reservation) {
                    
                    $service = $this->reservationxserviceDAO->getServiceByReservation($reservation->getId());

                    $flag = 1;
                    $lockerServ = $this->servicexlockerDAO->getLockerByService($service->getId());

                    if($lockerServ == false){
                        $flag = 0;
                    }

                    if (($this->checkDatesToServices($reservation, $reserve) == 0) && ($flag == 1)) {
                        foreach ($lockerServ as $lock) {
                            array_push($lockers, $lock);
                        }
                    }

                } 
                
                $lockerManList = array();
                $lockerWomanList = array();
                $exist = false;
                
                foreach ($listLockers as $locker) {
                    
                    foreach ($lockers as $locker2) {
                        
                        if ($locker->getId() == $locker2->getId()) {                            
                            $exist=true;
                        }
                    }

                    if (($exist == false) && ($locker->getSex() == "mujer") ) {
                        array_push($lockerWomanList, $locker);
                    }
                    else if (($exist == false) && ($locker->getSex() == "hombres")) {
                        array_push($lockerManList, $locker);
                    }
                    $exist = false;
                }

                if (!empty($lockerWomanList) || !empty($lockerManList)) {                  
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "add-locker.php");
                    require_once(VIEWS_PATH . "footer.php");

                } else {
                    return $this->hasAdditionalService($id_reservation);
                }    
			} else {                
                return $this->adminController->userPath();
			}
        }
        
        public function addMobileParasolPath($id_reservation = "", $fromList = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                
                
                $title = "Seleccione numero de sombrilla movil";                
                $reserveTemp = new Reservation();
                $reserveTemp->setId($id_reservation);
                $reserve = $this->reservationDAO->getById($reserveTemp);                
                $reservations = $this->reservationDAO->getAllAux();
                $listMobileParasoles = $this->mobileParasolDAO->getAll();
                
                $mobileParasoles = array();
                
                foreach ($reservations as $reservation) {
                    
                    $service = $this->reservationxserviceDAO->getServiceByReservation( $reservation->getId() );
                                        
                    $flag = 1;
                    $mobileParasolServ = $this->servicexmobileParasolDAO->getMobileParasolByService( $service->getId() );

                    if ($mobileParasolServ == false){
                        $flag = 0;
                    }
                    
                    if (($this->checkDatesToServices($reservation, $reserve) == 0) && ($flag == 1)) {                        
                        foreach ($mobileParasolServ as $mobileParasol) {                                                    
                            array_push($mobileParasoles, $mobileParasol);
                        } 
                    }

                } 
                
                $mobileParasolFinalList = array();
                $exist = false;                

                foreach ($listMobileParasoles as $mobileParasol) {
                    foreach ($mobileParasoles as $mobileParasol2) {                        
                        if ($mobileParasol->getId() == $mobileParasol2->getId()) {
                            $exist = true;
                        }
                    }
                    if ($exist == false) {
                        array_push($mobileParasolFinalList, $mobileParasol);
                    }
                    $exist = false;
                }        

                if (!empty($mobileParasolFinalList)) { 
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "add-parasol.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->hasAdditionalService($id_reservation);
                }                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        private function checkDatesToServices($reserveFromList, $reserve) {
            $flag = 1;
            if ( ($reserve->getDateEnd() < $reserveFromList->getDateStart()) xor ($reserve->getDateStart() > $reserveFromList->getDateEnd())) {
                $flag *= 1;	
            } else {
                $flag *= 0;
            }                    

            return $flag;
        }

        public function hasAdditionalService($id_reservation, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                if (!empty($id_reservation)) { 
                    $title = "¿Desea agregar un servicio adicional a la reserva?";
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "has-additional-service.php");
                    require_once(VIEWS_PATH . "footer.php");
                }                      
			} else {                
                return $this->adminController->userPath();
			}
        }
    
        public function chose($id_reserve, $answer) {                        
            if (!empty($answer) && !empty($id_reserve)) {
                if ($answer == "yes") {
                    return $this->addSelectServicePath($id_reserve, null, null);
                } else {
                    return $this->payPath($id_reserve);
                }                
            }
            return $this->hasAdditionalService($id_reserve, EMPTY_FIELDS, null);
        }

        public function optionsDistributor($service, $id_reserve) {
            if ($service == "parasol") {
                return $this->addMobileParasolPath($id_reserve, null, null, null);
            }
            else if ($service == "locker") {
                return $this->addLockerPath($id_reserve, null, null);
            }
            else if ($service == "parking") {
                return $this->parkingController->parkingMap($id_reserve, null, null, null);
            }
            return $this->addSelectServicePath($id_reserve, DB_ERROR);
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

        public function payPath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Realizar pago";                
                $reservationTemp = new Reservation();
                $reservationTemp->setId($id_reservation);
                $reservation = $this->reservationDAO->getById($reservationTemp);
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-payment-method.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }  

        public function addServiceWithoutParking($id_reservation) {
            if ($admin = $this->adminController->isLogged()) {    
                $additionalService = new AdditionalService();
                $reservationxservice = new ReservationxService();
                $additionalService->setTotal(0);
                $register_by = $this->adminController->isLogged();            

                if ($lastId = $this->additionalServiceDAO->add($additionalService, $register_by)) {
                    $reservationxservice->setIdReservation($id_reservation);
                    $reservationxservice->setIdService($lastId);
                    if ($this->reservationxserviceDAO->add($reservationxservice)) {
                        $this->hasAdditionalService($id_reservation, null, null);    
                    } else {
                        $this->parkingController->parkingMap($reservation, null, null, DB_ERROR);
                    }
                } else {
                    $this->parkingController->parkingMap($reservation, null, null, DB_ERROR);
                }
            } else {                
                return $this->adminController->userPath();
            }
        }
    
    }
    
?>