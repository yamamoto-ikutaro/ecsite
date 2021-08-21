@extends('layouts.app')
@section('content')
@if(Auth::check())
    @if(Auth::user()->role == 'admin')
      <h1 class="text-center">管理者用・商品一覧</h1>
    @endif
    @else
      <h1 class="text-center mt-4 mb-4">商品一覧</h1>
@endif

<section class="carousel">
  <div class="image_container">
    <ul id="img_list">
      <li><img src="{{ asset('top_images/果物.jpg') }}"></li>
      <li><img src="{{ asset('top_images/野菜.jpg') }}"></li>
      <li><img src="{{ asset('top_images/お米.jpg') }}"></li>
    </ul>
    <button id="prev">&laquo;</button>
    <button id="next">&raquo;</button>
  </div>
  
  <nav id="img_nav">
  </nav>
</section>

@if(Auth::check())
    @if(Auth::user()->role == 'admin')
    {!! link_to_route('add_product_screen', '商品の追加', [], ['class'=>'btn btn-primary mb-4']) !!}
    @endif
@endif
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-8">
                @include('items.items')
            </div>
            <div class="col-md-4 sidebar">
                @include('sidebar.sidebar')
            </div>
        </div>
    </div>
    <div>
        {{ $items->links() }}
    </div>
@endsection