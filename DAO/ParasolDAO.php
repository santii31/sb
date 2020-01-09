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
                    $parasolTemp->setId($row["parasol.id"]);
                    $parasolTemp->setChestNumber($row["parasol.number"]);
                    $parasolTemp->setPrice($row["parasol.price"]);
                    
                    
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
                    $parasol->setId($row["parasol.id"]);
                    $parasol->setChestNumber($row["parasol.number"]);
                    $parasol->setPrice($row["parasol.price"]);
                    
                    
					array_push($this->parasolList, $parasol);
				}
				return $this->parasolList;	
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
