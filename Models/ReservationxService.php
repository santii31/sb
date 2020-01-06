<?php

    namespace Models;

    class ReservationxService {

        private $id_reservation;  
        private $id_service;
        

        public function getIdReservation() {
            return $this->id_reservation;
        }

        public function setIdReservation($id_reservation) {
            $this->id_reservation = $id_reservation;            
        }

        public function getIdService() {
            return $this->id_service;
        }

        public function setIdService($id_service) {
            $this->id_service = $id_service;            
        }
        
    }

?>