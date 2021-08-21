<div>
  {!! Form::open(['route'=>'searchIndex', 'method'=>'get']) !!}
    {!! Form::label('keyword', '▼商品を検索') !!}
    <div class = "form-group input-group">
      {!! Form::text('keyword', null, ['class'=>'form-control', 'placeholder'=>'キーワードを入力']) !!}
      {!! Form::button('<i class="fas fa-search"></i>', ['class' => "btn input-group-text", 'type' => 'submit']) !!}
    </div>
    @if($errors->first('keyword'))
        <p class="text-danger">{{ $errors->first('keyword') }}</p>
    @endif
  {!! Form::close() !!}
</div>

<div class="dropdown open">
  <p class="bg-secondary text-white text-left p-2 mb-0 rounded">カテゴリー一覧</p>
  <ul class="list-unstyled col p-0 list-group">
    @foreach($categories as $category)
      <li class="category">{!! link_to_route('category.show', $category->category_name, [$category->id], ['class'=>'list-group-item text-secondary']) !!}</li>
    @endforeach
  </ul>
</div>