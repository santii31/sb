<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use Models\Locker as Locker;
    use Models\Parasol as Parasol;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use DAO\ParasolDAO as ParasolDAO;
    use DAO\LockerDAO as LockerDAO;
    use DAO\ReservationDAO as ReservationDAO;
    use DAO\ServicexLocker as ServicexLocker;
    use DAO\ServicexParasol as ServicexParasol;
    use DAO\ReservationxService as ReservationxService;
    use Controllers\AdminController as AdminController;  

    class AdditionalServiceController {

        private $additionalServiceDAO;
        private $servicexlockerDAO;
        private $servicexparasolDAO;
        private $adminController;

        public function __construct() {
            $this->additionalServiceDAO = new AdditionalServiceDAO();
            $this->parasolDAO = new ParasolDAO();
            $this->lockerDAO = new LockerDAO();
            $this->reservationDAO = new ReservationDAO();
            $this->servicexlockerDAO = new ServicexLockerDAO();
            $this->servicexparasolDAO = new ServicexParasolDAO();
            $this->reservationxserviceDAO = new ReservationxService();
            $this->adminController = new AdminController();
        }

        private function add($description, $locker, $parasol) {

            
            $total = 0;
            $flag1 = FALSE;
            $flag2 = FALSE;
            $description_s = filter_var($description, FILTER_SANITIZE_STRING);

            $additionalService = new AdditionalService();
            $additionalService->setDescription( strtolower($description_s) );
            
            $servicexlocker = new ServicexLocker();
            $servicexparasol = new ServicexParasol();

            if(!empty($locker)) {
                $total = $total + $locker->getPrice();
                $flag1 = TRUE;
            }

            if(!empty($parasol)) {
                $total = $total + $parasol->getPrice();
                $flag2 = TRUE;
            }

            if($flag1 || $flag2) {
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
            }


            if ($lastId == false) {
                return false;
            } else {
                return true;
            }
        }

        public function addService($description, $locker, $parasol) {
            if ($this->isFormRegisterNotEmpty($description, $locker, $parasol)) {   
                                                                             
                $serviceTemp = new AdditionalService();
                $serviceTemp->setDescription( strtolower($description) );                
                
				if ($this->additionalServiceDAO->getByDescription($serviceTemp) == null) {                                                       
                    if ($this->add($description, $locker, $parasol)) {                                                
                        return $this->addServicePath(null, SERVICE_ADDED);
                    } else {                        
                        return $this->addServicePath(DB_ERROR, null);        
                    }
                }                
                return $this->addServicePath(SERVICE_ERROR, null);
            }            
            return $this->addServicePath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($description, $locker, $parasol) {
            if (empty($description) ) {
                return false;
            }
            if (empty($locker) || empty($parasol)) {
                return false;
            }

            return true;
        }        

        public function addServicePath($alert = "", $success = "", $id_reservation) {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Añadir servicio adicional";
                
                $reservations = $this->reservationDAO->getAll();
                $parasoles1 = $this->parasolesDAO->getAll();
                $lockers1 = $this->lockerDAO->getAll();
                $lockers = array();
                $parasoles = array();
                foreach($reservations as $reservation) {
                    foreach($lockers1 as $locker) {
                        if( ($reservation->getAvailability() == true) && ($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) != false ) && ($this->servicexlockerDAO->getLockerByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) )->getId() == $locker->getId() ) {

                        }else {
                            array_push($lockers, $locker);       
                        }
                    } 
                }

                foreach($reservations as $reservation) {
                    foreach($parasoles1 as $parasol) {
                        if( ($reservation->getAvailability() == true) && ($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) != false ) && ($this->servicexparasolDAO->getParasolByService($this->reservationxserviceDAO->getServiceByReservation($reservation->getId()) )->getId() == $parasol->getId() ) {

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
			if ($this->isFormRegisterNotEmpty($total, $description)) {                     
                                                                             
                $serviceTemp = new AdditionalService();
                $serviceTemp->setId($id);                
                $serviceTemp->setDescription( strtolower($description) );                

				if ($this->additionalServiceDAO->checkDescription($serviceTemp) == null) { 
                    
                    // aca? o arriba del if?
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