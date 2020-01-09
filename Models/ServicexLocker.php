<?php

namespace Models;

class ServicexLocker {

    private $id_service;  
    private $id_locker;
    

    public function getIdService() {
        return $this->id_service;
    }

    public function setIdService($id_service) {
        $this->id_service = $id_service;            
    }
    public function getIdLocker() {
        return $this->id_locker;
    }

    public function setIdLocker($id_locker) {
        $this->id_locker = $id_locker;            
    }
    
}

?>