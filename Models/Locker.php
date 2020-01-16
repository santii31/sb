<?php

    namespace Models;
        
    class Locker {

        private $id;
        private $locker_number;
        private $price;
        private $sex;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getLockerNumber() {
            return $this->locker_number;
        }

        public function setLockerNumber($locker_number) {
            $this->locker_number = $locker_number;
            return $this;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }

        public function getSex() {
            return $this->sex;
        }

        public function setSex($sex) {
            $this->sex = $sex;            
        }

    }

?>