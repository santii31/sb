<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Reservation as Reservation;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationDAO {

		private $connection;
		private $reservationList = array();
		private $tableName = "admin";		

		public function __construct() {

		}

        public function add(Reservation $reservation) {								
			try {					
				$query = "CALL reservation_add(?, ?, ?, ?, ?, ?)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["FK_id_client"] = $reservation->getClient()->getId();
                $parameters["FK_id_admin"] = $reservation->getAdmin()->getId();
                $parameters["is_active"] = $reservation->getIsActive();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getById(Reservation $reservation) {
			try {				
				$reservationTemp = null;
				$query = "CALL reservation_getById(?)";
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$reservationTemp = new Reservation();
					$reservationTemp->setId($row["id"]);
					$reservationTemp->setDateStart($row["date_start"]);
                    $reservationTemp->setDateEnd($row["date_end"]);
                    $reservationTemp->setPrice($row["total_price"]);
                    $reservationTemp->setClient($row["FK_id_client"]);
                    $reservationTemp->setAdmin($row["FK_id_client"]);
					$reservationTemp->setIsActive($row["is_active"]);
				}
				return $reservationTemp;
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
                    $reservation = new Reservation();
					$reservation->setId($row["id"]);
					$reservation->setDateStart($row["date_start"]);
                    $reservation->setDateEnd($row["date_end"]);
                    $reservation->setPrice($row["total_price"]);
                    $reservation->setClient($row["FK_id_client"]);
                    $reservation->setAdmin($row["FK_id_client"]);
                    $reservation->setIsActive($row["is_active"]);
                    
					array_push($this->reservationList, $reservation);
				}
				return $this->reservationList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(Reservation $reservation) {
			try {
				$query = "CALL reservation_enableById(?)";
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Reservation $reservation) {
			try {
				$query = "CALL reservation_disableById(?)";
				$parameters["id"] = $reservation->getId();
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
