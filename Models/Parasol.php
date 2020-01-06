<?php

    namespace Models;
    
    use Models\AdditionalService as AdditionalService;

    class Parasol {

        private $id;
        private $parasol_number;
        private $price;
        private $additionalService;

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

        public function getAdditionalService() {
            return $this->additionalService;
        }

        public function setAdditionalService(AdditionalService $additionalService) {
            $this->additionalService = $additionalService;            
        }


    }

?>