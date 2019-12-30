<?php

    namespace Models;

    class Inventory {

        private $id;         
        private $quantity;   

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;            
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