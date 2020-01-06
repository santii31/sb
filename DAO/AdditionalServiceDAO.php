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
				$parameters["total"] = $additionalService->getTotal();				
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
                    $additionalServiceTemp->setTotal($row["service_total"]);
					$additionalServiceTemp->setIsActive($row["service_is_active"]);
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
					$additionalServiceTemp->setTotal($row["service_total"]);        
					$additionalServiceTemp->setIsActive($row["service_is_active"]);           
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
					$additionalService->setTotal($row["service_total"]);
					$additionalService->setIsActive($row["service_isActive"]);

					array_push($this->additionalServiceList, $additionalService);
				}
				return $this->additionalServiceList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(AdditionalService $additionalService) {
			try {
				$query = "CALL service_enableById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(AdditionalService $additionalService) {
			try {
				$query = "CALL service_disableById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}						

		// 
		public function checkDescription(AdditionalService $additionalService) {

		}

		public function update(AdditionalService $additionalService) {
			try {								
				$query = "CALL service_update(?, ?, ?)";		
				$parameters["description"] = $additionalService->getDescription();
				$parameters["total"] = $additionalService->getTotal();				
				$parameters["id"] = $additionalService->getId();				
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);	

			} catch (Exception $e) {
				// return false;				
				echo $e;
			}
		}

    }

 ?>
