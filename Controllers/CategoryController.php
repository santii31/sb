<?php

    namespace Controllers;    

    use DAO\CategoryDAO as CategoryDAO;

    class CategoryController {

        private $categoryDAO;

        public function __construct() {        
            $this->categoryDAO = new CategoryDAO();
        }
        

        public function getCategorys() {        
            return $this->categoryDAO->getAll();
        }


    }
    
?>
