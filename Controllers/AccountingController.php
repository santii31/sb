<?php

    namespace Controllers;    
    
    use Models\Reservation as Reservation;
    use Controllers\AdminController as AdminController; 
    use Controllers\ReservationController as ReservationController; 

    class AccountingController {

        private $adminController;        
        private $reservationController;        

        public function __construct() {            
            $this->adminController = new AdminController();
        }       
        

        public function diaryPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Caja diaria";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-diary.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function salesDailyPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $today = date("Y-m-d");
                $title = "Contabilidad - Ventas diarias - " . date("d/m/Y" , strtotime($today));   
                $this->reservationController = new ReservationController();
                $rsvList = $this->reservationController->getReservationsByDate($today);
                
                $total = 0;                

                foreach ($rsvList as $rsv) {
                    $total += $rsv->getPrice();
                }

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-daily.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        // ventas mensuales
        public function salesMonthlyPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Ventas mensuales";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-monthly.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function salesByAdminsPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Ventas por administradores";     
                $admins = $this->adminController->getAllWithRsv();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-admins.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function salesByDatesPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Ventas por fechas";                     
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-dates-search.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function search() {

        }
        
    }
    
?>
