@extends('layouts.app')

@section('content')
@if(Auth::check())
    @if(Auth::user()->role == 'admin')
    <div class="text-center mt-4" style=height:150px>
        <h1>管理者用・商品の編集/削除</h1>
    </div>
    @endif
@endif
<div class="text-center mt-4 mb-4">
    <h1>商品詳細</h1>
</div>
    <div class="col-md-10 d-flex mt-4 item_show">
        <div class="mb-4">
            <img src="{{ Storage::disk('s3')->url($item->image_url) }}" alt="item-img" class="card-img-top">
        </div>
        <div class="pt-4 col-md-4 content">
            <div class="mt-2">
                <p>商品名：{{ $item->item_title }}</p>
            </div>
            {!! nl2br(e($item->content)) !!}
            <div class="mt-2">
                <p>￥{{ $item->price }}</p>
            </div>
            <div>
                <p>残り：{{ $item->item_quantity }}個</p>
            </div>
            @if($item->item_quantity)
                <div>
                    @include('cart.cart_buttton')
                </div>
            @else
                <div class="text-danger mb-4">在庫切れ</div>
            @endif
        </div>
    </div>

@if(Auth::check())
    @if(Auth::user()->role == 'admin')
    <div>
        @include('admin.admin_update')
        @include('admin.admin_del_button')
    </div>
    @endif
@endif
@endsection