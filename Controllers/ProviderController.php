<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;  
    use DAO\ProviderDAO as ProviderDAO;

    class ProviderController {

        private $providerDAO;
        private $adminController;

        public function __construct() {
            $this->providerDAO = new providerDAO();
            $this->adminController = new AdminController();
        }     
        
        private function add($id, $name, $lastName, $phone, $email, $dni, $address, $cuil_number, $social_reason, $billing, $isActive) {
            $provider = new Provider();
            $provider->setId($id);
            $provider->setName($name);
            $provider->setLastName($lastName);
            $provider->setPhone($phone);
            $provider->setEmail($email);
            $provider->setDni($dni);
            $provider->setAddress($address);
            $provider->setCuilNumber($cuil_number);
            $provider->setSocialReason($social_reason);
            $provider->setBilling($billing);
            $provider->setIsActive($isActive);			
            if ($this->providerDAO->add($provider)) {
                return $provider;
            } else {
                return false;
            }
        }

        public function addProviderPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir proveedor";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-provider.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
		}

        public function listProviderPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Proveedores";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-providers.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

    }
    
?>