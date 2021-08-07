@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>ログイン</h1>
    </div>
    <div class="col-sm-6 offset-sm-3">
        {!! Form::open(['route'=>'login.post']) !!}
            <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', null, ['class'=>'form-control']) !!}
            @if($errors->first('email'))
                <p class="text-danger">{{ $errors->first('email') }}</p>
            @endif
            </div>
            <div class="form-group">
            {!! Form::label('password', 'パスワード') !!}
            {!! Form::password('password', ['class'=>'form-control']) !!}
            @if($errors->first('password'))
                <p class="text-danger">{{ $errors->first('password') }}</p>
            @endif
            </div>
            <div class="text-center">
                {!! Form::submit('ログイン', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
        
        <p class="mt-2">会員登録がまだの方は{!! link_to_route('signup.get', 'こちらをクリック') !!}</p>
    </div>
@endsection