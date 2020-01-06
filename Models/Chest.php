<?php

    namespace Models;
    
    use Models\AdditionalService as AdditionalService;

    class Chest {

        private $id;
        private $chest_number;
        private $price;
        private $additionalService;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getChestNumber() {
            return $this->chest_number;
        }

        public function setChestNumber($chest_number) {
            $this->chest_number = $chest_number;
            return $this;
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }

        public function getAdditionalService() {
            return $this->additionalService;
        }

        public function setAdditionalService(AdditionalService $additionalService) {
            $this->additionalService = $additionalService;            
        }


    }

?>