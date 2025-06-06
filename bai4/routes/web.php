<?php

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
