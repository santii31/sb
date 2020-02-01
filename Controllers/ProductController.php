<?php

    namespace Controllers;    

    use Models\Admin as Admin;
    use Models\Product as Product;
    use Models\Provider as Provider;
    use Models\Category as Category;
    use Models\ProviderxProduct as ProviderxProduct;
    use DAO\ProductDAO as ProductDAO;
    use DAO\ProviderxProductDAO as ProviderxProductDAO;
    use Controllers\AdminController as AdminController;  
    use Controllers\CategoryController as CategoryController;  

    class ProductController {

        private $productDAO;
        private $providerxProductDAO;
        private $adminController;
        private $categoryController;
        private $providerController;

        public function __construct() {
            $this->productDAO = new ProductDAO();
            $this->providerxProductDAO = new ProviderxProductDAO();
            $this->adminController = new AdminController();
            $this->categoryController = new CategoryController();
            $this->providerController = new ProviderController();
        }
        

        private function add($id_category, $id_provider, $name, $price, $quantity) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $quantity_s = filter_var($quantity, FILTER_SANITIZE_NUMBER_INT);

            $product = new Product();            
            $product->setName( strtolower($name_s) );
            $product->setPrice($price);
            $product->setQuantity($quantity_s);
            $category = new Category();
            $category->setId($id_category);
            $product->setCategory($category);  
            
            $provider = new Provider();
            $provider->setId($id_provider);

            $register_by = $this->adminController->isLogged();
            
            if ($lastId = $this->productDAO->add($product, $register_by)) {                                
                
                $product->setId($lastId);
                $providerProduct = new ProviderxProduct();
                $providerProduct->setProvider($provider);
                $providerProduct->setProduct($product);

                if ($this->providerxProductDAO->add($providerProduct)) {
                    return true;                    
                }
                return false;
            } else {
                return false;
            }
        }

        public function addProduct($id_category, $id_provider, $name, $price, $quantity) {

            // Saves the inputs in case of validation error
            $inputs = array(
                "cateogry" => $id_category,
                "provider" => $id_provider,
                "name"=> $name, 
                "price"=> $price,
                "quantity"=> $quantity
            );
            
            if ($this->isFormRegisterNotEmpty($id_category, $id_provider, $name, $price, $quantity)) {
                
                $productTemp = new Product();
                $productTemp->setName($name);                
                
				if ($this->productDAO->getByName($productTemp) == null) {                                                            
                    if ($this->add($id_category, $id_provider, $name, $price, $quantity)) {            
                        return $this->addProductPath(null, PRODUCT_ADDED);
                    } else {                        
                        return $this->addProductPath(DB_ERROR, null, $inputs);        
                    }
                }                
                return $this->addProductPath(PRODUCT_ERROR, null, $inputs);
            }            
            return $this->addProductPath(EMPTY_FIELDS, null, $inputs);            
        }

        private function isFormRegisterNotEmpty($id_category, $id_provider, $name, $price, $quantity) {
            if (empty($id_category) || 
                empty($id_provider) || 
                empty($name) || 
                empty($price) || 
                empty($quantity)) {
                    return false;
            }
            return true;
        }

        public function addProductPath($alert = "", $success = "", $inputs = array()) {
            if ($admin = $this->adminController->isLogged()) {                                       
                $title = "Producto - Añadir";
                $categories = $this->categoryController->getCategorys();
                $providers = $this->providerController->getProviders();
                $alert = sizeof($providers) > 0 ? null : PROVIDER_EMPTY;
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-product.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->adminController->userPath();
			}
        }

        public function searchPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Producto - Buscar por categoria";     
                $categories = $this->categoryController->getCategorys();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "search-product.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }   
        }

        public function search($value) {                              
            if ($admin = $this->adminController->isLogged()) { 
                if (!empty($value)) {
                    return $this->searchByCategory($value);                    
                }
                return $this->searchPath(EMPTY_FIELDS);
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function searchByCategory($id_category) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Producto - Buscar por categoria";
                
                $category = new Category();
                $category->setId($id_category);
                
                $product = new Product();
                $product->setCategory($category);                      

                $products = $this->productDAO->getByCategory($product);
                if (sizeof($products) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-product.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->searchPath(SEARCH_PRODUCT_EMPTY);
                }                
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

        public function updateProductPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Producto - Modificar informacion";       
                $productTemp = new Product();
                $productTemp->setId($id_product);                
                $product = $this->productDAO->getById($productTemp);
                $alert = sizeof($providers) > 0 ? null : PROVIDER_EMPTY;                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-product.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function update($id, $id_category, $name, $price, $quantity) {      
            
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


        // 
        public function getById(Product $product) {
            return $this->productDAO->getById($product);
        }

        public function addQuantity(Product $product, Admin $admin) {
            return $this->productDAO->addQuantity($product, $admin);
        }

        public function removeQuantity(Product $product, Admin $admin) {
            return $this->productDAO->removeQuantity($product, $admin);
        }

        public function getProducts() {
            return $this->productDAO->getAll();
        }

        public function getProviderByProduct(Product $product) {
            $provider = $this->providerxProductDAO->getProviderByProduct($product);
            $name = $provider->getProvider()->getName() . ' ' . $provider->getProvider()->getLastname();
            return $name;
        }

        // 
        public function getActiveCount() {
            return $this->productDAO->getActiveCount();
        }

        public function getDisableCount() {
            return $this->productDAO->getDisableCount();
        }

        public function getAllActiveWithLimit($start) {
            return $this->productDAO->getAllActiveWithLimit($start);
        }

        public function getAllDisableWithLimit($start) {
            return $this->productDAO->getAllDisableWithLimit($start);
        }

    }
    
?>