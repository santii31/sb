<?php

    namespace DAO;

	use \Exception as Exception;	
	use Models\BeachTent as BeachTent;	
	use Models\Hall as Hall;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class BeachTentDAO {

		private $connection;
		private $beachTentList = array();
		private $tableName = "beach_tent";		

		public function __construct() { }

		
        public function add() { }
					
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
                    // $beachTentTemp->setIsActive($row["is_active"]);
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
				$list = array();
				$query = "CALL tent_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $beachTent = new BeachTent();
                    $beachTent->setId($row["id"]);
					$beachTent->setNumber($row["number"]);
					$beachTent->setPrice($row["price"]);                                        
					array_push($list, $beachTent);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}		

		public function getAllWithActualReservation($today) {
			try {
				$query = "CALL tent_getAllWithActualReservation(?)";
				$parameters["today"] = $today;		
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);	
				foreach ($results as $row) {
					return $row["total"];
				}
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}	
		
		// no use...
		public function getAllWithoutReservation($today) {
			try {
				$query = "CALL tent_getAllWithoutReservation(?)";
				$parameters["today"] = $today;		
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);	
				foreach ($results as $row) {
					return $row["total"];
				}
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

 		public function getN_row($row) {
			try {
				$tents = array();
				$query = "CALL tent_getN_row(?)";
				$parameters["start"] = $row;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$beachTent = new BeachTent();
                    $beachTent->setId($row["id"]);
					$beachTent->setNumber($row["number"]);
					$beachTent->setPrice($row["price"]);                    
					$beachTent->setPosition($row["position"]);      

					$hall = new Hall();
					$hall->setNumber($row["hall_number"]);

					$beachTent->setHall($hall);

					array_push($tents, $beachTent);
				}
				return $tents;	
			} catch (Exception $e) {
				return false;								
			}
		}

		public function getSea_N_row($row) {
			try {
				$tents = array();
				$query = "CALL tent_getSea_N_row(?)";
				$parameters["start"] = $row;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$beachTent = new BeachTent();
                    $beachTent->setId($row["id"]);
					$beachTent->setNumber($row["number"]);
					$beachTent->setPrice($row["price"]);                    
					$beachTent->setPosition($row["position"]);      

					$hall = new Hall();
					$hall->setNumber($row["hall_number"]);

					$beachTent->setHall($hall);

					array_push($tents, $beachTent);
				}
				return $tents;	
			} catch (Exception $e) {
				return false;				
			}
		}
				

    }

 ?>
