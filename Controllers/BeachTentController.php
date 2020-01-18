<?php

    namespace Controllers;    

    use Models\BeachTent as BeachTent;
    use Models\Reservation as Reservation;
    use DAO\BeachTentDAO as BeachTentDAO;
    use Controllers\AdminController as AdminController;  
    use Controllers\ParasolController as ParasolController;  

    class BeachTentController {
        
        private $beachTentDAO;
        private $adminController;
        private $reservationController;

        public function __construct() {
            $this->beachTentDAO = new BeachTentDAO();
            $this->adminController = new AdminController(); 
            $this->reservationController = new ReservationController();           
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
                $parasolController = new ParasolController();                            

                // parasols
                $firtsParasol = $parasolController->getRowParasol(1);
                $secondParasol = $parasolController->getRowParasol(2);
                $thirdParasol = $parasolController->getRowParasol(3);
                $fourthParasol = $parasolController->getRowParasol(4);
                $fifthParasol = $parasolController->getRowParasol(5);

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

        public function hasReservation($id_tent) {            
            $reserveList = $this->reservationController->getByIdTent($id_tent);
            return sizeof($reserveList);
        }

        public function reservationToday($id_tent) {
            $reserveList = $this->reservationController->getByIdTent($id_tent);            
            foreach ($reserveList as $reserve) {
                if ($reservation = $this->reservationController->checkIsDateReserved($reserve)) {
                    return $reservation;
                }
            }
            return false;
        }

        public function hasFutureReservation($id_tent) {            
            $futureReserve = array();
            $reserveList = $this->reservationController->getByIdTent($id_tent);
            $today = date("Y-m-d");
            $dateToCompare = strtotime( $today );            
            
            foreach ($reserveList as $reserve) {                
                $reserveDate = strtotime( $reserve->getDateStart() );
                if ($reserveDate > $dateToCompare) {
                    array_push($futureReserve, $reserve);
                }                
            }
            return $futureReserve;
        }


    }
    
?>
