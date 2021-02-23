<?php
// start the session
session_start();

require_once 'config.php';   //get configuration
require_once 'CAS.php';      //load CAS lib
phpCAS::setDebug('/tmp/phpCAS'); //enable debugging

// Initialize phpCAS from settings in config.php
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);

// disables ssl server verification - ok for testing and required for now
phpCAS::setNoCasServerValidation();  

// For production use set the CA certificate that is the issuer of the cert
// on the CAS server and uncomment the line below
// phpCAS::setCasServerCACert($cas_server_ca_cert_path);

// force CAS authentication
phpCAS::forceAuthentication();

// at this step, the user has been authenticated by the CAS server
// and the user's login name can be read with phpCAS::getUser().

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







