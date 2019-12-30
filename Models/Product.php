<?php

    namespace Models;

    use Models\Provider as Provider;

    class Product {

        private $id;  
        private $name;
        private $price;
        private $provider;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;            
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }
        
        public function getProvider() {
            return $this->provider;
        }

        public function setProvider(Provider $provider) {
            $this->provider = $provider;            
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