<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ProviderxProduct as ProviderxProduct;
    use Models\Provider as Provider;	
    use Models\Product as Product;
    use Models\Category as Category;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProviderxProductDAO {

		private $connection;
		private $providerxProductList = array();
		private $tableName = "providerxproduct";		

		public function __construct() { }

		
        public function add(ProviderxProduct $providerxproduct) {								
			try {					
				$query = "CALL providerxproduct_add(?, ?)";
				$parameters["FK_id_provider"] = $providerxproduct->getProvider()->getId();
				$parameters["FK_id_product"] = $providerxproduct->getProduct()->getId();			
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}			
        }
					
		public function getProductByProvider(Provider $provider) {
			try {				
				$providerxproductTemp = null;
				$query = "CALL providerxproduct_getProductByProvider(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    $providerxproductTemp = new ProviderxProduct();

                    $product = new Product();
                    $product->setId($row["id"]);
                    $product->setName($row["name"]);
                    $product->setPrice($row["price"]);
                    $product->setIsActive($row["is_active"]);

                    $category = new Category();
                    $category->setId($row["id"]);
                    $category->setName($row["name"]);
                    $category->setDescription($row["description"]);

                    $providerxproductTemp->setProduct($product);    					
				}
				return $providerxproductTemp;
			} catch (Exception $e) {
				return false;
			}
		}

        public function getProviderByProduct(Product $product) {
			try {				
				$providerxproductTemp = null;
				$query = "CALL providerxproduct_getProviderByProduct(?)";
				$parameters["id"] = $product->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    $providerxproductTemp = new ProviderxProduct();

                    $provider = new Provider();
					$provider->setId($row["provider_id"]);
					$provider->setName($row["provider_name"]);
					$provider->setLastName($row["provider_lastName"]);
                    $provider->setPhone($row["provider_tel"]);
                    $provider->setEmail($row["provider_email"]);
					$provider->setDni($row["provider_dni"]);				
                    $provider->setAddress($row["provider_address"]);
                    $provider->setCuilNumber($row["provider_cuil"]);
                    $provider->setSocialReason($row["provider_socialReason"]);
                    $provider->setBilling($row["provider_typeBilling"]);
                    $provider->setIsActive($row["provider_isActive"]);
                    $providerxproductTemp->setProvider($provider);                    					
				}
				return $providerxproductTemp;
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
					array_push($this->providerxproductList, $providerxproduct);
				}
				return $this->providerxproductList;	
			} catch (Exception $e) {
				return false;
			}
		}						

    }

 ?>
