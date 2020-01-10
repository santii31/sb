<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Parasol as Parasol;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ParasolDAO {

		private $connection;
		private $parasolList = array();
		private $tableName = "parasol";		

		public function __construct() { }
		
					
		public function getById(Parasol $parasol) {
			try {				
				$parasolTemp = null;
				$query = "CALL parasol_getById(?)";
				$parameters["id"] = $parasol->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$parasolTemp = new Parasol();
                    $parasol->setId($row["id"]);
                    $parasol->setParasolNumber($row["parasol_number"]);
                    $parasol->setPrice($row["price"]);                                    					
					$parasol->setPosition($row["position"]);
                    
				}
				return $parasolTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL parasol_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$parasol = new Parasol();
                    $parasol->setId($row["id"]);
                    $parasol->setParasolNumber($row["parasol_number"]);
                    $parasol->setPrice($row["price"]);                                    					
					$parasol->setPosition($row["position"]);
                    
					array_push($this->parasolList, $parasol);
				}
				return $this->parasolList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function getN_row($row) {
			try {
				$parasolTemp = array();
				$query = "CALL parasol_getN_row(?)";
				$parameters["start"] = $row;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$parasol = new Parasol();
                    $parasol->setId($row["id"]);
                    $parasol->setParasolNumber($row["parasol_number"]);
                    $parasol->setPrice($row["price"]);                                    					
					$parasol->setPosition($row["position"]);
					array_push($parasolTemp, $parasol);
				}
				return $parasolTemp;	
			} catch (Exception $e) {
				return false;								
			}
		}
	
    }

 ?>
