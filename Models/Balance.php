<?php

    namespace Models;

    use Models\Reservation as Reservation;

    class Balance {

        private $id;
        private $date;
        private $concept;   
        private $number_receipt;
        private $total;
        private $partial;
        private $remainder;    
        private $reservation;    


        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }       
    
        public function getDate() {
            return $this->date;
        }
    
        public function setDate($date) {
            $this->date = $date;
        }
    
        public function getConcept() {
            return $this->concept;
        }
    
        public function setConcept($concept) {
            $this->concept = $concept;
        }
    
        public function getNumberReceipt() {
            return $this->number_receipt;
        }
    
        public function setNumberReceipt($number_receipt) {
            $this->number_receipt = $number_receipt;
        }
    
        public function getTotal() {
            return $this->total;
        }
    
        public function setTotal($total) {
            $this->total = $total;
        }
    
        public function getPartial() {
            return $this->partial;
        }
    
        public function setPartial($partial) {
            $this->partial = $partial;
        }
    
        public function getRemainder() {
            return $this->remainder;
        }
    
        public function setRemainder($remainder) {
            $this->remainder = $remainder;
        }
    
        public function getReservation() {
            return $this->reservation;
        }
    
        public function setReservation(Reservation $reservation) {
            $this->reservation = $reservation;
        }
    }

?>