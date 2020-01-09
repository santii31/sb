<?php

    namespace Models;
    
    class ParkingHall {

        private $id;
        private $number;        

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

    }

?>