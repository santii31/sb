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

        public function updatePath($id_balance, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Balance - Modificar";         
                $balanceTemp = new Balance();
                $balanceTemp->setId($id_balance);
                $balance = $this->balanceDAO->getById($balanceTemp);                                        
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-balance.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        private function isFormUpdateNotEmpty($date, $concept, $number_r, $total, $partial, $remainder) {
            if (empty($date) ||                 
                empty($concept) || 
                empty($number_r) || 
                empty($total) ||                 
                empty($partial) || 
                empty($remainder)) {
                    return false;
            }
            return true;
        }

        public function update($id_balance, $date, $concept, $number_r, $total, $partial, $remainder, $id_reservation) {
            if ($admin = $this->adminController->isLogged()) {   

                if ($this->isFormUpdateNotEmpty($date, $concept, $number_r, $total, $partial, $remainder)) {     

                    $balance = new Balance();
                    $balance->setId($id_balance);
                    $balance->setDate($date);
                    $balance->setConcept($concept);
                    $balance->setNumberReceipt($number_r);
                    $balance->setTotal($total);
                    $balance->setPartial($partial);
                    $balance->setRemainder($remainder);
                                                
                    $update_by = $this->adminController->isLogged();

                    if ($this->balanceDAO->update($balance, $update_by)) {
                        if ($this->modifyOtherBalances($id_reservation, $balance->getId(), $balance->getRemainder())) { 
                            return $this->addBalancePath($id_reservation, null, 'Balance modificado con éxito.');
                        } else {
                            // echo 'aca';
                            return $this->updatePath($id_balance, DB_ERROR, null);    
                        }                    
                    } else {                    
                        // echo 'xd';
                        return $this->updatePath($id_balance, DB_ERROR, null);
                    }                                        
                    return $this->updatePath($id_balance, REGISTER_ERROR, null);
                }                        
                return $this->updatePath($id_balance, EMPTY_FIELDS, null);

            } else {
				return $this->adminController->userPath();
			}
        }    

        private function modifyOtherBalances($id_reservation, $id_balance, $remainder) {
            $update_by = $this->adminController->isLogged();
            $reservation = new Reservation();
            $reservation->setId($id_reservation);
            $balances = $this->balanceDAO->getByReservationId($reservation);        

            $count1 = 0;
            $count2 = 0;
            $totalNext = $remainder;

            foreach ($balances as $balance) {
                if ($balance->getId() > $id_balance) {
                    
                    $balance->setTotal($totalNext);
                    $balance->setRemainder($balance->getTotal() - $balance->getPartial());
                    $totalNext = $balance->getRemainder();
                    $count1++;
                    
                    if ($this->balanceDAO->update($balance, $update_by)) {
                        $count2++;
                    }
                }
            }

            if ($count1 == $count2) {
                return true;
            } else {
                return false;
            }
        }

        public function delete($id_balance, $id_reservation) {
            if ($admin = $this->adminController->isLogged()) {   
                    
                $balanceTemp = new Balance();
                $balanceTemp->setId($id_balance);

                $balance = $this->balanceDAO->getById($balanceTemp);    

                if ($this->modifyOtherBalances($id_reservation, $balance->getId(), $balance->getTotal())) {
                    
                    if ($this->balanceDAO->delete($balance)) {                        
                        return $this->addBalancePath($id_reservation, null, 'Balance eliminado con éxito.');
                    }                                    
                    return $this->addBalancePath($id_reservation, DB_ERROR, null);

                } else {
                    return $this->addBalancePath($id_reservation, DB_ERROR, null);                    
                }    

            } else {
                return $this->adminController->userPath();
            }
        }

    }
    
?>