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

// logout
if (isset($_REQUEST['logout'])) {
	phpCAS::logout();
}

$username = phpCAS::getUser();
$_SESSION['username'] = $username;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    error_log("login from session");
    header("Location: display.php");
    exit;
}                                                                        
?>







