<?php

    namespace Models;
    
    class Config {
        
        private $date_start_season;
        private $date_end_season;
        private $price_tent_season;        
        private $price_tent_january;
        private $price_tent_january_day;
        private $price_tent_january_fortnigh;        
        private $price_tent_february;
        private $price_tent_february_day;
        private $price_tent_february_first_fortnigh;
        private $price_tent_february_second_fortnigh;
        private $price_parasol;
                        

        public function getDateStartSeason() {
            return $this->date_start_season;
        }

        public function setDateStartSeason($date_start_season) {
            $this->date_start_season = $date_start_season;
        }

        public function getDateEndSeason() {
            return $this->date_end_season;
        }

        public function setDateEndSeason($date_end_season) {
            $this->date_end_season = $date_end_season;
        }

        public function getPriceTentSeason() {
            return $this->price_tent_season;
        }

        public function setPriceTentSeason($price_tent_season) {
            $this->price_tent_season = $price_tent_season;
        }

        public function getPriceTentJanuary() {
            return $this->price_tent_january;
        }

        public function setPriceTentJanuary($price_tent_january) {
            $this->price_tent_january = $price_tent_january;
        }

        public function getPriceTentJanuaryDay() {
            return $this->price_tent_january_day;
        }

        public function setPriceTentJanuaryDay($price_tent_january_day) {
            $this->price_tent_january_day = $price_tent_january_day;
        }

        public function getPriceTentJanuaryFortnigh() {
            return $this->price_tent_january_fortnigh;
        }

        public function setPriceTentJanuaryFortnigh($price_tent_january_fortnigh) {
            $this->price_tent_january_fortnigh = $price_tent_january_fortnigh;
        }                                    
        
        public function getPriceTentFebruary() {
            return $this->price_tent_february;
        }

        public function setPriceTentFebruary($price_tent_february) {
            $this->price_tent_february = $price_tent_february;
        }

        public function getPriceTentFebruaryDay() {
            return $this->price_tent_february_day;
        }

        public function setPriceTentFebruaryDay($price_tent_february_day) {
            $this->price_tent_february_day = $price_tent_february_day;
        }

        public function getPriceTentFebruaryFirstFortnigh() {
            return $this->price_tent_february_first_fortnigh;
        }

        public function setPriceTentFebruaryFirstFortnigh($price_tent_february_first_fortnigh) {
            $this->price_tent_february_first_fortnigh = $price_tent_february_first_fortnigh;
        }

        public function getPriceTentFebruarySecondFortnigh() {
            return $this->price_tent_february_second_fortnigh;
        }

        public function setPriceTentFebruarySecondFortnigh($price_tent_february_second_fortnigh) {
            $this->price_tent_february_second_fortnigh = $price_tent_february_second_fortnigh;
        }
        
        public function getPriceParasol() {
            return $this->price_parasol;
        }

        public function setPriceParasol($price_parasol) {
            $this->price_parasol = $price_parasol;
        }

    }

?>