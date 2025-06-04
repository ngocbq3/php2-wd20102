<?php

use App\Controllers\Admin\ProductController;

$router->get('/admin/products', ProductController::class . "@index");
