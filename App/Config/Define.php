<?php
define("DIR_ROOT", $_SERVER["DOCUMENT_ROOT"] . "/");
define("DIR_APP", DIR_ROOT . "App/");
define("DIR_CONTROLLERS", DIR_APP . "Controllers/");
define("DIR_MODELS", DIR_APP . "Models/");
define("DIR_VIEWS", DIR_APP . "Views/");
define("DIR_AJAX", DIR_APP . "Ajax/");
define("DIR_LIBS", DIR_ROOT . "Libs/");
define("DIR_INCLUDE", DIR_VIEWS . "Include/");
define("REDIRECT_URL", $_SERVER["REDIRECT_URL"]);
define("REQUEST_URI", $_SERVER["REQUEST_URI"]);

//Connect to DataBase

define("DB_SERVER", "localhost");	//	HOST
define("DB_USER", "root");	// USERNAME
define("DB_PASS", "");	// PASSWORD
define("DB_NAME", "store");	// DATABASE NAME

require_once( DIR_LIBS . "BackEnd/redbeans/rb.php" );

R::setup( 'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME , DB_USER, DB_PASS );

R::ext('xdispense', function( $type ){
    return R::getRedBean()->dispense( $type );
});
