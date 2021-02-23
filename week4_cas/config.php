// Full Hostname of your CAS Server
$cas_host = 'auth.miamioh.edu/cas';
// Context of the CAS Server
$cas_context = '';
// Port of your CAS server. Normally for a https server it's 443
$cas_port = 443;
// Client config for cookie hardening
$client_domain = 'ceclnx01.cec.miamioh.edu';
$client_path = 'phpcas';
$client_secure = true;
$client_httpOnly = true;
$client_lifetime = 0;
// Initialize phpCAS from settings in config.php
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_context);
phpCAS::setNoCasServerValidation();  // disables ssl server verification - ok for testing and required for now
