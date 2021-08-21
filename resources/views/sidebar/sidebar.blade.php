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
  <button class="btn btn-secondary btn-block" type="button" id="dropdownMenu5" data-toggle="dropdown">
    <div class="d-flex">
        <div>カテゴリー一覧</div>
    </div>
  </button>
  <ul class="list-unstyled col mt-4 list-group">
    @foreach($categories as $category)
      <li class="category">{!! link_to_route('category.show', $category->category_name, [$category->id], ['class'=>'list-group-item text-secondary']) !!}</li>
    @endforeach
  </ul>
</div>