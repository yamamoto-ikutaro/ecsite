@extends('layouts.app')
@section('content')
    <div class="text-center">
        <h1>会員登録</h1>
    </div>
    <div class="col-sm-6 offset-sm-3">
        {!! Form::open(['route'=>'signup.post'])!!}
            <div class="form-group">
                {!! Form::label('name', '氏名') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
                @if($errors->first('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('postalCode', '郵便番号（ハイフンなし）') !!}
                {!! Form::text('postalCode', null, ['class'=>'form-control']) !!}
                @if($errors->first('postalCode'))
                    <p class="text-danger">{{ $errors->first('postalCode') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('address', '住所') !!}
                {!! Form::text('address', null, ['class'=>'form-control']) !!}
                @if($errors->first('address'))
                    <p class="text-danger">{{ $errors->first('address') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
                @if($errors->first('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('telephone', '電話番号（ハイフンなし）') !!}
                {!! Form::text('telephone', null, ['class'=>'form-control']) !!}
                @if($errors->first('telephone'))
                    <p class="text-danger">{{ $errors->first('telephone') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('password', 'パスワード') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
                @if($errors->first('password'))
                    <p class="text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('password_confirmation', 'パスワード確認') !!}
                {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                @if($errors->first('password_confirmation'))
                    <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                @endif
            </div>
            <div class="text-center">
                {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection