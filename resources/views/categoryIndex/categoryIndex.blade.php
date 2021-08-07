@extends('layouts.app')

@section('content')
<h1 class="text-center mt-4 mb-4">{{ $category->category_name }}</h1>
    <div class="container mb-4">
        <div class="row">
            <div class="col-sm-8">
                @include('categoryIndex.categoryItems')
            </div>
            <div class="col-sm-4 sidebar">
                @include('sidebar.sidebar')
            </div>
        </div>
    </div>
    <div>
        {{ $category_items->links() }}
    </div>
@endsection