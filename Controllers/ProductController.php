<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;  
    use DAO\ProductDAO as ProductDAO;

    class ProductController {

        private $productDAO;
        private $adminController;

        public function __construct() {
            $this->adminController = new AdminController();
            $this->productDAO = new ProductDAO();
        }

        private function add($id, $name, $price, $category, $isActive) {
            $product = new Product();
            $product->setId($id);
            $product->setName($name);
            $product->setPrice($price);
            $product->setCategory($category);
            $product->setIsActive($isActive);
            			
            if ($this->productDAO->add($product)) {
                return $product;
            } else {
                return false;
            }
        }

        public function addProductPath($alert = "", $success = "") {
            if ($admin = $this->isLogged()) {                                       
                $title = "Añadir product";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-product.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->userPath();
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