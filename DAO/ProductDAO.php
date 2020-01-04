<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Product as Product;
    use Models\Category as Category;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProductDAO {

		private $connection;
		private $productList = array();
		private $tableName = "product";		

		public function __construct() {

		}

        public function add(Product $product) {								
			try {					
				$query = "CALL product_add(?, ?, ?, ?)";
				$parameters["name"] = $product->getName();
				$parameters["price"] = $product->getprice();
				$parameters["FK_id_category"] = $product->getCategory()->getId();
				$parameters["is_active"] = $product->getIsActive();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
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
                    $productTemp->setId($row["id"]);
                    $productTemp->setName($row["name"]);
                    $productTemp->setPrice($row["price"]);
                    $productTemp->setIsActive($row["is_active"]);

                    $category = new Category();
                    $category->setId($row["id"]);
                    $category->setName($row["name"]);
                    $category->setDescription($row["description"]);

                    $productTemp->setCategory($category);
				}
				return $productTemp;
			} catch (Exception $e) {
				return false;
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
                    $productTemp->setIsActive($row["is_active"]);

                    $category = new Category();
                    $category->setId($row["id"]);
                    $category->setName($row["name"]);
                    $category->setDescription($row["description"]);

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
					$productTemp = new Product();
                    $productTemp->setId($row["id"]);
                    $productTemp->setName($row["name"]);
                    $productTemp->setPrice($row["price"]);
                    $productTemp->setIsActive($row["is_active"]);

                    $category = new Category();
                    $category->setId($row["id"]);
                    $category->setName($row["name"]);
                    $category->setDescription($row["description"]);

                    $productTemp->setCategory($category);
					array_push($this->productList, $product);
				}
				return $this->productList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(Product $product) {
			try {
				$query = "CALL product_enableById(?)";
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Product $product) {
			try {
				$query = "CALL product_disableById(?)";
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}		

		/*
		public function updateUser(User $user) {
			try {								
				$query = "UPDATE " . $this->tableName . " AS user 
														  INNER JOIN profile_users AS p_user ON user.FK_dni =  p_user.dni
														 SET
															 user.mail = :mail,
															 user.password = :password,
															 p_user.dni = :dni,
															 p_user.first_name = :firstname,
															 p_user.last_name = :lastname
 														 WHERE 
															 p_user.dni = :dni";					
				
				$parameters["mail"] = $user->getMail();
				$parameters["password"] = $user->getPassword();
				$parameters["dni"] = $user->getDni();
				$parameters["firstname"] = $user->getFirstName();
				$parameters["lastname"] = $user->getLastName();				

				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters);								
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
		*/

    }

 ?>
