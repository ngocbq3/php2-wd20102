@extends('layout')

@section('title')
    Trang chủ
@endsection

@section('content')
    <h1>Trang chủ website</h1>

    @foreach ($products as $product)
        <div>
            Tên sản phẩm:
            <a href="{{ APP_URL . 'product/' . $product->id }}">{{ $product->name }}</a>
            <br>
            Price: {{ $product->price }}
        </div>
        <hr>
    @endforeach
@endsection
