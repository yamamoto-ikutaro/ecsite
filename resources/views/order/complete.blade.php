@extends('layouts.app')

@section('content')
<div class="text-center jumbotron mt-4">
    <h2 class="mb-4">{{ Auth::user()->name }} 様</h2>
    <h1 class="mb-4">ご注文ありがとうございました。</h1>
    {!! link_to_route('items.index', 'トップページへ', [], ['class'=>'btn btn-primary']) !!}
</div>
@endsection