<?php

/**
 * Login encryption hash
 */
define('HASH_PWD_KEY', 'KEYSALT');
define('HASH_PWD_ALGO', 'sha512');

/* ==================================================================================================== */

/**
 * CSRF encryption hash
 */
define('HASH_CSRF_KEY', 'CSRF_TOKEN_GENERATE');
define('HASH_CSRF_ALGO', 'sha512');
define('CSF_TOKEN_DEF', 'q');

/* ==================================================================================================== */

/**
 * TOKEN JWT
 */
/* ==================================================================================================== */
define('JWT_SALT', 'RANDOM');
