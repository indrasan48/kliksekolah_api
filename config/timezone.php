<?php

/**
 * set time zone
 * separator DATE_DEFAULT_FORMAT is -
 * set value DATE_DEFAULT_FORMAT with format character date PHP only [Y, m, d]
 */ 
define('DATE_DEFAULT_TIMEZONE_SET', 'Asia/jakarta');
date_default_timezone_set(DATE_DEFAULT_TIMEZONE_SET);
/* ==================================================================================================== */

/**
 * default date format for input data
 */
define('DATA_DATE_FORMAT', 'd-m-Y');
/* ==================================================================================================== */

/**
 * code format date and datetime from DB
 */
define('DB_DATE_FORMAT', 'd-m-Y');
define('DB_DATETIME_FORMAT', 'd-m-Y H:i:s');
/* ==================================================================================================== */
