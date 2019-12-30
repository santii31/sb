<?php

    namespace Controllers;    

    class ProviderController {

        
        public function addProviderPath($alert = "", $success = "") {
			// if (isset($_SESSION["loggedUser"])) {
            //     $admin = $_SESSION["loggedUser"];
            //     if ($admin->getRole() == 1) {
            //         $roleController = new RoleController();
            //         $roles = $roleController->getAllRoles();
            //         if ($roles) {
                        $title = "Añadir proveedor";
                        require_once(VIEWS_PATH . "head.php");
                        require_once(VIEWS_PATH . "sidenav.php");
                        require_once(VIEWS_PATH . "add-provider.php");
                        require_once(VIEWS_PATH . "footer.php");
            //         } else {
            //             return $this->adminPath();
            //         }
            //     } else {
            //         return $this->userPath();
            //     }
			// }
			// else {
			// 	return $this->userPath();
			// }
		}

        public function listProviderPath($alert = "", $success = "") {
            // if (isset($_SESSION["loggedUser"])) {
            //     $admin = $_SESSION["loggedUser"];
            //     if ($admin->getRole() == 1) {
            //         $users = $this->userDAO->getAll();
            //         if ($users) {
                        $title = "Proveedores";
                        require_once(VIEWS_PATH . "head.php");
                        require_once(VIEWS_PATH . "sidenav.php");
                        require_once(VIEWS_PATH . "list-providers.php");
                        require_once(VIEWS_PATH . "footer.php");
            //         } else {
            //             return $this->adminPath();
            //         }
            //     } else {
            //         return $this->userPath();
            //     }
            // } else {
            //     return $this->userPath();
            // }
        } 

    }
    
?>