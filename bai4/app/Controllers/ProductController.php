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
            'name' => 'Test 2',
            'image' => 'No Image',
            'description' => 'Mô tả 2',
            'price' => 101,
            'stock' => 9922,
            'category_id' => 3
        ];

        $id = Product::create($data);
        dd($id);
    }

    public function update()
    {
        $data = [
            'name' => 'Test 1 update',
            'image' => 'No Image',
            'description' => 'Mô tả ví dụ update',
            'price' => 100,
            'stock' => 999,
            'category_id' => 3
        ];
        Product::update(108, $data);
    }

    public function destroy()
    {
        Product::delete(1);
    }
}
