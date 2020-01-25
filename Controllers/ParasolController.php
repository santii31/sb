<?php

    namespace Controllers;    
    
    use Models\Parasol as Parasol;
	use DAO\ParasolDAO as ParasolDAO;    

    class ParasolController {

        private $parasolDAO;        

        public function __construct() {
            $this->parasolDAO = new ParasolDAO();            
        }        

        
        public function getRowParasol($n) {
            return $this->parasolDAO->getN_row($n);
        }

        // cambiar aca
        public function hasReservation($id_parasol) {            
            $reserveList = $this->reservationController->getByIdTent($id_tent);
            return sizeof($reserveList);
        }

        public function reservationToday($id_parasol) {
            $reserveList = $this->reservationController->getByIdTent($id_tent);            
            foreach ($reserveList as $reserve) {
                if ($reservation = $this->reservationController->checkIsDateReserved($reserve)) {
                    return $reservation;
                }
            }
            return false;
        }

        public function hasFutureReservation($id_parasol) {            
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