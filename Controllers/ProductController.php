<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;  
    use DAO\ProductDAO as ProductDAO;
    use DAO\CategoryDAO as CategoryDAO;

    class ProductController {

        private $productDAO;
        private $categoryDAO;
        private $adminController;

        public function __construct() {
            $this->productDAO = new ProductDAO();
            $this->categoryDAO = new CategoryDAO();
            $this->adminController = new AdminController();
        }

        private function add($id, $name, $price, $quantity, $category) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

            $product = new Product();
            $product->setId($id);
            $product->setName( strtolower($name_s) );
            $product->setPrice($price);
            $product->setQuantity($quantity_s);
            $product->setCategory($category);            

            $register_by = $this->adminController->isLogged();
            			
            if ($this->productDAO->add($product, $register_by)) {
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
                empty($category)) {
                    return false;
            }
            return true;
        }

        public function addProductPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Añadir producto";
                $categories = $this->categoryDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-product.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function listProductPath($alert = "", $success = "", $id_category) {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Productos";
                $category = $this->categoryDAO->getAll();
                $products = $this->productDAO->getByCategory($id_category);
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
                if ($this->productDAO->enableById($product, $admin)) {
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
                if ($this->productDAO->disableById($product, $admin)) {
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
                    $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);
        
                    $product = new Product();        
                    $product->setId($id);    
                    $product->setName( strtolower($name_s) );
                    $product->setPrice($price);
                    $product->setQuantity($quantity_s);
                    $product->setCategory($category);

                    $update_by = $this->adminController->isLogged();
                    
                    if ($this->productDAO->update($product, $update_by)) {                                                
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