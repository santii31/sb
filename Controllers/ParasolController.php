<?php

    namespace Controllers;    
    
    use Models\Parasol as Parasol;
	use DAO\ParasolDAO as ParasolDAO;    

    class ParasolController {

        private $parasolDAO;        

        public function __construct() {
            $this->parasolDAO = new ParasolDAO();            
        }        

        public function getRowParasol($n) {
            return $this->parasolDAO->getN_row($n);
        }

    }

?>