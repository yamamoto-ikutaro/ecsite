@extends('layouts.app')

@section('content')
    <div class="text-center m-5">
        <h1>注文画面</h1>
    </div>
        <div class="row">
            <div class="col-md-8">
            @foreach($cart_items as $cart_item)
            @if($cart_item->item_quantity > 0)
                <div class="col-md-12 mb-4 d-flex">
                    <div class="col-md-7">
                        <img src="{{ Storage::disk('s3')->url($cart_item->image_url) }}" alt="item-img" class="card-img-top">
                    </div>
                    <div class="col-md-5 pl-0 pr-0 pt-4 d-flex flex-column">
                        <div class="mt-2">
                            <p>商品名：{{ $cart_item->item_title }}</p>
                        </div>
                        {!! nl2br(e($cart_item->content)) !!}
                        <div class="mt-2">
                            <p>数量：{{ $cart_item->pivot->quantity }}個</p>
                        </div>
                        <div>
                            <p>￥{{ $cart_item->price }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="text-danger col-md-12 mb-4">{{ $cart_item->item_title }}が在庫切れのためカートから削除されました。</div>
            @endif
            @endforeach
            </div>
            <div class="col-md-4 sidebar">
                @include('cart.cart_total_fee')
                @include('order.deliveryInfo')
            </div>
        </div>
@endsection