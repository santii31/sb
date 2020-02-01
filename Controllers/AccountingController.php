<?php

    namespace Controllers;    
    
    use Models\Staff as Staff;
    use Models\DiaryBalance as DiaryBalance;    
    use DAO\DiaryBalanceDAO as DiaryBalanceDAO;
    use Controllers\StaffController as StaffController; 
    use Controllers\AdminController as AdminController;     
    use Controllers\ReservationController as ReservationController; 

    class AccountingController {

        private $adminController;          
        private $staffController;         
        private $reservationController;        
        private $diaryBalanceDAO;    

        public function __construct() {            
            $this->adminController = new AdminController();                        
        }       
        
        
        public function diaryPath($date = null, $alert = "", $success ="") {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Caja diaria";        
                $this->diaryBalanceDAO = new DiaryBalanceDAO();
                
                if ($date == null) {
                    $subTitle = "Caja diaria del " . date("d-m-Y");
                    $diarys = $this->diaryBalanceDAO->getByDate( date("Y-m-d") );
                    $values = $this->getSummary(date("Y-m-d"));
                } else {
                    $subTitle = "Caja diaria del " . date("d-m-Y" , strtotime($date));
                    $diarys = $this->diaryBalanceDAO->getByDate($date);
                    $values = $this->getSummary($date);
                }                    

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-diary.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        private function getSummary($date) {            
            $this->diaryBalanceDAO = new DiaryBalanceDAO();
            $diarys = $this->diaryBalanceDAO->getByDate($date);

            // entradas
            $inCash = 0;
            $inTarjet = 0;
            $inCheck = 0;
            $inOther = 0;

            // salidas
            $outCash = 0;
            $outTarjet = 0;
            $outCheck = 0;
            $outOther = 0;

            foreach ($diarys as $diary) {

                if ($diary->getType() == "ingreso") {

                    if ($diary->getPayment() == "efectivo") {

                        $inCash += $diary->getTotal();

                    } else if ($diary->getPayment() == "tarjeta") {

                        $inTarjet += $diary->getTotal();

                    } else if ($diary->getPayment() == "cheque") {
                        
                        $inCheck += $diary->getTotal();

                    } else if ($diary->getPayment() == "otros") {

                        $inOther += $diary->getTotal();

                    }

                } else if ($diary->getType() == "salida") {

                    if ($diary->getPayment() == "efectivo") {

                        $outCash += $diary->getTotal();

                    } else if ($diary->getPayment() == "tarjeta") {

                        $outTarjet += $diary->getTotal();

                    } else if ($diary->getPayment() == "cheque") {
                        
                        $outCheck += $diary->getTotal();

                    } else if ($diary->getPayment() == "otros") {

                        $outOther += $diary->getTotal();

                    }                    

                }
            }
                    
            $values = array(
                "inCash" => $inCash,
                "inTarjet" => $inTarjet,
                "inCheck" => $inCheck,
                "inOther" => $inOther,                
                "outCash" => $outCash,
                "outTarjet" => $outTarjet,
                "outCheck"=> $outCheck,
                "outOther"=> $outOther,
                "totalCash" => $inCash - $outCash,
                "totalTarjet" => $inTarjet - $outTarjet,
                "totalCheck" => $inCheck - $outCheck,
                "totalOther" => $inOther - $outOther,
                "totalIn" => $inCash + $inTarjet + $inCheck + $inOther,
                "totalOut" => $outCash + $outTarjet + $outCheck + $outOther,
                "total" => ($inCash + $inTarjet + $inCheck + $inOther) - ($outCash + $outTarjet + $outCheck + $outOther)
            );
    
            return $values;
        }

        public function addDiary($start, $type, $payment, $detail, $total) {
            if ($this->isFormNotEmpty($start, $type, $payment, $detail, $total)) {

                $this->diaryBalanceDAO = new DiaryBalanceDAO();
                $registerBy = $this->adminController->isLogged();
                $diaryBalance = new DiaryBalance();
                $diaryBalance->setDate($start);
                $diaryBalance->setType($type);
                $diaryBalance->setPayment($payment);
                $diaryBalance->setDetail($detail);
                $diaryBalance->setTotal($total);

                if ($this->diaryBalanceDAO->add($diaryBalance, $registerBy)) {
                    return $this->diaryPath(null, null, DIARY_BALANCE_ADDED);
                }
                return $this->diaryPath(null, DB_ERROR, null);
            }
            return $this->diaryPath(null, EMPTY_FIELDS, null);
        }

        private function isFormNotEmpty($start, $type, $payment, $detail, $total) {
            if (empty($start) || 
                empty($type) || 
                empty($payment) || 
                empty($detail) || 
                empty($total)) {
                    return false;
            }
            return true;
        }
        
        public function salesDailyPath() {
            if ($admin = $this->adminController->isLogged()) {                       
                $today = date("Y-m-d");
                $title = "Contabilidad - Ventas diarias - " . date("d/m/Y" , strtotime($today));   
                $this->reservationController = new ReservationController();                
                $rsvList = $this->reservationController->getReservationsByDateToBalance($today);                
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
                $adminList = $this->adminController->getAllWithRsv();
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
                    $rsvList = $this->reservationController->getReservationsByDateToBalance($date);
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

                    $title = "Contabilidad - Ventas entre el " . date("d/m/Y" , strtotime($date_start)) . 
                             " y el " . date("d/m/Y" , strtotime($date_end));   
                    
                    $this->reservationController = new ReservationController();                    
                    $rsvList = $this->reservationController->getReservationsBetweenDatesToBalance($date_start, $date_end);
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
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Sueldos del personal";       
                $total = 0;
                $this->staffController = new StaffController();
                $staffs = $this->staffController->getAllStAff();

                foreach ($staffs as $staff) {
                    if ($staff->getIsActive()) {
                        $total += $staff->getSalary();
                    }
                }

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-staff.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}            
        }

    }
    
?>
