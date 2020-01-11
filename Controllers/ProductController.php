<?php

    namespace Controllers;    

    use Models\Category as Category;
    use Models\Product as Product;
    use DAO\ProductDAO as ProductDAO;
    use Controllers\CategoryController as CategoryController;  
    use Controllers\AdminController as AdminController;  

    class ProductController {

        private $productDAO;
        private $adminController;
        private $categoryController;

        public function __construct() {
            $this->productDAO = new ProductDAO();
            $this->adminController = new AdminController();
            $this->categoryController = new CategoryController();
        }

        private function add($id_category, $name, $price, $quantity) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

            $product = new Product();            
            $product->setName( strtolower($name_s) );
            $product->setPrice($price);
            $product->setQuantity($quantity_s);

            $category = new Category();
            $category->setId($id_category);

            $product->setCategory($category);            

            $register_by = $this->adminController->isLogged();
            
            if ($this->productDAO->add($product, $register_by)) {
                return true;
            } else {
                return false;
            }
        }

        public function addProduct($id_category, $name, $price, $quantity) {
            if ($this->isFormRegisterNotEmpty($id_category, $name, $price, $quantity)) {
                
                $productTemp = new Product();
                $productTemp->setName($name);                
                
				if ($this->productDAO->getByName($productTemp) == null) {                                                            
                    if ($this->add($id_category, $name, $price, $quantity)) {            
                        return $this->addProductPath(null, PRODUCT_ADDED);
                    } else {                        
                        return $this->addProductPath(DB_ERROR, null);        
                    }
                }                
                return $this->addProductPath(PRODUCT_ERROR, null);
            }            
            return $this->addProductPath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($id_category, $name, $price, $quantity) {
            if (empty($id_category) || 
                empty($name) || 
                empty($price) || 
                empty($quantity)) {
                    return false;
            }
            return true;
        }

        public function addProductPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Producto - Añadir";
                $categories = $this->categoryController->getCategorys();
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
                // $category = $this->categoryDAO->getAll();
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
                $title = "Producto - Modificar informacion";       
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

        public function update($id_category, $name, $price, $quantity) {      
            
            if ($this->isFormRegisterNotEmpty($id_category, $name, $price, $quantity)) {     
                
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
                            
                    $category = new Category();
                    $category->setId($id_category);

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