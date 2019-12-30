<?php

    namespace Models;
    
    use Models\Reservation as Reservation;

    class AdditionalService {

        private $id;
        private $description;        
        private $price;
        private $reservation;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;            
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
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