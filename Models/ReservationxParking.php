<?php

    namespace Models;

    use Models\Parking as Parking;
    use Models\Reservation as Reservation;

    class ReservationxParking {

        private $reservation;  
        private $parking;
        

        public function getReservation() {
            return $this->reservation;
        }

        public function setReservation(Reservation $reservation) {
            $this->reservation = $reservation;            
        }

        public function getParking() {
            return $this->parking;
        }

        public function setParking(Parking $parking) {
            $this->parking = $parking;            
        }
        
    }

?>