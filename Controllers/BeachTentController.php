<?php

    namespace Controllers;    

    use Models\BeachTent as BeachTent;
	use DAO\BeachTentDAO as BeachTentDAO;
    use Controllers\AdminController as AdminController;  

    class BeachTentController {
        
        private $beachTentDAO;
        private $adminController;

        public function __construct() {
            $this->beachTentDAO = new BeachTentDAO();
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

        public function showMap() {
            if ($admin = $this->adminController->isLogged()) {
                
                $title = 'Mapa de carpas';		

                // Tents
                $firstRow = $this->beachTentDAO->getN_row(1);
                $secondRow = $this->beachTentDAO->getN_row(2);
                $thirdRow = $this->beachTentDAO->getN_row(3);
                $fourthRow = $this->beachTentDAO->getN_row(4);
                $fifthRow = $this->beachTentDAO->getN_row(5);
                $sixthRow = $this->beachTentDAO->getN_row(6);
                $seventhRow = $this->beachTentDAO->getN_row(7);

                // tents sea
                $firstSeaRow = $this->beachTentDAO->getSea_N_row(1);
                $secondSeaRow = $this->beachTentDAO->getSea_N_row(2);
                $thirdSeaRow = $this->beachTentDAO->getSea_N_row(3);
                $fourthSeaRow = $this->beachTentDAO->getSea_N_row(4);
                $fifthSeaRow = $this->beachTentDAO->getSea_N_row(5);
                $sixthSeaRow = $this->beachTentDAO->getSea_N_row(6);
                $seventhSeaRow = $this->beachTentDAO->getSea_N_row(7);

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "dashboard.php");
                require_once(VIEWS_PATH . "footer.php");

            } else {
                return $this->adminController->userPath();
            }
        }                 

    }
    
?>
