<div class="pl-0">
    <div class="mt-4">
        <p class="h5">▼お届け先</p>
    </div>
    <div>
        {!! Form::open(['route'=>'order']) !!}
            <div class="form-group">
                {!! Form::label('name', '氏名') !!}
                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
                @if($errors->first('name'))
                    <p class="text-danger">{{ $errors->first('name') }}</p>
                @endif
            </div>
            <div class="form-group">
            <div class="form-group">
                {!! Form::label('postalCode', '郵便番号') !!}
                {!! Form::text('postalCode', Auth::user()->postalCode, ['class' => 'form-control']) !!}
                @if($errors->first('postalCode'))
                    <p class="text-danger">{{ $errors->first('postalCode') }}</p>
                @endif
            </div>
                {!! Form::label('address', '住所') !!}
                {!! Form::text('address', Auth::user()->address, ['class' => 'form-control']) !!}
                @if($errors->first('address'))
                    <p class="text-danger">{{ $errors->first('address') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
                @if($errors->first('email'))
                    <p class="text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form-group">
                {!! Form::label('telephone', '電話番号') !!}
                {!! Form::text('telephone', Auth::user()->telephone, ['class' => 'form-control']) !!}
                @if($errors->first('telephone'))
                    <p class="text-danger">{{ $errors->first('telephone') }}</p>
                @endif
            </div>
            @if($totalPrice > 0)
                <div>
                    {!! Form::submit('注文', ['class'=>'btn btn-primary mb-4']) !!}
                </div>
            @endif
        {!! Form::close() !!}
    </div>
</div>