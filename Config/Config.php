<?php

    namespace Config;
    
    define("ROOT", dirname(__DIR__) . "/");
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
	define("DB_ERROR", "An error has ocurred. Try later!");	

	define("SHOW_ADDED", "Show added with success.");
	define("SHOW_DISABLE", "Show disable with success.");
	define("SHOW_ENABLE", "Show enable with success.");
	define("SHOW_ERROR", "Can't add the show! Check the date, hour or the movie and try again.");
	define("SHOW_CHECK_DAY", "The show must be at least one day anticipation.");
	define("SHOW_EXIST", "This show has already been registered.");	
	
	define("USER_ADDED", "User added with success.");
	define("USER_DISABLE", "User disable with success.");
	define("USER_ENABLE", "User enable with success.");
	define("ACCOUNT_DISABLE", "Your account is disabled at the moment. Contact the admin.");
	define("ELIMINATE_YOURSELF", "You can't disable yourself.");

	define("LOGIN_NEEDED", "Please! Login to continue.");
	define("LOGIN_ERROR", "You have entered an invalid e-mail or password. Try again!");	
	define("REGISTER_ERROR", "This email address has already been registered.");
	define("EMPTY_FIELDS", "Complete all the fields correctly to continue.");

	define("IMAGE_UPLOAD", "Image upload with success.");
	define("IMAGE_UPLOAD_ERROR", "An error has ocurred. The image can't upload.");
	define("IMAGE_TYPE_ERROR", "The file does not correspond to an image");

?>
