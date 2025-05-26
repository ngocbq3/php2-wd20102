<?php

namespace App\Controllers;

use App\Models\Product;

class HomeController
{
    //Hiển thị trang chủ
    public function index()
    {
        $products = Product::all();
        return view("home", compact('products'));
    }

    public function admin()
    {
        return view('admin.dashboard');
    }
}
