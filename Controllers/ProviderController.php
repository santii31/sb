<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;  

    class ProviderController {

        private $providerDAO;
        private $adminController;

        public function __construct() {
            // $this->providerDAO = new providerDAO();
            $this->adminController = new AdminController();
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