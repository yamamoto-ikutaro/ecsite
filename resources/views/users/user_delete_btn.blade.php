{!! Form::open(['route'=>['user.delete', Auth::id()], 'method'=>'delete']) !!}
    {!! Form::submit('退会', ['class'=>'btn btn-danger mt-2 mb-2']) !!}
{!! Form::close() !!}