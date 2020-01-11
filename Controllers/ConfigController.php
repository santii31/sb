<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;

    class ConfigController {

        private $adminController;

        public function __construct() {        
            $this->adminController = new AdminController();
        }

        public function updateValuesPath($alert = "", $success = "") {        
            if ($admin = $this->adminController->isLogged()) {    
                
                $title = "Configuracion - Actualizar";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "config.php");
                require_once(VIEWS_PATH . "footer.php");

            } else {
                return $this->adminController->userPath();
            }
        }


    }
    
?>
