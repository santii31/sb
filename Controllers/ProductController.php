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

        private function add($id, $name, $price, $category) {

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

    }
    
?>