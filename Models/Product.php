<?php

    namespace Models;

    use Models\Basic as Basic;
    use Models\Admin as Admin;
    use Models\Category as Category;
    use Models\Provider as Provider;

    class Product extends Basic {

        private $id;  
        private $name;
        private $price;
        private $category;
        private $provider;
        private $quantity;

        private $date_added;
        private $added_by;
        private $date_remove;        
        private $remove_by;

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

        public function getProvider() {
            return $this->provider;
        }

        public function setProvider(Provider $provider) {
            $this->provider = $provider;            
        }

        public function getQuantity() {
            return $this->quantity;
        }

        public function setQuantity($quantity) {
            $this->quantity = $quantity;            
        }
        
        // 
        public function getDateAdded() {
            return $this->date_added;
        }

        public function setDateAdded($date_added) {
            $this->date_added = $date_added;
        }

        public function getAddedBy() {
            return $this->added_by;
        }
        
        public function setAddedBy(Admin $added_by) {
            $this->added_by = $added_by;            
        }

        public function getDateRemove() {
            return $this->date_remove;
        }

        public function setDateRemove($date_remove) {
            $this->date_remove = $date_remove;            
        }

        public function getRemoveBy() {
            return $this->remove_by;
        }

        public function setRemoveBy(Admin $remove_by) {
            $this->remove_by = $remove_by;            
        }

        public function getIsActive() {
            return $this->isActive;
        }

        public function setIsActive($is_active) {
            $this->is_active = $is_active;            
        }
        

    }

?>