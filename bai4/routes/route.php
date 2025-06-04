<?php

require_once __DIR__ . '/../env.php';
require_once __DIR__ . "/../app/helper.php";
// Require composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

require_once "web.php";
require_once "admin.php";

// Run it!
$router->run();
