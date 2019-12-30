<?php

    namespace Models;
    
    class Cliente {

        private $id;
        private $name;
        private $lastname;
        private $email;
        private $phone;
        private $city;
        private $address;        
        private $stayAddress;   //Domicilio de estadia (Temporal)

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

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
            return $this;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
            return $this;
        }

        public function getCity() {
            return $this->city;
        }

        public function setCity($city) {
            $this->city = $city;
            return $this;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->addres = $address;
            return $this;
        }

        public function getStayAddress() {
            return $this->stayAddress;
        }

        public function setStayAddress($stayAddress) {
            $this->stayAddress = $stayAddress;
            return $this;
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