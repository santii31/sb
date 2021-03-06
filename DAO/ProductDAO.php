<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Product as Product;
	use Models\Category as Category;
	use Models\Admin as Admin;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProductDAO {

		private $connection;
		private $productList = array();
		private $tableName = "product";		

		public function __construct() { }

		
        public function add(Product $product, Admin $registerBy) {								
			try {													
				$query = "CALL product_add(?, ?, ?, ?, ?, ?, @lastId)";
				$parameters["name"] = $product->getName();
				$parameters["price"] = $product->getPrice();
				$parameters["quantity"] = $product->getQuantity();
				$parameters["FK_id_category"] = $product->getCategory()->getId();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();
				$this->connection = Connection::getInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

				foreach ($results as $row) {
                    $lastId = $row['lastId'];                
                }
				return $lastId;
			}
			catch (Exception $e) {
				return false;				
				// echo $e;
			}			
        }
					
		public function getById(Product $product) {
			try {				
				$productTemp = null;
				$query = "CALL product_getById(?)";
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$productTemp = new Product();
                    $productTemp->setId($row["product_id"]);
                    $productTemp->setName($row["product_name"]);
					$productTemp->setPrice($row["product_price"]);
					$productTemp->setQuantity($row["product_quantity"]);
                    $productTemp->setIsActive($row["product_isActive"]);

                    $category = new Category();
                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);                    

                    $productTemp->setCategory($category);
				}
				return $productTemp;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getByCategory(Product $product) {
			try {				
				$productList = array();
				$query = "CALL product_getByCategory(?)";
				$parameters["FK_id_category"] = $product->getCategory()->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					
					$product = new Product();
                    $product->setId($row["product_id"]);
                    $product->setName($row["product_name"]);
					$product->setPrice($row["product_price"]);
					$product->setQuantity($row["product_quantity"]);
                    $product->setIsActive($row["product_isActive"]);

                    $category = new Category();
                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);                    

					$product->setCategory($category);
					
					array_push($productList, $product);
				}
				return $productList;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

        public function getByName(Product $product) {
			try {				
				$productTemp = null;
				$query = "CALL product_getByName(?)";
				$parameters["name"] = $product->getName();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$productTemp = new Product();
                    $productTemp->setId($row["id"]);
                    $productTemp->setName($row["name"]);
					$productTemp->setPrice($row["price"]);
					$productTemp->setQuantity($row["quantity"]);
                    $productTemp->setIsActive($row["is_active"]);

                    $category = new Category();
                    $category->setId($row["id"]);
                    $category->setName($row["name"]);                    

                    $productTemp->setCategory($category);
				}
				return $productTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL product_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$product = new Product();
                    $product->setId($row["product_id"]);
                    $product->setName($row["product_name"]);
					$product->setPrice($row["product_price"]);
					$product->setQuantity($row["product_quantity"]);
					$product->setIsActive($row["product_isActive"]);
					$product->setDateRegister($row["product_date_register"]);

                    $category = new Category();
                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);                    

                    $product->setCategory($category);
					array_push($this->productList, $product);
				}
				return $this->productList;	
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}		

		public function checkName(Product $product) {
			try {
				$query = "CALL product_checkName(?, ?)";
				$parameters["name"] = $product->getName();
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}
				
		public function enableById(Product $product, Admin $enableBy) {
			try {
				$query = "CALL product_enableById(?, ?, ?)";
				$parameters["id"] = $product->getId();
				$parameters["date_enable"] = date("Y-m-d");
				$parameters["enable_by"] = $enableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Product $product, Admin $disableBy) {
			try {
				$query = "CALL product_disableById(?)";
				$parameters["date_disable"] = date("Y-m-d");
				$parameters["disable_by"] = $disableBy->getId();
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}		

		public function update(Product $product, Admin $updateBy) {
			try {								
				$query = "CALL product_update(?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $product->getName();
				$parameters["price"] = $product->getPrice();
				$parameters["quantity"] = $product->getQuantity();
				$parameters["FK_id_category"] = $product->getCategory()->getId();
				$parameters["update_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId(); 	
				$parameters["id"] = $product->getId(); 	
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}

		public function addQuantity(Product $product, Admin $addedBy) {
			try {								
				$query = "CALL product_add_quantity(?, ?, ?, ?)";						
				$parameters["quantity"] = $product->getQuantity();				
				$parameters["date_add"] = date("Y-m-d");
				$parameters["add_by"] = $addedBy->getId(); 	
				$parameters["id"] = $product->getId(); 	
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}

		public function removeQuantity(Product $product, Admin $removeBy) {
			try {								
				$query = "CALL product_remove_quantity(?, ?, ?, ?)";						
				$parameters["quantity"] = $product->getQuantity();				
				$parameters["date_remove"] = date("Y-m-d");
				$parameters["remove_by"] = $removeBy->getId(); 	
				$parameters["id"] = $product->getId(); 	
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}

		public function getActiveCount() {
            try {				
                $query = "CALL product_getActiveCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
				return false;
				// echo $e;
            }
        }

        public function getDisableCount() {
            try {				
                $query = "CALL product_getDisableCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
				return false;                
				// echo $e;
            }
        }

        public function getAllActiveWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL product_getAllActiveWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$product = new Product();
                    $product->setId($row["product_id"]);
                    $product->setName($row["product_name"]);
					$product->setPrice($row["product_price"]);
					$product->setQuantity($row["product_quantity"]);
					$product->setIsActive($row["product_isActive"]);
					$product->setDateRegister($row["product_date_register"]);

                    $category = new Category();
                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);                    

                    $product->setCategory($category);
					array_push($list, $product);
				}
                return $list;
            }
            catch (Exception $ex) {
				return false;
				// echo $ex;
            }
        }

        public function getAllDisableWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL product_getAllDisableWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$product = new Product();
                    $product->setId($row["product_id"]);
                    $product->setName($row["product_name"]);
					$product->setPrice($row["product_price"]);
					$product->setQuantity($row["product_quantity"]);
					$product->setIsActive($row["product_isActive"]);
					$product->setDateRegister($row["product_date_register"]);

                    $category = new Category();
                    $category->setId($row["category_id"]);
                    $category->setName($row["category_name"]);                    

                    $product->setCategory($category);
					array_push($list, $product);
                }
                return $list;
            }
            catch (Exception $ex) {
				return false;
				// echo $ex;
            }
        }

    }

 ?>
