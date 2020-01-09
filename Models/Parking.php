<?php

    namespace Models;

    use Models\ParkingHall as ParkingHall;

    class Parking {

        private $id;
        private $number;
        private $price;
        private $position;
        private $hall;    

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getNumber() {
            return $this->number;
        }

        public function setNumber($number) {
            $this->number = $number;
            return $this;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }

        public function getPosition() {
            return $this->position;
        }

        public function setPosition($position) {
            $this->position = $position;
            return $this;
        }   
        
        public function getHall() {
            return $this->hall;
        }

        public function setHall(ParkingHall $hall) {
            $this->hall = $hall;
            return $this;
        } 

    }

?>