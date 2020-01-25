<?php

    namespace Models;    

    class DiaryBalance extends Basic {

        private $id;
        private $type;   
        private $date;
        private $payment;
        private $detail;
        private $total;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }       
    
        public function getType() {
            return $this->type;
        }
    
        public function setType($type) {
            $this->type = $type;
        }

        public function getDate() {
            return $this->date;
        }
    
        public function setDate($date) {
            $this->date = $date;
        }
    
        public function getPayment() {
            return $this->payment;
        }
    
        public function setPayment($payment) {
            $this->payment = $payment;
        }
    
        public function getDetail() {
            return $this->detail;
        }
    
        public function setDetail($detail) {
            $this->detail = $detail;
        }

        public function getTotal() {
            return $this->total;
        }
    
        public function setTotal($total) {
            $this->total = $total;
        }
    
    }

?>