<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Parking as Parking;	
	use Models\ParkingHall as ParkingHall;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ParkingDAO {

		private $connection;
		private $parkingList = array();
		private $tableName = "parking";		

		public function __construct() { }

        					
		public function getById(Parking $parking) {
			try {				
				$parking = null;
				$query = "CALL parking_getById(?)";
				$parameters["id"] = $parking->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$parkingTemp = new Parking();
                    $parkingTemp->setId($row["id"]);
					$parkingTemp->setNumber($row["number"]);
					$parkingTent->setPrice($row["price"]);
				}
				return $parkingTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByNumber(Parking $parking) {
			try {				
				$parkingTemp = null;
				$query = "CALL parking_getByNumber(?)";
				$parameters["number"] = $parking->getNumber();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$parkingTemp = new Parking();
                    $parkingTemp->setId($row["id"]);
					$parkingTemp->setNumber($row["number"]);
					$parkingTemp->setPrice($row["price"]);
				}
				return $parkingTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getAll() {
			try {
				$query = "CALL parking_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $parking = new Parking();
                    $parking->setId($row["id"]);
					$parking->setNumber($row["number"]);
					$parking->setPrice($row["price"]);
                    
					array_push($this->parkingList, $parkingTent);
				}
				return $this->parkingList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function getN_row($row) {
			try {
				$parkings = array();
				$query = "CALL parking_getN_row(?)";
				$parameters["start"] = $row;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$parking = new Parking();
                    $parking->setId($row["id"]);
					$parking->setNumber($row["number"]);
					$parking->setPrice($row["price"]);                    					
					$parking->setPosition($row["position"]);      

					$hall = new ParkingHall();
					$hall->setNumber($row["hall_number"]);

					$parking->setHall($hall);

					array_push($parkings, $parking);
				}
				return $parkings;	
			} catch (Exception $e) {
				return false;								
			}
		}		

    }

 ?>
