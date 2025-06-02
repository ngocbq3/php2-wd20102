<?php

namespace App\Controllers;

use App\Models\Product;

class ProductController
{
    public function index()
    {
        $products = Product::select(['*'])
            ->where('category_id', '=', 3)
            ->andWhere('price', '>', 50)
            ->orderBy('name', 'DESC')
            ->limit(5)
            ->get();
        dd($products);
    }

    public function store()
    {
        $data = [
            'name' => 'Test 1',
            'image' => 'No Image',
            'description' => 'Mô tả ví dụ',
            'price' => 100,
            'stock' => 99,
            'category_id' => 3
        ];

        $id = Product::create($data);
        dd($id);
    }
}
