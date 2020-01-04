<?php

    namespace Models;

    use Models\Category as Category;

    class Product {

        private $id;  
        private $name;
        private $price;
        private $category;

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
        

        

    }

?>