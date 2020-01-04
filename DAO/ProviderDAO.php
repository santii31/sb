<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Provider as Provider;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProviderDAO {

		private $connection;
		private $providerList = array();
		private $tableName = "provider";		

		public function __construct() {

		}

        public function add(Provider $provider) {								
			try {					
				$query = "CALL provider_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $provider->getName();
				$parameters["lastname"] = $provider->getLastName();
				$parameters["tel"] = $provider->getPhone();
				$parameters["email"] = $provider->getEmail();
                $parameters["dni"] = $provider->getDni();
                $parameters["address"] = $address->getAddress();
                $parameters["cuil"] = $provider->getCuilNumber();
                $parameters["social_reason"] = $provider->getSocialReason();
                $parameters["type_billing"] = $provider->getBilling();
                $parameters["is_active"] = $provider->getIsActive();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getById(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getById(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}


        public function getByEmail(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getByEmail(?)";
				$parameters["email"] = $provider->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		
		public function getAll() {
			try {
				$query = "CALL provider_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
					array_push($this->providerList, $provider);
				}
				return $this->providerList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(Provider $provider) {
			try {
				$query = "CALL provider_enableById(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Provider $provider) {
			try {
				$query = "CALL provider_disableById(?)";
				$parameters["id"] = $provider->getId();
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
