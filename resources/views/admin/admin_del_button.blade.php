{!! Form::open(['route' => ['admin_item.delete', $item->id], 'method' => 'delete']) !!}
    {!! Form::submit('削除', ['class'=>'btn btn-danger']) !!}
{!! Form::close() !!}