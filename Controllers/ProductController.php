<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;  
    use DAO\ProductDAO as ProductDAO;

    class ProductController {

        private $productDAO;
        private $adminController;

        public function __construct() {
            $this->productDAO = new ProductDAO();
            $this->adminController = new AdminController();
        }

        private function add($id, $name, $price, $quantity, $category) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);

            $product = new Product();
            $product->setId($id);
            $product->setName( strtolower($name_s) );
            $product->setPrice($price);
            $product->setCategory($category);            
            			
            if ($this->productDAO->add($product)) {
                return true;
            } else {
                return false;
            }
        }

        public function addProduct($name, $price, $quantity, $category) {
            if ($this->isFormRegisterNotEmpty($name, $price, $quantity, $category)) {
                
                $productTemp = new Product();
                $productTemp->setName($name);                
                
				if ($this->productDAO->getByName($productTemp) == null) {                                                            
                    if ($this->add($name, $price, $quantity, $category)) {            
                        return $this->addProductPath(null, PRODUCT_ADDED);
                    } else {                        
                        return $this->addProductPath(DB_ERROR, null);        
                    }
                }                
                return $this->addProductPath(PRODUCT_ERROR, null);
            }            
            return $this->addProductPath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($name, $price, $quantity, $category) {
            if (empty($name) || 
                empty($price) || 
                empty($quantity) || 
                empty($category) {
                    return false;
            }
            return true;
        }

        public function addProductPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Añadir producto";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-product.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function listProductPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Productos";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-products.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }


        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $product = new Product();
                $product->setId($id);
                if ($this->productDAO->enableById($product)) {
                    return $this->listProductPath(null, PRODUCT_ENABLE);
                } else {
                    return $this->listProductPath(DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $product = new Product();
                $product->setId($id);
                if ($this->productDAO->disableById($product)) {
                    return $this->listProductPath(null, PRODUCT_DISABLE);
                } else {
                    return $this->listProductPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }


        public function updateProductPath($id_client, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Modificar informacion";       
                $productTemp = new Product();
                $productTemp->setId($id_product);                
                $product = $this->productDAO->getById($productTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-product.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function update($name, $price, $quantity, $category) {      
            
            if ($this->isFormRegisterNotEmpty($name, $price, $quantity, $category)) {     
                
                $productTemp = new Product();
                $productTemp->setId($id);                
                $clientTemp->setName($name);

				if ($this->productDAO->checkName($name) == null) {                                                                           
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    
        
                    $product = new Product();        
                    $product->setId($id);    
                    $product->setName($name_s);
                    $product->setPrice($price);
                    $product->setQuantity($quantity);
                    $product->setCategory($category);
                    
                    if ($this->productDAO->update($product)) {                                                
                        return $this->listProductPath(null, PRODUCT_UPDATE);
                    } else {                        
                        return $this->listProductPath(DB_ERROR, null);        
                    }
                }                
                return $this->updateProductPath($id, NAME_ERROR);
            }            
            return $this->updateProductPath($id ,EMPTY_FIELDS);
        }



    }
    
?>