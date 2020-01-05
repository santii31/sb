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

        private function add($description, $price) {

            $additionalService = new AdditionalService();
            $additionalService->setDescription($description);
            $additionalService->setPrice($price);            

            if ($this->additionalServiceDAO->add($additionalService)) {
                return true;
            } else {
                return false;
            }
        }

        public function addService($description, $price) {
            if ($this->isFormRegisterNotEmpty($description, $price)) {
                $serviceTemp = new AdditionalService();
                $serviceTemp->setDescription($description);                

                // arreglar ? - agrega dos servicios iguales
				if ($this->additionalServiceDAO->getByDescription($serviceTemp) == null) {                                        
                    $service = $this->add($description, $price);
                    if ($service) {                                                
                        return $this->addServicePath(null, SERVICE_ADDED);
                    } else {                        
                        return $this->addServicePath(DB_ERROR, null);        
                    }
                }                
                return $this->addServicePath(SERVICE_ERROR, null);
            }            
            return $this->addServicePath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($description, $price) {
            if (empty($description) || empty($price)) {
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

        public function listServicetPath($alert = "", $success = "") {
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