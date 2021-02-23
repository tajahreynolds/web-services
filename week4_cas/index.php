<?php
// start the session
session_start();

require_once 'config.php';   //get configuration
require_once 'CAS.php';      //load CAS
phpCAS::setDebug('/tmp/phpCAS'); //enable debugging

// Initialize phpCAS from settings in config.php
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
phpCAS::setNoCasServerValidation();  // disables ssl server verification - ok for testing and required for now

phpCAS::forceAuthentication();
$username = phpCAS::getUser();
$_SESSION['username'] = $username;

// logout
if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
} else {
    error_log("login from CAS");
    header("Location: display.php");
}                                                              
?>







