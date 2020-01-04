<?php

    namespace Config;
    
    define("ROOT", dirname(__DIR__) . "/");
	// define("FRONT_ROOT", "http://localhost/sb/");
	define("FRONT_ROOT", "/SouthBeach/");
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

	define("SHOW_ADDED", "Show added with success.");
	define("SHOW_DISABLE", "Show disable with success.");
	define("SHOW_ENABLE", "Show enable with success.");
	define("SHOW_ERROR", "Can't add the show! Check the date, hour or the movie and try again.");
	define("SHOW_CHECK_DAY", "The show must be at least one day anticipation.");
	define("SHOW_EXIST", "This show has already been registered.");	
	
	define("ADMIN_ADDED", "Administrador añadido con éxito .");
	define("ADMIN_DISABLE", "Administrador deshabilitado con éxito.");
	define("ADMIN_ENABLE", "Administrador habilitado con éxito.");
	define("ACCOUNT_DISABLE", "Esta cuenta se encuentra deshabilitada por el momento. Contacte con los administradores.");
	define("DISABLE_YOURSELF", "No puedes deshabilitarte a ti mismo.");

	define("LOGIN_NEEDED", "Inicie sesion para continuar.");
	define("LOGIN_ERROR", "El email ingresado o la contraseña son incorrectos. Intente nuevamente.");	
	define("REGISTER_ERROR", "Este email ya se encuentra registrado.");
	define("EMPTY_FIELDS", "Complete todos los campos correctamente para continuar.");	

?>
