@extends('layouts.app')

@section('content')
    <div class="text-center mt-4 jumbotron">
        <h1>ご利用ありがとうございました。</h1>
    {!! link_to_route('items.index', 'トップページへ', [], ['class'=>'btn btn-primary mt-4']) !!}
    </div>
@endsection