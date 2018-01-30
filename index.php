<?php

header("Content-Type: application/json");

require './config.php';

spl_autoload_register(function($class) {
    require_once './'.LIBS . strtolower($class). '.php';
});

$app = new application();


