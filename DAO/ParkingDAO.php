<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Parking as Parking;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class BeachTentDAO {

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
