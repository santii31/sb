<?php

    namespace Models;
    

    class Provider {

        private $id;
        private $name;
        private $lastname;
        private $phone;
        private $email;
        private $dni;
        private $address;                
        private $cuil_number;
        private $social_reason;
        private $billing;
        private $is_active;
        
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
            return $this;
        }

        public function getLastName() {
            return $this->lastname;
        }

        public function setLastName($lastname) {
            $this->lastname = $lastname;
            return $this;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
            return $this;
        }        

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
            return $this;
        }

        public function getDni() {
            return $this->dni;
        }

        public function setDni($dni) {
            $this->dni = $dni;
            return $this;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
            return $this;
        }

        public function getCuilNumber() {
            return $this->cuil_number;
        }

        public function setCuilNumber($cuil_number) {
            $this->cuil_number = $cuil_number;
            return $this;
        }

        public function getSocialReason() {
            return $this->social_reason;
        }

        public function setSocialReason($social_reason) {
            $this->social_reason = $social_reason;
            return $this;
        }        
        
        public function getBilling() {
            return $this->billing;
        }

        public function setBilling($billing) {
            $this->billing = $billing;
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