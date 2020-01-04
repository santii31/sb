<?php

    namespace Models;

    use Models\Category as Category;

    class Product {

        private $id;  
        private $name;
        private $price;
        private $category;
        private $isActive;

        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;            
        }

        public function getName() {
            return $this->name;
        }

        public function setName($name) {
            $this->name = $name;            
        }
        
        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;            
        }
        
        public function getCategory() {
            return $this->provider;
        }

        public function setCategory(Category $category) {
            $this->category = $category;            
        }
        
        public function getIsActive() {
            return $this->isActive;
        }

        public function setIsActive($isActive) {
            $this->isActive = $isActive;            
        }
        

    }

?>