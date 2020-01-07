<?php

    namespace Models;
    
    use Models\Basic as Basic;

    class Staff extends Basic {

        private $id;
        private $name;
        private $lastname;
        private $position;
        private $date_start;
        private $date_end;
        private $dni;
        private $address;
        private $phone;   
        private $shirt_size;
        private $pant_size;
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

        public function getPosition() {
            return $this->position;
        }

        public function setPosition($position) {
            $this->position = $position;
            return $this;
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

        public function getDni() {
            return $this->dni;
        }

        public function setDni($dni) {
            $this->dni = $dni;
            return $this;
        }

        public function getPhone() {
            return $this->phone;
        }

        public function setPhone($phone) {
            $this->phone = $phone;
            return $this;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setAddress($address) {
            $this->address = $address;
            return $this;
        }

        public function getShirtSize() {
            return $this->shirt_size;
        }

        public function setShirtSize($shirt_size) {
            $this->shirt_size = $shirt_size;
            return $this;
        }

        public function getPantSize() {
            return $this->pant_size;
        }

        public function setPantSize($pant_size) {
            $this->pant_size = $pant_size;
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