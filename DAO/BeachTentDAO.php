<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\BeachTent as BeachTent;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class BeachTentDAO {

		private $connection;
		private $beachTentList = array();
		private $tableName = "beach_tent";		

		public function __construct() { }

		
        public function add() {
			
		}
					
		public function getById(BeachTent $beachTent) {
			try {				
				$beachTentTemp = null;
				$query = "CALL tent_getById(?)";
				$parameters["id"] = $beachTent->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$beachTentTemp = new BeachTent();
                    $beachTentTemp->setId($row["id"]);
					$beachTentTemp->setNumber($row["number"]);
					$beachTent->setPrice($row["price"]);
                    $beachTentTemp->setIsActive($row["is_active"]);
				}
				return $beachTentTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByNumber(BeachTent $beachTent) {
			try {				
				$beachTentTemp = null;
				$query = "CALL tent_getByNumber(?)";
				$parameters["number"] = $beachTent->getNumber();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$beachTentTemp = new BeachTent();
                    $beachTentTemp->setId($row["id"]);
					$beachTentTemp->setNumber($row["number"]);
					$beachTentTemp->setPrice($row["price"]);
                    $beachTentTemp->setIsActive($row["is_active"]);
				}
				return $beachTentTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getAll() {
			try {
				$query = "CALL reservation_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $beachTent = new BeachTent();
                    $beachTent->setId($row["id"]);
					$beachTent->setNumber($row["number"]);
					$beachTent->setPrice($row["price"]);
                    $beachTent->setIsActive($row["is_active"]);
                    
					array_push($this->beachTentList, $beachTent);
				}
				return $this->beachTentList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				

    }

 ?>
