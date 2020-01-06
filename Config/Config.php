<?php

    namespace Config;
    
    define("ROOT", dirname(__DIR__) . "/");
	// define("FRONT_ROOT", "http://localhost/sb/");	//no borrar - yo uso este
	define("FRONT_ROOT", "http://localhost/sb/");
    define("VIEWS_PATH", "Views/");
	define("CSS_PATH", FRONT_ROOT . VIEWS_PATH . "assets/css/");
	define("JS_PATH", FRONT_ROOT . VIEWS_PATH . "assets/js/");	
	define("IMG_PATH", FRONT_ROOT . VIEWS_PATH . "assets/img/");	

	//DB
	define("DB_HOST", "localhost");
	define("DB_NAME", "southbeach");
	define("DB_USER", "root");
	define("DB_PASS", "");

	//ERR MSGS
	define("DB_ERROR", "Un error ha ocurrido. Intente mas tarde!");	

	define("LOGIN_NEEDED", "Inicie sesión para continuar.");
	define("LOGIN_ERROR", "El email ingresado o la contraseña son incorrectos.");	
	define("REGISTER_ERROR", "El email ingresado ya se encuentra registrado.");
	define("EMPTY_FIELDS", "Complete los campos correctamente para continuar.");
	
	define("ADMIN_ADDED", "Administrador añadido con éxito .");
	define("ADMIN_DNI", "El DNI ingresado ya se encuentra registrado.");
	define("ADMIN_DISABLE", "Administrador deshabilitado con éxito.");
	define("ADMIN_ENABLE", "Administrador habilitado con éxito.");
	define("ADMIN_UPDATE", "Administrador modificado con éxito.");
	define("ACCOUNT_DISABLE", "Cuenta deshabilitada. Contacte con los administradores.");
	define("DISABLE_YOURSELF", "No puedes deshabilitarte a ti mismo.");

	define("SERVICE_ADDED", "Servicio adicional añadido con éxito.");
	define("SERVICE_ERROR", "El servicio adicional ya se encuentra registrado.");
	define("SERVICE_DISABLE", "Servicio adicional deshabilitado con éxito.");
	define("SERVICE_ENABLE", "Servicio adicional habilitado con éxito.");
	define("SERVICE_UPDATE", "Servicio adicional modificado con éxito.");

	define("PROVIDER_ADDED", "Proveedor añadido con éxito.");
	define("PROVIDER_ERROR", "El proveedor ya se encuentra registrado.");
	define("PROVIDER_DISABLE", "Proveedor deshabilitado con éxito.");
	define("PROVIDER_ENABLE", "Proveedor habilitado con éxito.");
	define("PROVIDER_UPDATE", "Proveedor modificado con éxito.");

	define("CLIENT_ADDED", "Cliente potencial añadido con éxito.");
	define("CLIENT_ERROR", "El cliente potencial ya se encuentra registrado.");
	define("CLIENT_DISABLE", "Cliente potencial deshabilitado con éxito.");
	define("CLIENT_ENABLE", "Cliente potencial habilitado con éxito.");
	define("CLIENT_UPDATE", "Cliente potencial modificado con éxito.");

	define("PRODUCT_ADDED", "Producto añadido con éxito.");
	define("PRODUCT_ERROR", "El producto ya se encuentra registrado.");
	define("PRODUCT_DISABLE", "Producto deshabilitado con éxito.");
	define("PRODUCT_ENABLE", "Producto habilitado con éxito.");
	define("PRODUCT_UPDATE", "Producto modificado con éxito.");
		
	define("STAFF_ADDED", "Empleado añadido con éxito.");
	define("STAFF_ERROR", "El Empleado ya se encuentra registrado.");
	define("STAFF_DISABLE", "Empleado deshabilitado con éxito.");
	define("STAFF_ENABLE", "Empleado habilitado con éxito.");
	define("STAFF_UPDATE", "Empleado modificado con éxito.");

	// Reservas
	define("RESERVATION_ADDED", "Reserva añadida con éxito.");
	define("RESERVATION_ERROR", "La carpa se encuentra reservada.");		
		

?>
