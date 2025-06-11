@extends('admin.admin')

@section('title')
    Thêm sản phẩm
@endsection

@section('content')
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" value="{{ $product['name'] ?? '' }}" class="form-control">
                @isset($errors['name'])
                    <span class="text-danger">{{ $errors['name'] }}</span>
                @endisset
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                @isset($errors['image'])
                    <span class="text-danger">{{ $errors['image'] }}</span>
                @endisset
            </div>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" 
                            @isset($product['category_id'])
                                @selected($cate->id == $product['category_id'])
                            @endisset
                            >
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" value="{{ $product['price'] ?? '' }}" step="0.1"
                    class="form-control">
                @isset($errors['price'])
                    <span class="text-danger">{{ $errors['price'] }}</span>
                @endisset
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $product['stock'] ?? '' }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="10" class="form-control">{{ $product['description'] ?? '' }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{ route('admin/products') }}" class="btn btn-primary">List</a>
            </div>
        </form>
    </div>
@endsection
