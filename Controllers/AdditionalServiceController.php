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

            if (!empty($locker)) {
                
                $total = $additionalService->getTotal() + $locker->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexlocker->setIdService($additionalService->getId());
                $servicexlocker->setIdLocker($locker->setId());

                if ($this->servicexlockerDAO->add($servicexlocker)) {
                    return true;
                }
                return false;
            }            
            return false;
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
            
            if (!empty($parasol)) {
                
                $total = $additionalService->getTotal() + $parasol->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexparasol->setIdService($additionalService->getId());
                $servicexparasol->setIdParasol($parasol->setId());

                if ($this->servicexparasolDAO->add($servicexparasol)) {
                    return true;
                }
                return false;
            }            
            return false;
        }

        private function addServiceWithParking($description, $parking, $id_reservation) {
            $total = 0;
            $description_s = filter_var($description, FILTER_SANITIZE_STRING);
            $additionalService = new AdditionalService();
            $servicexParking = new ServicexParking();
            $reservationxservice = new ReservationxService();
            $additionalService->setDescription( strtolower($description_s) );
            
            if (!empty($parking)) {
                
                $total = $total + $parking->getPrice();
                $additionalService->setTotal($total);
                $register_by = $this->adminController->isLogged();
                
                if ($lastId = $this->additionalServiceDAO->add($additionalService, $register_by)) {
                    
                    $reservationxservice->setIdReservation($id_reservation);
                    $reservationxservice->setIdService($lastId);
                    $reservationxserviceDAO->add($reservationxservice);
                    $servicexparking->setIdService($lastId);
                    $servicexparking->setIdParking($parking->setId());

                    if ($this->servicexparkingDAO->add($servicexparking)) {
                        return true; 
                    }
                } else {
                    return false;
                }
            }            
        }

        private function addParking(AdditionalService $additionalService, $parking) {
            $total = 0;
            $servicexParking = new ServicexParking();
            if (!empty($parking)) {
                $total = $additionalService->getTotal() + $parking->getPrice();
                $additionalService->setTotal($total);
                $update_by = $this->adminController->isLogged();
                $additionalServiceDAO->update($additionalService, $update_by);
                $servicexparking->setIdService($additionalService->getId());
                $servicexparking->setIdParking($parking->setId());
                if ($this->servicexparkingDAO->add($servicexparking)) {
                    return true;
                }
                return false;
            }
            return false;
        }


        /*private function add($description, $locker, $parasol, $parking) {

            
            $total = 0;
            $flag1 = FALSE;
            $flag2 = FALSE;
            $description_s = filter_var($description, FILTER_SANITIZE_STRING);

            $additionalService = new AdditionalService();
            $additionalService->setDescription( strtolower($description_s) );
            
            $servicexlocker = new ServicexLocker();
            $servicexparasol = new ServicexParasol();
            $servicexparking = new ServicexParking();

            if(!empty($locker)) {
                $total = $total + $locker->getPrice();
                $flag1 = TRUE;
            }

            if(!empty($parasol)) {
                $total = $total + $parasol->getPrice();
                $flag2 = TRUE;
            }

            if(!empty($parking)) {
                $total = $total + $parking->getPrice();
                $flag3 = TRUE;
            }

            if($flag1 || $flag2 || $flag3) {
                $additionalService->setTotal($total);
                $register_by = $this->adminController->isLogged();
                $lastId = $this->additionalServiceDAO->add($additionalService, $register_by);
                if($flag1) {
                    $servicexlocker->setIdService($lastId);
                    $servicexlocker->setIdLocker($locker->setId());
                    $this->servicexlockerDAO->add($servicexlocker);
                }
                if($flag2) {
                    $servicexparasol->setIdService($lastId);
                    $servicexparasol->setIdParasol($parasol->getId());
                    $this->servicexparasolDAO->add($servicexparasol);
                }
                if($flag3) {
                    $servicexparking->setIdService($lastId);
                    $servicexparking->setIdParking($parking->getId());
                    $this->servicexparkingDAO->add($servicexparking);
                }
            }


            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }*/

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

        private function isFormRegisterNotEmpty($description, $locker, $parasol, $parking) {            
            if (empty($description) || empty($locker) || empty($parasol) || empty($parking)) {
                return false;
            }
            return true;
        }        

        private function isFormUpdateNotEmpty($description, $price) {            
            if (empty($description) || empty($price)) {
                return false;
            }
            return true;
        }   
        

        /*public function addServicePath($alert = "", $success = "", $id_reservation=NULL) {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Añadir servicio adicional";
                
                
                $clients = $this->clientDAO->getAll();
                $parasoles1 = $this->parasolDAO->getAll();
                $parasoles = array();

                $reservations = $this->reservationDAO->getAll();
                $lockers1 = $this->lockerDAO->getAll();
                $lockers = array();
                foreach($reservations as $reservation) {
                    foreach($lockers1 as $locker) {
                        if( ($reservation->getAvailability() == true) && ($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) != false ) && ($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()))->getId() == $locker->getId())) {

                        } else {
                            array_push($lockers, $locker);       
                        }
                    } 
                }

                foreach($reservations as $reservation) {
                    foreach($parasoles1 as $parasol) {
                        if( ($reservation->getAvailability() == true) && ($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) != false ) && ($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) )->getId() == $parasol->getId() )) {

                        }else {
                            array_push($parasoles, $parasol);       
                        }
                    } 
                }

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-service.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }*/


        public function addSelectServicePath($id_reservation = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Seleccione servicio adicional";
                if (empty($id_reservation)) {
                    $clientList = $this->clientDAO->getAll();
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "select-service-client.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "select-service.php");
                    require_once(VIEWS_PATH . "footer.php");
                }                   
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function addLockerPath($id_reservation = "", $id_client = "", $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                                                       
                $title = "Seleccione numero de locker";
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
                
                var_dump($reserve);
                $reservations = $this->reservationDAO->getAll();
                $listLockers = $this->lockerDAO->getAll();
                $lockers = array();
                foreach($listLockers as $locker) {
                    foreach($reservations as $reservation) {
                        if( ($this->reservationController->checkIsDateReserved($reservation)) && ($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId()) != false ) ) {
                            if($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId())->getNumber() == $locker->getNumber()) {

                            }
                        }else if( ($this->reservationController->checkIsDateReserved($reservation)) && ($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId()) != false ) ) {
                            if($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId())->getNumber() == $locker->getNumber()) {
                                if($reserve->getDateEnd() >= $reservation->getDateStart()) {

                                }
                            }
                        }else{
                            array_push($lockers, $locker);       
                        }
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
                $listParasol = $this->parasolDAO->getAll();
                $parasoles = array();
                foreach($listParasol as $parasol) {
                    foreach($reservations as $reservation) {
                        if( ($reservation->getAvailability() == true) && ($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId()) != false ) ) {
                            if($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId())->getNumber() == $parasol->getNumber()) {

                            }
                        }else if( ($reservation->getAvailability() == false) && ($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId()) != false ) ) {
                            if($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId())->getId())->getNumber() == $parasol->getNumber()) {
                                if($reserve->getDateEnd() >= $reservation->getDateStart()) {

                                }
                            }
                        }else{
                            array_push($parasoles, $parasol);       
                        }
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
                require_once(VIEWS_PATH . "parking.php");
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

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $service = new AdditionalService();
                $service->setId($id);
                if ($this->additionalServiceDAO->enableById($service, $admin)) {
                    return $this->listServicePath(null, SERVICE_ENABLE);
                } else {
                    return $this->listServicePath(DB_ERROR, null);
                }
            } else {
                return $this->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $service = new AdditionalService();
                $service->setId($id);
                if ($this->additionalServiceDAO->disableById($service, $admin)) {
                    return $this->listServicePath(null, SERVICE_DISABLE);
                } else {
                    return $this->listServicePath(DB_ERROR, null);
                }              
            } else {
                return $this->userPath();
            }                
        }

        public function updatePath($id_service, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Servicios - Modificar informacion";       
                $service = new AdditionalService();
                $service->setId($id_service);                
                $srv = $this->additionalServiceDAO->getById($service);    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-service.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }        

        public function update($id, $description, $total) {
			if ($this->isFormUpdateNotEmpty($total, $description)) {                     
                                                                             
                $serviceTemp = new AdditionalService();
                $serviceTemp->setId($id);                
                $serviceTemp->setDescription( strtolower($description) );                

				if ($this->additionalServiceDAO->checkDescription($serviceTemp) == null) { 
                                        
                    $description_s = filter_var($description, FILTER_SANITIZE_STRING);
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setId($id);                
                    $additionalService->setDescription( strtolower($description_s) );
                    $additionalService->setTotal($total); 

                    $update_by = $this->adminController->isLogged();

                    if ($this->additionalServiceDAO->update($additionalService, $update_by)) {                                                
                        return $this->listServicePath(null, SERVICE_UPDATE);
                    } else {                                                
                        return $this->listServicePath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, SERVICE_ERROR);
            }            
            return $this->updatePath($id, EMPTY_FIELDS);
        }        

    }
    
?>