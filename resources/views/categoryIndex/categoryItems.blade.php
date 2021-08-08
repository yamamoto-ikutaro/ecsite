<div class="row">
@foreach($category_items as $category_item)
    <div class="card col-md-4">
        <div class="mt-2">
            <a href="{{ route('items.show', ['id'=>$category_item->id]) }}">
                <img src="{{ Storage::disk('s3')->url($category_item->image_url) }}" alt="item-img" class="card-img-top">
            </a>
        </div>
        <div class="card-body pl-0">
            <div class="mt-2">
                <p>商品名：{{ $category_item->item_title }}</p>
            </div>
            {!! nl2br(e($category_item->content)) !!}
            <div class="mt-2">
                <p>￥{{ $category_item->price }}</p>
            </div>
            <div class="mt-2">
                <p>残り：{{ $category_item->item_quantity }}個</p>
            </div>
        </div>
    </div>
@endforeach
</div>