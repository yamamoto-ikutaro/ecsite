@extends('layouts.app')

@section('content')
<h1 class="text-center mt-4 mb-4">検索結果</h1>

<div class="row">
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="row">
                @if(count($items) > 0)
                    @foreach($items as $item)
                        <div class="card col-md-4">
                            <div class="mt-2 image_box">
                                <a href="{{ route('items.show', ['id'=>$item->id]) }}">
                                    <img src="{{ Storage::disk('s3')->url($item->image_url) }}" alt="item-img" class="card-img-top">
                                </a>
                            </div>
                            <div class="card-body pl-0 mt-5 pt-5">
                                <div class="mt-2">
                                    <p>商品名：{{ $item->item_title }}</p>
                                </div>
                                {!! nl2br(e($item->content)) !!}
                                <div class="mt-2">
                                    <p>残り：{{ $item->item_quantity }}個</p>
                                </div>
                                <div class="mt-2">
                                    <p>￥{{ $item->price }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                </div>
                    <h1 class="mb-4 text-danger text-center">商品が見つかりませんでした</h1>
                    <div class="text-center">
                        {!! link_to_route('items.index', 'トップページへ', [], ['class'=>'btn btn-primary']) !!}
                    </div>
                @endif
                </div>
                <div class="mt-4">
                    {{ $items->appends(['keyword'=>$keyword])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection