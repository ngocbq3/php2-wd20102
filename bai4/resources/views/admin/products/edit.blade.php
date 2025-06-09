@extends('admin.admin')

@section('title')
    Cập nhật sản phẩm
@endsection

@section('content')
    <div class="container">
        @if ($message != '')
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('admin/products/edit/' . $product->id) }}" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ $product->name }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label> <br>
                <img src="{{ APP_URL . $product->image }}" width="100" alt=""> <br>

                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Category Name</label>
                <select name="category_id" id="" class="form-control">
                    @foreach ($categories as $cate)
                        <option value="{{ $cate->id }}" @selected($product->category_id == $cate->id)>
                            {{ $cate->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" step="0.1" class="form-control" value="{{ $product->price }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="10" class="form-control">{{ $product->description }}</textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin/products') }}" class="btn btn-primary">List</a>
            </div>
        </form>
    </div>
@endsection
