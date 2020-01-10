<?php

    namespace Controllers;    
    
    use Controllers\AdminController as AdminController;  

    class ParkingController {

        private $parkingDAO;
        private $adminController;

        public function __construct() {
            // $this->parkingDAO = new ParkingDAO();
            $this->adminController = new AdminController();
        }

        public function 

        public function parkingMap() {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Plano de cocheras";       
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "parking.php");
                require_once(VIEWS_PATH . "footer.php"); 
            } else {
                return $this->adminController->userPath();
            }
        }
        
    }
    
?>
