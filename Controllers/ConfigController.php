<?php

    namespace Controllers;    

    use Models\Admin as Admin;
    use Models\Config as Config;
    use DAO\ConfigDAO as ConfigDAO;
    use Controllers\AdminController as AdminController;

    class ConfigController {

        private $configDAO;
        private $adminController;

        public function __construct() {        
            $this->adminController = new AdminController();
            $this->configDAO = new ConfigDAO();
        }

        
        public function updateValuesPath($alert = "", $success = "") {        
            if ($admin = $this->adminController->isLogged()) {                    
                $title = "Configuracion - Actualizar";          
                $cfg = $this->configDAO->get();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "config.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }

        public function update($date_s, $date_e, $season, $january, $january_day, $january_fortnigh, $february, $february_day,
                               $february_first_fortnigh, $february_second_fortnigh, $parasol) {

            if ($this->isFormUpdateNotEmpty($date_s, $date_e, $season, $january, $january_day, $january_fortnigh, $february, $february_day,
                                            $february_first_fortnigh, $february_second_fortnigh, $parasol)) {
                                
                $season_s = filter_var($season, FILTER_SANITIZE_NUMBER_FLOAT);
                $january_s = filter_var($january, FILTER_SANITIZE_NUMBER_FLOAT);
                $january_day_s = filter_var($january_day, FILTER_SANITIZE_NUMBER_FLOAT);
                $january_fortnigh_s = filter_var($january_fortnigh, FILTER_SANITIZE_NUMBER_FLOAT);
                $february_s = filter_var($february, FILTER_SANITIZE_NUMBER_FLOAT);
                $february_day_s = filter_var($february_day, FILTER_SANITIZE_NUMBER_FLOAT);
                $february_first_fortnigh_s = filter_var($february_first_fortnigh, FILTER_SANITIZE_NUMBER_FLOAT);
                $february_second_fortnigh_s = filter_var($february_second_fortnigh, FILTER_SANITIZE_NUMBER_FLOAT);
                $parasol_s = filter_var($parasol, FILTER_SANITIZE_NUMBER_FLOAT);

                $config = new Config();
                $config->setDateStartSeason($date_s);
                $config->setDateEndSeason($date_e);
                $config->setPriceTentSeason($season_s);
                $config->setPriceTentJanuary($january_s);
                $config->setPriceTentJanuaryDay($january_day_s);
                $config->setPriceTentJanuaryFortnigh($january_fortnigh_s);
                $config->setPriceTentFebruary($february_s);
                $config->setPriceTentFebruaryDay($february_day_s);
                $config->setPriceTentFebruaryFirstFortnigh($february_first_fortnigh_s);
                $config->setPriceTentFebruarySecondFortnigh($february_second_fortnigh_s);
                $config->setPriceParasol($parasol_s);

                $update_by = $this->adminController->isLogged();

                if ($this->configDAO->update($config, $update_by)) {                    
                    return $this->updateValuesPath(null, CONFIG_UPDATE);
                }                
                return $this->updateValuesPath(DB_ERROR, null);
            } 
            return $this->updateValuesPath(EMPTY_FIELDS, null);
        }

        private function isFormUpdateNotEmpty($date_s, $date_e, $season, $january, $january_day, $january_fortnigh, $february, $february_day,
                                              $february_first_fortnigh, $february_second_fortnigh, $parasol) {
            if (empty($date_s) || 
                empty($date_e) || 
                empty($season) || 
                empty($january) || 
                empty($january_day) || 
                empty($january_fortnigh) || 
                empty($february) || 
                empty($february_day) || 
                empty($february_first_fortnigh) || 
                empty($february_second_fortnigh) ||                 
                empty($parasol)) {
                    return false;
            }
            return true;
        }

        
    }    
?>
