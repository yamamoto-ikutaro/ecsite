@if(Auth::check())
    @if(App\Cart::where('user_id', Auth::id())->where('item_id', $item->id)->first())
        <p class="font-weight-bold text-success">カート追加済み</p>
    @else
        {!! Form::open(['route' => ['cart_item.add', $item->id]]) !!}
            {!! Form::submit('カートに追加', ['class'=>'btn btn-primary mb-4']) !!}
        {!! Form::close() !!}
    @endif
@endif