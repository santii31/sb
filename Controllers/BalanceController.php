<?php

    namespace Controllers;    
    
    use Models\Balance as Balance;
    use Models\Reservation as Reservation;
	use DAO\BalanceDAO as BalanceDAO;   
    use Controllers\AdminController as AdminController; 
    use Controllers\ReservationController as ReservationController; 

    class BalanceController {

        private $balanceDAO;        
        private $adminController; 
        private $reservationController;   

        public function __construct() {            
            $this->adminController = new AdminController();
            $this->balanceDAO = new BalanceDAO();
        }       
        

        public function totalBalance() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Balance";         
                $this->reservationController = new ReservationController();                       
                $rsvList = $this->reservationController->getAllToBalanceReservations();    
                $remainderTotal = 0;
                foreach ($rsvList as $rsv) {                    
                    $total = $rsv->getPrice();
                    $partial = $this->balanceDAO->getSumPartialByClient($rsv->getClient());
                    $remainder = $total - $partial;
                    $remainderTotal += $remainder;
                }                

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-balance.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function addBalancePath($id_reservation, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                       

                $title = "Cliente - Saldo";      
                $this->reservationController = new ReservationController();
                $flag = true;                                
                                
                $reservation = $this->reservationController->getByIdToBalance($id_reservation);

                $balances = $this->balanceDAO->getByReservationId($reservation);
                $partialByClient = $this->balanceDAO->getSumPartialByClient($reservation->getClient());                

                if ($partialByClient == $reservation->getPrice()) {                   
                    $flag = false;
                } else {                                        
                    $flag = true;
                    $remainderByClient = $reservation->getPrice() - $partialByClient;
                }                
                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "balance.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function add($id_reservation, $date, $concept, $number_r, $total, $partial, $remainder) {
            if ($this->isFormNotEmpty($id_reservation, $date, $concept, $number_r, $total, $partial) && $remainder >= 0) {
                
                $balance = new Balance();
                $balance->setDate($date);
                $balance->setConcept($concept);
                $balance->setNumberReceipt($number_r);
                $balance->setTotal($total);
                $balance->setPartial($partial);
                $balance->setRemainder($remainder);

                $reservation = new Reservation();
                $reservation->setId($id_reservation);

                $balance->setReservation($reservation);

                if ($this->balanceDAO->add($balance)) {
                    return $this->addBalancePath($id_reservation, null, null);
                }
                return $this->addBalancePath($id_reservation, DB_ERROR, null);
            }            
            return $this->addBalancePath($id_reservation, EMPTY_FIELDS, null);
        }
        
        private function isFormNotEmpty($id_reservation, $date, $concept, $number_r, $total, $partial) {
            if (empty($id_reservation) || 
                empty($date) || 
                empty($concept) || 
                empty($number_r) || 
                empty($total) ||                 
                empty($partial)) {
                    return false;
            }
            return true;
        }
    }
    
?>
