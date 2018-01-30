<?php

/**
 * Directory
 * ended with slash (/)
 */

$serverip = $_SERVER['SERVER_ADDR'] == "::1" ? 'localhost' : $_SERVER['SERVER_ADDR'];


define('DOMAIN', 'localhost');
define('API', 'api');

define('URLKEY', 'https://' . DOMAIN . '');

define('URL', 'https://' . DOMAIN . '/' . API . '/');

define('LIBS', 'libs/');
define('CONTROLLERS', 'controllers/');
define('MODELS', 'models/');
define('VIEWS', 'views/');


/* ==================================================================================================== */