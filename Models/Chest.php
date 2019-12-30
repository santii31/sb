<?php

    namespace Models;
    
    use Models\Reservation as Reservation;

    class Chest {

        private $id;
        private $reservation;        

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getReservation() {
            return $this->reservation;
        }

        public function setReservation(Reservation $reservation) {
            $this->reservation = $reservation;
            return $this;
        }       

        // public function getIsActive() {
        //     return $this->is_active;
        // }

        // public function setIsActive($is_active) {
        //     $this->is_active = $is_active;
        //     return $this;
        // }

    }

?>