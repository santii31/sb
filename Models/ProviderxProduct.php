<?php

    namespace Models;

    use Models\Provider as Provider;
    use Models\Product as Product;

    class ProviderxProduct {

        private $provider;  
        private $product;      

        public function getProvider() {
            return $this->provider;
        }

        public function setProvider(Provider $provider) {
            $this->provider = $provider;            
        }

        public function getProduct() {
            return $this->product;
        }

        public function setProduct(Product $product) {
            $this->product = $product;            
        }
        
        // public function getTotal() {
        //     return $this->total;
        // }

        // public function setTotal($total) {
        //     $this->total = $total;            
        // }
        
        // public function getDiscount() {
        //     return $this->discount;
        // }

        // public function setDiscount($discount) {
        //     $this->discount = $discount;            
        // }

        // public function getTransactionDate() {
        //     return $this->transaction_date;
        // }

        // public function setTransactionDate($transaction_date) {
        //     $this->transaction_date = $transaction_date;            
        // }
        

    }

?>