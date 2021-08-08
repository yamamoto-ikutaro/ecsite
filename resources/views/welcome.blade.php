@extends('layouts.app')
@section('content')
@if(Auth::check())
    @if(Auth::user()->role == 'admin')
      <h1 class="text-center">管理者用・商品一覧</h1>
    @endif
    @else
      <h1 class="text-center mt-4 mb-4">商品一覧</h1>
@endif

<!--<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">-->
<!--  <div class="carousel-inner" id="top_images">-->
<!--    <div class="carousel-item active">-->
<!--      <img class="d-block top-image" src="{{ asset('top_images/森風景.jpg') }}" alt="First slide">-->
<!--    </div>-->
<!--    <div class="carousel-item">-->
<!--      <img class="d-block top-image" src="{{ asset('top_images/田んぼ風景.jpg') }}" alt="Second slide">-->
<!--    </div>-->
<!--    <div class="carousel-item">-->
<!--      <img class="d-block top-image" src="{{ asset('top_images/川風景.jpg') }}" alt="Third slide">-->
<!--    </div>-->
<!--  </div>-->
<!--  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">-->
<!--    <span class="carousel-control-prev-icon" aria-hidden="true"></span>-->
<!--    <span class="sr-only">Previous</span>-->
<!--  </a>-->
<!--  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">-->
<!--    <span class="carousel-control-next-icon" aria-hidden="true"></span>-->
<!--    <span class="sr-only">Next</span>-->
<!--  </a>-->
<!--</div>-->
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
    <div>
        {{ $items->links() }}
    </div>
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
@endsection