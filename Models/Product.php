<?php

    namespace Models;

    use Models\Basic as Basic;
    use Models\Category as Category;

    class Product extends Basic {

        private $id;  
        private $name;
        private $price;
        private $category;
        private $quantity;
        private $is_active;

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
            return $this->category;
        }

        public function setCategory(Category $category) {
            $this->category = $category;            
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;            
        }
        
        public function getIsActive() {
            return $this->isActive;
        }

        public function setIsActive($is_active) {
            $this->is_active = $is_active;            
        }
        

    }

?>