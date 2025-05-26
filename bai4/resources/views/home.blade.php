@extends('layout')

@section('title')
    Trang chủ
@endsection

@section('content')
    <h1>Trang chủ website</h1>

    @foreach ($products as $product)
        <div>
            Tên sản phẩm: {{ $product->name }}
        </div>
        <hr>
    @endforeach
@endsection
