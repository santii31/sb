<?php

    namespace Models;
    
    use Models\Basic as Basic;

    class Client extends Basic {

        private $id;
        private $name;
        private $lastname;        
        private $address;        
        private $city;
        private $cp;
        private $email;
        private $phone;
        private $family_group;
        private $stayAddress; 
        private $phone_stay;
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
        
        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
            return $this;
        }

        public function getCity() {
            return $this->city;
        }

        public function setCity($city) {
            $this->city = $city;
            return $this;
        }

        public function getCp() {
            return $this->cp;
        }

        public function setCp($cp) {
            $this->cp = $cp;
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

        public function getFamilyGroup() {
            return $this->family_group;
        }

        public function setFamilyGroup($family_group) {
            $this->family_group = $family_group;
            return $this;
        }

        public function getStayAddress() {
            return $this->stayAddress;
        }

        public function setStayAddress($stayAddress) {
            $this->stayAddress = $stayAddress;
            return $this;
        }

        
        public function getPhoneStay() {
            return $this->phone_stay;
        }

        public function setPhoneStay($phone_stay) {
            $this->phone_stay = $phone_stay;
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