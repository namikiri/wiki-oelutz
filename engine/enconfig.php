<?php
if (!defined('THIS_IS_NYANN'))
	header ('Location: http://natribu.org');

define ('DB_HOST', 'localhost');
define ('DB_NAME', 'database');
define ('DB_USER', 'username');
define ('DB_PASSWORD', 'password');
define ('RECAP_PUBLIC', 'recaptcha_public_key');
define ('RECAP_SEC', 'recaptcha_private_key');

define ('CDN_PASS', 'control_panel_passwd');
define ('CDN_SALT', 'some_security_salt');


?>