<?php

namespace App\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Category::select(['products.*', 'categories.name as cate_name'])
            ->join('products', 'category_id')
            ->get();
        return view("admin.products.index", compact('products'));
    }
}
