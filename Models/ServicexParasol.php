<?php

namespace Models;

class ServicexParasol {

    private $id_service;  
    private $id_parasol;
    

    public function getIdService() {
        return $this->id_service;
    }

    public function setIdService($id_service) {
        $this->id_service = $id_service;            
    }
    public function getIdParasol() {
        return $this->id_parasol;
    }

    public function setIdParasol($id_parasol) {
        $this->id_parasol = $id_parasol;            
    }
    
}

?>