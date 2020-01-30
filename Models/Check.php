<?php

    namespace Models;
        
    class Check {

        private $id;
        private $bank;
        private $account_number;
        private $check_number;
        private $charged;
        private $payment_date;
        private $client;
        
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getBank() {
            return $this->bank;
        }

        public function setBank($bank) {
            $this->bank = $bank;            
        }

        public function getAccountNumber() {
            return $this->account_number;
        }

        public function setAccountNumber($account_number) {
            $this->account_number = $account_number;
            return $this;
        }
        
        public function getCheckNumber() {
            return $this->check_number;
        }

        public function setCheckNumber($check_number) {
            $this->check_number = $check_number;
            return $this;
        }

        public function getCharged() {
            return $this->charged;
        }

        public function setCharged($charged) {
            $this->charged = $charged;
            return $this;
        }

        public function getPaymentDate() {
            return $this->payment_date;
        }

        public function setPaymentDate($payment_date) {
            $this->payment_date = $payment_date;
            return $this;
        }

        public function getClient() {
            return $this->client;
        }

        public function setClient($client) {
            $this->client = $client;            
        }

    }

?>