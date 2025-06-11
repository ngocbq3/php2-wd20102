<?php

use App\Controllers\Admin\ProductController;

$router->mount('/admin', function () use ($router) {

    $router->get('/products', ProductController::class . "@index");
    $router->get('/products/create', ProductController::class . "@create"); //form
    $router->post('/products/create', ProductController::class . "@store"); //add to database
    $router->post('/products/delete/{id}', ProductController::class . "@destroy");
    $router->get('/products/edit/{id}', ProductController::class . "@edit"); //form
    $router->post('/products/edit/{id}', ProductController::class . "@update"); //update
});

$router->before('GET|POST', '/admin.*', function () {
    if (!isset($_SESSION['user'])) {
        redirect('auth/login');
    } else {
        if ($_SESSION['user']->role != 'admin') {
            redirect('');
        }
    }
});
