<?php

    namespace Models;

    use Models\Hall as Hall;

    class BeachTent {

        private $id;
        private $number;
        private $price;   
        private $position;
        private $is_sea;
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
            return $this;
        }

        public function getPosition() {
            return $this->position;
        }

        public function setPosition($position) {
            $this->position = $position;
            return $this;
        }        

        public function getIsSea() {
            return $this->is_sea;
        }

        public function setIsSea($is_sea) {
            $this->is_sea = $is_sea;
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