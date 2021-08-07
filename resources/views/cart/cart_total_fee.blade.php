<div>
    <p class="mb-2">小計：￥{{ $totalPrice }}</p>
</div>
<div class="shippingFee">
    @if($totalPrice > 0)
        <p class="mb-2">送料：￥500</p>
    @else
        <p class="mb-2">送料：￥0</p>
    @endif
</div>
<div>
    @if($totalPrice > 0)
        <p class="mb-2 mt-2 h4">合計：￥{{ $totalPrice + 500 }}</p>
    @else
        <p class="mb-2 mt-2 h4">合計：￥{{ $totalPrice }}</p>
    @endif
</div>