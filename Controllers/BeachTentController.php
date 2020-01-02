<?php

    namespace Controllers;    

    use Models\BeachTent as BeachTent;
	use DAO\BeachTentDAO as BeachTentDAO;
    use Controllers\AdminController as AdminController;  

    class BeachTentController {
        
        private $beachTentDAO;
        private $adminController;

        public function __construct() {
            // $this->beachTentDAO = new BeachTentDAO();
            $this->adminController = new AdminController();
        }

        public function addReservePath($alert = "", $success = "") {                        
            if ($admin = $this->adminController->isLogged()) {
                $title = 'Añadir reserva';			
                require_once(VIEWS_PATH . "head.php");                         
                require_once(VIEWS_PATH . "sidenav.php");                         
                require_once(VIEWS_PATH . "add-reserve.php");      
                require_once(VIEWS_PATH . "footer.php");    
            } else {
                return $this->adminController->userPath();
            }
        }

    }
    
?>
