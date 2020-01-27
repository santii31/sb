<?php

    namespace Models;

    use Models\Basic as Basic;

    class AdditionalService extends Basic {

        private $id;         
        private $total;        
        private $is_active;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getTotal() {
            return $this->total;
        }

        public function setTotal($total) {
            $this->total = $total;            
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