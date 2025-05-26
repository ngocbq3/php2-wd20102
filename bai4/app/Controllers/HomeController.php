<?php

namespace App\Controllers;

use App\Models\Category;
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

    public function show($id)
    {
        $product = Product::find($id);
        return view('detail', compact('product'));

        // $products = Category::select(['products.*', 'categories.name'])
        //     ->join('products', 'category_id')
        //     ->get();
        // dd($products);
    }
}
