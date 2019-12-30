<?php

    namespace Models;

    class Schedule {

        private $id;            

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
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