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
            if ($admin = $this->adminController->isLogged()) {

                $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

                if ($quantity_s >= 1 ) {
                    
                    $product = new Product();
                    $product->setId($id_product);

                    $productTemp = $this->productController->getById($product);                    
                    $currQuantity = $productTemp->getQuantity();
                    $currQuantity += $quantity_s;

                    $product->setQuantity($currQuantity);

                    if ($this->productController->addQuantity($product, $admin)) {
                        return $this->listStockPath(null, STOCK_ADDED);            
                    }
                    return $this->listStockPath(DB_ERROR, null);   
                }
                return $this->listStockPath(STOCK_ZERO, null);  
            } else {
                return $this->adminController->userPath();
            }          
        }

        public function removeStock($id_product, $quantity) {
            if ($admin = $this->adminController->isLogged()) {

                $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

                if ($quantity_s >= 1 ) {
                    
                    $product = new Product();
                    $product->setId($id_product);

                    $productTemp = $this->productController->getById($product);                    
                    $currQuantity = $productTemp->getQuantity();
                    
                    if ($currQuantity >= $quantity_s ) {
                        
                        $currQuantity -= $quantity_s;
    
                        $product->setQuantity($currQuantity);
    
                        if ($this->productController->removeQuantity($product, $admin)) {
                            return $this->listStockPath(null, STOCK_REMOVE);            
                        }
                        return $this->listStockPath(DB_ERROR, null);            
                    }
                    return $this->listStockPath(STOCK_REMOVE_ERROR, null);            
                }
                return $this->listStockPath(STOCK_ZERO, null);  
            } else {
                return $this->adminController->userPath();
            } 
        }
        
    }
    
?>
