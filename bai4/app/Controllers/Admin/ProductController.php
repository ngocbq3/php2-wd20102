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

        //Validate
        $errors = [];
        if ($product['name'] == "") {
            $errors['name'] = "Bạn chưa nhập tên";
        }
        if ($product['price'] == "" || $product['price'] < 0) {
            $errors['price'] = "Giá cần nhập số nguyên dương";
        }

        //Xử lý ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = "images/" . $file['name']; //đường dẫn ảnh
            move_uploaded_file($file['tmp_name'], $image); //upload ảnh

            //đưa ảnh vào mảng
            $product['image'] = $image;
        }
        //Trường hợp có lỗi khi validate
        if ($errors) {
            $categories = Category::all();
            return view('admin.products.create', compact('categories', 'errors', 'product'));
        }
        Product::create($product);
        return redirect('admin/products');
    }

    public function destroy($id)
    {
        Product::delete($id);
        return redirect('admin/products');
    }

    //form edit
    public function edit($id)
    {
        //lấy sản phẩm muốn cập nhật
        $product = Product::find($id);
        //lấy danh sách danh mục
        $categories = Category::all();

        //Lấy thông báo khi cập nhật
        $message = $_SESSION['message'] ?? "";
        //Xóa session
        unset($_SESSION['message']);
        return view("admin.products.edit", compact('product', 'categories', 'message'));
    }

    //Update to database
    public function update($id)
    {
        $product = $_POST;
        //Xử lý ảnh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = "images/" . $file['name']; //đường dẫn ảnh
            move_uploaded_file($file['tmp_name'], $image); //upload ảnh

            //đưa ảnh vào mảng
            $product['image'] = $image;

            //lấy dữ liệu cũ để xóa ảnh
            $product_old = Product::find($id);
            if (file_exists($product_old->image)) {
                unlink($product_old->image);
            }
        }

        $_SESSION['message'] = "Cập nhật dữ liệu thành công";

        Product::update($id, $product);
        return redirect("admin/products/edit/$id");
    }
}
