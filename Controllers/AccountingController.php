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
        
        // ingresos y salidas
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
        
        public function salesMonthlyPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Ventas mensuales";                
                $this->reservationController = new ReservationController();
                $rsvList = $this->reservationController->getSalesMonthly();                 
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

        public function search($date) {
            if ($admin = $this->adminController->isLogged()) {    
                if (!empty($date)) {

                    $title = "Contabilidad - Ventas del día - " . date("d/m/Y" , strtotime($date));   

                    $this->reservationController = new ReservationController();
                    $rsvList = $this->reservationController->getReservationsByDate($date);
                    $total = 0;                

                    foreach ($rsvList as $rsv) {
                        $total += $rsv->getPrice();
                    }

                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "accounting-daily.php");
                    require_once(VIEWS_PATH . "footer.php"); 
                    
                } else {
                    return $this->salesByDatesPath(EMPTY_FIELDS);
                }
            } else {
				return $this->adminController->userPath();
			}
        }
        
        public function searchBetween($date_start, $date_end) {
            if ($admin = $this->adminController->isLogged()) {    
                if (!empty($date_start) && !empty($date_end)) {

                    $title = "Contabilidad - Ventas entre el " . date("d/m/Y" , strtotime($date_start)) . ' y el ' . date("d/m/Y" , strtotime($date_end));   

                    $this->reservationController = new ReservationController();
                    $rsvList = $this->reservationController->getReservationsBetweenDates($date_start, $date_end);
                    $total = 0;                

                    foreach ($rsvList as $rsv) {
                        $total += $rsv->getPrice();
                    }

                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "accounting-daily.php");
                    require_once(VIEWS_PATH . "footer.php"); 
                    
                } else {
                    return $this->salesByDatesPath(EMPTY_FIELDS);
                }
            } else {
				return $this->adminController->userPath();
			}
        }

        public function staffSalaryPath() {

        }

    }
    
?>
