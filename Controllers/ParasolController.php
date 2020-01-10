<?php

    namespace Controllers;    
    
    use Models\Parasol as Parasol;
	use DAO\ParasolDAO as ParasolDAO;
    // use Controllers\AdminController as AdminController;  

    class ParasolController {

        private $parasolDAO;
        private $adminController;

        public function __construct() {
            $this->parasolDAO = new ParasolDAO();
            // $this->adminController = new AdminController();
        }        

        public function getRowParasol($n) {
            return $this->parasolDAO->getN_row($n);
        }

    }





?>