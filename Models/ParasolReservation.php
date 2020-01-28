<?php

    namespace Models;

    use Models\Basic as Basic;
    use Models\Client as Client;    
    use Models\Parking as Parking;    
    use Models\Parasol as Parasol;    

    class ParasolReservation extends Basic {

        private $id;
        private $date_start;
        private $date_end;
        private $stay;        
        private $price;    
        private $client;            
        private $parasol;        
        private $parking;
        private $is_reserved;
        private $is_active;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

		public function getDateStart() {
            return $this->date_start;
        }

        public function setDateStart($date_start) {
            $this->date_start = $date_start;
            return $this;
        }

		public function getDateEnd() {
            return $this->date_end;
        }

        public function setDateEnd($date_end) {
            $this->date_end = $date_end;
            return $this;
        }
        
        public function getStay() {
            return $this->stay;
        }

        public function setStay($stay) {
            $this->stay = $stay;            
        }        

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
            return $this;
        }

        public function getClient() {
            return $this->client;
        }

        public function setClient(Client $client) {
            $this->client = $client;
            return $this;
        }

        public function getParasol() {
            return $this->parasol;
        }

        public function setParasol(Parasol $parasol) {
            $this->parasol = $parasol;
            return $this;
        }

        public function getParking() {
            return $this->parking;
        }

        public function setParking(Parking $parking) {
            $this->parking = $parking;
            return $this;
        }

        public function getIsReserved() {
            return $this->is_reserved;
        }

        public function setIsReserved($is_reserved) {                        
            $this->is_reserved = $is_reserved;
            return $this;
        }

        public function getIsActive() {
            return $this->is_active;
        }

        public function setIsActive($is_active) {
            $this->is_active = $is_active;
            return $this;
        }

    }

?>