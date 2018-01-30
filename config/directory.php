<?php

/**
 * Directory
 * ended with slash (/)
 */

$serverip = $_SERVER['SERVER_ADDR'] == "::1" ? 'localhost' : $_SERVER['SERVER_ADDR'];


define('DOMAIN', '127.0.0.1');
define('API', 'kliksekolah_api');

define('URLKEY', 'http://' . DOMAIN . '');

define('URL', 'http://' . DOMAIN . '/' . API . '/');

define('LIBS', 'libs/');
define('CONTROLLERS', 'controllers/');
define('MODELS', 'models/');
define('VIEWS', 'views/');


/* ==================================================================================================== */