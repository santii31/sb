<?php

    namespace Controllers;    
    
    use Models\Product as Product;    
    use Controllers\ProductController as ProductController; 
    use Controllers\AdminController as AdminController; 

    class StockController {
        
        private $adminController;
        private $productController;
        
        public function __construct() {
            $this->adminController = new AdminController();
            $this->productController = new ProductController();
        }   

        public function listStockPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Stock";                
                $products = $this->productController->getProducts();        
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "stock.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

        private function getProviderByProduct(Product $product) {
            return $this->productController->getProviderByProduct($product);
        }

        public function addStock($id_product, $quantity) {
            var_dump($id_product);
            var_dump($quantity);
        }

        public function removeStock($id_product, $quantity) {
            var_dump($id_product);
            var_dump($quantity);
        }
        
    }
    
?>
