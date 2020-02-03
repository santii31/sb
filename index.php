<?php

	// 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// production
	// ini_set('display_errors', 0);
	// ini_set('display_startup_errors', 0);	
	// error_reporting(E_ALL);
	// log_errors = On
	
	// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	// header("Cache-Control: post-check=0, pre-check=0", false);
	// header("Pragma: no-cache");

	date_default_timezone_set('America/Argentina/Buenos_Aires');

	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;

	Autoload::start();

	session_start();

	Router::Route(new Request());

?>
