@extends('layouts.app')

@section('content')
<div class="text-center m-5">
    <h1>カート内商品</h1>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if($errors->first('quantity'))
        <div class="alert alert-danger">
            {{ $errors->first('quantity') }}
        </div>
    @endif
    
</div>
    @if(count($cart_items) > 0)
    <div class="row">
        <div class="col-md-8">
            @foreach($cart_items as $cart_item)
            @if($cart_item->item_quantity > 0)
                <div class="mb-4 d-flex">
                    <div class="col-md-8">
                        <img src="{{ Storage::disk('s3')->url($cart_item->image_url) }}" alt="item-img" class="card-img-top">
                    </div>
                    <div class="col-md-4 pl-0 pr-0 pt-4 d-flex flex-column">
                        <div class="mt-2">
                            <p>商品名：{{ $cart_item->item_title }}</p>
                        </div>
                        {!! nl2br(e($cart_item->content)) !!}
                        <div class="mt-2">
                            <select name="quantity_{{ $cart_item->id }}"
                                onchange="location.href='{{ route('cart_item.update', ['id' => $cart_item->id]) }}?quantity=' + this.value">
                                @for ($num = 1; $num <= 10; $num++)
                                    <option {{ ($cart_item->pivot->quantity == $num) ? "selected" : "" }}>{{ $num }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="mt-1">
                            <p>数量：{{ $cart_item->pivot->quantity }}</p>
                        </div>
                        <div>
                            <p>￥{{ $cart_item->price }}</p>
                        </div>
                        <div>
                            {!! Form::open(['route' => ['cart_item.delete', $cart_item->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
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
                @if($totalPrice > 0)
                    <div>    
                        {!! link_to_route('order.get', '注文画面へ進む', [], ['class'=>'btn btn-primary']) !!}
                    </div>
                @endif
            </div>
    </div>
    @else
        <div class="text-center bg-light p-5">
            <p class="h1 p-5 text-danger">カートに商品がありません</div>
        </div>
    @endif
@endsection