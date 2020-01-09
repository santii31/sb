<?php

    namespace Controllers;    
    
    use Models\Parking as Parking;
	use DAO\ParkingDAO as ParkingDAO;
    use Controllers\AdminController as AdminController;  

    class ParkingController {

        private $parkingDAO;
        private $adminController;

        public function __construct() {
            $this->parkingDAO = new ParkingDAO();
            $this->adminController = new AdminController();
        }

        public function parkingMap() {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Plano de cocheras";       
                
                // parkings
                $firstRow = $this->parkingDAO->getN_row(1);
                $secondRow = $this->parkingDAO->getN_row(2);
                $thirdRow = $this->parkingDAO->getN_row(3);
                $fourthRow = $this->parkingDAO->getN_row(4);
                $fifthRow = $this->parkingDAO->getN_row(5);
                $sixthRow = $this->parkingDAO->getN_row(6);
                $seventhRow = $this->parkingDAO->getN_row(7);
                $eighthRow = $this->parkingDAO->getN_row(8);
                $ninthhRow = $this->parkingDAO->getN_row(9);
                $tenthRow = $this->parkingDAO->getN_row(10);

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
