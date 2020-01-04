<?php

    namespace Models;
    
    use Models\AdditionalService as AdditionalService;

    class Umbrella {

        private $id;
        private $umbrella_number;
        private $price;
        private $additionalService;



        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getUmbrellaNumber() {
            return $this->umbrella_number;
        }

        public function setUmbrellaNumber($umbrella_number) {
            $this->umbrella_number = $umbrella_number;
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