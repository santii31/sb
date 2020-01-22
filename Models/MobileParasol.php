<?php

    namespace Models;
    
    class MobileParasol {

        private $id;
        private $mobileParasol_number;
        private $price;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getMobileParasolNumber() {
            return $this->mobileParasol_number;
        }

        public function setMobileParasolNumber($mobileParasol_number) {
            $this->mobileParasol_number = $mobileParasol_number;
            return $this;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }

    }

?>