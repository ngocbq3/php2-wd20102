<?php

use App\Controllers\Admin\ProductController;

$router->mount('/admin', function () use ($router) {

    $router->get('/products', ProductController::class . "@index");
    $router->get('/products/create', ProductController::class . "@create");
    $router->post('/products/create', ProductController::class . "@store");
    $router->post('/products/{id}', ProductController::class . "@destroy");
});
