<?php

    namespace Models;
    
    use Models\Admin as Admin;

    abstract class Basic {

        private $date_register;
        private $register_by;
        private $date_disable;
        private $disable_by;
        private $date_enable;
        private $enable_by;
        private $date_update;
        private $update_by;

        public function getDateRegister() {
            return $this->date_register;
        }

        public function setDateRegister($date_register) {
            $this->date_register = $date_register;            
        }

        public function getRegisterBy() {
            return $this->register_by;
        }

        public function setRegisterBy(Admin $register_by) {
            $this->register_by = $register_by;            
        }        
        
        public function getDateDisable() {
            return $this->date_disable;
        }

        public function setDateDisable($date_disable) {
            $this->date_disable = $date_disable;            
        }   
        
        public function getDisableBy() {
            return $this->disable_by;
        }

        public function setDisableBy(Admin $disable_by) {
            $this->disable_by = $disable_by;            
        }  
        
        public function getDateEnable() {
            return $this->date_enable;
        }

        public function setDateEnable($date_enable) {
            $this->date_enable = $date_enable;            
        } 
        
        public function getEnableBy() {
            return $this->enable_by;
        }

        public function setEnableBy(Admin $enable_by) {
            $this->enable_by = $enable_by;            
        }  
        
        public function getDateUpdate() {
            return $this->date_update;
        }

        public function setDateUpdate($date_update) {
            $this->date_update = $date_update;            
        } 
        
        public function getUpdateBy() {
            return $this->update_by;
        }

        public function setUpdateBy(Admin $update_by) {
            $this->update_by = $update_by;            
        }

    }

?>