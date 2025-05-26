<?php

use App\Controllers\HomeController;

require_once __DIR__ . '/env.php';
require_once __DIR__ . "/app/helper.php";
// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

//Create define router
$router->get('/about', function () {
    echo "About page";
});
$router->get('/contact', function () {
    echo "Contact page";
});
$router->get("/", "App\Controllers\HomeController@index");
$router->get("/admin", HomeController::class . "@admin");

//Tham số trên đường dẫn
$router->get('/{id}/posts', function ($id) {
    echo "Post is ID: $id";
});


// Run it!
$router->run();
