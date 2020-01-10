<?php

    namespace Models;
    
    class Parasol {

        private $id;
        private $parasol_number;
        private $price;
        private $position;        
        private $hall;  
    
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getParasolNumber() {
            return $this->parasol_number;
        }

        public function setParasolNumber($parasol_number) {
            $this->parasol_number = $parasol_number;
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

        public function setHall(Hall $hall) {
            $this->hall = $hall;
            return $this;
        }          


    }

?>