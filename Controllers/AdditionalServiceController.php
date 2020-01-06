<?php

    namespace Controllers;    

    use Models\AdditionalService as AdditionalService;
    use DAO\AdditionalServiceDAO as AdditionalServiceDAO;
    use Controllers\AdminController as AdminController;  

    class AdditionalServiceController {

        private $additionalServiceDAO;
        private $adminController;

        public function __construct() {
            $this->additionalServiceDAO = new AdditionalServiceDAO();
            $this->adminController = new AdminController();
        }

        private function add($description, $total) {
            $additionalService = new AdditionalService();
            $additionalService->setDescription( strtolower($description) );
            $additionalService->setTotal($total);            

            if ($this->additionalServiceDAO->add($additionalService)) {
                return true;
            } else {
                return false;
            }
        }

        public function addService($description, $total) {
            if ($this->isFormRegisterNotEmpty($description, $total)) {   
                                                                             
                $serviceTemp = new AdditionalService();
                $serviceTemp->setDescription( strtolower($description) );                
                
				if ($this->additionalServiceDAO->getByDescription($serviceTemp) == null) {                                                       
                    if ($this->add($description, $total)) {                                                
                        return $this->addServicePath(null, SERVICE_ADDED);
                    } else {                        
                        return $this->addServicePath(DB_ERROR, null);        
                    }
                }                
                return $this->addServicePath(SERVICE_ERROR, null);
            }            
            return $this->addServicePath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($description, $total) {
            if (empty($description) || empty($total)) {
                return false;
            }
            return true;
        }        

        public function addServicePath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Añadir servicio adicional";
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
                if ($this->additionalServiceDAO->enableById($service)) {
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
                if ($this->additionalServiceDAO->disableById($service)) {
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
                $title = "Modificar informacion";       
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
                $serviceTemp->setDescription( strtolower($description) );                
                
                // comprobar la descripcion, igual que proveedores con email (checkEmail)
				if ($this->additionalServiceDAO->checkDescription($serviceTemp) == null) {                                         
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setDescription( strtolower($description) );
                    $additionalService->setTotal($total); 

                    if ($this->additionalServiceDAO->update($additionalService)) {                                                
                        return $this->listServicePath(null, SERVICE_UPDATE);
                    } else {                                                
                        return $this->listServicePath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, "descripcion utilizada");
            }            
            return $this->updatePath($id, EMPTY_FIELDS);
        }        

    }
    
?>