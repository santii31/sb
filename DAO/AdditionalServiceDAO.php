<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Admin as Admin;	
	use Models\AdditionalService as AdditionalService;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdditionalServiceDAO {

		private $connection;
		private $additionalServiceList = array();
		private $tableName = "additional_service";		

		public function __construct() { }


		public function add(AdditionalService $additionalService, Admin $registerBy) {
            try {
                $query = "CALL service_add(?, ?, ?, @lastId)";				
				$parameters["total"] = $additionalService->getTotal();	
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();
				$this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
                
                foreach ($results as $row) {
                    $lastId = $row['lastId'];                
                }
                
                return $lastId;
            } catch(Exception $e) {
				return false;
				// echo $e;
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
                    $additionalServiceTemp->setTotal($row["service_total"]);
					$additionalServiceTemp->setIsActive($row["service_is_active"]);
				}
				return $additionalServiceTemp;
			} catch (Exception $e) {
				return false;
				// echo $e;
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
					$additionalService->setTotal($row["service_total"]);
					$additionalService->setIsActive($row["service_is_active"]);

					array_push($this->additionalServiceList, $additionalService);
				}
				return $this->additionalServiceList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(AdditionalService $additionalService, Admin $enableBy) {
			try {
				$query = "CALL service_enableById(?, ?, ?)";
				$parameters["id"] = $additionalService->getId();
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

		public function disableById(AdditionalService $additionalService, Admin $disableBy) {
			try {
				$query = "CALL service_disableById(?, ?, ?)";
				$parameters["id"] = $additionalService->getId();
				$parameters["date_disable"] = date("Y-m-d");
				$parameters["disable_by"] = $disableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}						

		public function update(AdditionalService $additionalService, Admin $updateBy) {
			try {												
				$query = "CALL service_update(?, ?, ?, ?)";						
				$parameters["total"] = $additionalService->getTotal();				
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();				
				$parameters["id"] = $additionalService->getId();				
				$this->connection = Connection::GetInstance();				
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);	
			} catch (Exception $e) {
				return false;				
				// echo $e;
			}
		}

    }

 ?>