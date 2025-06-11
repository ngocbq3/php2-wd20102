<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;

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

$router->get('/product/{id}', HomeController::class . '@show');
$router->get('/products', ProductController::class . "@index");
$router->get('/products/store', ProductController::class . "@store");
$router->get('/products/update', ProductController::class . "@update");
$router->get('/products/delete', ProductController::class . "@destroy");

$router->set404(function () {
    header('HTTP/1.1 404 Not Found');
    echo "404 not found";
});

//Login & register
$router->get('/auth/login', AuthController::class . "@login");
$router->post('/auth/login', AuthController::class . "@postLogin");
$router->get('/auth/register', AuthController::class . "@register");
$router->post('/auth/register', AuthController::class . "@postRegister");

//Logout
$router->get('/auth/logout', AuthController::class . "@logout");
