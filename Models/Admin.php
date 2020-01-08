<?php

    namespace Models;
    
    use Models\Basic as Basic;

    class Admin extends Basic {

        private $id;
        private $name;
        private $lastname;
        private $email;
        private $dni;
        private $password;     
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

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
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