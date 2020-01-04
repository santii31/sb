<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;

    class HomeController {

        private $adminController;

        public function __construct() {        
            $this->adminController = new AdminController();
        }

        public function Index($alert = "") {        
            if (!$this->adminController->isLogged()) {    
                $title = 'Bienvenido!';			
                require_once(VIEWS_PATH . "index.php");                         
            } else {
                return $this->adminController->dashboard();
            }
        }
        
    }
    
?>
