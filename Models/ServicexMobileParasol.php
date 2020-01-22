<?php

namespace Models;

class ServicexMobileParasol {

    private $id_service;  
    private $id_mobileParasol;
    

    public function getIdService() {
        return $this->id_service;
    }

    public function setIdService($id_service) {
        $this->id_service = $id_service;            
    }
    public function getIdMobileParasol() {
        return $this->id_mobileParasol;
    }

    public function setIdMobileParasol($id_mobileParasol) {
        $this->id_mobileParasol = $id_mobileParasol;            
    }
    
}

?>