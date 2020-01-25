<?php

    namespace Controllers;    
    
    use Models\Product as Product;    
    use Controllers\AdminController as AdminController; 
    use Controllers\ProductController as ProductController; 

    class StockController {
        
        private $adminController;
        private $productController;
        
        public function __construct() {
            $this->adminController = new AdminController();
            $this->productController = new ProductController();
        }   
        

        public function listStockPath($page = 1, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                
                $title = "Stock";                
                $productsCount = $this->productController->getActiveCount();         
                $pages = ceil ($productsCount / MAX_ITEMS_PAGE);                                                                  

                // This variable will contain the number of the current page
                $current = 0;                  

                if ($page == 1) {                                        
                    $products = $this->productController->getAllActiveWithLimit(0);
                } else {
                    $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                    $products = $this->productController->getAllActiveWithLimit($startFrom);                    
                }
                                  
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
                        return $this->listStockPath(1, null, STOCK_ADDED);            
                    }
                    return $this->listStockPath(1, DB_ERROR, null);   
                }
                return $this->listStockPath(1, STOCK_ZERO, null);  
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
                            return $this->listStockPath(1, null, STOCK_REMOVE);            
                        }
                        return $this->listStockPath(1, DB_ERROR, null);            
                    }
                    return $this->listStockPath(1, STOCK_REMOVE_ERROR, null);            
                }
                return $this->listStockPath(1, STOCK_ZERO, null);  
            } else {
                return $this->adminController->userPath();
            } 
        }
        
    }
    
?>
