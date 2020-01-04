<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Category as Category;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class CategoryDAO {

		private $connection;
		private $categoryList = array();
		private $tableName = "category";		

		public function __construct() {

		}

        
					
		public function getById(Category $category) {
			try {				
				$categoryTemp = null;
				$query = "CALL category_getById(?)";
				$parameters["id"] = $category->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$categoryTemp = new Category();
                    $categoryTemp->setId($row["id"]);
                    $categoryTemp->setName($row["name"]);
                    $categoryTemp->setDescription($row["description"]);
				}
				return $categoryTemp;
			} catch (Exception $e) {
				return false;
			}
        }
        
        public function getByName(Category $category) {
			try {				
				$categoryTemp = null;
				$query = "CALL category_getByName(?)";
				$parameters["name"] = $category->getName();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$categoryTemp = new Category();
                    $categoryTemp->setId($row["id"]);
                    $categoryTemp->setName($row["name"]);
                    $categoryTemp->setDescription($row["description"]);
				}
				return $categoryTemp;
			} catch (Exception $e) {
				return false;
			}
		}


		public function getAll() {
			try {
				$query = "CALL category_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $categoryTemp = new Category();
                    $categoryTemp->setId($row["id"]);
                    $categoryTemp->setName($row["name"]);
                    $categoryTemp->setDescription($row["description"]);
					array_push($this->categoryList, $category);
				}
				return $this->categoryList;	
			} catch (Exception $e) {
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
