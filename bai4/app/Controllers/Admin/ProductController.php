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
            ->orderBy('products.id', 'desc')
            ->get();
        return view("admin.products.index", compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.products.create", compact('categories'));
    }

    public function store()
    {
        $product = $_POST;
        //Xử lý ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = "images/" . $file['name']; //đường dẫn ảnh
            move_uploaded_file($file['tmp_name'], $image); //upload ảnh

            //đưa ảnh vào mảng
            $product['image'] = $image;
        }

        Product::create($product);
        return redirect('admin/products');
    }

    public function destroy($id)
    {
        Product::delete($id);
        return redirect('admin/products');
    }
}
