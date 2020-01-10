<?php

namespace Models;

class ServicexParking {

    private $id_service;  
    private $id_parking;
    

    public function getIdService() {
        return $this->id_service;
    }

    public function setIdService($id_service) {
        $this->id_service = $id_service;            
    }
    public function getIdParking() {
        return $this->id_parking;
    }

    public function setIdParking($id_parking) {
        $this->id_parking = $id_parking;            
    }
    
}

?>