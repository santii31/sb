<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\AdditionalService as AdditionalService;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdditionalServiceDAO {

		private $connection;
		private $additionalServiceList = array();
		private $tableName = "additional_service";		

		public function __construct() { }


		public function add(AdditionalService $additionalService) {
			try {					
				$query = "CALL service_add(?, ?)";
				$parameters["description"] = $additionalService->getDescription();
				$parameters["price"] = $additionalService->getPrice();				
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				throw $e;
			}
		}        				

		public function getById(AdditionalService $additionalService) {
			try {				
				$additionalServiceTemp = null;
				$query = "CALL service_getById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$additionalServiceTemp = new AdditionalService();
                    $additionalServiceTemp->setId($row["service_id"]);
                    $additionalServiceTemp->setDescription($row["service_description"]);
                    $additionalServiceTemp->setPrice($row["service_total"]);

				}
				return $additionalServiceTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByDescription(AdditionalService $additionalService) {
			try {				
				$additionalServiceTemp = null;
				$query = "CALL service_getByDescription(?)";
				$parameters["description"] = $additionalService->getDescription();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$additionalServiceTemp = new AdditionalService();
                    $additionalServiceTemp->setId($row["service_id"]);
                    $additionalServiceTemp->setDescription($row["service_description"]);
                    $additionalServiceTemp->setPrice($row["service_total"]);                   
				}
				return $additionalServiceTemp;
			} catch (Exception $e) {
				return false;
			}
		}		
		
		public function getAll() {
			try {
				$query = "CALL service_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
                    $additionalService->setPrice($row["service_total"]);

					array_push($this->additionalServiceList, $additionalService);
				}
				return $this->additionalServiceList;	
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
