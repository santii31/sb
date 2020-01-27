<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Admin as Admin;	
	use Models\Provider as Provider;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProviderDAO {

		private $connection;
		private $providerList = array();
		private $tableName = "provider";		

		public function __construct() { }

		
        public function add(Provider $provider, Admin $registerBy) {								
			try {					
				$query = "CALL provider_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $provider->getName();
				$parameters["lastname"] = $provider->getLastName();
				$parameters["tel"] = $provider->getPhone();
				$parameters["email"] = $provider->getEmail();
                $parameters["dni"] = $provider->getDni();
                $parameters["address"] = $provider->getAddress();
                $parameters["cuil"] = $provider->getCuilNumber();
                $parameters["social_reason"] = $provider->getSocialReason();
				$parameters["type_billing"] = $provider->getBilling();     
				$parameters["item"] = $provider->getItem();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();           
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;		
				// echo $e;		
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
					$providerTemp->setItem($row["item"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByItem(Provider $provider) {
			try {				
				$providerList = array();
				$query = "CALL provider_getByItem(?)";
				$parameters["item"] = $provider->getItem();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$provider = new Provider();
					$provider->setId($row["id"]);
					$provider->setName($row["name"]);
					$provider->setLastName($row["lastname"]);
                    $provider->setPhone($row["tel"]);
                    $provider->setEmail($row["email"]);
					$provider->setDni($row["dni"]);				
                    $provider->setAddress($row["address"]);
                    $provider->setCuilNumber($row["cuil"]);
                    $provider->setSocialReason($row["social_reason"]);
					$provider->setBilling($row["type_billing"]);
					$provider->setItem($row["item"]);
					$provider->setIsActive($row["is_active"]);

					$admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

					$provider->setRegisterBy($admin);

					array_push($providerList, $provider);
				}
				return $providerList;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getByDni(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getByDni(?)";
				$parameters["dni"] = $provider->getDni();
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
					$providerTemp->setItem($row["item"]);
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
					$providerTemp->setItem($row["item"]);
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
					$providerTemp->setItem($row["item"]);
					$providerTemp->setIsActive($row["is_active"]);
					
					$admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

					$providerTemp->setRegisterBy($admin);
					
					array_push($this->providerList, $providerTemp);
				}
				return $this->providerList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function getAllActives() {
			try {
				$list = array();
				$query = "CALL provider_getAllActives()";
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
					$providerTemp->setItem($row["item"]);
					$providerTemp->setIsActive($row["is_active"]);
					
					$admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

					$providerTemp->setRegisterBy($admin);
					
					array_push($list, $providerTemp);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function enableById(Provider $provider, Admin $enableBy) {
			try {
				$query = "CALL provider_enableById(?, ?, ?)";
				$parameters["id"] = $provider->getId();
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

		public function disableById(Provider $provider, Admin $disableBy) {
			try {
				$query = "CALL provider_disableById(?, ?, ?)";
				$parameters["id"] = $provider->getId();
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
				
		public function checkEmail(Provider $provider) {
			try {
				$query = "CALL provider_checkEmail(?, ?)";
				$parameters["email"] = $provider->getEmail();
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function checkDni(Provider $provider) {
			try {
				$query = "CALL provider_checkDni(?, ?)";
				$parameters["dni"] = $provider->getDni();
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}		
		
		public function update(Provider $provider, Admin $updateBy) {
			try {								
				$query = "CALL provider_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $provider->getName();
				$parameters["lastname"] = $provider->getLastName();
				$parameters["tel"] = $provider->getPhone();
				$parameters["email"] = $provider->getEmail();
                $parameters["dni"] = $provider->getDni();
                $parameters["address"] = $provider->getAddress();
                $parameters["cuil"] = $provider->getCuilNumber();
                $parameters["social_reason"] = $provider->getSocialReason();
				$parameters["type_billing"] = $provider->getBilling();
				$parameters["item"] = $provider->getItem(); 			
				$parameters["id"] = $provider->getId(); 	
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}
		
		public function getActiveCount() {
            try {				
                $query = "CALL provider_getActiveCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getDisableCount() {
            try {				
                $query = "CALL provider_getDisableCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;                
            }
        }

        public function getAllActiveWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL provider_getAllActiveWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$provider = new Provider();
					$provider->setId($row["id"]);
					$provider->setName($row["name"]);
					$provider->setLastName($row["lastname"]);
                    $provider->setPhone($row["tel"]);
                    $provider->setEmail($row["email"]);
					$provider->setDni($row["dni"]);				
                    $provider->setAddress($row["address"]);
                    $provider->setCuilNumber($row["cuil"]);
                    $provider->setSocialReason($row["social_reason"]);
					$provider->setBilling($row["type_billing"]);
					$provider->setItem($row["item"]);
					$provider->setIsActive($row["is_active"]);

					$admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

					$provider->setRegisterBy($admin);

					array_push($list, $provider);
				}
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getAllDisableWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL provider_getAllDisableWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$provider = new Provider();
					$provider->setId($row["id"]);
					$provider->setName($row["name"]);
					$provider->setLastName($row["lastname"]);
                    $provider->setPhone($row["tel"]);
                    $provider->setEmail($row["email"]);
					$provider->setDni($row["dni"]);				
                    $provider->setAddress($row["address"]);
                    $provider->setCuilNumber($row["cuil"]);
                    $provider->setSocialReason($row["social_reason"]);
					$provider->setBilling($row["type_billing"]);
					$provider->setItem($row["item"]);
					$provider->setIsActive($row["is_active"]);
					
					$admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

					$provider->setRegisterBy($admin);

					array_push($list, $provider);       
                }
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }

    }

 ?>
