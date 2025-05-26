@extends('layout')

@section('title')
    $product->name
@endsection

@section('content')
    <div>
        <h3>tên sản phẩm: {{ $product->name }}</h3>
        <div>
            Giá: {{ $product->price }}
        </div>
        <div>
            <img src="{{ APP_URL . $product->image }}" width="190" alt="">
        </div>
        <div>
            {{ $product->description }}
        </div>
    </div>
@endsection
