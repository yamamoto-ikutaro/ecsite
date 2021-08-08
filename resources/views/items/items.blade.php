<div class="row">
@foreach($items as $item)
    <div class="card col-md-4">
        <div class="mt-2 image_box">
            <a href="{{ route('items.show', ['id'=>$item->id]) }}">
                <img src="{{ Storage::disk('s3')->url($item->image_url) }}" alt="item-img" class="card-img-top">
            </a>
        </div>
        <div class="card-body mt-5 pt-5">
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
</div>
<div class="mt-3">
    {{ $items->links() }}
</div>