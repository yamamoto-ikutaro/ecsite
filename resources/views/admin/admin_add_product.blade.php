@extends('layouts.app')

@section('content')
@if(Auth::check())
    @if(Auth::user()->role == 'admin')
        <div class="text-center mt-4" style=height:150px>
            <h1>管理者用・商品の追加</h1>
        </div>
        
        <div>
        {!! Form::open(['route'=>'add_product', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('item_title', '商品名：', ['class'=>'text-right', 'style'=>'width:100px;']) !!}
                {!! Form::text('item_title', null) !!}
                @if($errors->first('item_title'))
                    <p class="text-danger">{{ $errors->first('item_title') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('image', '画像：', ['class'=>'text-right', 'style'=>'width:100px;']) !!}
                {!! Form::file('image') !!}
                @if($errors->first('image'))
                    <p class="text-danger">{{ $errors->first('image') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('price', '値段：', ['class'=>'text-right', 'style'=>'width:100px;']) !!}
                {!! Form::number('price', null, ['class'=>'col-sm-1', 'min'=>0]) !!}
                @if($errors->first('price'))
                    <p class="text-danger">{{ $errors->first('price') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('category_id', 'カテゴリー：', ['class'=>'text-right', 'style'=>'width:100px;']) !!}
                {!! Form::select('category_id', $categories, null) !!}
            </div>
            <div class="form-group">
                {!! Form::label('item_quantity', '商品個数：', ['class'=>'text-right', 'style'=>'width:100px;']) !!}
                {!! Form::number('item_quantity', null, ['class' => 'col-sm-1', 'min'=>0]) !!}
                @if($errors->first('item_quantity'))
                    <p class="text-danger">{{ $errors->first('item_quantity') }}</p>
                @endif
            </div>
            <div class="form-group row">
                {!! Form::label('content', '商品説明：', ['class'=>'text-right', 'style'=>'width:115px; margin-right:3px;']) !!}
                {!! Form::textarea('content', null, ['class'=>'col-sm-8']) !!}
                @if($errors->first('content'))
                    <p class="text-danger">{{ $errors->first('content') }}</p>
                @endif
            </div>
            {!! Form::submit('追加', ['class' => 'btn btn-primary mb-4', 'style'=>'margin-left:102px;']) !!}
        {!! Form::close() !!}
        <div>
    @endif
@endif
@endsection